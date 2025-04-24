<h1>Téléchargement</h1>
<a href='?module=downloads&action=add'>Ajouter</a>

<?php
if (isset($downloads)) {
    ?>
    <table>
        <tr>
            <th>Catégorie</th>
            <th>Nom du fichier</th>
            <th>Type de fichier</th>
            <th>Extension</th>
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($downloads as $id => $value) {


            echo '<tr>
        <td>' . $value['category'] . '</td>
        <td>' . $value['name'] . '</td>
        <td>' . $value['extensionType'] . '</td>
        <td>' . $value['extension'] . '</td>';
            
            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=downloads&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=downloads&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }            
            
        echo '<td><form action="index.php?module=downloads&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=downloads&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
    </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun membres créé.';
}
?>