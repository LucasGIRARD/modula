<?php
if (!empty($_POST['nick']) AND !empty($_POST['password']) AND !empty($_POST['email'])) {
    $nick = $_POST['nick'];
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
    $admin = $_POST['admin'];
    include('../include/rfc822.php');
    if (is_valid_email_address($_POST['email'])) {
        $DBC = mysql_connect("localhost", "root", "");
        mysql_select_db("creative");
        $q = "INSERT INTO member (timestamp1, firstName, lastName, birthday, gender, country, department, town, email, steamFriend, nick, password, admin) VALUES (NOW(), '$firstName', '$lastName', '$birthday', '$gender', '$country', '$department', '$town', '$email', '$steamFriend', '$nick', '$password', $admin)";
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
echo $message;
?>