<h1>Thèmes</h1>
<a href='?module=themes&action=add'>Ajouter</a>

<?php
if (isset($themes)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($themes as $id => $value) {

            echo '<tr>
        <td>' . $value['name'] . '</td>
        <td><form action="index.php?module=themes&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=themes&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun thèmes créé.';
}
?>