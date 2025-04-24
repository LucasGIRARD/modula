<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $alias = '';
                $enabled = '';
                $type = '';
                $link = '';
                $linkPage = '';
                $position = '';
                $linkMenu = '';
                $linkParent = '';

                $id = 0;
                break;
            case 'initLists':
                switch ($action) {
                    case 'add':
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT id, name FROM page");

                        foreach ($donneesSQL as $value) {
                            $pages[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT id, name FROM menu");

                        foreach ($donneesSQL as $value) {
                            $menus[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT id, name FROM menu_link");

                        foreach ($donneesSQL as $value) {
                            $links[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;
                        break;
                }

                break;
            case 'postVars':
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $name = $_POST['name'];
                        $alias = $_POST['alias'];
                        $enabled = $_POST['enabled'];
                        $type = $_POST['type'];
                        $link = $_POST['link'];
                        $linkPage = $_POST['linkPage'];
                        $position = $_POST['position'];
                        $linkMenu = $_POST['linkMenu'];
                        $linkParent = $_POST['linkParent'];
                        $id = $_POST['id'];
                        if ($linkPage == "") {
                            $linkPage = NULL;
                        }

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
                    default :
                        $id = $_POST['id'];
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
                        $donneesSQL = select($connection, "SELECT name, alias, enabled, link, position, MENU_id, PAGE_id, parentId, type FROM menu_link WHERE id=?", array($id));

                        list($name, $alias, $enabled, $link, $position, $linkMenu, $linkPage, $linkParent, $type) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT ml.id, ml.name, ml.enabled, m.name AS menuName, m.alias AS menuAlias 
                                FROM menu_link AS ml 
                                LEFT JOIN menu AS m ON ml.MENU_id = m.id 
                                ORDER BY m.alias, ml.name");

                        foreach ($donneesSQL as $value) {
                            $links[$value['id']]['name'] = $value['name'];
                            $links[$value['id']]['enabled'] = $value['enabled'];
                            $links[$value['id']]['menuName'] = $value['menuName'];
                            $links[$value['id']]['menuAlias'] = $value['menuAlias'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO menu_link (name, alias, enabled, link, position, MENU_id, PAGE_id, parentId, type) VALUES (?,?,?,?,?,?,?,?,?)", array(array($name, $alias, $enabled, $link, $position, $linkMenu, $linkPage, $linkParent, $type)));
                $id = getLastId($connection);
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE menu_link SET name=?, alias=?, enabled=?, link=?, position=?, MENU_id=?, PAGE_id=?, parentId=?, type=? WHERE id=?", array(array($name, $alias, $enabled, $link, $position, $linkMenu, $linkPage, $linkParent, $type, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM menu_link WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE menu_link SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE menu_link SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/menusLinks/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/menusLinks/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/menusLinks/view_modify.php';
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