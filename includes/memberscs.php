<?php
$dayNumber = date("N") - 1;
$minute = date("i");
if ($minute > 30) {
    $hour = date("G") * 2 + 1;
} else {
    $hour = date("G") * 2;
}
$weekArray = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
$day = $weekArray[$dayNumber];

include 'includes/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection, "SELECT id, name FROM lineup WHERE GAME_id=1 ORDER BY id");
?>
<div id="members">
    <nav id="submenu">
        <ul>
            <li><a href='?page=members'>TOUS</a></li>
            <li id='last'><a href='?page=memberscs'>CS</a></li>
        </ul>
    </nav>
    <br />
    <?php
    foreach ($donneesSQL as $donnees) {
        $donneesSQL2 = select($connection, "SELECT CS.nick, ml.rang, $day FROM member_lineup AS ml LEFT JOIN CS USING ( MEMBER_id ) LEFT JOIN availability USING ( MEMBER_id ) WHERE ml.LINEUP_id=?", array($donnees['id']));
        ?>
        <div class='lineup'>
            <h2><?php echo $donnees['name']; ?></h2>
            <table>
                <tr>
                    <th>pseudo</th>
                    <th>rang</th>
                    <?php
                    if (isset($_SESSION['LU'])) {
                        ?>
                        <th>dispo</th>
                    </tr>
                    <?php
                    foreach ($donneesSQL2 as $donnees2) {
                        ?>
                        <tr>
                            <td><a href='?page=member&id=<?php echo $donnees['id'] ?>'><?php echo $donnees2['nick'] ?></a></td>
                            <td><?php echo $donnees2['rang'] ?></td>
                            <?php
                            if ($donnees2[$day][$hour] == 1) {
                                ?>
                                <td class='dispo'>oui</td>
                                <?php
                            } else {
                                ?>
                                <td class='ndispo'>non</td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    </tr>
                    <?php
                    foreach ($donneesSQL2 as $donnees2) {
                        ?>
                        <tr>
                            <td><a href='?page=member&id=<?php echo $donnees['id']; ?>'><?php echo $donnees2['nick']; ?></a></td>
                            <td><?php echo $donnees2['rang']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <?php
    }
    closeSQLConnexion($connection);
    ?>
</div>
