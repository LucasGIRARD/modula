<?php
if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idPageNews = $_GET['id'];
    }
} else {
    $idPageNews = 1;
}
$newsPerPage = 10;
$firstLimit = ($idPageNews - 1) * $newsPerPage;


$connection = openSQLConnexion();
$totalNews = select($connection,"SELECT COUNT(*) AS nbNews FROM news");
$nbPages = ceil($totalNews[0]['nbNews'] / $newsPerPage);
$donneesSQL = select($connection,"SELECT n.id, content, title, DATE_FORMAT( n.created, '%d/%m/%Y | %H:%i' ) AS timestamp1, intro, MEMBER_id, nick FROM news AS n LEFT JOIN member AS m ON (MEMBER_id = m.id) ORDER BY n.id DESC LIMIT  $firstLimit, $newsPerPage");
closeSQLConnexion($connection);

include 'include/news/view.php';
?>