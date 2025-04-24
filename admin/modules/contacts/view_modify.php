<h1><?php echo $actionDisplay; ?> un formulaire</h1>
<a href="?module=contacts">Listing</a>
<form action="index.php?module=contacts&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>

        <div><label for="name">Nom du formulaire :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="name">Compte Recaptcha :</label><input type="text" id="account" name="account" value="<?php echo $account; ?>" /></div>
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

        <div>
            <label for="elementLastname">Elément(s) actif(s) :</label>
            <?php
            if ($elementLastname) {
                echo '<input type="checkbox" id="elementLastname" name="elementLastname" value="1" checked="checked" /><label for="elementLastname">Nom</label>';
            } else {
                echo '<input type="checkbox" id="elementLastname" name="elementLastname" value="1" /><label for="elementLastname">Nom</label>';
            }

            if ($elementFirstname) {
                echo '<input type="checkbox" id="elementFirstname" name="elementFirstname" value="1" checked="checked" /><label for="elementFirstname">Prénom</label>';
            } else {
                echo '<input type="checkbox" id="elementFirstname" name="elementFirstname" value="1" /><label for="elementFirstname">Prénom</label>';
            }

            if ($elementEmailAdress) {
                echo '<input type="checkbox" id="elementEmailAdress" name="elementEmailAdress" value="1" checked="checked" /><label for="elementEmailAdress">Adresse</label>';
            } else {
                echo '<input type="checkbox" id="elementEmailAdress" name="elementEmailAdress" value="1" /><label for="elementEmailAdress">Adresse</label>';
            }

            if ($elementEntreprise) {
                echo '<input type="checkbox" id="elementEntreprise" name="elementEntreprise" value="1" checked="checked" /><label for="elementEntreprise">Entreprise</label>';
            } else {
                echo '<input type="checkbox" id="elementEntreprise" name="elementEntreprise" value="1" /><label for="elementEntreprise">Entreprise</label>';
            }

            if ($elementWebsite) {
                echo '<input type="checkbox" id="elementWebsite" name="elementWebsite" value="1" checked="checked" /><label for="elementWebsite">Site internet</label>';
            } else {
                echo '<input type="checkbox" id="elementWebsite" name="elementWebsite" value="1" /><label for="elementWebsite">Site internet</label>';
            }

            if ($elementObject) {
                echo '<input type="checkbox" id="elementObject" name="elementObject" value="1" checked="checked" /><label for="elementObject">Objet</label>';
            } else {
                echo '<input type="checkbox" id="elementObject" name="elementObject" value="1" /><label for="elementObject">Objet</label>';
            }

            if ($elementMessage) {
                echo '<input type="checkbox" id="elementMessage" name="elementMessage" value="1" checked="checked" /><label for="elementMessage">Message</label>';
            } else {
                echo '<input type="checkbox" id="elementMessage" name="elementMessage" value="1" /><label for="elementMessage">Message</label>';
            }

            if ($elementCaptcha) {
                echo '<input type="checkbox" id="elementCaptcha" name="elementCaptcha" value="1" checked="checked" /><label for="elementCaptcha">Captcha</label>';
            } else {
                echo '<input type="checkbox" id="elementCaptcha" name="elementCaptcha" value="1" /><label for="elementCaptcha">Captcha</label>';
            }
            ?>
        </div>     

        <div>
            <label for="elementLastname">Elément(s) obligatoire(s) :</label>
            <?php
            if ($elementNeededLastname) {
                echo '<input type="checkbox" id="elementNeededLastname" name="elementNeededLastname" value="1" checked="checked" /><label for="elementNeededLastname">Nom</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededLastname" name="elementNeededLastname" value="1" /><label for="elementNeededLastname">Nom</label>';
            }

            if ($elementNeededFirstname) {
                echo '<input type="checkbox" id="elementNeededFirstname" name="elementNeededFirstname" value="1" checked="checked" /><label for="elementNeededFirstname">Prénom</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededFirstname" name="elementNeededFirstname" value="1" /><label for="elementNeededFirstname">Prénom</label>';
            }

            if ($elementNeededEmailAdress) {
                echo '<input type="checkbox" id="elementNeededEmailAdress" name="elementNeededEmailAdress" value="1" checked="checked" /><label for="elementNeededEmailAdress">Adresse</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededEmailAdress" name="elementNeededEmailAdress" value="1" /><label for="elementNeededEmailAdress">Adresse</label>';
            }

            if ($elementNeededEntreprise) {
                echo '<input type="checkbox" id="elementNeededEntreprise" name="elementNeededEntreprise" value="1" checked="checked" /><label for="elementNeededEntreprise">Entreprise</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededEntreprise" name="elementNeededEntreprise" value="1" /><label for="elementNeededEntreprise">Entreprise</label>';
            }

            if ($elementNeededWebsite) {
                echo '<input type="checkbox" id="elementNeededWebsite" name="elementNeededWebsite" value="1" checked="checked" /><label for="elementNeededWebsite">Site internet</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededWebsite" name="elementNeededWebsite" value="1" /><label for="elementNeededWebsite">Site internet</label>';
            }

            if ($elementNeededObject) {
                echo '<input type="checkbox" id="elementNeededObject" name="elementNeededObject" value="1" checked="checked" /><label for="elementNeededObject">Objet</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededObject" name="elementNeededObject" value="1" /><label for="elementNeededObject">Objet</label>';
            }

            if ($elementNeededMessage) {
                echo '<input type="checkbox" id="elementNeededMessage" name="elementNeededMessage" value="1" checked="checked" /><label for="elementNeededMessage">Message</label>';
            } else {
                echo '<input type="checkbox" id="elementNeededMessage" name="elementNeededMessage" value="1" /><label for="elementNeededMessage">Message</label>';
            }
            ?>
        </div>  
    </fieldset>

    <fieldset>
        <legend>Objet(s)</legend>
        <?php
        if (isset($objects) && !empty($objects)) {
            foreach ($objects as $id => $value) {
                if ($value['used']) {
                    echo '<input type="checkbox" id="' . $id . '" name="objects[]" value="' . $id . '" checked="checked" /><label for="' . $id . '">' . $value['name'] . '</label>';
                } else {
                    echo '<input type="checkbox" id="' . $id . '" name="objects[]" value="' . $id . '" /><label for="' . $b . '">' . $value['name'] . '</label>';
                }
            }
            
            if (isset($objectsOld)) {
                foreach ($objectsOld as $id => $value) {
                    echo '<input type="hidden" name="objectsOld[]" value="' . $id . '" />';
                }
            }
            
        } else {
            echo 'aucun objet prédéfini.';
        }
        ?>
    </fieldset>

    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>