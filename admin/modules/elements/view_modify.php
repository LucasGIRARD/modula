<h1><?php echo $actionDisplay; ?> un élément</h1>
<a href="?module=elements">Listing</a>

<form action="index.php?module=elements&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom de l'élément :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="alias">Alias de l'élément :</label><input type="text" id="alias" name="alias" value="<?php echo $alias; ?>" /></div>
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
            <label for="module">Module de l'élément :</label>
            <select id="module" name="module">
                <option value="0">Sélectionner</option>
                <?php
                foreach ($modules as $key => $value) {
                    if ($key == $module) {
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
        <legend><label for="content">Contenu</label></legend>
        <textarea id="content" name="content" rows="4" cols="20"><?php echo $content; ?></textarea>
    </fieldset>
    <?php
    if (isset($elements) && !empty($elements)) {
        echo '<fieldset>
        <legend><label for="content">Paramètres</label></legend><ul>';
        foreach ($elements as $key => $value) {
           echo '<li>- ' . $value . '</li>';
        }
        echo '</ul></fieldset>';
    }
    ?>


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>