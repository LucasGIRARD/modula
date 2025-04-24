<?php
if (!isset($_SESSION['pseudo']) OR !isset($_SESSION['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}
$idMember = $_SESSION['id'];



include 'include/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT firstName, lastName, gender, country, department, town, email, steamFriend, nick, DATE_FORMAT(birthday,'%d') AS birthday, DATE_FORMAT(birthday,'%m') AS birthmonth, DATE_FORMAT(birthday,'%Y') AS birthyear, monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM member AS m LEFT JOIN availability AS a ON ( MEMBER_id = m.id ) WHERE m.id=?",array($idMember));
closeSQLConnexion($connection);
$donnees=$donneesSQL[0];
$donneesSQL=null;

$availability = '0'.$donnees['monday'].'0'.$donnees['tuesday'].'0'.$donnees['wednesday'].'0'.$donnees['thursday'].'0'.$donnees['friday'].'0'.$donnees['saturday'].'0'.$donnees['sunday'];

$nick = $donnees['nick'];
$birthday = $donnees['birthday'];
$birthmonth = $donnees['birthmonth'];
$birthyear = $donnees['birthyear'];
$firstName = $donnees['firstName'];
$lastName = $donnees['lastName'];
$gender = $donnees['gender'];
$country = $donnees['country'];
$department = $donnees['department'];
$town = $donnees['town'];
$email = $donnees['email'];
$steamFriend = $donnees['steamFriend'];

include 'include/account/view.php';
?>
