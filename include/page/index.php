<?php
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT id,name FROM page WHERE name=?",array($page));
$donnees=$donneesSQL[0];
$donneesSQL=null;
$donneesSQL = select($connection,"SELECT c.id, c.name, t.name AS typeName FROM `content-page` AS cp LEFT JOIN content AS c ON CONTENT_id = c.id LEFT JOIN type AS t ON t.id=TYPE_id WHERE PAGE_id=?",array($donnees['id']));
$donnees2=$donneesSQL[0];
$donneesSQL=null;
/// TODO
$donneesSQL = select($connection,"SELECT a.title, DATE_FORMAT(a.modified,'%d/%m/%Y') as modified, a.content FROM article_has_content AS ac LEFT JOIN article AS a ON ARTICLE_id = a.id WHERE CONTENT_id=? ORDER BY position",array($donnees2['id']));

///
closeSQLConnexion($connection);

include 'include/page/view.php';
?>
