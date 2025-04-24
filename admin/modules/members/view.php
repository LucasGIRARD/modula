<h1>Membres</h1>
<a href='?module=members&action=add'>Ajouter</a>

<?php
if (isset($members)) {
    ?>
    <table>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($members as $id => $value) {


            echo '<tr>
        <td>' . $value['nick'] . '</td>
        <td><form action="index.php?module=members&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=members&action=delete" method="POST">
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