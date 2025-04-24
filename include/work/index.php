<?php

if (!isset($_POST['action'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}
switch ($_POST['action']) {
    case 'connect':
        if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
            if (empty($_POST['pseudo']) && empty($_POST['pass'])) {
                $message = "le champ pseudo et password n'ont pas été remplies !";
            } elseif (empty($_POST['pseudo'])) {
                $message = "le champ pseudo n'a pas été remplie !";
            } elseif (empty($_POST['pass'])) {
                $message = "le champ password n'a pas été remplie !";
            } else {
                include 'include/SQL.php';
                $connection = openSQLConnexion();
                $donneesSQL = select($connection, "SELECT id, LINEUP_id FROM member AS m LEFT JOIN member_lineup ON ( m.id = MEMBER_id ) WHERE nick=? AND password=?", array($_POST['pseudo'], hash('sha256', $_POST['pass'])));
                closeSQLConnexion($connection);
                if (count($donneesSQL) == 1) {
                    $donnees = $donneesSQL[0];
                    $donneesSQL = null;
                    $_SESSION['pseudo'] = $_POST['pseudo'];
                    $_SESSION['id'] = $donnees['id'];
                    if (!empty($donnees['LINEUP_id'])) {
                        $_SESSION['LU'] = $donnees['LINEUP_id'];
                    }
                    echo "<meta http-equiv='Refresh' content='2;URL=?page=" . $_POST['page'] . "'>";
                    $message = "Vous êtes connecté!";
                } else {
                    $message = "mauvais pseudo ou pass!";
                }
            }
        }
        break;
    case 'unconnect':
        session_unset();
        session_destroy();
        echo "<meta http-equiv='Refresh' content='2;URL=?page=" . $_POST['page'] . "'>";
        $message = "Vous êtes déconnecté!";
        break;
    case 'register':
        if (!empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['email'])) {
            $pseudo = $_POST['pseudo'];
            $password = hash('sha256', $_POST['password']);
            $email = $_POST['email'];
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $birthday = $_POST['birthyear'] . '-' . $_POST['birthmonth'] . '-' . $_POST['birthday'];
            $gender = $_POST['gender'];
            $country = $_POST['country'];
            $department = $_POST['department'];
            $town = $_POST['town'];
            $steamFriend = $_POST['steamFriend'];
            include('rfc822.php');
            if (is_valid_email_address($_POST['email'])) {
                include 'include/SQL.php';
                $connection = openSQLConnexion();
                $queryOK = insertUpdate($connection, "INSERT INTO member (timestamp1, firstName, lastName, birthday, gender, country, department, town, email, steamFriend, nick, password) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(array($firstName, $lastName, $birthday, $gender, $country, $department, $town, $email, $steamFriend, $pseudo, $password)));
                closeSQLConnexion($connection);
                if ($queryOK) {
                    $message = "Vous êtes bien enregistré.";
                } else {
                    $message = "Une erreur s'est produite.";
                }
            } else {
                $message = "Email incorrect.";
            }
        } else {
            $message = "Le ou les champs suivant n'ont pas été remplies : pseudo, password, email.";
        }
        break;
    case 'contact':
        if (isset($_SESSION['pseudo'])) {
            if (!empty($_POST['object']) AND !empty($_POST['message'])) {
                $memberID = $_SESSION['id'];
                $object = $_POST['object'];
                $message = $_POST['message'];
                include 'include/SQL.php';
                $connection = openSQLConnexion();
                $queryOK = insertUpdate($connection, "INSERT INTO contact (object, message, timestamp1, MEMBER_id) VALUES (?, ?, NOW(), ?)", array(array($object, $message, $memberID)));
                closeSQLConnexion($connection);
                if ($queryOK) {
                    $message = "Votre message à été envoyé.";
                } else {
                    $message = "Une erreur s'est produite.";
                }
            } else {
                $message = "Le ou les champs suivant n'ont pas été remplies : objet et message.";
            }
        } else {
            require_once('include/recaptcha/recaptchalib.php');
            $privatekey = "6Lf5_9USAAAAAOpvPbrgvEX5kLpeQlP90jq0xXvX ";
            $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

            if (!$resp->is_valid) {
                // What happens when the CAPTCHA was entered incorrectly
                $message = "Le reCAPTCHA n'a pas été entré correctement. Revenez en arrière et essayez à nouveau.";
            } else {
                // Your code here to handle a successful verification


                if (isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['object']) && isset($_POST['message'])) {
                    $lastName = $_POST['lastName'];
                    $firstName = $_POST['firstName'];
                    $email = $_POST['email'];
                    $company = $_POST['company'];
                    $website = $_POST['website'];
                    $object = $_POST['object'];
                    $messageUser = nl2br($_POST['message']);

                    $headers = 'From: ' . $firstName . ' ' . $lastName . ' <' . $email . '>' . "\n";
                    $headers .='Reply-To: ' . $email . '' . "\n";
                    $headers .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
                    $headers .='Content-Transfer-Encoding: 8bit';

                    $sujet = "[SITE INTERNET CV] : " . $object;
                    $messageEmail = "<html><head><title>" . $sujet . "</title></head><body><b>Nom</b> : " . $lastName . "<br /><b>Prénom</b> : " . $firstName . "<br /><b>Email</b> : " . $email . "<br /><b>entreprise</b> : " . $company . "<br /><b>site internet</b> : " . $website . "<br /><b>Objet</b> : " . $object . "<br />" . $messageUser . "<br /><br />";

                    if (mail('emploi@lucas-girard.fr', $sujet, $messageEmail, $headers)) {
                        $message = "<center>Le mail a été envoyé<br />Redirection en cours.</center></body></html><meta http-equiv='refresh' content='5; URL=index.php'";
                    } else {
                        $message = 'Le mail n\'a pu être envoyé, veuillez rafraichir la page ou réessayer ultérieurement.';
                    }
                } else {
                    $message = "Le ou les champs suivants n'ont pas été remplies : Nom, Prénom, adresse e-mail, Objet, Votre message.";
                }
            }
        }
        break;
    case 'recruit':
        if (isset($_SESSION['pseudo'])) {
            include 'include/SQL.php';
            $connection = openSQLConnexion();
            if (isset($_POST['steamFriend'])) {
                $queryOK = insertUpdate($connection, "UPDATE member SET steamFriend=? WHERE id=?", array(array($_POST['steamFriend'], $_SESSION['id'])));
            }
            if (isset($_POST['birthday'])) {
                $birthday = $_POST['birthyear'] . '-' . $_POST['birthmonth'] . '-' . $_POST['birthday'];
                $queryOK = insertUpdate($connection, "UPDATE member SET birthday=? WHERE id=?", array(array($birthday, $_SESSION['id'])));
            }
            if (isset($_POST['country'])) {
                $queryOK = insertUpdate($connection, "UPDATE member SET country=? WHERE id=?", array(array($_POST['country'], $_SESSION['id'])));
            }
            if (isset($_POST['department'])) {
                $queryOK = insertUpdate($connection, "UPDATE member SET department=? WHERE id=?", array(array($_POST['department'], $_SESSION['id'])));
            }
            if (isset($_POST['town'])) {
                $queryOK = insertUpdate($connection, "UPDATE member SET town=? WHERE id=?", array(array($_POST['town'], $_SESSION['id'])));
            }

            if (!empty($_POST['game']) AND !empty($_POST['steamID']) AND !empty($_POST['nick']) AND !empty($_POST['xp']) AND !empty($_POST['level']) AND !empty($_POST['microphone']) AND !empty($_POST['TS3']) AND !empty($_POST['WIRE'])) {
                $MEMBER_id = $_SESSION['id'];

                $microphone = $_POST['microphone'];
                $TS3 = $_POST['TS3'];
                $WIRE = $_POST['WIRE'];
                $knowUs = $_POST['knowUs'];
                $other = $_POST['other'];
                $GAME_id = $_POST['game'];
                $experience = $_POST['xp'];
                $level = $_POST['level'];
                $weaponTP = $_POST['TPistol'];
                $weaponTA = $_POST['TAuto'];
                $weaponCTP = $_POST['CTPistol'];
                $weaponCTA = $_POST['CTAuto'];
                $nick = $_POST['nick'];
                $steamId = $_POST['steamID'];
                $availability = str_split($_POST['availability'], 49);
                $monday = substr($availability[0], 1);
                $tuesday = substr($availability[1], 1);
                $wednesday = substr($availability[2], 1);
                $thursday = substr($availability[3], 1);
                $friday = substr($availability[4], 1);
                $saturday = substr($availability[5], 1);
                $sunday = substr($availability[6], 1);

                $queryOK1 = insertUpdate($connection, "INSERT INTO recruitment (timestamp1, microphone, TS3, WIRE, knowUs, other, MEMBER_id, GAME_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)", array(array($microphone, $TS3, $WIRE, $knowUs, $other, $MEMBER_id, $GAME_id)));
                $queryOK2 = insertUpdate($connection, "INSERT INTO cs (experience, level, weaponTP, weaponTA, weaponCTP, weaponCTA, nick, steamId, GAME_id, MEMBER_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(array($experience, $level, $weaponTP, $weaponTA, $weaponCTP, $weaponCTA, $nick, $steamId, $GAME_id, $MEMBER_id)));
                $queryOK3 = insertUpdate($connection, "INSERT INTO availability (MEMBER_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", array(array($MEMBER_id, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday)));
                if ($queryOK1 && $queryOK2 && $queryOK3) {
                    $message = "Vous êtes bien enregistré.";
                } else {
                    $message = "Une erreur s'est produite.";
                }
            } else {
                $message = "Le ou les champs suivant n'ont pas été remplies : jeu, steam ID, pseudo, expérience, level, microphone, TS3, WIRE.";
            }
            closeSQLConnexion($connection);
        } else {
            $message = "Vous devez être inscrit pour pouvoir postuler.";
        }
        break;

        break;
    case 'away':
        $departure = $_POST['departureYear'] . '-' . $_POST['departureMonth'] . '-' . $_POST['departureDay'] . ' ' . $_POST['departureHour'] . ':' . $_POST['departureMinute'] . ':00';
        $return = $_POST['returnYear'] . '-' . $_POST['returnMonth'] . '-' . $_POST['returnDay'] . ' ' . $_POST['returnHour'] . ':' . $_POST['returnMinute'] . ':00';
        $message = $_POST['message'];
        $id = $_SESSION['id'];
        include 'include/SQL.php';
        $connection = openSQLConnexion();
        $queryOK = insertUpdate($connection, "INSERT INTO away (departure, comeback, message, MEMBER_id) VALUES (?, ?, ?, ?)", array(array($departure, $return, $message, $id)));
        closeSQLConnexion($connection);
        if ($queryOK) {
            $message = "Votre absence est bien enregistré.";
        } else {
            $message = "Votre absence n'est pas enregistré.Une erreur s'est produite.";
        }
        break;
    case 'deleteAway':
        $id = $_POST['id'];
        $mid = $_SESSION['id'];
        include 'include/SQL.php';
        $connection = openSQLConnexion();
        $queryOK = insertUpdate($connection, "DELETE FROM away WHERE id=? AND MEMBER_id=?", array(array($id, $mid), array($id, $mid)), true);
        closeSQLConnexion($connection);
        if ($queryOK[0] == 1) {
            $message = "Votre absence est effacée.";
        } else {
            $message = "Votre absence n'est pas effacée.Une erreur s'est produite.";
        }
        break;
    case 'modifyAccount':
        $nick = $_POST['nick'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $birthday = $_POST['birthyear'] . '-' . $_POST['birthmonth'] . '-' . $_POST['birthday'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $department = $_POST['department'];
        $town = $_POST['town'];
        $email = $_POST['email'];
        $steamFriends = $_POST['steamFriends'];
        $availability = str_split($_POST['availability'], 49);
        $monday = substr($availability[0], 1);
        $tuesday = substr($availability[1], 1);
        $wednesday = substr($availability[2], 1);
        $thursday = substr($availability[3], 1);
        $friday = substr($availability[4], 1);
        $saturday = substr($availability[5], 1);
        $sunday = substr($availability[6], 1);
        include 'include/SQL.php';
        $connection = openSQLConnexion();
        $queryOK = insertUpdate($connection, "UPDATE availability SET monday=?, tuesday=?, wednesday=?, thursday=?, friday=?, saturday=?, sunday=? WHERE MEMBER_id=?", array(array($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday, $_SESSION['id'])));
        $queryOK = insertUpdate($connection, "UPDATE member SET nick=?, lastName=?, firstName=?, birthday=?, gender=?, country=?, department=?, town=?, email=?, steamFriends=? WHERE id=?", array(array($nick, $lastName, $firstName, $birthday, $gender, $country, $department, $town, $email, $steamFriends, $_SESSION['id'])));
        closeSQLConnexion($connection);
        break;
}
include 'include/work/view.php';
?>