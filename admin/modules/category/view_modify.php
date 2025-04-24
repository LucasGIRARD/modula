<h1><?php echo $actionDisplay; ?> une catégorie</h1>
<a href="?module=category">Listing</a>

<form action="index.php?module=category&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom de la catégorie :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
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
        <div><label for="description">Description de la catégorie :</label><input type="text" id="description" name="description" value="<?php echo $description; ?>" /></div>
    </fieldset>


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>