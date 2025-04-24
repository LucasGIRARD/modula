<h1>Menus</h1>
<a href='?module=menusLinks&action=add'>Ajouter</a>

<?php
if (isset($links)) {
       
    $oldAlias = '';
    foreach ($links as $id => $value) {

        if ($value['menuAlias'] != $oldAlias) {
            echo '</table><h3>' . $value['menuName'] . ' ( ' . $value['menuAlias'] . ' )</h3>
        <table>
        <tr>
            <th>Nom</th>            
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>';
        }

        echo '<tr>
        <td>' . $value['name'] . '</td>';

        if ($value['enabled'] == TRUE) {
            echo '<td>Activer</td>
            <td><form action="index.php?module=menusLinks&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
        } else {
            echo '<td>Désactiver</td>
            <td><form action="index.php?module=menusLinks&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
        }

        echo '<td><form action="index.php?module=menusLinks&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=menusLinks&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';

        $oldAlias = $value['menuAlias'];
    }
    echo '</table>';
} else {
    echo 'Aucun menu créé.';
}
?>