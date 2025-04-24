<?php

include 'include/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection, "SELECT w.id, DATE_FORMAT(w.schedule,'%d/%m/%Y <br /> %H:%i') AS schedule, l.name AS 'lineup', o.name AS 'opponent', network, t.name AS 'type'
FROM confrontation AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_confrontation AS t ON ( TYPE_id = t.id )
LEFT JOIN map AS m ON ( m.MATCH_id = w.id )
WHERE w.id NOT IN (SELECT DISTINCT MATCH_id FROM map)");
$donneesSQL2 = select($connection, "SELECT w.id, DATE_FORMAT(w.schedule,'%d/%m/%Y <br /> %H:%i') AS schedule, l.name AS 'lineup', o.name AS 'opponent', network, t.name AS 'type', SUM(resultSide1Us+resultSide2Us) AS 'resultUs', SUM(resultSide1Them+resultSide2Them) AS 'resultThem'
FROM confrontation AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_confrontation AS t ON ( TYPE_id = t.id )
LEFT JOIN map AS m ON ( m.MATCH_id = w.id )
WHERE w.id IN (SELECT DISTINCT MATCH_id FROM map)
GROUP BY MATCH_id");
closeSQLConnexion($connection);

?>
<div id="match">
    <?php
    if (count($donneesSQL) > 0) {
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
             foreach ($donneesSQL as $donnees) {
                ?>
                <tr>
                    <td><?php echo $donnees['schedule']; ?></td>
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
    if (count($donneesSQL2) > 0) {
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
            foreach ($donneesSQL2 as $donnees) {
                if (!empty($donnees['resultUs']) OR !empty($donnees['resultThem'])){
                    $result = $donnees['resultUs'] . '/' . $donnees['resultThem'];
                }
                else{
                   $result = "Non renseigné";
                }                
                ?>
                <tr>
                    <td><?php echo $donnees['schedule']; ?></td>
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