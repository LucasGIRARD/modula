<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $content = '';

                $id = 0;
                break;
            case 'initLists':
                $donneesSQL = select($connection, "SELECT b.id, b.alias FROM block AS b WHERE b.enabled=1");

                foreach ($donneesSQL as $value) {
                    $blocks[$value['id']]['alias'] = '[modula_block:' . $value['alias'] . ']';
                }

                $donneesSQL = NULL;
                break;
            case 'postVars':
                $id = $_POST['layoutId'];
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $name = $_POST['name'];
                        $content = $_POST['content'];

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
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
                        $donneesSQL = select($connection, "SELECT name, content FROM layout WHERE id=?", array($id));

                        list($name, $content) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;                    
                    default:
                        $donneesSQL = select($connection, "SELECT l.id, l.name AS layoutName, p.name AS pageName FROM layout AS l LEFT JOIN page AS p on l.id = p.LAYOUT_id ORDER BY l.id");

                        foreach ($donneesSQL as $value) {

                            if (isset($layouts[$value['id']])) {
                                $layouts[$value['id']]['pages'] .= ', ' . $value['pageName'];
                            } else {
                                $layouts[$value['id']]['name'] = $value['layoutName'];
                                $layouts[$value['id']]['pages'] = $value['pageName'];
                            }
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO layout (name, content) VALUES (?,?)", array(array($name, $content)));
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE layout SET name=?, content=? WHERE id=?", array(array($name, $content, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM layout WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                break;
            case 'disableDb':
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/layouts/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/layouts/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/layouts/view_modify.php';
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