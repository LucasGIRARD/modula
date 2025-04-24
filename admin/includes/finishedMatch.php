<?php
if (!isset($_POST["numberMap"])) {
    echo '<form action="?page=finishedMatch" method="post">
    <label for="numberMap">nombre de map : </label><input type="text" name="numberMap" id="numberMap" size="1" maxlength="2" value="1" />
    <input type="hidden" name="idMatch" value="'.$_GET["id"].'" />
    <input type="submit" value="Envoyer" />
</form>';
} else {
    $numberMap = $_POST["numberMap"];
    echo '<form action="?page=finishedMatchSQL" method="post">';
    for ($i = 0; $i < $numberMap; $i++) {
        echo '<label for="name'.$i.'">Nom de la map : </label><input type="text" name="name'.$i.'" id="name'.$i.'" maxlength="2" value="" /><br />
    <label for="firstSide'.$i.'">Premier côté : </label><select name="firstSide'.$i.'" id="firstSide'.$i.'">
        <option value="0">Terroriste</option>
        <option value="1">anti-terroriste</option>
    </select>
    <fieldset>
        <legend>Premier côté : </legend>
        <label for="resultSide1Us'.$i.'">nous : </label><input type="text" name="resultSide1Us'.$i.'" id="resultSide1Us'.$i.'" size="1" maxlength="2" value="" />
        <label for="resultSide1Them'.$i.'">eux : </label><input type="text" name="resultSide1Them'.$i.'" id="resultSide1Them'.$i.'" size="1" maxlength="2" value="" />
    </fieldset>
    <fieldset>
        <legend>Second côté : </legend>
        <label for="resultSide2Us'.$i.'">nous : </label><input type="text" name="resultSide2Us'.$i.'" id="resultSide2Us'.$i.'" size="1" maxlength="2" value="" />
        <label for="resultSide2Them'.$i.'">eux : </label><input type="text" name="resultSide2Them'.$i.'" id="resultSide2Them'.$i.'" size="1" maxlength="2" value="" />
    </fieldset>
    <label for="rapport'.$i.'">rapport :</label><textarea name="rapport'.$i.'" id="rapport'.$i.'" maxlength="16777215"></textarea><br />';
    }
    echo '<input type="hidden" name="numberMap" value="'.$numberMap.'" /><input type="hidden" name="idMatch" value="'.$_POST["idMatch"].'" />
    <input type="submit" value="Envoyer" />
</form>';
}
?>