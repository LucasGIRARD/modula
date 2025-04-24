<?php

if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idMember = $_GET['id'];
    }
} else {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT DATE_FORMAT( timestamp1, '%d/%m/%Y | %H:%i' ) AS timestamp1, firstName, lastName,DATE_FORMAT( birthday, '%d/%m/%Y' ) AS birthday, gender, country, department, town, email, steamFriend, nick FROM member WHERE id=" . $idMember);
mysql_close($DBC);
$donnees = mysql_fetch_array($donneesSQL);
if ($donnees['gender'] = "m"){
    $gender = "Homme";
}
 else {
    $gender = "Femme";
}
echo "<div id='member'>
<span class='key'>pseudo : </span>" . $donnees['nick'] . "<br />
<span class='key'>genre : </span>" . $gender . "<br />
<span class='key'>nom : </span>" . $donnees['lastName'] . "<br />
<span class='key'>prénom : </span>" . $donnees['firstName'] . "<br />
<span class='key'>date d'anniversaire : </span>" . $donnees['birthday'] . "<br />
<span class='key'>Pays : </span>" . $donnees['country'] . "<br />
<span class='key'>Département : </span>" . $donnees['department'] . "<br />
<span class='key'>Ville : </span>" . $donnees['town'] . "<br />
<span class='key'>email : </span>" . $donnees['email'] . "<br />
<span class='key'>Steam Amis : </span>" . $donnees['steamFriend'] . "<br />
<span class='key'>date d'inscription : </span>" . $donnees['timestamp1'] . "</div>";
?>