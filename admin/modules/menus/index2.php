<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $alias = '';
                $enabled = 1;

                $id = 0;
                break;
            case 'initLists':
                $donneesSQL = select($connection, "SELECT id, name, enabled FROM menu_link WHERE MENU_id=?", array($id));

                $links = array();

                foreach ($donneesSQL as $value) {
                    $links[$value['id']]['name'] = $value['name'];
                    $links[$value['id']]['enabled'] = $value['enabled'];
                }

                $donneesSQL = NULL;

                break;
            case 'postVars':
 $id = $_POST['id'];
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $name = $_POST['name'];
                        $alias = $_POST['alias'];
                        $enabled = $_POST['enabled'];

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
                    default :                       
                        break;
                    case 'modifiedParameters':
                        break;
                }

                break;
            case 'postPVars':
                break;
            case 'verifyPost':
                if (!empty($errorField)) {
                    if (count($errorField) == 1) {
                        $errorMessage = 'Le champ suivant n\'a pas été rempli : ' . $errorField[0] . '.';
                    } else {
                        $errorMessage = 'Les champs suivant n\'ont pas été remplis : ' . implode(', ', $errorField) . '.';
                    }
                    $moduleAction = NULL;
                    $moduleAction[0] = 'listView';
                }
                break;
            case 'dbVars':
                switch ($action) {
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT name, alias, enabled FROM menu WHERE id=?", array($id));

                        list($name, $alias, $enabled) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT id, name, enabled FROM menu");

                        foreach ($donneesSQL as $value) {
                            $menus[$value['id']]['name'] = $value['name'];
                            $menus[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO menu (name, alias, enabled) VALUES (?,?,?)", array(array($name, $alias, $enabled)));
                $id = getLastId($connection);
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE menu SET name=?, alias=?, enabled=? WHERE id=?", array(array($name, $alias, $enabled, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM menu WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE menu SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE menu SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/menus/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/menus/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/menus/view_modify.php';
                break;
            case 'parametersView':
                break;
            case 'writeFile':
                switch ($action) {
                    case 'added':
                        break;
                    case 'modified':
                        break;
                }
                break;
            case 'deleteFile':
                break;
        }
    }
}
?>