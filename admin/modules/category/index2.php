<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $description = '';
                $module = '';

                $id = 0;
                break;
            case 'initLists':
                $donneesSQL = select($connection, "SELECT id, name FROM module WHERE enabled=1 AND category=1");

                foreach ($donneesSQL as $value) {
                    $modules[$value['id']] = $value['name'];
                }

                $donneesSQL = NULL;
                break;
            case 'postVars':

                switch ($action) {
                    case 'added':
                    case 'modified':
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $description = $_POST['description'];
                        $module = $_POST['module'];

                        if (empty($module)) {
                            $module = NULL;
                        }

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
                        break;
                    case 'modifiedParameters':
                        break;
                    default :
                        $id = $_POST['id'];
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
                    case 'added':
                        break;
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT name, description, MODULE_id FROM category WHERE id=?", array($id));

                        list($name, $description, $module) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    case 'modified':
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT c.id, c.name, c.description, m.name AS moduleName FROM category AS c LEFT JOIN module AS m ON c.MODULE_id = m.id");

                        foreach ($donneesSQL as $value) {
                            if (!empty($value['moduleName'])) {
                                $category[$value['id']]['moduleName'] = $value['moduleName'];
                            } else {
                                $category[$value['id']]['moduleName'] = 'TOUS';
                            }
                            $category[$value['id']]['name'] = $value['name'];
                            $category[$value['id']]['description'] = $value['description'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO category (name, description, MODULE_id) VALUES (?,?,?)", array(array($name, $description, $module)));
                        $id = getLastId($connection);
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE category SET name=?, description=?, MODULE_id=? WHERE id=?", array(array($name, $description, $module, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM category WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE category SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE category SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/category/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/category/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/category/view_modify.php';
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