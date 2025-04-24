<h1>Menus</h1>
<a href='?module=menus&action=add'>Ajouter</a>

<?php
if (isset($menus)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>            
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($menus as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td>';           

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=menus&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=menus&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=menus&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=menus&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
              </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun menu créé.';
}
?>