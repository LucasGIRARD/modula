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
include 'includes/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT DATE_FORMAT(created, '%d/%m/%Y | %H:%i' ) AS created, firstName, lastName,DATE_FORMAT( birthday, '%d/%m/%Y' ) AS birthday, gender, country, department, town, email, steamFriend, nick FROM member WHERE id=?",array($idMember));
closeSQLConnexion($connection);
$donnees=$donneesSQL[0];
$donneesSQL=null;
if ($donnees['gender'] == "m"){
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
<span class='key'>date d'inscription : </span>" . $donnees['created'] . "</div>";
?>