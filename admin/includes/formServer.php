<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT * FROM type_server");
mysql_close($DBC);
?>
<form action="?page=<?php echo $action; ?>ServerSQL" method="post">
    <label for="number">Numéro : </label><input type="text" size="4" maxlength="2" name="number" id="number" value="<?php echo $number; ?>" />
    <label for="ip">IP : </label><input type="text" size="20" maxlength="15" name="ip" id="ip" value="<?php echo $ip; ?>" />
    <label for="description">Description : </label><input type="text" size="60" maxlength="50" name="description" id="description" value="<?php echo $description; ?>" />
    <label for="type">Type : </label><select name="type" id="type">
        <?php
        while ($donnees = mysql_fetch_array($donneesSQL)) {
            if ($donnees['id'] == $type) {
                echo "<option value='" . $donnees['id'] . "' selected='selected'>" . $donnees['name'] . "</option>";
            } else {
                echo "<option value='" . $donnees['id'] . "' >" . $donnees['name'] . "</option>";
            }
        }
        ?>
    </select>
    <label for="password">Password : </label><input type="text" size="70" maxlength="60" name="password" id="password" value="<?php echo $password; ?>" />
    <input type="hidden" name="idServer" value="<?php echo $idServer; ?>" />
    <input type="submit" value="Envoyer" />
</form>
