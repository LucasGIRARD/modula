<?php
$connection = openSQLConnexion();
$donneesSQL = select($connection, "SELECT d.id, title, c.name, description, extension FROM download AS d LEFT JOIN category AS c ON CATEGORY_id = c.id LEFT JOIN extension_name AS en ON en.id = d.EXTENSION_NAME_id LEFT JOIN extension AS e ON e.EXTENSION_NAME_id = en.id ORDER BY c.id, d.id");
closeSQLConnexion($connection);
include 'include/download/view.php';
?>


