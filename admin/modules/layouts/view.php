<h1>Modèles</h1>
<a href='?module=layouts&action=add'>Ajouter</a>

<?php
if (isset($layouts)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Page(s)</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($layouts as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td>
        <td>' . $value['pages'] . '</td>
        <td><form action="index.php?module=layouts&action=modify" method="POST">
    <input type="hidden" name="layoutId" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=layouts&action=delete" method="POST">
    <input type="hidden" name="layoutId" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
    </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun modèle créé.';
}
?>