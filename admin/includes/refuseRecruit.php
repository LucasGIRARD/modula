<?php
$id = $_GET['id'];
$csid = $_GET['csid'];
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
mysql_query("DELETE FROM recruitment WHERE id='$id'");
if (mysql_affected_rows() == 1) {
    mysql_query("DELETE FROM cs WHERE id='$csid'");
    if (mysql_affected_rows() == 1) {
        $message = "La demande de recrutement à été effacée.";
    } else {
        $message = "Une erreur s'est produite.";
    }
} else {
    $message = "Une erreur s'est produite.";
}
mysql_close($DBC);
?>
