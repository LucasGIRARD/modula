<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT n.id, title, DATE_FORMAT(n.timestamp1,'%d/%m/%Y') AS timestamp1, intro, content, nick AS 'auteur' FROM news AS n, member AS m ORDER BY id DESC"); 
mysql_close($DBC);
?>

<h2><a href="?page=newNews">Ajouter une news</a></h2>

<table><tr>
<th>Titre</th>
<th>Date</th>
<th>Auteur</th>
<th>Modifier</th>
<th>Supprimer</th>
</tr>
<?php
while ($donnees = mysql_fetch_array($donneesSQL)) // On fait une boucle pour lister les news
{
?>
<tr>
<td><?php echo $donnees['title']; ?></td>
<td><?php echo $donnees['timestamp1']; ?></td>
<td><?php echo stripslashes($donnees['auteur']); ?></td>
<td><?php echo '<a href="?page=modifyNews&id=' . $donnees['id'] . '">'; ?>Modifier</a></td>
<td><?php echo '<a href="?page=deleteNews&id=' . $donnees['id'] . '">'; ?>Supprimer</a></td>
</tr>
<?php
} // Fin de la boucle qui liste les news
?>
</table>
