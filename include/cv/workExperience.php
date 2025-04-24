<fieldset><legend>EXPERIENCES PROFESSIONNELLES</legend>
    <table>
        <?php
        $lasttype = "";
        $lastWork = "";
        $descriptionBool = false;
        foreach ($donneesSQL2 as $donnees) {
            if ($lasttype != $donnees["typeId"]) {
                if (!empty($lasttype)) {
                    if ($descriptionBool) {
                        $descriptionBool = false;
                        echo "</td></tr>";
                    } else {
                        echo "</ul></td></tr>";
                    }
                }
                ?>
                <tr>
                    <td><?php echo $donnees["name"]; ?></td><td>
                        <?php
                        $lasttype = $donnees["typeId"];
                    }
                    if ($lastWork != $donnees["id"]) {
                        if (!empty($donnees["description"])) {
                            $descriptionBool = true;
                            ?>
                            <span><?php echo $donnees["description"]; ?></span>
                            <?php
                        } else {
                            if (!empty($lastWork)) {
                                ?>
                                </ul>
                                <?php
                            }
                            if ($donnees["startDates"] == $donnees["endDate"]) {
                                ?>
                                <span><?php echo $donnees["startDates"]; ?> - <?php echo $donnees["company"]; ?> - <?php echo $donnees["situation"]; ?></span>
                                <ul>
                                    <?php
                                } else {
                                    ?>
                                    <span>de <?php echo $donnees["startDates"]; ?> au <?php echo $donnees["endDate"]; ?> - <?php echo $donnees["company"]; ?> - <?php echo $donnees["situation"]; ?></span>
                                    <ul>
                                        <?php
                                    }
                                }
                                $lastWork = $donnees["id"];
                            }
                            if (!empty($donnees["skill"])) {
                                ?>
                                <li><?php echo $donnees["skill"]; ?></li>
                                <?php
                            }
                        }
                        if (!$descriptionBool) {
                            echo "</ul>";
                        }
                        ?>                    
                        </td>
                        </tr>
                        </table>
                        </fieldset>