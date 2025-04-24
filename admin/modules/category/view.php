<h1>Catégorie</h1>
<a href='?module=category&action=add'>Ajouter</a>

<?php
if (isset($category)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Module</th>
            <th>Description</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($category as $id => $value) {
            echo '<tr>
        <td>' . $value['name'] . '</td>            
        <td>' . $value['moduleName'] . '</td>
        <td>' . $value['description'] . '</td>
        <td><form action="index.php?module=category&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=category&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
    </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucune catégorie créé.';
}
?>