<?php

if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idMatch = $_GET['id'];
    }
} else {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT DATE_FORMAT(w.timestamp1,'%d/%m/%Y | %H:%i') AS timestamp1, l.name AS 'lineup', o.name AS 'opponent', site, network, t.name AS 'type'
FROM war AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_war AS t ON ( TYPE_id = t.id )
WHERE w.id=" . $idMatch);
$donneesSQL2 = mysql_query("SELECT side1CT, resultSide1Us, resultSide2Us, resultSide1Them, resultSide2Them, rapport, name FROM map WHERE MATCH_id=" . $idMatch);
mysql_close($DBC);
$donnees = mysql_fetch_array($donneesSQL);
echo "<div id='match'>
<span class='key'>Date : </span>" . $donnees['timestamp1'] . "<br />
<span class='key'>Lineup : </span>" . $donnees['lineup'] . "<br />
<span class='key'>Adversaire : </span>";
if (!empty($donnees['site'])) {
    echo "<a href='http://" . $donnees['site'] . "'>" . $donnees['opponent'] . "</a>";
} else {
    echo $donnees['opponent'];
}
echo "<br />
<span class='key'>Réseau : </span>" . $donnees['network'] . "<br />
<span class='key'>Type : </span>" . $donnees['type'] . "<br />
<span class='key'>Nombre de map : </span>" . mysql_num_rows($donneesSQL2) . "<br />";
$i = 1;
while ($donnees = mysql_fetch_array($donneesSQL2)) {
    if ($donnees['side1CT'] == '1') {
        $side = "CT";
    } elseif ($donnees['side1CT'] == '0') {
        $side = "Terro";
    } else {
        $side = "Non renseigné";
    }
    if (!empty($donnees['name'])) {
        $name = $donnees['name'];
    } else {
        $name = "Non renseigné";
    }
    if ($donnees['side1CT'] == '1') {
        $side = "CT";
    }
    elseif ($donnees['side1CT'] == '0') {
        $side = "Terro";
    }
    else {
        $side = "Non renseigné";
    }
    if (!empty($donnees['resultSide1Us'])) {
        $resultSide1Us = $donnees['resultSide1Us'];
    }
    else {
        $resultSide1Us = "Non renseigné";
    }
    if (!empty($donnees['resultSide1Them'])) {
        $resultSide1Them = $donnees['resultSide1Them'];
    }
    else {
        $resultSide1Them = "Non renseigné";
    }
    if (!empty($donnees['resultSide2Us'])) {
        $resultSide2Us = $donnees['resultSide2Us'];
    }
    else {
        $resultSide2Us = "Non renseigné";
    }
    if (!empty($donnees['resultSide2Them'])) {
        $resultSide2Them = $donnees['resultSide2Them'];
    }
    else {
        $resultSide2Them = "Non renseigné";
    }
    if (!empty($donnees['rapport'])) {
        $rapport = $donnees['rapport'];
    }
    else {
        $rapport = "Non renseigné";
    }
    echo "<div class='map'><span class='key'>Map N° $i</span><br />
    <span class='key'>Nom de la map : </span>" . $name . "<br />
    <span class='key'>Premier side : </span>" . $side . "<br />
    <span class='key'>Résultat 1<sup>er</sup> side : </span>" . $resultSide1Us . "/" . $resultSide1Them . "<br />
    <span class='key'>Résultat 2<sup>ème</sup> side : </span>" . $resultSide2Us . "/" . $resultSide2Them . "<br />
    <span class='key'>Rapport : </span>" . $rapport . "</div>";
    $i++;
}
?>




