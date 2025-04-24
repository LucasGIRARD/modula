<?php
$id = $_GET['id'];
$mid = $_GET['mid'];
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
mysql_query("DELETE FROM recruitment WHERE id='$id'");
if (mysql_affected_rows() == 1) {
     $q = "INSERT INTO member_lineup (MEMBER_id, LINEUP_id, rang) VALUES ('$mid', '1', '')";
    if (mysql_query($q)) {
        $message = "Le membre à integré la team.";
    } else {
        $message = "Une erreur s'est produite.";
    }
    
} else {
    $message = "Une erreur s'est produite.";
}
mysql_close($DBC);
?>
