<?php

if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");    
}
$idNews = $_GET['id'];
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT title, intro, content, CATEGORY_id, MEMBER_id, DATE_FORMAT(timestamp1,'%d') AS day, DATE_FORMAT(timestamp1,'%m') AS month, DATE_FORMAT(timestamp1,'%Y') AS year, DATE_FORMAT(timestamp1,'%H') AS hour, DATE_FORMAT(timestamp1,'%i') AS minute FROM news WHERE id=$idNews");
mysql_close($DBC); 
$donnees = mysql_fetch_array($donneesSQL);


$title = $donnees['title'];
$day = $donnees['day'];
$month = $donnees['month'];
$year = $donnees['year'];
$hour = $donnees['hour'];
$minute = $donnees['minute'];
$category = $donnees['CATEGORY_id'];
$intro = $donnees['intro'];
$content = $donnees['content'];
$idMember = $donnees['MEMBER_id'];
$action = "modify";
include('formNews.php');
?>
