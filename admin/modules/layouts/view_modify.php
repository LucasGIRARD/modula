<h1><?php echo $actionDisplay; ?> un modèle</h1>
<a href="?module=layouts">Listing</a>

<form action="index.php?module=layouts&action=<?php echo $action; ?>" method="POST">
    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom du modèle :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>        
    </fieldset>
    
    <fieldset>
        <legend>Contenu</legend>        
        <textarea id="content" name="content" rows="4" cols="20"><?php echo $content; ?></textarea>
         <?php
        if (isset($blocks)) {
        ?>
        <fieldset>
            <legend>Bloc(s) disponible(s)</legend>
            <ul>
                <?php
                foreach ($blocks as $key => $value) {
                    echo '<li>- ' . $value['alias'] . '</li>';
                }
                ?>
            </ul>
        </fieldset>
        <?php
        }
        ?>
    </fieldset>
    <input type="hidden" name="layoutId" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>