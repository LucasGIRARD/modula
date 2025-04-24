<div id="account">
    <form action="?page=work" method="post">
        <div>
            <label for="nick">Pseudo :</label><input type="text" size="45" maxlength="30" name="nick" id="nick" value="<?php echo $nick; ?>" />
            <label for="lastName">Nom :</label><input type="text" size="45" maxlength="30" name="lastName" id="lastName" value="<?php echo $lastName; ?>" />
            <label for="firstName">Prénom :</label><input type="text" size="45" maxlength="30" name="firstName" id="firstName" value="<?php echo $firstName; ?>" />
            <label for="birth">Date de naissance :</label><input type='text' name='birthday' id="birth" size='1' maxlength='2' value="<?php echo $birthday; ?>" /> / <input type='text' name='birthmonth' size='1' maxlength='2' value="<?php echo $birthmonth; ?>" /> / <input type='text' name='birthyear' size='2' maxlength='4' value="<?php echo $birthyear; ?>" /><br />
            <label for="genre">Genre :</label><select name="gender" id="genre">
                <option value='' ></option>
                <?php
                if ($gender == 'm') {
                    echo "<option value='m' selected='selected'>Homme</option><option value='f'>Femme</option>";
                } elseif ($gender == 'f') {
                    echo "<option value='m'>Homme</option><option value='f' selected='selected'>Femme</option>";
                } else {
                    echo "<option value='m'>Homme</option><option value='f'>Femme</option>";
                }
                ?>
            </select><br />
            <label for="country">Pays :</label><input type="text" size="45" maxlength="30" name="country" id="country" value="<?php echo $country; ?>" />
            <label for="department">Département :</label><input type="text" size="45" maxlength="30" name="department" id="department" value="<?php echo $department; ?>" />
            <label for="town">Ville :</label><input type="text" size="45" maxlength="30" name="town" id="town" value="<?php echo $town; ?>" />
            <label for="email">Email :</label><input type="text" size="66" maxlength="45" name="email" id="email" value="<?php echo $email; ?>" />
            <label for="steamFriends">Steam AMIS :</label><input type="text" size="66" maxlength="45" name="steamFriends" id="steamFriends" value="<?php echo $steamFriend; ?>" />

        </div>
        <?php include('include/dispo/dispo.html'); ?>
        <script type="text/javascript" >
            main2('<?php echo $availability ?>');
        </script>
        <br />
        <input type="hidden" name="action" value="modifyAccount" />
        <input type="submit" value="Envoyer" />
    </form>
</div>