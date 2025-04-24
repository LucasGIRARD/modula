<?php
foreach ($donneesSQL as $donnees) {
    ?>
        <article>
            <div class="topnews">
                <h2><?php echo $donnees['title']; ?></h2>
            </div>
            <div class="bodynews">
    <?php
    echo $donnees['content'];
    ?>
            </div>
            <div class="bottomnews">
                <div class="leftColumn"></div><div class="rightColumn">date de modification: <?php echo $donnees['modified']; ?></div>
            </div>
        </article>
    <?php
}
?>