<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT c.id, DATE_FORMAT(c.timestamp1,'%d/%m/%Y %H:%i')AS date1, nick, object, wasRead, answered 
    FROM contact AS c LEFT JOIN member AS m ON ( c.MEMBER_id = m.id )"); 
mysql_close($DBC);
?>   
<table><tr>            
        <th>Date</th>
        <th>Pseudo</th>
        <th>objet</th>        
        <th>Lu(s)</th>
        <th>Répondu</th>
        <th>Lire/Répondre</th>
        <th>Supprimer</th>
    </tr>
    <?php
    while ($donnees = mysql_fetch_array($donneesSQL)) { // On fait une boucle pour lister les news
        ?>
        <tr>
            <td><?php echo $donnees['date1']; ?></td>
            <td><?php echo $donnees['nick']; ?></td>
            <td><?php echo $donnees['object']; ?></td>
            <td><?php echo $donnees['wasRead']; ?></td>
            <td><?php echo $donnees['answered']; ?></td>
            <td><?php echo '<a href="?page=readAnswerContact&id=' . $donnees['id'] . '">'; ?>v</a></td>
            <td><?php echo '<a href="?page=deleteContact&id=' . $donnees['id'] . '">'; ?>x</a></td>
        </tr>
        <?php
    } // Fin de la boucle qui liste les news
    ?>
</table>