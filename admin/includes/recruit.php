<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT r.id, m.id as mid, cs.id as csid, microphone, TS3, WIRE, knowUs, other, m.steamFriend, CS.nick AS 'pseudo',
DATE_FORMAT(r.timestamp1,'%d/%m/%Y') AS date1, DATE_FORMAT(r.timestamp1,'%H:%i') AS hour1
FROM recruitment AS r
LEFT JOIN member AS m ON ( r.MEMBER_id = m.id )
LEFT JOIN CS ON ( CS.MEMBER_id = r.MEMBER_id )"); 
mysql_close($DBC);
?>

<table><tr>
        <th>Date</th>
        <th>Pseudo</th>
        <th>Micro</th>
        <th>TS3</th>
        <th>WIRE</th>
        <th>Connu ?</th>
        <th>Autre(s)</th>
        <th>Steam</th>
        <th>Accepter</th>
        <th>Refuser</th>
    </tr>
    <?php
    while ($donnees = mysql_fetch_array($donneesSQL)) { // On fait une boucle pour lister les news
        ?>
        <tr>
            <td><?php echo $donnees['date1']."<br />".$donnees['hour1']; ?></td>
            <td><?php echo $donnees['pseudo']; ?></td>
            <td><?php echo $donnees['microphone']; ?></td>
            <td><?php echo $donnees['TS3']; ?></td>
            <td><?php echo $donnees['WIRE']; ?></td>
            <td><?php echo $donnees['knowUs']; ?></td>
            <td><?php echo $donnees['other']; ?></td>
            <td><?php echo $donnees['steamFriend']; ?></td>
            <td><?php echo '<a href="?page=acceptRecruit&id=' . $donnees['id'] . '&mid=' . $donnees['mid'] . '">'; ?>v</a></td>
            <td><?php echo '<a href="?page=refuseRecruit&id=' . $donnees['id'] . '&csid=' . $donnees['csid'] . '">'; ?>x</a></td>
        </tr>
    <?php
} // Fin de la boucle qui liste les news
?>
</table>
