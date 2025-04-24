<h1>Centres d'intérêts</h1>
<a href='?module=activities&action=add'>Ajouter</a>
<?php
if (isset($activities)) {
    ?>
    <table>
        <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php        
        foreach ($activities as $id => $value) {
            echo '<tr>
        <td>' . $value['name'] . '</td><td>' . $value['category'] . '</td>';

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=activities&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=activities&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=activities&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=activities&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun formulaire créé.';
}
?>