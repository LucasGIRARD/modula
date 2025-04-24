<?php

$numberMap = $_POST['numberMap'];
$idMatch = $_POST['idMatch'];

for ($i = 0; $i < $numberMap; $i++) {
    $name = $_POST['name' . $i];
    $firstSide = $_POST['firstSide' . $i];
    $resultSide1Us = $_POST['resultSide1Us' . $i];
    $resultSide1Them = $_POST['resultSide1Them' . $i];
    $resultSide2Us = $_POST['resultSide2Us' . $i];
    $resultSide2Them = $_POST['resultSide2Them' . $i];
    $rapport = $_POST['rapport' . $i];
    $DBC = mysql_connect("localhost", "root", "");
    mysql_select_db("creative");
    $q = "INSERT INTO map (side1CT, resultSide1Us, resultSide2Us, resultSide1Them, resultSide2Them, rapport, name, MATCH_id) VALUES ($firstSide, $resultSide1Us, $resultSide2Us, $resultSide1Them, $resultSide2Them, '$rapport', '$name', $idMatch)";
    echo $q;
    if (mysql_query($q)) {
        $message = "Map ajouté.";
    } else {
        $message = "Une erreur s'est produite.";
    }
    mysql_close($DBC);
}
echo $message;
?>