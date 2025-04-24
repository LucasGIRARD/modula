<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'postVars':
                 
                $id = $_POST['id'];
                $title = $_POST['title'];
                $headingTitle = $_POST['headingTitle'];
                $footerCopyright = $_POST['footerCopyright'];
                $open = $_POST['open'];
                $keywords = $_POST['keywords'];
                $description = $_POST['description'];
               
                break;
            case 'verifyPost':
                if (isset($errorField) && !empty($errorField)) {
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
                $donneesSQL = select($connection, "SELECT id, title, open, headingTitle, footerCopyright, alias, keywords, description 
                            FROM configuration WHERE active='1' AND type='site'");

                list($id, $title, $open, $headingTitle, $footerCopyright, $alias, $keywords, $description) = $donneesSQL[0];

                $donneesSQL = NULL;
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE configuration SET title=?, headingTitle=?, footerCopyright=?, open=?, keywords=?, description=? WHERE id=?", array(array($title, $headingTitle, $footerCopyright, $open, $keywords, $description, $id)));                
                break;
            case 'listView':
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'configuration/view.php';
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