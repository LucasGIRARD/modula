<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT w.id, DATE_FORMAT(w.timestamp1,'%d/%m/%Y %H:%i') AS timestamp1, l.name AS 'lineup', o.name AS 'opponent', t.name AS 'type'
FROM war AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_war AS t ON ( TYPE_id = t.id )
WHERE w.id NOT IN (SELECT DISTINCT MATCH_id FROM map)");
$donneesSQL2 = mysql_query("SELECT w.id, DATE_FORMAT(w.timestamp1,'%d/%m/%Y %H:%i') AS timestamp1, l.name AS 'lineup', o.name AS 'opponent', t.name AS 'type'
FROM war AS w
LEFT JOIN lineup AS l ON ( LINEUP_id = l.id )
LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id )
LEFT JOIN type_war AS t ON ( TYPE_id = t.id )
WHERE w.id IN (SELECT DISTINCT MATCH_id FROM map)"); 
mysql_close($DBC);
?>

<h2><a href="?page=newMatch">Ajouter un match</a></h2>

<table>
    <caption>Match en préparation</caption>
    <tr>            
        <th>Date</th>
        <th>Lineup</th>
        <th>Adversaire</th>
        <th>Type</th>
        <th>Modifier</th>
        <th>Fini</th>
        <th>Annuler</th>
    </tr>
    <?php
    while ($donnees = mysql_fetch_array($donneesSQL)) { // On fait une boucle pour lister les news
        ?>
        <tr>
            <td><?php echo $donnees['timestamp1']; ?></td>
            <td><?php echo $donnees['lineup']; ?></td>
            <td><?php echo $donnees['opponent']; ?></td>
            <td><?php echo $donnees['type']; ?></td>
            <td><?php echo '<a href="?page=modifyMatch&id=' . $donnees['id'] . '">'; ?>x</a></td>
            <td><?php echo '<a href="?page=finishedMatch&id=' . $donnees['id'] . '">'; ?>v</a></td>
            <td><?php echo '<a href="?page=deleteMatch&id=' . $donnees['id'] . '">'; ?>x</a></td>
        </tr>
        <?php
    } // Fin de la boucle qui liste les news
    ?>
</table>
<br />
<br />
<table>
    <caption>Match terminé</caption>
    <tr>            
        <th>Date</th>
        <th>Lineup</th>
        <th>Adversaire</th>
        <th>Type</th>
        <th>Modifier</th>
        <th>Effacer</th>
    </tr>
    <?php
    while ($donnees = mysql_fetch_array($donneesSQL2)) { 
        ?>
        <tr>
            <td><?php echo $donnees['timestamp1']; ?></td>
            <td><?php echo $donnees['lineup']; ?></td>
            <td><?php echo $donnees['opponent']; ?></td>
            <td><?php echo $donnees['type']; ?></td>
            <td><?php echo '<a href="?page=modifyMatch&id=' . $donnees['id'] . '">'; ?>x</a></td>
            <td><?php echo '<a href="?page=deleteMatch&id=' . $donnees['id'] . '">'; ?>x</a></td>
        </tr>
        <?php
    } 
    ?>
</table>