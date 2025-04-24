<?php

$connection = openSQLConnexion();
$donneesSQL = select($connection, "SELECT id,name FROM object");
closeSQLConnexion($connection);
require_once('include/recaptcha/recaptchalib.php');
$publickey = "6Lf5_9USAAAAAIXWAoRmc4fBtbzQ_SHtqOFV9qIA ";
include 'include/contact/view.php';
?>