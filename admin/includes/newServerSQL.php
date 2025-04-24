<?php
if (!empty($_POST['ip'])) {
$number = $_POST['number'];
$ip = $_POST['ip'];
$description = $_POST['description'];
$type = $_POST['type'];
$password = $_POST['password'];
    $DBC = mysql_connect("localhost", "root", "");
    mysql_select_db("creative");
    $q = "INSERT INTO server (number, ip, description, TYPE_SERVER_id, password) VALUES ('$number', '$ip', '$description', $type, '$password')";
    echo $q;
    if (mysql_query($q)) {
        $message = "Serveur ajouté.";
    } else {
        $message = "Une erreur s'est produite.";
    }
    mysql_close($DBC);
} else {
    $message = "Le ou les champs suivant n'ont pas été remplies : ip.";
}
echo $message;
?>
