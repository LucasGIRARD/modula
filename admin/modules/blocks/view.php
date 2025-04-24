<h1>Blocs</h1>
<a href='?module=blocks&action=add'>Ajouter</a>

<?php
if (isset($blocks)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($blocks as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td>
        <td>' . $value['type'] . '</td>';           

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=blocks&action=disable" method="POST">
    <input type="hidden" name="blockId" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=blocks&action=enable" method="POST">
    <input type="hidden" name="blockId" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=blocks&action=modify" method="POST">
    <input type="hidden" name="blockId" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=blocks&action=delete" method="POST">
    <input type="hidden" name="blockId" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun block créé.';
}
?>