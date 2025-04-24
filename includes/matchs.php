<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT w.id, DATE_FORMAT(w.timestamp1,'%d/%m/%Y <br /> %H:%i') AS timestamp1, l.name AS 'lineup', o.name AS 'opponent', network, t.name AS 'type'
FROM war AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_war AS t ON ( TYPE_id = t.id )
LEFT JOIN map AS m ON ( m.MATCH_id = w.id )
WHERE w.id NOT IN (SELECT DISTINCT MATCH_id FROM map)");



$donneesSQL2 = mysql_query("SELECT w.id, DATE_FORMAT(w.timestamp1,'%d/%m/%Y <br /> %H:%i') AS timestamp1, l.name AS 'lineup', o.name AS 'opponent', network, t.name AS 'type', SUM(resultSide1Us+resultSide2Us) AS 'resultUs', SUM(resultSide1Them+resultSide2Them) AS 'resultThem'
FROM war AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_war AS t ON ( TYPE_id = t.id )
LEFT JOIN map AS m ON ( m.MATCH_id = w.id )
WHERE w.id IN (SELECT DISTINCT MATCH_id FROM map)
GROUP BY MATCH_id");
mysql_close($DBC);
?>
<div id="match">
    <?php
    $b = mysql_num_rows($donneesSQL);
    if (mysql_num_rows($donneesSQL) > 0) {
        ?>
        <table>
            <caption>Match en préparation</caption>
            <tr>
                <th>Date</th>
                <th>Lineup</th>
                <th>Adversaire</th>
                <th>Réseau</th>
                <th>Type</th>
            </tr>
            <?php
            while ($donnees = mysql_fetch_array($donneesSQL)) {
                ?>
                <tr>
                    <td><?php echo $donnees['timestamp1']; ?></td>
                    <td><?php echo $donnees['lineup']; ?></td>
                    <td><?php echo $donnees['opponent']; ?></td>
                    <td><?php echo $donnees['network']; ?></td>
                    <td><?php echo $donnees['type']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>

    <?php
    $a = mysql_num_rows($donneesSQL2);
    if (mysql_num_rows($donneesSQL2) > 0) {
        ?>
        <table>
            <caption>Match terminé</caption>
            <tr>
                <th>Date</th>
                <th>Lineup</th>
                <th>Adversaire</th>
                <th>Réseau</th>
                <th>Type</th>
                <th>Résultats</th>
                <th>Rapport</th>
            </tr>
            <?php
            while ($donnees = mysql_fetch_array($donneesSQL2)) {
                if (!empty($donnees['resultUs']) OR !empty($donnees['resultThem'])){
                    $result = $donnees['resultUs'] . '/' . $donnees['resultThem'];
                }
                else{
                   $result = "Non renseigné";
                }                
                ?>
                <tr>
                    <td><?php echo $donnees['timestamp1']; ?></td>
                    <td><?php echo $donnees['lineup']; ?></td>
                    <td><?php echo $donnees['opponent']; ?></td>
                    <td><?php echo $donnees['network']; ?></td>
                    <td><?php echo $donnees['type']; ?></td>
                    <td><?php echo $result ?></td>
                    <td><a href="?page=match&id=<?php echo $donnees['id']; ?>">Rapport</a></td>
                </tr>
                <?php
            } // Fin de la boucle qui liste les news
            ?>
        </table>
        <?php
    }
    ?>

</div>