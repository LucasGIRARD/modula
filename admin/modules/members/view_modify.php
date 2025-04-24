<h1><?php echo $actionDisplay; ?> un membre</h1>
<a href="?module=members">Listing</a>

<form action="index.php?module=members&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom d'utilisateur :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div>
            <label for="day">Date de création : </label>
            <input type='text' name='day' id="day" size='1' maxlength='2' value=<?php echo $day; ?> /> / <input type='text' name='month' size='1' maxlength='2' value=<?php echo $month; ?> /> / <input type='text' name='year' size='2' maxlength='4' value=<?php echo $year; ?> />
            à <input type='text' name='hour' size='1' maxlength='2' value=<?php echo $hour; ?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo $minute; ?> />
        </div>

        <div><label for="password">Mot de passe :</label><input type="text" id="password" name="password" value="<?php echo $password; ?>" /></div>
        <div><label for="passwordC">Mot de passe (confirmation) :</label><input type="text" id="passwordC" name="passwordC" value="<?php echo $passwordC; ?>" /></div>
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
        <legend>Détails personnel</legend>
        <div><label for="lastname">Nom de famille :</label><input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" /></div>
        <div><label for="firstname">Prénom :</label><input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" /></div>

        <div>
            <label for="gender">Genre :</label>
            <select id="gender" name="enabled">
                <?php
                if ($gender == "m") {
                    echo '<option value="m" selected="selected">Homme</option>                
                <option value="f">Femme</option>';
                } elseif ($gender == "f") {
                    echo '<option value="m">Homme</option>                
                <option value="f" selected="selected">Femme</option>';
                } else {
                    echo '<option value="m">Homme</option>                
                <option value="f">Femme</option>';
                }
                ?>                      
            </select>
        </div>
        <div><label for="birthday">Date d'anniversaire :</label><input type="text" id="birthday" name="birthday" value="<?php echo $birthday; ?>" /></div>
        <div><label for="birthplace">Lieu de naissance :</label><input type="text" id="birthplace" name="birthplace" value="<?php echo $birthplace; ?>" /></div>
    </fieldset>

    <fieldset>
        <legend>Adresse(s) Email</legend>
        <?php
        foreach ($emails as $key => $value) {
            echo '<div><form action="index.php?module=members&action=' . $action . 'ed" method="POST"><label for=\'email' . $key . '\'>Email :</label><input type=\'text\' id=\'email' . $key . '\' name=\'email' . $key . '\' value=' . $value . ' /><input type="submit" value="Mise à jour" /></form></div>';
        }
        ?>
        <fieldset>
            <legend>Nouvelle adresse Email</legend>
            <div><label for="email">Email :</label><input type="text" id="email" name="email" value="" /></div>
        </fieldset>        
    </fieldset>

    <fieldset>
        <legend>Adresse(s)</legend>
        <?php
        foreach ($adresss as $key => $value) {
            echo '<fieldset>
            <legend>' . $value['legendName'] . '</legend><div><form action="index.php?module=members&action=' . $action . 'ed" method="POST"><label for=\'name' . $key . '\'>Nom de l\'adresse :</label><input type=\'text\' id=\'name' . $key . '\' name=\'name' . $key . '\' value=\'' . $value['name'] . '\' /></div>
        <div><label for=\'adress' . $key . '\'>adresse :</label><input type=\'text\' id=\'adress' . $key . '\' name=\'adress' . $key . '\' value=\'' . $value['adress'] . '\' /></div>
        <div><label for=\'cp' . $key . '\'>Code postal :</label><input type=\'text\' id=\'cp' . $key . '\' name=\'cp' . $key . '\' value=\'' . $value['cp'] . '\' /></div>
        <div><label for=\'town' . $key . '\'>Ville :</label><input type=\'text\' id=\'town' . $key . '\' name=\'town' . $key . '\' value=\'' . $value['town'] . '\' /></div>
        <div><label for=\'department' . $key . '\'>Départment :</label><input type=\'text\' id=\'department' . $key . '\' name=\'department' . $key . '\' value=\'' . $value['department'] . '\' /></div>
        <div><label for=\'country' . $key . '\'>Pays :</label><input type=\'text\' id=\'country' . $key . '\' name=\'country' . $key . '\' value=\'' . $value['country'] . '\' /></div><input type="submit" value="Mise à jour" /></form></fieldset>';
        }
        ?>

        <fieldset>
            <legend>Nouvelle adresse</legend>
            <div><label for="name">Nom de l"adresse :</label><input type="text" id="name" name="name" value="" /></div>
            <div><label for="adress">adresse :</label><input type="text" id="adress" name="adress" value="" /></div>
            <div><label for="cp">Code postal :</label><input type="text" id="cp" name="cp" value="" /></div>
            <div><label for="town">Ville :</label><input type="text" id="town" name="town" value="" /></div>
            <div><label for="department">Départment :</label><input type="text" id="department" name="department" value="" /></div>
            <div><label for="country">Pays :</label><input type="text" id="country" name="country" value="" /></div>
        </fieldset>
    </fieldset>

    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>