<fieldset><legend>CENTRES D'INTERETS</legend>
    <?php
    $lastTitle = "";
    foreach ($donneesSQL5 as $donnees) {
        if ($donnees["id"] != $lastTitle) {
            if (!empty($lastTitle)) {
                echo "</ul>";
            }
            echo "<span>" . $donnees["title"] . "</span> :<ul>";
        }

        echo "<li>" . $donnees["activitie"] . "</li>";
        $lastTitle = $donnees["id"];
    }
    ?>
</ul>
</fieldset>







