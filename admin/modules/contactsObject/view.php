<h1>Objets</h1>
<a href='?module=contactsObject&action=add'>Ajouter</a>

<?php
if (isset($object)) {
    ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Formulaire(s)</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($object as $id => $value) {


            echo '<tr>
        <td>' . $value['name'] . '</td>
        <td>' . $value['formsName'] . '</td>
        <td><form action="index.php?module=contactsObject&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=contactsObject&action=delete" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Supprimer" />
</form></td>
    </tr>';
        }
        ?>
    </table>
    <?php
} else {
    echo 'Aucun objet créé.';
}
?>