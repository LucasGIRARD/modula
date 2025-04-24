<div id="download">
    <?php
    $lastCategory = null;
    foreach ($donneesSQL as $donnees) {
        if ($donnees['name'] != $lastCategory) {
            if ($lastCategory != null) {
                ?>
            </ul>
            <?php
        }
        ?>
        <h3><?php echo $donnees['name']; ?></h3><hr/>
        <p><?php echo $donnees['description']; ?></p>
        <ul>
            <?php
        }
        ?>
        <li><a href="/file/<?php echo $donnees['id']; ?>.<?php echo $donnees['extension']; ?>"><?php echo $donnees['title']; ?></a></li>
        <?php
        $lastCategory = $donnees['name'];
    }
    ?>
</ul>
</div>