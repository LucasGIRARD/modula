<h1><?php echo $actionDisplay; ?> une news</h1>
<a href="?module=news">Listing</a>
<form action="index.php?module=news&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        
        <div><label for="name">Nom de la news :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        
        <div>
            <label for="day">Date de création : </label>
            <input type='text' name='day' id="day" size='1' maxlength='2' value=<?php echo $day; ?> /> / <input type='text' name='month' size='1' maxlength='2' value=<?php echo $month; ?> /> / <input type='text' name='year' size='2' maxlength='4' value=<?php echo $year; ?> />
            à <input type='text' name='hour' size='1' maxlength='2' value=<?php echo $hour; ?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo $minute; ?> />
        </div>
        
        <div>
            <label for="author">Auteur : </label>
            <select name="author" id="author">        
                <?php
                if ($author == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($authors as $key => $value) {
                    if ($author == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>       
            </select>
        </div>
        
        <div>
            <label for="category">Catégorie : </label>
            <select name="category" id="category">
                <?php
                if ($category == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($categories as $key => $value) {
                    if ($category == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        
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

    </fieldset>
    
    <fieldset>
        <legend>Contenu</legend>
        
        <div><label for="intro">Intro : </label><textarea name="intro" id="intro"><?php echo $intro; ?></textarea></div>
        
        <div><label for="content">Contenu :</label><textarea name="content" id="content" ><?php echo $content; ?></textarea></div>
        
    </fieldset>
    
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>