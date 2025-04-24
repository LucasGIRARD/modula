<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $enabled = 0;
                $category = '';
                $id = 0;
                break;
            case 'initLists':

                $donneesSQL = select($connection, "SELECT c.id, c.name
                            FROM category AS c
                            LEFT JOIN module AS m ON c.MODULE_id = m.id 
                            WHERE m.alias = 'downloads' OR c.MODULE_id IS NULL
                            ORDER BY c.name");


                foreach ($donneesSQL as $value2) {
                    $categories[$value2['id']] = $value2['name'];
                }

                $donneesSQL = NULL;
                break;
            case 'postVars':
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $id = $_POST['id'];
                        
                        $file = $_FILES["file"];
                        
                        
                        
                        break;                   
                    default :
                        $id = $_POST['id'];
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

                    if ($file['error'] != 0) {
                        $errorMessagePHPFileUpload = array("",
                            "Le fichier téléchargé excède la taille authorisé par le serveur. <!--(php.ini => upload_max_filesize) -->",
                            "Le fichier téléchargé excède la taille authorisé par le formulaire. <!--(HTML => MAX_FILE_SIZE) -->",
                            "Le fichier n'a été que partiellement téléchargé. <!-- (max_execution_time) -->",
                            "Aucun fichier n'a été téléchargé.",
                            "",
                            "Le fichier n'a pas été téléchargé. <!--(serveur => dossier temporaire) -->",
                            "Le fichier n'a pas été téléchargé. <!--(serveur => droit d'écriture) -->",
                            "Le fichier n'a pas été téléchargé. <!--(serveur => extension PHP -->");
                        if (count($errorField) > 0) {
                            $errorMessage = '<br />';
                        }
                        $errorMessage .= $errorMessagePHPFileUpload[$file['error']];
                    }
                    
                    if ($errorFile != 0) {
                        $errorMessagePHPFileUpload = array(
                            "",
                            "Une erreur lors de l'upload du fichier " . $fileName . " s'est produit.",
                            "Format de fichier non authorisé.",
                            "Le dossier final d'upload ne permet pas l'écriture à PHP.",
                            "échec de l'insertion dans la base de donnée."
                            );
                        if (count($errorField) > 0) {
                            $errorMessage = '<br />';
                        }
                        $errorMessage .= $errorMessagePHPFileUpload[$file['error']];
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
                        $donneesSQL = select($connection, "SELECT d.name, d.enabled, e.name AS extension , d.CATEGORY_id
                            FROM download AS d
                            LEFT JOIN extension_name AS en ON d.EXTENSION_NAME_id = en.id
                            LEFT JOIN extension AS e ON e.EXTENSION_NAME_id = en.id WHERE d.id=?", array($id));

                        list($name, $enabled, $extension, $category) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    case 'modified':
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT d.id, d.name, d.enabled, c.name AS category, en.name AS extensionType, e.name AS extension
                            FROM download AS d
                            LEFT JOIN category AS c ON d.CATEGORY_id = c.id
                            LEFT JOIN extension_name AS en ON d.EXTENSION_NAME_id = en.id
                            LEFT JOIN extension AS e ON e.EXTENSION_NAME_id = en.id
                            ORDER BY c.name, d.name");

                        foreach ($donneesSQL as $value2) {
                            $downloads[$value2['id']]['name'] = $value2['name'];
                            $downloads[$value2['id']]['enabled'] = $value2['enabled'];
                            $downloads[$value2['id']]['category'] = $value2['category'];
                            $downloads[$value2['id']]['extensionType'] = $value2['extensionType'];
                            $downloads[$value2['id']]['extension'] = $value2['extension'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                break;

            case 'updateDb':
                break;

            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM download WHERE id=?", array(array($id)));
                break;

            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE download SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE download SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/downloads/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/downloads/view_add.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/downloads/view_modify.php';
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