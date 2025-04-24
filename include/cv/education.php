<fieldset><legend>FORMATIONS</legend>
    <?php
    $notfirst = false;
    foreach ($donneesSQL3 as $donnees) {
        if ($notfirst) {
            echo "<br />";
        }
        $notfirst = true;
        echo $donnees["startYear"] . " - " . $donnees["endYear"] . " | ";
        if (!$donnees["obtained"]) {
            echo "Niveau ";
        }
        echo $donnees["degreeName"] . " - " . $donnees["schoolName"] . " - " . $donnees["town"];
        if (!empty($donnees["optionName"])) {
            echo "<div class='option'>- Option : " . $donnees["optionName"] . "</div>";
        }
        else {
            echo "<br />";
        }
    }
    ?>
</fieldset>