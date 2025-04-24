<h1>Configuration</h1>
<form action="index.php?page=configuration&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="title">Nom du site :</label><input type="text" id="title" name="title" value="<?php echo $title; ?>" /></div>                   
        <div><label for="headingTitle">Slogan :</label><input type="text" id="headingTitle" name="headingTitle" value="<?php echo $headingTitle; ?>" /></div>
        <div><label for="footerCopyright">Footer :</label><input type="text" id="footerCopyright" name="footerCopyright" value="<?php echo $footerCopyright; ?>" /></div>
       
        <div>
            <label for="open">Statut du site :</label>
            <select id="open" name="open">
                <?php
                if ($open == 0) {
                    echo '<option>Ouvert</option>
                <option selected="selected">Fermée</option>
                <option>Maintenance</option>';
                } elseif ($open == 1) {
                    echo '<option>Ouvert</option>
                <option>Fermée</option>
                <option selected="selected">Maintenance</option>';
                }  elseif ($open == 2) {
                    echo '<option selected="selected">Ouvert</option>
                <option>Fermée</option>
                <option>Maintenance</option>';
                } else {
                    echo '<option>Ouvert</option>
                <option>Fermée</option>
                <option>Maintenance</option>';
                }
                ?>                      
            </select>
        </div>
        
    </fieldset>
    <fieldset>
        <legend>Meta Tags</legend>
        <div><label for="keywords">Mots Clefs :</label><textarea name="keywords" id="keywords" rows="4" cols="10"><?php echo $keywords; ?></textarea></div>
        <div><label for="description">Description du site :</label><textarea name="description" id="description" rows="4" cols="20"><?php echo $description; ?></textarea></div>
    </fieldset>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>