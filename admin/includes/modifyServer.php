<?php
if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");    
}

$idServer = $_GET['id'];
$action = "modify";

$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT number, IP, description, TYPE_SERVER_id, password FROM server WHERE id=$idServer");
mysql_close($DBC); 
$donnees = mysql_fetch_array($donneesSQL);

$number = $donnees['number'];
$ip = $donnees['IP'];
$description = $donnees['description'];
$type = $donnees['TYPE_SERVER_id'];
$password = $donnees['password'];

include('formServer.php');
?>