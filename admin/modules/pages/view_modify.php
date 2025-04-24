<h1><?php echo $actionDisplay; ?> une page</h1>
<a href="?module=pages">Listing</a>

<form action="index.php?module=pages&action=<?php echo $action; ?>" method="POST">
    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom de la page :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="alias">Alias de la page :</label><input type="text" id="alias" name="alias" value="<?php echo $alias; ?>" /></div>
        <div>
            <label for="enabled">Activé :</label>
            <select id="enabled" name="enabled">
                <?php
                if ($enabled == 0) {
                    echo '<option value="1">Oui</option>                
                <option value="0" selected="selected">Non</option>';
                } elseif ($enabled == 1) {
                    echo '<option value="1" selected="selected">Oui</option>                
                <option value="0">Non</option>';
                } else {
                    echo '<option value="1">Oui</option>                
                <option value="0">Non</option>';
                }
                ?>

            </select>
        </div>        
        <div>
            <label for="layout">Sélectionner un modèle d'affichage :</label>
            <select id="layout" name="layout">                
                <?php
                if ($pageLayoutId == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($layouts as $key => $value) {
                    if ($pageLayoutId == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>                
            </select>
        </div>       
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
    <input type="hidden" name="pageId" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>