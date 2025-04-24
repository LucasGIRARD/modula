<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT * FROM lineup");
mysql_close($DBC);
?>
<form action="?page=<?php echo $action; ?>MemberSQL" method="post">
    <label for="nick">pseudo : </label><input type="text" size="45" maxlength="30" name="nick" id="nick" value="<?php echo $nick; ?>" /><br />
    <label for="date">Date de création : </label><input type='text' name='day' id="date" size='1' maxlength='2' value='<?php echo $day; ?>' /> / <input type='text' name='month' size='1' maxlength='2' value='<?php echo $month; ?>' /> / <input type='text' name='year' size='2' maxlength='4' value='<?php echo $year; ?>' /> à <input type='text' name='hour' size='1' maxlength='2' value='<?php echo $hour; ?>' /> H <input type='text' name='minute' size='1' maxlength='2' value='<?php echo $minute; ?>' /><br />
    <label for="lastName">nom : </label><input type="text" size="45" maxlength="30" name="lastName" id="lastName" value="<?php echo $lastName; ?>" /><br />
    <label for="firstName">prénom : </label><input type="text" size="45" maxlength="30" name="firstName" id="firstName" value="<?php echo $firstName; ?>" /><br />
    <label for="birth">Date de naissance : </label><input type='text' name='birthday' id="birth" size='1' maxlength='2' value='<?php echo $bday; ?>' /> / <input type='text' name='birthmonth' size='1' maxlength='2' value='<?php echo $bmonth; ?>' /> / <input type='text' name='birthyear' size='2' maxlength='4' value='<?php echo $byear; ?>' /><br />
    <label for="gender">Genre : </label><select name="gender" id="gender">
        <option value=''></option>
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
    <label for="country">Pays : </label><input type="text" size="45" maxlength="30" name="country" id="country" value="<?php echo $country; ?>" /><br />
    <label for="department">Département : </label><input type="text" size="45" maxlength="30" name="department" id="department" value="<?php echo $department; ?>" /><br />
    <label for="town">Ville : </label><input type="text" size="45" maxlength="30" name="town" id="town" value="<?php echo $town; ?>" /><br />
    <label for="email">Email : </label><input type="text" size="66" maxlength="45" name="email" id="email" value="<?php echo $email; ?>" /><br />
    <label for="steamFriend">Steam AMIS : </label><input type="text" size="66" maxlength="45" name="steamFriend" id="steamFriend" value="<?php echo $steamFriend; ?>" /><br />
    <label for="password">Password : </label><input type="password" size="60" maxlength="50" name="password" id="password" value="<?php echo $password; ?>" /><br />
    <label for="admin">Admin : </label><select name="admin" id="admin">
        <?php
        if ($admin == '1') {
            echo "<option value='1' selected='selected'>1</option><option value='0'>0</option>";
        } else {
            echo "<option value='1'>1</option><option value='0' selected='selected'>0</option>";
        }
        ?>
    </select><br />
    <input type="hidden" name="idMember" value="<?php echo $idMember; ?>" />
    <input type="submit" value="Envoyer" />
</form>
