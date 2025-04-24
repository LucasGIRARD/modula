<?php
foreach ($donneesSQL as $donnees) {
    ?>
        <article>
            <div class="topnews">
                <h2><?php echo $donnees['title']; ?></h2>
            </div>
            <div class="bodynews">
    <?php
    echo $donnees['intro'];
    if (!empty($donnees['content'])) {
        ?>
        <div class='Readmore'><a href='?page=news&id=<?php echo $donnees['id']; ?>'>Lire la suite...</a></div>
        <?php
    }
    ?>
            </div>
            <div class="bottomnews">
                <div  class="leftColumn">Auteur : <a href="?page=member&id=<?php echo $donnees['MEMBER_id']; ?>"><?php echo $donnees['nick']; ?></a></div><div class="rightColumn">date : <?php echo $donnees['timestamp1']; ?></div>
            </div>
        </article>
    <?php
}
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