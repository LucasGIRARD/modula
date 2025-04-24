<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT id, name FROM lineup WHERE GAME_id=1 ORDER BY id");
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
    $dayNumber = date("N") - 1;
    $minute = date("i");
    if ($minute > 30) {
        $hour = date("G") * 2 + 1;
    } else {
        $hour = date("G") * 2;
    }
    $weekArray = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
    $day = $weekArray[$dayNumber];
    while ($donnees = mysql_fetch_array($donneesSQL)) {
        $sqldispo = "SELECT CS.nick, ml.rang, $day FROM member_lineup AS ml LEFT JOIN CS USING ( MEMBER_id ) LEFT JOIN availability USING ( MEMBER_id ) WHERE ml.LINEUP_id=" . $donnees['id'];
        $donneesSQL2 = mysql_query($sqldispo);
        echo "<div class='lineup'>
           <h2>" . $donnees['name'] . "</h2>
        <table>
            <tr>
                <th>pseudo</th>
                <th>rang</th>";
        if (isset($_SESSION['LU'])) {
            echo "<th>dispo</th></tr>";
            while ($donnees2 = mysql_fetch_array($donneesSQL2)) {
                echo "<tr>
                <td><a href='?page=member&id=" . $donnees['id'] . "'>" . $donnees2['nick'] . "</a></td>
                <td>" . $donnees2['rang'] . "</td>";
                if ($donnees2[$day][$hour] == 1) {
                    echo "<td class='dispo'>oui</td>";
                } else {
                    echo "<td class='ndispo'>non</td>";
                }
                echo "</tr>";
            }
        } else {
            echo '</tr>';
            while ($donnees2 = mysql_fetch_array($donneesSQL2)) {
                echo "<tr>
                <td><a href='?page=member&id=" . $donnees['id'] . "'>" . $donnees2['nick'] . "</a></td>
                <td>" . $donnees2['rang'] . "</td></tr>";
            }
        }
        echo "</table></div>";
    }
    mysql_close($DBC);
    ?>
</div>
