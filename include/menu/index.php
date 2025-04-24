<?php
include_once 'include/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT name, link FROM menu_link AS ml LEFT JOIN link_has_content AS lc ON l.id=LINK_id  WHERE BLOCK_id=2 ORDER BY position");
closeSQLConnexion($connection);
include 'include/menu/view.php';
?>