<?php
$connection = openSQLConnexion();
$donneesSQL = select($connection, "SELECT l.name AS linkName, link, l.description AS linkDescription, c.name AS categoryName, c.description AS categoryDescription, c.id FROM links AS l LEFT JOIN category AS c ON CATEGORY_id = c.id ORDER BY c.id, l.id");
closeSQLConnexion($connection);
include 'include/links/view.php';
?>