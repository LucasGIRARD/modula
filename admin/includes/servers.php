<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT * FROM type_server ORDER BY number");
?>
<h2><a href="?page=newServer">Ajouter un serveur</a></h2>
<?php
while ($donnees = mysql_fetch_array($donneesSQL)) {
    $donneesSQL2 = mysql_query("SELECT * FROM server WHERE TYPE_SERVER_id=".$donnees['id']." ORDER BY number");    
    ?>

    <h2><?php echo $donnees['name']; ?></h2>
    <table><tr>
            <th>Numéro</th>
            <th>IP</th>
            <th>Password</th>
            <th>Description</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php 
        while ($donnees2 = mysql_fetch_array($donneesSQL2)) { 
            ?>
            <tr>
                <td><?php echo $donnees2['number']; ?></td>
                <td><?php echo $donnees2['IP']; ?></td>
                <td><?php echo $donnees2['password']; ?></td>
                <td><?php echo $donnees2['description']; ?></td>                
                <td><?php echo '<a href="?page=modifyServer&id=' . $donnees2['id'] . '">'; ?>v</a></td>
                <td><?php echo '<a href="?page=deleteServer&id=' . $donnees2['id'] . '">'; ?>x</a></td>
            </tr>
            <?php
        } 
        echo "</table>";
    }
    mysql_close($DBC);
    ?>
