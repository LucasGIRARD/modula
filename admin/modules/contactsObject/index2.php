<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';

                $id = 0;
                break;
            case 'initLists':
                switch ($action) {
                    case 'add':
                        break;
                    case 'modify':
                        break;
                }

                break;
            case 'postVars':
                $id = $_POST['id'];

                switch ($action) {
                    case 'added':
                    case 'modified':
                        $name = $_POST['name'];

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
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
                        $donneesSQL = select($connection, "SELECT name FROM object WHERE id=?", array($id));

                        list($name) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT o.id, o.name, cf.name AS formName FROM object AS o LEFT JOIN contact_form_has_object AS cfho ON cfho.OBJECT_id = o.id LEFT JOIN contact_form AS cf ON cf.id = cfho.CONTACT_FORM_id");

                        foreach ($donneesSQL as $value) {
                            if (isset($object[$value['id']])) {
                                $object[$value['id']]['formsName'] .= ', ' . $value['formName'];
                            } else {
                                $object[$value['id']]['name'] = $value['name'];
                                $object[$value['id']]['formsName'] = $value['formName'];
                            }
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO object (name) VALUES (?)", array(array($name)));
                $id = getLastId($connection);
                break;

            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE object SET name=? WHERE id=?", array(array($name, $id)));
                break;

            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM object WHERE id=?", array(array($id)));
                break;

            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE object SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE object SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/contactsObject/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/contactsObject/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/contactsObject/view_modify.php';
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