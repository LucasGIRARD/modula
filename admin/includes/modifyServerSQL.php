<?php
if (!empty($_POST['ip'])) {
$number = $_POST['number'];
$ip = $_POST['ip'];
$description = $_POST['description'];
$type = $_POST['type'];
$password = $_POST['password'];
$idServer = $_POST['idServer'];
    $DBC = mysql_connect("localhost", "root", "");
    mysql_select_db("creative");

     $q = "UPDATE server SET number='$number', ip='$ip', description='$description', TYPE_SERVER_id='$type', password='$password' WHERE id=" . $idServer;
    
    if (mysql_query($q)) {
        $message = "Serveur modifié.";
    } else {
        $message = "Une erreur s'est produite.";
    }
    mysql_close($DBC);
} else {
    $message = "Le ou les champs suivant n'ont pas été remplies : ip.";
}
?>