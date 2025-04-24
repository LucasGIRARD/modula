<ul>
    <?php
    foreach ($donneesSQL as $donnees) {
        ?>
        <li><a href="<?php echo $donnees['link']; ?>"><?php echo $donnees['name']; ?></a></li>
        <?php
    }
    ?>    
</ul>