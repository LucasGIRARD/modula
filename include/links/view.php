<script type="text/javascript" src="include/links/deploy.js"></script>

<nav class="readMore">- <a href='javascript:deployHide("all")'>tout déplier</a> + <a href='javascript:deployHide("none")'>tout replier</a></nav>

<?php
$lastCategory = null;
foreach ($donneesSQL as $donnees) {
    if ($donnees['categoryName'] != $lastCategory) {
        if ($lastCategory != null) {
            ?>
            </dl></fieldset>
            <?php
        }
        ?>
        <fieldset><legend><a href='javascript:deployHide("<?php echo $donnees['id']; ?>")'>- <?php echo $donnees['categoryName']; ?></a></legend><dl id="<?php echo $donnees['id']; ?>">
                <?php
                if (!empty($donnees['categoryDescription'])) {
                    echo $donnees['categoryDescription'] . "<hr/>";
                }
                ?>            

                <?php
            }
            ?>
            <dt><a href="<?php echo $donnees['link']; ?>"><?php echo $donnees['linkName']; ?></a></dt>
            <dd><?php echo $donnees['linkDescription']; ?></dd>
            <?php
            if ($donnees['categoryName'] != $lastCategory) {
                ?>

                <?php
            }
            $lastCategory = $donnees['categoryName'];
        }
        ?>
    </dl>
</fieldset>
