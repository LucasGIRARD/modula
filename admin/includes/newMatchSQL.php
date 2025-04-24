<?php
if (!empty($_POST['otherOpponentName']) AND !empty($_POST['otherOpponentWebsite'])) {
    $otherOpponentName = $_POST['otherOpponentName'];
    $otherOpponentWebsite = $_POST['otherOpponentWebsite'];
    $DBC = mysql_connect("localhost", "root", "");
    mysql_select_db("creative");
    $q = "INSERT INTO opponent (name, site) VALUES ('$otherOpponentName' , '$otherOpponentWebsite')";
    if (mysql_query($q)) {
        $message = "Opposant Ajouté.";
        $opponent = mysql_insert_id();
    } else {
        $message = "Une erreur s'est produite.";
    }
    mysql_close($DBC);    
} else {
    $opponent = $_POST['opponent'];
}
$timestamp1 = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' ' . $_POST['hour'] . ':' . $_POST['minute'] . ':00';
$lineup = $_POST['lineup'];
$type = $_POST['type'];

$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$q = "INSERT INTO war (timestamp1, LINEUP_id, OPPONENT_id, TYPE_id) VALUES ('$timestamp1', $lineup, $opponent, $type)";
if (mysql_query($q)) {
    $message = "Match bien enregistré.";
} else {
    $message = "Une erreur s'est produite.";
}
mysql_close($DBC);
?>