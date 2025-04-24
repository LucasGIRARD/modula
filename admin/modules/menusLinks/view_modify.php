<h1><?php echo $actionDisplay; ?> un lien</h1>
<a href="?module=menus">Listing</a>

<form action="index.php?module=menusLinks&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom du lien :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="alias">Alias du lien :</label><input type="text" id="alias" name="alias" value="<?php echo $alias; ?>" /></div>
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
            <label for="type">Type :</label>
            <select id="type" name="type">
                <?php
                if ($type == "1") {
                    echo '<option value="1" selected="selected">Lien</option>
                <option value="2">Séparateur</option>                
                <option value="3">catégorie</option>';
                } elseif ($type == "2") {
                    echo '<option value="1">Lien</option>
                <option value="2" selected="selected">Séparateur</option>                
                <option value="3">catégorie</option>';
                } elseif ($type == "3") {
                    echo '<option value="1">Lien</option>
                <option value="2">Séparateur</option>                
                <option value="3" selected="selected">catégorie</option>';
                } else {
                    echo '<option value="1">Lien</option>
                <option value="2">Séparateur</option>                
                <option value="3">catégorie</option>';
                }              
                ?>                
            </select>
        </div>
        <div><label for="link">Lien :</label><input type="text" id="link" name="link" value="<?php echo $link; ?>" /></div>
        <div>
            <label for="linkPage">Page :</label>
            <select id="linkPage" name="linkPage">
                <?php
                if ($linkPage == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($pages as $key => $value) {
                    if ($linkPage == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>                
            </select>
        </div>
        <div><label for="position">Position :</label><input type="text" id="position" name="position" value="<?php echo $position; ?>" /></div>
        <div>
            <label for="linkMenu">Menu :</label>
            <select id="linkMenu" name="linkMenu">
                <?php               
                foreach ($menus as $key => $value) {
                    if ($linkMenu == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>                
            </select>
        </div>
        
        <div>
            <label for="linkParent">Lien parent :</label>
            <select id="linkParent" name="linkParent">
                <?php
                if ($linkParent == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($links as $key => $value) {
                    if ($linkParent == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>                
            </select>
        </div>
        
    </fieldset>


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>