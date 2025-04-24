<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $id = 0;
                $name = '';
                $alias = '';
                $enabled = 0;
                $content = '';

                $pageLayoutId = 0;
                break;
            case 'initLists':
                switch ($action) {
                    case 'add':
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT id, name FROM layout");

                        foreach ($donneesSQL as $value) {
                            $layouts[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT b.id, b.alias FROM block AS b WHERE b.enabled=1");

                        foreach ($donneesSQL as $value) {
                            $blocks[$value['id']]['alias'] = '[modula_block:' . $value['alias'] . ']';
                        }

                        $donneesSQL = NULL;
                        break;
                    case 'parameters':
                        $donneesSQL = select($connection, "SELECT id, name FROM page WHERE enabled=1");

                        foreach ($donneesSQL as $value) {
                            $pages[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;
                        break;
                }

                break;
            case 'postVars':
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $id = $_POST['pageId'];

                        $name = $_POST['name'];
                        $alias = $_POST['alias'];
                        $enabled = $_POST['enabled'];
                        $content = $_POST['content'];



                        if (empty($_POST['layout'])) {
                            $pageLayoutId = NULL;
                        } else {
                            $pageLayoutId = $_POST['layout'];
                        }

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }

                        if (empty($alias)) {
                            array_push($errorField, 'alias');
                        }
                        break;
                    case 'modifiedParameters':
                        break;
                    default :
                        $id = $_POST['pageId'];
                        break;
                }

                break;
            case 'postPVars':
                $homePage = $_POST['homePage'];
                $maintenancePage = $_POST['maintenancePage'];
                $_403Page = $_POST['403Page'];
                $_404Page = $_POST['404Page'];
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
                        $donneesSQL = select($connection, "SELECT name, alias, enabled, LAYOUT_id, content FROM page WHERE id=?", array($id));

                        list($name, $alias, $enabled, $pageLayoutId, $content) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT p.id, p.enabled, l.name AS layoutName, p.name AS pageName FROM page AS p LEFT JOIN layout AS l on l.id = p.LAYOUT_id");

                        foreach ($donneesSQL as $value) {
                            $pages[$value['id']]['name'] = $value['pageName'];
                            $pages[$value['id']]['layoutName'] = $value['layoutName'];
                            $pages[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO page (name, alias, enabled, LAYOUT_id, content) VALUES (?,?,?,?,?)", array(array($name, $alias, $enabled, $pageLayoutId, $content)));
                $id = getLastId($connection);
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE page SET name=?, alias=?, enabled=?, LAYOUT_id=?, content=? WHERE id=?", array(array($name, $alias, $enabled, $pageLayoutId, $content, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM page WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE page SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE page SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                $donneesSQL = select($connection, "SELECT mp.name, mp.value FROM module_parameters AS mp LEFT JOIN module AS m ON mp.MODULE_id = m.id WHERE m.name='page'");

                foreach ($donneesSQL as $key => $value) {
                    if ($value['name'] == "home") {
                        $homePage = $value['value'];
                    } elseif ($value['name'] == "maintenance") {
                        $maintenancePage = $value['value'];
                    } elseif ($value['name'] == "403") {
                        $_403Page = $value['value'];
                    } elseif ($value['name'] == "404") {
                        $_404Page = $value['value'];
                    }
                }

                $donneesSQL = NULL;
                break;
            case 'updatePDb':
                $queryOK = insertUpdate($connection, "UPDATE parameters AS p LEFT JOIN module AS m SET p.value=? WHERE m.name=page AND p.name=?", array(array($homePage, 'home'), array($maintenancePage, 'maintenance'), array($_403Page, '403'), array($_404Page, '404')));

                break;
            case 'listView':
                $contentView = 'modules/pages/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/pages/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/pages/view_modify.php';
                break;
            case 'parametersView':
                $contentView = 'modules/pages/view_parameters.php';
                break;
            case 'writeFile':
                $arrayTags = array();
                $arrayIncludes = array();

                $donneesSQL = select($connection, "SELECT b.id, b.alias FROM block AS b WHERE b.enabled=1");

                foreach ($donneesSQL as $value) {
                    array_push($arrayTags, '[modula_block:' . $value['alias'] . ']');
                    array_push($arrayIncludes, '<?php include \'modules/blocks/views/' . $value['id'] . '.php\'; ?>');
                }

                $donneesSQL = NULL;

                $content = str_replace($arrayTags, $arrayIncludes, $content);
                $fp = fopen('../modules/pages/views/' . $id . '.php', 'w');
                fwrite($fp, $content);
                fclose($fp);
                break;
            case 'deleteFile':
                break;
        }
    }
}
?>