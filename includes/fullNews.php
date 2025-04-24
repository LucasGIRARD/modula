<?php
if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");    
}
$idNews = $_GET['id'];


include 'includes/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT content, title, DATE_FORMAT( n.created, '%d/%m/%Y | %H:%i' ) AS created, intro, MEMBER_id, nick FROM news AS n, member AS m WHERE n.id=?",array($idNews));
closeSQLConnexion($connection);
$donnees=$donneesSQL[0];
$donneesSQL=null;
?>
<div id="news">
        <article>
            <div class="topnews">
                <img src="images/cs.gif" class="icone" alt="icône news cs"/><h2><?php echo $donnees['title']; ?></h2>
            </div>
            <div class="bodynews">
                <?php
                echo $donnees['intro']."<br /><br />".$donnees['content'];
                ?>
            </div>
            <div class="bottomnews">
                <div  class="bottomnewsleft">Auteur : <a href="?page=member&id=<?php echo $donnees['MEMBER_id']; ?>"><?php echo $donnees['nick']; ?></a></div><div class="bottomnewsright">date : <?php echo $donnees['created']; ?></div>
            </div>
        </article>
</div>