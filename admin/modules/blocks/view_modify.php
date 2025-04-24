<h1><?php echo $actionDisplay; ?> un bloc</h1>
<a href="?module=blocks">Listing</a>

<form action="index.php?module=blocks&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom du bloc :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="alias">Alias du bloc :</label><input type="text" id="alias" name="alias" value="<?php echo $alias; ?>" /></div>
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
            <label for="layout">Modèle de bloc :</label>
            <select id="layout" name="layout">
                <option value="">Sélectionner</option>
                <?php
                foreach ($blockLayout as $key => $value) {
                    if ($key == $layout) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>                
            </select>
        </div>
        <div>
            <label for="module">Module du bloc :</label>
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
        <?php
        if (isset($elements)) {
        ?>
        <div>
            <label for="element">Elément du bloc :</label>
            <select id="element" name="element">
                <option value="0">Sélectionner</option>
                <?php
                foreach ($elements as $key => $value) {
                    if ($key == $element) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>                
            </select>
        </div>
        <?php 
        }
        ?>
    </fieldset>

    <fieldset>
        <legend><label for="content">Contenu</label></legend>
        <textarea id="content" name="content" rows="4" cols="20"><?php echo $content; ?></textarea>
    </fieldset>    
    <?php
    if (isset($blockParameter)) {
        echo '<fieldset>
        <legend><label for="content">Paramètres</label></legend>';
        foreach ($blockParameter as $key => $value) {
            switch ($value['type']) {
                case 'input':
                    echo '<div><label for="' . $key . '">' . $key . ' :</label><input type="text" id="' . $key . '" name="' . $key . '" value="" /></div>';
                    break;
                case 'select':
                    echo '<div><label for="' . $key . '">' . $key . ' :</label><select id="' . $key . '" name="' . $key . '">';
                    foreach ($value['values'] as $key => $value) {
                        if ($key == $blockType) {
                            echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                        } else {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                    }
                    echo '</select></div>';
                    break;
                default:
                    break;
            }
        }

        echo '</fieldset>';
    }
    ?>


    <input type="hidden" name="blockId" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />

</form>