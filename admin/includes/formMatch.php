<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQLO = mysql_query("SELECT id, name FROM opponent");
$donneesSQLL = mysql_query("SELECT id, name FROM lineup");
$donneesSQLT = mysql_query("SELECT id, name FROM type_war");
mysql_close($DBC);
?>
<form action="?page=<?php echo $action; ?>MatchSQL" method="post">
    <label for="date">Date : </label><input type='text' name='day' id="date" size='1' maxlength='2' value=<?php echo $day; ?> /> / <input type='text' name='month' size='1' maxlength='2' value=<?php echo $month; ?> /> / <input type='text' name='year' size='2' maxlength='4' value=<?php echo $year; ?> /> à <input type='text' name='hour' size='1' maxlength='2' value=<?php echo $hour; ?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo $minute; ?> /><br />
    <label for="opponent">Opposant : </label><select name="opponent" id="opponent">
        <?php
        while ($donnees = mysql_fetch_array($donneesSQLO)) {
            if ($donnees['id'] == $opponent) {
                echo "<option value='" . $donnees['id'] . "' selected='selected'>" . $donnees['name'] . "</option>";
            } else {
                echo "<option value='" . $donnees['id'] . "' >" . $donnees['name'] . "</option>";
            }
        }
        ?>
    </select><br />
    <label for="otherOpponentName">Autre opposant, Nom : </label><input type='text' name='otherOpponentName' id="otherOpponentName" size='65' maxlength='45' value='' /><br />
    <label for="otherOpponentWebsite">Autre opposant, Site : </label><input type='text' name='otherOpponentWebsite' id="otherOpponentWebsite" size='65' maxlength='45' value='' /><br />
    <label for="lineup">Lineup : </label><select name="lineup" id="lineup">
        <?php
        while ($donnees = mysql_fetch_array($donneesSQLL)) {
            if ($donnees['id'] == $lineup) {
                echo "<option value='" . $donnees['id'] . "' selected='selected'>" . $donnees['name'] . "</option>";
            } else {
                echo "<option value='" . $donnees['id'] . "' >" . $donnees['name'] . "</option>";
            }
        }
        ?>
    </select><br />
    <label for="type">Type : </label><select name="type" id="type">
        <?php
        while ($donnees = mysql_fetch_array($donneesSQLT)) {
            if ($donnees['id'] == $type) {
                echo "<option value='" . $donnees['id'] . "' selected='selected'>" . $donnees['name'] . "</option>";
            } else {
                echo "<option value='" . $donnees['id'] . "' >" . $donnees['name'] . "</option>";
            }
        }
        ?>
    </select><br />
    <input type="hidden" name="idWar" value="<?php echo $idWar; ?>" />
    <input type="submit" value="Envoyer" />
</form>
