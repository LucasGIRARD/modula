<div id="register">
    <form action="?page=work" method="post">
        <fieldset>
            <legend>informations obligatoires :</legend>
            <div>
                <label for="pseudo">Pseudo :</label><input type="text" size="45" maxlength="30" name="pseudo" id="pseudo" value="" />
                <label for="password">Password :</label><input type="password" size="60" maxlength="50" name="password" id="password" value="" />
                <label for="email">Email :</label><input type="text" size="66" maxlength="45" name="email" id="email" value="" />
            </div>
        </fieldset>
        <fieldset>
            <legend>information optionnelle :</legend>
            <div>
                <label for="lastName">Nom :</label><input type="text" size="45" maxlength="30" name="lastName" id="lastName" value="" /><br />
                <label for="firstName">Prénom :</label><input type="text" size="45" maxlength="30" name="firstName" id="firstName" value="" /><br />
                <label for="birth">Date de naissance :</label><input type='text' name='birthday' id="birth" size='1' maxlength='2' value="" /> / <input type='text' name='birthmonth' size='1' maxlength='2' value="" /> / <input type='text' name='birthyear' size='2' maxlength='4' value="" /><br />
                <label for="gender">Genre :</label><select name="gender" id="gender">
                    <option value='' ></option>
                    <option value='m'>Homme</option>
                    <option value='f'>Femme</option>
                </select><br />
                <label for="country">Pays :</label><input type="text" size="45" maxlength="30" name="country" id="country" value="" /><br />
                <label for="department">Département :</label><input type="text" size="45" maxlength="30" name="department" id="department" value="" /><br />
                <label for="town">Ville :</label><input type="text" size="45" maxlength="30" name="town" id="town" value="" /><br />
                <label for="steamFriend">Steam Amis :</label><input type="text" size="66" maxlength="45" name="steamFriend" id="steamFriend" value="" /><br />
            </div>
        </fieldset>
        <br />
        <input type="hidden" name="action" value="register" />
        <input type="submit" value="Envoyer" />
    </form>
</div>
