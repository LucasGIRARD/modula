<h1>CVs</h1>
<a href='?module=resumes&action=add'>Ajouter</a>
<?php
if (isset($resumes)) {
    ?>
    <table>
        <tr>
            <th>Membre</th> 
            <th>Titre</th>            
            <th>Status</th>
            <th>Activer / Désactiver</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php        
        foreach ($resumes as $id => $value) {


            echo '<tr>
        <td>' . $value['member'] . '</td>
        <td>' . $value['name'] . '</td>';

            if ($value['enabled'] == TRUE) {
                echo '<td>Activer</td>
            <td><form action="index.php?module=resumes&action=disable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Désactiver" />
</form></td>';
            } else {
                echo '<td>Désactiver</td>
            <td><form action="index.php?module=resumes&action=enable" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Activer" />
</form></td>';
            }

            echo '<td><form action="index.php?module=resumes&action=modify" method="POST">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="submit" value="Modifier" />
</form></td>
              <td><form action="index.php?module=resumes&action=delete" method="POST">
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