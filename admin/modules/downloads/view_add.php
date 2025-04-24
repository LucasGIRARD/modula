<h1><?php echo $actionDisplay; ?> un téléchargement</h1>
<a href="?module=downloads">Listing</a>

<form action="index.php?module=downloads&action=<?php echo $action; ?>ed" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom du fichier : </label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
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
            <label for="category">Catégorie : </label>
            <select name="category" id="category">        
                <?php
                foreach ($categories as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>
        <div>
            <label for="file">Fichier : </label>
            <input type="file" name="file" id="file" value="" />
        </div>
    </fieldset>
    
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>