<?php
$id = $_GET['id'];
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
mysql_query("DELETE FROM server WHERE id='$id'");
if (mysql_affected_rows() == 1) {
    $message = "Le serveur est bien effacé.";
} else {
    $message = "Une erreur s'est produite.";
}
mysql_close($DBC);
?>
