<?php

if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");    
}
$idMember = $_GET['id'];
$action = "modify";

$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");

$donneesSQL = mysql_query("SELECT firstName, lastName, gender, country, department, town, email, steamFriend, nick, password, admin, DATE_FORMAT(timestamp1,'%d') AS day, DATE_FORMAT(timestamp1,'%m') AS month, DATE_FORMAT(timestamp1,'%Y') AS year, DATE_FORMAT(timestamp1,'%H') AS hour, DATE_FORMAT(timestamp1,'%i') AS minute, DATE_FORMAT(birthday,'%d') AS bday, DATE_FORMAT(birthday,'%m') AS bmonth, DATE_FORMAT(birthday,'%Y') AS byear FROM member WHERE id=$idMember");
mysql_close($DBC); 
$donnees = mysql_fetch_array($donneesSQL);

$nick = $donnees['nick'];
$bday = $donnees['bday'];
$bmonth = $donnees['bmonth'];
$byear = $donnees['byear'];
$day = $donnees['day'];
$month = $donnees['month'];
$year = $donnees['year'];
$hour = $donnees['hour'];
$minute = $donnees['minute'];
$firstName = $donnees['firstName'];
$lastName = $donnees['lastName'];
$gender = $donnees['gender'];
$country = $donnees['country'];
$department = $donnees['department'];
$town = $donnees['town'];
$email = $donnees['email'];
$steamFriend = $donnees['steamFriend'];
$password = $donnees['password'];
$admin = $donnees['admin'];

include('formMember.php');
?>