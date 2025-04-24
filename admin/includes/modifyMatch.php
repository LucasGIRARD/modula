<?php
if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");    
}

$idWar = $_GET['id'];
$action = "modify";

$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT LINEUP_id, OPPONENT_id, TYPE_id, DATE_FORMAT(timestamp1,'%d') AS day, DATE_FORMAT(timestamp1,'%m') AS month, DATE_FORMAT(timestamp1,'%Y') AS year, DATE_FORMAT(timestamp1,'%H') AS hour, DATE_FORMAT(timestamp1,'%i') AS minute FROM war WHERE id=$idWar");
mysql_close($DBC); 
$donnees = mysql_fetch_array($donneesSQL);
	 

$day = $donnees['day'];
$month = $donnees['month'];
$year = $donnees['year'];
$hour = $donnees['hour'];
$minute = $donnees['minute'];
$opponent = $donnees['OPPONENT_id'];
$lineup = $donnees['LINEUP_id'];
$type = $donnees['TYPE_id'];
include('formMatch.php');
?>