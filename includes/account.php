<?php
if (!isset($_SESSION['pseudo']) OR !isset($_SESSION['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}
$idMember = $_SESSION['id'];



include 'includes/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT firstName, lastName, gender, country, department, town, email, steamFriend, nick, DATE_FORMAT(birthday,'%d') AS birthday, DATE_FORMAT(birthday,'%m') AS birthmonth, DATE_FORMAT(birthday,'%Y') AS birthyear, monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM member AS m LEFT JOIN availability AS a ON ( MEMBER_id = m.id ) WHERE m.id=?",array(array($idMember)));
closeSQLConnexion($connection);

$availability = '0'.$donneesSQL[0]['monday'].'0'.$donneesSQL[0]['tuesday'].'0'.$donneesSQL[0]['wednesday'].'0'.$donneesSQL[0]['thursday'].'0'.$donneesSQL[0]['friday'].'0'.$donneesSQL[0]['saturday'].'0'.$donneesSQL[0]['sunday'];

$nick = $donneesSQL[0]['nick'];
$birthday = $donneesSQL[0]['birthday'];
$birthmonth = $donneesSQL[0]['birthmonth'];
$birthyear = $donneesSQL[0]['birthyear'];
$firstName = $donneesSQL[0]['firstName'];
$lastName = $donneesSQL[0]['lastName'];
$gender = $donneesSQL[0]['gender'];
$country = $donneesSQL[0]['country'];
$department = $donneesSQL[0]['department'];
$town = $donneesSQL[0]['town'];
$email = $donneesSQL[0]['email'];
$steamFriend = $donneesSQL[0]['steamFriend'];
?>

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
        <?php include('includes/dispo.html'); ?>
        <script type="text/javascript" >
            main2('<?php echo $availability ?>');
        </script>
        <br />
        <input type="hidden" name="action" value="modifyAccount" />
        <input type="submit" value="Envoyer" />
    </form>
</div>