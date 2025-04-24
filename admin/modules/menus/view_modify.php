<h1><?php echo $actionDisplay; ?> un menu</h1>
<a href="?module=menus">Listing</a>

<form action="index.php?module=menus&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom du menu :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="alias">Alias du menu :</label><input type="text" id="alias" name="alias" value="<?php echo $alias; ?>" /></div>
        <div>
            <label for="enabled">Activé :</label>
            <select id="enabled" name="enabled">
                <?php
                if ($enabled == 0) {
                    echo '<option value="1">Oui</option>                
                <option value="0" selected="selected">Non</option>';
                } elseif ($enabled == 1) {
                    echo '<option value="1" selected="selected">Oui</option>                
                <option value="0">Non</option>';
                } else {
                    echo '<option value="1">Oui</option>                
                <option value="0">Non</option>';
                }
                ?>                
            </select>
        </div>                
    </fieldset>

    <?php
    if (isset($links) && !empty($links)) {
        echo '<fieldset>
        <legend><label for="content">Liens</label></legend><table>
        <tr>
        <th>Nom</th>            
        <th>Status</th>
        <th>Activer / Désactiver</th>
        <th>Modifier</th>
        <th>Supprimer</th>
        </tr>';
        foreach ($links as $id => $value) {
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
        }
        echo '</table></fieldset>';
    }
    ?>


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>