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

include 'includes/SQL.php';
$connection = openSQLConnexion();
$totalNews = select($connection,"SELECT COUNT(*) AS nbNews FROM news");
$nbPages = ceil($totalNews[0]['nbNews'] / $newsPerPage);
$donneesSQL = select($connection,"SELECT n.id, content, title, DATE_FORMAT( n.created, '%d/%m/%Y | %H:%i' ) AS timestamp1, intro, MEMBER_id, nick FROM news AS n LEFT JOIN member AS m ON (MEMBER_id = m.id) ORDER BY n.id DESC LIMIT  $firstLimit, $newsPerPage");
closeSQLConnexion($connection);
?>
<div id="news">
<?php
foreach ($donneesSQL as $donnees) {
    ?>
        <article>
            <div class="topnews">
                <img src="images/cs.gif" class="icone" alt="icône news cs"/><h2><?php echo $donnees['title']; ?></h2>
            </div>
            <div class="bodynews">
    <?php
    echo $donnees['intro'];
    if (!empty($donnees['content'])) {
        ?>
        <div class='Readmore'><a href='?page=fullNews&id=<?php echo $donnees['id']; ?>'>Lire la suite...</a></div>
        <?php
    }
    ?>
            </div>
            <div class="bottomnews">
                <div  class="bottomnewsleft">Auteur : <a href="?page=member&id=<?php echo $donnees['MEMBER_id']; ?>"><?php echo $donnees['nick']; ?></a></div><div class="bottomnewsright">date : <?php echo $donnees['timestamp1']; ?></div>
            </div>
        </article>
    <?php
} // Fin de la boucle qui liste les news
?>
    <div class="navnews">
    <?php
    if ($nbPages > 1) {
        ?>
        Page : 
            <?php
        for ($i = 1; $i <= $nbPages; $i++) {
            ?>
        <a href="?page=news&id=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
        }
    }
    ?>
    </div>
</div>