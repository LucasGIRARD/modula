<?php
if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");    
}
$idNews = $_GET['id'];
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT content, title, DATE_FORMAT( n.timestamp1, '%d/%m/%Y | %H:%i' ) AS timestamp1, intro, MEMBER_id, nick FROM news AS n, member AS m WHERE n.id=$idNews");
mysql_close($DBC);
$donnees = mysql_fetch_array($donneesSQL);
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
                <div  class="bottomnewsleft">Auteur : <a href="?page=member&id=<?php echo $donnees['MEMBER_id']; ?>"><?php echo $donnees['nick']; ?></a></div><div class="bottomnewsright">date : <?php echo $donnees['timestamp1']; ?></div>
            </div>
        </article>
</div>