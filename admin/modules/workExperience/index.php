<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                switch ($action) {
                    case 'add':
                        break;
                    case 'addedStep':
                        break;
                    default:
                        break;
                }
                break;
            case 'initLists':
                switch ($action) {
                    case 'add':
                        break;

                    case 'addedStep':
                        break;

                    case 'modify':
                    case 'addedPart':
                    case 'modifiedPart':
                    case 'deletePart':
                        break;

                    case 'parameters':
                    case 'modifiedParameters':
                        break;
                    default:
                        break;
                }
                break;
            case 'post':
                switch ($action) {
                    case 'modified':
                        $id = $_POST['id'];
                    case 'added':
                        break;

                    case 'addedStep':
                        break;

                    case 'modify':
                    case 'delete':
                    case 'enable':
                    case 'disable':
                        break;

                    case 'addedPart':
                        break;

                    case 'modifiedPart':
                        break;

                    case 'deletePart':
                        break;

                    case 'modifiedParameters':
                        break;
                    default:
                        break;
                }
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
            case 'getDB':
                switch ($action) {
                    case 'listing':
                    case 'added':
                    case 'modified':
                    case 'delete':
                    case 'enable':
                    case 'disable':

                        break;

                    case 'addedStep':
                    case 'addedPart':
                    case 'modifiedPart':
                    case 'deletePart':
                    case 'modify':

                        break;

                    case 'parameters':
                    case 'modifiedParameters':

                        break;

                    default:

                        break;
                }
                break;
            case 'pushDB':
                switch ($action) {
                    case 'added':
                        break;
                    case 'addedStep':
                        break;
                    case 'addedPart':
                        break;
                    case 'modified':
                        break;
                    case 'modifiedPart':
                        break;
                    case 'delete':
                        $queryOK = insertUpdate($connection, "DELETE FROM starter WHERE id=?", array(array($id)));
                        break;
                    case 'deletePart':
                        break;
                    case 'enable':
                        $queryOK = insertUpdate($connection, "UPDATE starter SET enabled=1 WHERE id=?", array(array($id)));
                        break;
                    case 'disable':
                        $queryOK = insertUpdate($connection, "UPDATE starter SET enabled=0 WHERE id=?", array(array($id)));
                        break;
                    case 'modifiedParameters':
                        break;
                    default:
                        break;
                }
                break;
            case 'view':
                switch ($action) {
                    case 'added':
                    case 'modified':
                    case 'delete':
                    case 'enable':
                    case 'disable':
                    case 'listing':
                        $contentView = 'modules/starter/view.php';
                        break;

                    case 'add':
                        $actionDisplay = "Ajouter";
                        $action = 'added';
                        $contentView = 'modules/starter/view_add.php';
                        break;

                    case 'addedStep':
                        break;

                    case 'addedPart':
                    case 'modifiedPart':
                    case 'deletePart':
                    case 'modify':
                        $actionDisplay = "Modifier";
                        $action = 'modified';
                        $contentView = 'modules/starter/view_modify.php';
                        break;

                    case 'parameters':
                    case 'modifiedParameters':
                        break;
                    default:
                        break;
                }
                break;
            case 'file':
                switch ($action) {
                    case 'added':
                    case 'modified':
                        break;

                    case 'addedPart':
                    case 'modifiedPart':
                        break;

                    case 'delete':
                    case 'deletePart':
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
    }
}
?>