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
    $idMember = $_POST['idMember'];
    include('../include/rfc822.php');
    if (is_valid_email_address($_POST['email'])) {
        $DBC = mysql_connect("localhost", "root", "");
        mysql_select_db("creative");
        $q = "UPDATE member SET firstName='$firstName', lastName='$lastName', birthday='$birthday', gender='$gender', country='$country', department='$department', town='$town', email='$email', steamFriend='$steamFriend', nick='$nick', password='$password', admin=$admin WHERE id=" . $idMember;
        if (mysql_query($q)) {
            $message = "Membre modifé.";
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