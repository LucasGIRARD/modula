<h1>Eléments</h1>
<a href='?module=elements&action=add'>Ajouter</a>

<?php
if (isset($elements)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Module</th>
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($elements as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td>
        <td>' . $value['module'] . '</td>';

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=elements&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=elements&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=elements&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=elements&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun élément créé.';
}
?>