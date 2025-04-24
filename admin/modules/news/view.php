<h1>News</h1>
<a href='?module=news&action=add'>Ajouter</a>
<?php
if (isset($news)) {
    ?>
    <table>
        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Auteur</th>
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php        
        foreach ($news as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td><td>' . $value['createdDate'] . '</td><td>' . $value['author'] . '</td>';

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=news&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=news&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=news&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=news&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucune news créé.';
}
?>