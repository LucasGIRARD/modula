<link rel='stylesheet' type='text/css' href='shadowbox/shadowbox.css' />
<script type='text/javascript' src='shadowbox/shadowbox.js'></script>
<script type='text/javascript'>
    Shadowbox.init();
</script>
<div class="center">
    <?php
    $lastCategory = null;
    foreach ($donneesSQL as $donnees) {
        if ($donnees['catId'] != $lastCategory) {
            ?>
            <h3><?php echo $donnees['catName']; ?></h3><hr/>
            <?php
        }
        ?>
        <?php if (!empty($donnees['name'])) { ?>
            <div class="leftColumnNF"><a href="image/portefolio/<?php echo $donnees['id']; ?>.jpg" class='shadowbox'><img class="portefolio" alt="image de présentation du projet : <?php echo $donnees['name']; ?>" src="image/portefolio/<?php echo $donnees['id']; ?>.jpg" /></a></div>
            <div class="rightColumnNF">
                Nom du de projet : <b><?php echo $donnees['name']; ?></b><br />
                <br />
                Type de projet : <?php echo $donnees['type']; ?><br />
                <br />
                Technologies utilisés : <?php echo $donnees['technology']; ?><br />
                <br />
                Commentaire : <?php if (!empty($donnees['comment'])) {
            echo $donnees['comment'];
        } else {
            echo "aucun commentaire.";
        } ?>
            <?php if (!empty($donnees['link'])) { ?><div class="readMore"><a href="<?php echo $donnees['link']; ?>">Lien</a></div><?php } ?>
            </div><br />
            <?php
        } else {
            echo "Aucun projet dans le portefolio.";
        }
        ?>
        <br /><br />
        <?php
        $lastCategory = $donnees['catId'];
    }
    ?>
</div>