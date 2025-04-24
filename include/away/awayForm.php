<?php
$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
$tomorrowDay = date("d", $tomorrow);
$tomorrowMonth = date("m", $tomorrow);
$tomorrowYear = date("Y", $tomorrow);
?>
<div id="away">
    <form method="post" action="?page=work">
        <div>
            <label for="departure">Date de départ :</label><input type='text' name='departureDay' id='departure' size='1' maxlength='2' value='<?php echo date("d"); ?>' /> / <input type='text' name='departureMonth' size='1' maxlength='2' value='<?php echo date("m"); ?>' /> / <input type='text' name='departureYear' size='2' maxlength='4' value='<?php echo date("Y"); ?>' /> à <input type='text' name='departureHour' size='1' maxlength='2' value='<?php echo date("H"); ?>' /> H <input type='text' name='departureMinute' size='1' maxlength='2' value='<?php echo date("i"); ?>' /><br />
            <label for="return">Date de retour :</label><input type='text' name='returnDay' id='return' size='1' maxlength='2' value='<?php echo $tomorrowDay; ?>' /> / <input type='text' name='returnMonth' size='1' maxlength='2' value='<?php echo $tomorrowMonth; ?>' /> / <input type='text' name='returnYear' size='2' maxlength='4' value='<?php echo $tomorrowYear; ?>' /> à <input type='text' name='returnHour' size='1' maxlength='2' value='12' /> H <input type='text' name='returnMinute' size='1' maxlength='2' value='00' /><br />
            <label for="message">raison de l'absence :</label><textarea name="message" id="message" cols="30" rows="5"></textarea>
        </div>
        <input type="hidden" name="action" value="away" />
        <input type="submit" value="Envoyer" />
    </form>
</div>