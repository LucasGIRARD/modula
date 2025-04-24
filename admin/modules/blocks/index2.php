<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $alias = '';
                $layout = '';
                $module = '';
                $content = '';
                $enabled = 1;

                $id = 0;
                break;
            case 'initLists':
                $donneesSQL = select($connection, "SELECT id, name FROM block_layout WHERE enabled = 1");

                foreach ($donneesSQL as $value) {
                    $blockLayout[$value['id']] = $value['name'];
                }

                $donneesSQL = NULL;

                $donneesSQL = select($connection, "SELECT id, name FROM module WHERE enabled=1 AND element=1");

                foreach ($donneesSQL as $value) {
                    $modules[$value['id']] = $value['name'];
                }

                $donneesSQL = NULL;

                break;
            case 'postVars':
                $id = $_POST['blockId'];
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $name = $_POST['name'];
                        $alias = $_POST['alias'];
                        $layout = $_POST['layout'];
                        $module = $_POST['module'];
                        $content = $_POST['content'];
                        $enabled = $_POST['enabled'];

                        if (isset($_POST['element']) && !empty($_POST['element'])) {
                            $element = $_POST['element'];
                        } else {
                            $element = NULL;
                        }

                        if (empty($layout)) {
                            $layout = NULL;
                        }

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
                        $donneesSQL = select($connection, "SELECT enabled, name, alias, content, BLOCK_LAYOUT_id, MODULE_id, ELEMENT_id FROM block WHERE id=?", array($id));

                        list($enabled, $name, $alias, $content, $layout, $module, $element) = $donneesSQL[0];

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT id, name FROM element_pattern WHERE enabled = 1 AND MODULE_id = ?", array($module));

                        foreach ($donneesSQL as $value) {
                            $elements[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT blp.name, blp.value, blpl.value AS valueList FROM block_layout_parameter AS blp LEFT JOIN block_layout_parameter_list AS blpl ON blpl.BLOCK_LAYOUT_PARAMETER_id = blp.id WHERE blp.BLOCK_LAYOUT_id=?", array($layout));

                        foreach ($donneesSQL as $value) {
                            if (!isset($blockParameter[$value['name']])) {
                                $blockParameter[$value['name']]['value'] = $value['value'];
                                if (!empty($value['valueList'])) {
                                    $blockParameter[$value['name']]['values'] = array();
                                    $blockParameter[$value['name']]['type'] = 'select';
                                } else {
                                    $blockParameter[$value['name']]['type'] = 'input';
                                }
                            }
                            if (!empty($value['valueList'])) {
                                array_push($blockParameter[$value['name']]['values'], $value['valueList']);
                            }
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT name, value FROM block_parameter WHERE BLOCK_id=?", array($layout));

                        foreach ($donneesSQL as $value) {
                            $blockParameter[$value['name']]['value'] = $value['value'];
                            $blockParameter[$value['name']]['type'] = $value['type'];
                        }

                        $donneesSQL = NULL;
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT b.id, b.name, b.enabled, bl.name AS type FROM block AS b LEFT JOIN block_layout AS bl ON b.BLOCK_LAYOUT_id = bl.id");

                        foreach ($donneesSQL as $value) {
                            $blocks[$value['id']]['name'] = $value['name'];
                            $blocks[$value['id']]['enabled'] = $value['enabled'];
                            $blocks[$value['id']]['type'] = $value['type'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO block (enabled, name, alias, content, BLOCK_LAYOUT_id, MODULE_id, ELEMENT_id) VALUES (?,?,?,?,?,?,?)", array(array($enabled, $name, $alias, $content, $layout, $module, $element)));
                $id = getLastId($connection);
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE block SET enabled=?, name=?, alias=?, content=?, BLOCK_LAYOUT_id=?, MODULE_id=?, ELEMENT_id=? WHERE id=?", array(array($enabled, $name, $alias, $content, $layout, $module, $element, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM block WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE block SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE block SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/blocks/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/blocks/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/blocks/view_modify.php';
                break;
            case 'parametersView':
                break;
            case 'writeFile':
                if (empty($layout) && !empty($module)) {
                    $donneesSQL = select($connection, "SELECT id, name FROM module WHERE enabled=1 AND element=1");

                    foreach ($donneesSQL as $value2) {
                        $modules[$value2['id']] = $value2['name'];
                    }

                    $donneesSQL = NULL;


                    $arrayTags = '[modula_element:content]';

                    $arrayIncludes = '<?php ';

                    switch ($modules[$module]) {
                        case 'menus':
                            $arrayIncludes .= '$donneesSQL = select($connection, "SELECT name, link FROM menu_link WHERE MENU_id = ' . $id . ' ORDER BY position");';
                            break;

                        default:
                            break;
                    }



                    $arrayIncludes .= 'foreach ($donneesSQL as $value) {
                                        include \'modules/elements/views/1.php\';
                                       }
                                       $donneesSQL = NULL;   
                                       ?>';



                    $content = str_replace($arrayTags, $arrayIncludes, $content);
                }

                $fp = fopen('../modules/blocks/views/' . $id . '.php', 'w');
                fwrite($fp, $content);
                fclose($fp);
                break;
            case 'deleteFile':
                unlink('../modules/blocks/views/' . $id . '.php');
                break;
        }
    }
}
?>