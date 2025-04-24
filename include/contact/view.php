<div class="center">
    <div class="textcenter">
        <a href="http://fr.linkedin.com/pub/lucas-girard/57/468/a7b"><img class="logo" src="image/contact/viadeo.png" alt="logo linkedin"></a>
        <a href="http://fr.viadeo.com/fr/profile/lucas.girard6"><img class="logo" src="image/contact/linkedin.png" alt="logo viadeo"></a>
    </div>
</div>
<br />
<form action='index.php' method='post'>
    <div>
        Les champs marqués d'une étoile (<span class="obligatory">*</span>) sont obligatoires.<br />
        <br />
        <?php
        if (!isset($_SESSION['pseudo'])) {
            ?>
            <label for="lastName">Nom<span class="obligatory">*</span> : </label><input type="text" size="45" maxlength="255" name="lastName" id="lastName" value="" /><br />
            <label for="firstName">Prénom<span class="obligatory">*</span> : </label><input type="text" size="45" maxlength="255" name="firstName" id="firstName" value="" /><br />
            <label for="email">adresse e-mail<span class="obligatory">*</span> : </label><input type="text" size="45" maxlength="255" name="email" id="email" value="" /><br />
            <label for="company">Entreprise : </label><input type="text" size="45" maxlength="255" name="company" id="company" value="" /><br />
            <label for="website">Site internet : </label><input type="text" size="45" maxlength="255" name="website" id="website" value="" /><br />
            <?php
        }
        if (!count($donneesSQL) < 1) {
            ?>
            <label for="object">Objet<span class="obligatory">*</span> :</label><select name="object" id="object">
                <?php
                foreach ($donneesSQL as $donnees) {
                    ?>
                    <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['name']; ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
        } else {
            ?>
            <label for="object">Objet<span class="obligatory">*</span> :</label><input type="text" size="45" maxlength="255" name="object" id="object" value="" /><br />
            <?php
        }
        ?>
    </div>
    <label for="message">Votre message<span class="obligatory">*</span> :</label><br /><textarea name="message" id="message" cols="50" rows="5"></textarea><br />
    <br />
    <?php
    echo recaptcha_get_html($publickey);
    ?>
    <br />
    <input type='hidden' name='action' value='contact' />
    <input type="submit" value="Envoyer" />
</form>