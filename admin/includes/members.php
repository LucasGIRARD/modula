<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT id, DATE_FORMAT(timestamp1,'%d/%m/%Y')AS date1, nick, admin FROM member"); 
mysql_close($DBC);
?>

<h2><a href="?page=newMember">Ajouter un membre</a></h2>

<table><tr>
        <th>Date</th>
        <th>Pseudo</th>
        <th>Admin</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php
    while ($donnees = mysql_fetch_array($donneesSQL)) { // On fait une boucle pour lister les news
        ?>
        <tr>
            <td><?php echo $donnees['date1']; ?></td>
            <td><?php echo $donnees['nick']; ?></td>
            <td><?php echo $donnees['admin']; ?></td>
            <td><?php echo '<a href="?page=modifyMember&id=' . $donnees['id'] . '">'; ?>v</a></td>
            <td><?php echo '<a href="?page=deleteMember&id=' . $donnees['id'] . '">'; ?>x</a></td>
        </tr>
    <?php
} // Fin de la boucle qui liste les news
?>
</table>