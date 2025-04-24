<?php
if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idPageMember = $_GET['id'];
    }
} else {
    $idPageMember = 1;
}
$memberPerPage = 100;
$firstLimit = ($idPageMember - 1) * $memberPerPage;

include 'include/SQL.php';
$connection = openSQLConnexion();
$totalMember = select($connection,"SELECT COUNT(*) AS nbMember FROM member");
$nbPages = ceil($totalMember[0]['nbMember'] / $memberPerPage);
$donneesSQL = select($connection,"SELECT id, nick FROM member AS m ORDER BY m.id DESC LIMIT  $firstLimit, $memberPerPage");
closeSQLConnexion($connection);
?>
<div id="members">
    <nav id="submenu">
        <ul>
            <li><a href='?page=members'>TOUS</a></li>
            <li id='last'><a href='?page=memberscs'>CS</a></li>
        </ul>
    </nav>
    <br />
    <div class="lineup">
        <ul>
            <?php
            foreach ($donneesSQL as $donnees) {
                echo '<li><a href="?page=member&id=' . $donnees['id'] . '">' . $donnees['nick'] . '</a></li>';
            }
            ?>

        </ul>
        <div class="navnews">
            <?php
            if ($nbPages > 1) {
                echo 'Page : ';
                for ($i = 1; $i <= $nbPages; $i++) {
                    echo '<a href="?page=news&id=' . $i . '">' . $i . '</a> ';
                }
            }
            ?>
        </div>
    </div>
</div>