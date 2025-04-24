<h1>Modules</h1>
<?php
if (isset($modules)) {
?>
<table>
    <tr>
        <th>Nom</th>
        <th>Status</th>
        <th>Activer / Désactiver</th>
        <th>Paramètre par défault</th>
    </tr>
    <?php
    foreach ($modules as $id => $value) {
        
        
        echo '<tr>
        <td>' . $value['name'] . '</td>';
        if ($value['system'] == TRUE) {
            echo '<td>Activé</td>
            <td></td>';
        } else {
            if ($value['enabled'] == TRUE) {
            echo '<td>Activé</td>
            <td><form action="index.php?page=modules&action=disable" method="POST">
    <input type="hidden" name="moduleId" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
        } else {
            echo '<td>Désactivé</td>
            <td><form action="index.php?page=modules&action=enable" method="POST">
    <input type="hidden" name="moduleId" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></a></td>';
        }
        }
        

        echo ' <td><a href=\'?page=modules&id=' . $id . '\'>Paramètre par défault</a></td>
    </tr>';
    }
    ?>
</table>
<?php
} else {
        echo 'Aucun module administrable.';
    }
?>