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
                $host = 'mysql:host=localhost;dbname=creative';
                $user = 'root';
                $password = '';
                $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                $connection = new PDO($host, $user, $password, $option);

// Préparation de notre requête
                if (!$resultats = $connection->prepare("SELECT id, LINEUP_id FROM member AS m LEFT JOIN member_lineup ON ( m.id = MEMBER_id ) WHERE nick=? AND password=?")) {
                    list($pdoCode, $internalCode, $msg) = $connection->errorInfo();
                    die(sprintf("La préparation de la requête a échoué : %d/%d, %s", $pdoCode, $internalCode, $msg));
                }
// Exécution, une première fois de la requête, avec nos valeurs
                if (!$resultats->execute(array($_POST['pseudo'], hash('sha256', $_POST['pass'])))) {
                    list($pdoCode, $internalCode, $msg) = $insert->errorInfo();
                    die(sprintf("L'exécution de la requête a échoué : %d/%d, %s", $pdoCode, $internalCode, $msg));
                }
                $donnees = $resultats->fetch();
                if ($resultats->rowCount() == 1) {
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
                $resultats->closeCursor(); // on ferme le curseur des résultats
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
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                $q = "INSERT INTO member (timestamp1, firstName, lastName, birthday, gender, country, department, town, email, steamFriend, nick, password) VALUES (NOW(), '$firstName', '$lastName', '$birthday', '$gender', '$country', '$department', '$town', '$email', '$steamFriend', '$pseudo', '$password')";
                if (mysql_query($q)) {
                    $message = "Vous êtes bien enregistré.";
                } else {
                    $message = "Une erreur s'est produite.";
                }
                mysql_close($DBC);
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
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                $q = "INSERT INTO contact (object, message, timestamp1, MEMBER_id) VALUES ('$object', '$message', NOW(), $memberID)";
                if (mysql_query($q)) {
                    $message = "Votre message à été envoyé.";
                } else {
                    $message = "Une erreur s'est produite.";
                }
                mysql_close($DBC);
            } else {
                $message = "Le ou les champs suivant n'ont pas été remplies : objet et message.";
            }
        } else {
            $message = "Vous devez être inscrit pour pouvoir nous contacter.";
        }
        break;
    case 'recruit':
        if (isset($_SESSION['pseudo'])) {
            if (isset($_POST['steamFriend'])) {
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                mysql_query("UPDATE member SET steamFriend=" . $_POST['steamFriend'] . " WHERE id=" . $_SESSION['id']);
                mysql_close($DBC);
            }
            if (isset($_POST['birthday'])) {
                $birthday = $_POST['birthyear'] . '-' . $_POST['birthmonth'] . '-' . $_POST['birthday'];
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                mysql_query("UPDATE member SET birthday=" . $birthday . " WHERE id=" . $_SESSION['id']);
                mysql_close($DBC);
            }
            if (isset($_POST['country'])) {
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                mysql_query("UPDATE member SET country=" . $_POST['country'] . " WHERE id=" . $_SESSION['id']);
                mysql_close($DBC);
            }
            if (isset($_POST['department'])) {
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                mysql_query("UPDATE member SET department=" . $_POST['department'] . " WHERE id=" . $_SESSION['id']);
                mysql_close($DBC);
            }
            if (isset($_POST['town'])) {
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                mysql_query("UPDATE member SET town=" . $_POST['town'] . " WHERE id=" . $_SESSION['id']);
                mysql_close($DBC);
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
                $DBC = mysql_connect("localhost", "root", "");
                mysql_select_db("creative");
                if (mysql_query("INSERT INTO recruitment (timestamp1, microphone, TS3, WIRE, knowUs, other, MEMBER_id, GAME_id) VALUES (NOW(), $microphone, $TS3, $WIRE, $knowUs, '$other', $MEMBER_id, $GAME_id)")) {
                    if (mysql_query("INSERT INTO cs (experience, level, weaponTP, weaponTA, weaponCTP, weaponCTA, nick, steamId, GAME_id, MEMBER_id) VALUES ($experience, $level, $weaponTP, $weaponTA, $weaponCTP, $weaponCTA, '$nick', '$steamId', $GAME_id, $MEMBER_id)")) {
                        $a = "INSERT INTO availability (MEMBER_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES ($MEMBER_id, '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday')";
                        if (mysql_query($a)) {
                            $message = "Vous êtes bien enregistré.";
                        }
                    }
                } else {
                    $message = "Une erreur s'est produite.";
                }
                mysql_close($DBC);
            } else {
                $message = "Le ou les champs suivant n'ont pas été remplies : objet et message.";
            }
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
        $DBC = mysql_connect("localhost", "root", "");
        mysql_select_db("creative");
        if (mysql_query("INSERT INTO away (departure, `return`, message, MEMBER_id) VALUES ('$departure', '$return', '$message', $id)")) {
            $message = "Votre absence est bien enregistré.";
        } else {
            $message = "Votre absence n'est pas enregistré.Une erreur s'est produite.";
        }
        mysql_close($DBC);
        break;
    case 'deleteAway':
        $id = $_POST['id'];
        $mid = $_SESSION['id'];
        $DBC = mysql_connect("localhost", "root", "");
        mysql_select_db("creative");
        mysql_query("DELETE FROM away WHERE id='".$id."' AND MEMBER_id='".$mid."'");
        if (mysql_affected_rows() == 1) {
            $message = "Votre absence est bien effacée.";
        } else {
            $message = "Votre absence n'est pas effacée.Une erreur s'est produite.";
        }
        mysql_close($DBC);
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
        $DBC = mysql_connect("localhost", "root", "");
        mysql_select_db("creative");
        $a = "UPDATE availability SET monday='$monday', tuesday='$tuesday', wednesday='$wednesday', thursday='$thursday', friday='$friday', saturday='$saturday', sunday='$sunday' WHERE MEMBER_id=" . $_SESSION['id'];
        echo $a;
        mysql_query($a) or die('Requête invalide : ' . mysql_error());
        mysql_query("UPDATE member SET nick=$nick, lastName=$lastName, firstName=$firstName, birthday=$birthday, gender=$gender, country=$country, department=$department, town=$town, email=$email, steamFriends=$steamFriends WHERE id=" . $_SESSION['id']);
        mysql_close($DBC);
        break;
}



echo "<div>$message</div>";
?>
