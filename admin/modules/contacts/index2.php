<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = "";
                $account = "";
                $enabled = 0;
                $elementLastname = 0;
                $elementFirstname = 0;
                $elementEmailAdress = 0;
                $elementEntreprise = 0;
                $elementWebsite = 0;
                $elementObject = 0;
                $elementMessage = 0;
                $elementCaptcha = 0;
                $elementNeededLastname = 0;
                $elementNeededFirstname = 0;
                $elementNeededEmailAdress = 0;
                $elementNeededEntreprise = 0;
                $elementNeededWebsite = 0;
                $elementNeededObject = 0;
                $elementNeededMessage = 0;
                $id = 0;
                break;
            case 'initLists':
                $donneesSQL = select($connection, "SELECT id, name FROM object");

                foreach ($donneesSQL as $value) {
                    $objects[$value['id']]['name'] = $value['name'];
                }

                $donneesSQL = NULL;
                break;
            case 'postVars':
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $id = $_POST['id'];

                        $name = $_POST['name'];
                        $account = $_POST['account'];
                        $enabled = $_POST['enabled'];
                        if (isset($_POST['elementLastname'])) {
                            $elementLastname = $_POST['elementLastname'];
                        } else {
                            $elementLastname = NULL;
                        }

                        if (isset($_POST['elementFirstname'])) {
                            $elementFirstname = $_POST['elementFirstname'];
                        } else {
                            $elementFirstname = NULL;
                        }

                        if (isset($_POST['elementEmailAdress'])) {
                            $elementEmailAdress = $_POST['elementEmailAdress'];
                        } else {
                            $elementEmailAdress = NULL;
                        }

                        if (isset($_POST['elementEntreprise'])) {
                            $elementEntreprise = $_POST['elementEntreprise'];
                        } else {
                            $elementEntreprise = NULL;
                        }

                        if (isset($_POST['elementWebsite'])) {
                            $elementWebsite = $_POST['elementWebsite'];
                        } else {
                            $elementWebsite = NULL;
                        }

                        if (isset($_POST['elementObject'])) {
                            $elementObject = $_POST['elementObject'];
                        } else {
                            $elementObject = NULL;
                        }

                        if (isset($_POST['elementMessage'])) {
                            $elementMessage = $_POST['elementMessage'];
                        } else {
                            $elementMessage = NULL;
                        }

                        if (isset($_POST['elementCaptcha'])) {
                            $elementCaptcha = $_POST['elementCaptcha'];
                        } else {
                            $elementCaptcha = NULL;
                        }

                        if (isset($_POST['elementNeededLastname'])) {
                            $elementNeededLastname = $_POST['elementNeededLastname'];
                        } else {
                            $elementNeededLastname = NULL;
                        }

                        if (isset($_POST['elementNeededFirstname'])) {
                            $elementNeededFirstname = $_POST['elementNeededFirstname'];
                        } else {
                            $elementNeededFirstname = NULL;
                        }

                        if (isset($_POST['elementNeededEmailAdress'])) {
                            $elementNeededEmailAdress = $_POST['elementNeededEmailAdress'];
                        } else {
                            $elementNeededEmailAdress = NULL;
                        }

                        if (isset($_POST['elementNeededEntreprise'])) {
                            $elementNeededEntreprise = $_POST['elementNeededEntreprise'];
                        } else {
                            $elementNeededEntreprise = NULL;
                        }

                        if (isset($_POST['elementNeededWebsite'])) {
                            $elementNeededWebsite = $_POST['elementNeededWebsite'];
                        } else {
                            $elementNeededWebsite = NULL;
                        }

                        if (isset($_POST['elementNeededObject'])) {
                            $elementNeededObject = $_POST['elementNeededObject'];
                        } else {
                            $elementNeededObject = NULL;
                        }

                        if (isset($_POST['elementNeededMessage'])) {
                            $elementNeededMessage = $_POST['elementNeededMessage'];
                        } else {
                            $elementNeededMessage = NULL;
                        }

                        if (isset($_POST['objects'])) {
                            foreach ($_POST['objects'] as $key => $value) {
                                $objects[$key]['name'] = $value;
                                $objects[$key]['used'] = '1';
                            }
                        } else {
                            $objects = NULL;
                        }

                        if (isset($_POST['objectsOld'])) {
                            foreach ($_POST['objectsOld'] as $key => $value) {
                                $objectsOld[$key] = '1';
                            }
                        } else {
                            $objectsOld = NULL;
                        }

                        $objectsAdd = array();

                        if (!empty($objects)) {
                            foreach ($objects as $key => $value) {
                                if (!isset($objectsOld[$key])) {
                                    array_push($objectsAdd, array($key));
                                }
                            }
                        }
                        if (!empty($objectsOld)) {
                            $objectsDelete = array();
                            foreach ($objectsOld as $key => $value) {
                                if (!isset($objects[$key])) {
                                    array_push($objectsDelete, array($key));
                                }
                            }
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
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT name, captchaAccount, enabled, lastname, firstname, emailAdress, entreprise, website, object, message, captcha, neededLastname, neededFirstname, neededEmailAdress, neededEntreprise, neededWebsite, neededObject, neededMessage FROM contact_form WHERE id=?", array($id));

                        list($name, $account, $enabled, $elementLastname, $elementFirstname, $elementEmailAdress, $elementEntreprise, $elementWebsite, $elementObject, $elementMessage, $elementCaptcha, $elementNeededLastname, $elementNeededFirstname, $elementNeededEmailAdress, $elementNeededEntreprise, $elementNeededWebsite, $elementNeededObject, $elementNeededMessage) = $donneesSQL[0];

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT OBJECT_id as id FROM contact_form_has_object WHERE CONTACT_FORM_id=?", array($id));

                        foreach ($donneesSQL as $value) {
                            $objectsOld[$value['id']]['used'] = '1';
                        }

                        $donneesSQL = NULL;
                        break;                   
                    default:
                        $donneesSQL = select($connection, "SELECT id, name, enabled FROM contact_form");


                        foreach ($donneesSQL as $value) {
                            $contactforms[$value['id']]['name'] = $value['name'];
                            $contactforms[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO contact_form (name, captchaAccount, enabled, lastname, firstname, emailAdress, entreprise, website, object, message, captcha, neededLastname, neededFirstname, neededEmailAdress, neededEntreprise, neededWebsite, neededObject, neededMessage) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array(array($name, $account, $enabled, $elementLastname, $elementFirstname, $elementEmailAdress, $elementEntreprise, $elementWebsite, $elementObject, $elementMessage, $elementCaptcha, $elementNeededLastname, $elementNeededFirstname, $elementNeededEmailAdress, $elementNeededEntreprise, $elementNeededWebsite, $elementNeededObject, $elementNeededMessage)));
                $id = getLastId($connection);
                if (!empty($objectsAdd)) {
                    $queryOK = insertUpdate($connection, "INSERT INTO contact_form_has_objects (CONTACT_FORM_id, OBJECT_id) VALUES ($id,?)", $objectsAdd);
                }
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE contact_form SET name=?, captchaAccount=?, enabled=?, lastname=?, firstname=?, emailAdress=?, entreprise=?, website=?, object=?, message=?, captcha=?, neededLastname=?, neededFirstname=?, neededEmailAdress=?, neededEntreprise=?, neededWebsite=?, neededObject=?, neededMessage=? WHERE id=?", array(array($name, $account, $enabled, $elementLastname, $elementFirstname, $elementEmailAdress, $elementEntreprise, $elementWebsite, $elementObject, $elementMessage, $elementCaptcha, $elementNeededLastname, $elementNeededFirstname, $elementNeededEmailAdress, $elementNeededEntreprise, $elementNeededWebsite, $elementNeededObject, $elementNeededMessage, $id)));
                
                if (!empty($objectsDelete)) {
                    $queryOK = insertUpdate($connection, "DELETE FROM contact_form_has_objects WHERE OBJECT_id=?", $objectsDelete);
                }

                if (!empty($objectsAdd)) {
                    $queryOK = insertUpdate($connection, "INSERT INTO contact_form_has_objects (CONTACT_FORM_id, OBJECT_id) VALUES (?,?)", $objectsAdd);
                }
                break;

            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM contact_form WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE contact_form SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE contact_form SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/contacts/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/contacts/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/contacts/view_modify.php';
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