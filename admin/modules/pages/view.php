<h1>Pages</h1>
<a href='?module=pages&action=add'>Ajouter</a><a href='?module=pages&action=parameters'>Paramètres</a>

<?php
if (isset($pages)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Modèle</th>
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($pages as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td>';

            if (!empty($value['layoutName'])) {
                echo '<td>' . $value['layoutName'] . '</td>';
            } else {
                echo '<td>Aucun modèle</td>';
            }

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=pages&action=disable" method="POST">
    <input type="hidden" name="pageId" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=pages&action=enable" method="POST">
    <input type="hidden" name="pageId" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=pages&action=modify" method="POST">
    <input type="hidden" name="pageId" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=pages&action=delete" method="POST">
    <input type="hidden" name="pageId" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucune page créée.';
}
?>