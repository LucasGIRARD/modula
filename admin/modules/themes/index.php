<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                switch ($action) {
                    case 'add':
                        $name = '';
                        $alias = '';
                        $html = '';
                        $javascript = '';
                        $css = '';

                        $id = 0;
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
                        $name = $_POST['name'];
                        $alias = $_POST['alias'];
                        $html = $_POST['html'];
                        $javascript = $_POST['javascript'];
                        $css = $_POST['css'];

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }

                        break;

                    case 'addedStep':
                        break;

                    case 'modify':
                    case 'delete':
                    case 'enable':
                    case 'disable':
                        $id = $_POST['id'];
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
                        $donneesSQL = select($connection, "SELECT id, name FROM theme");

                        foreach ($donneesSQL as $value) {
                            $themes[$value['id']]['name'] = $value['name'];
                        }

                        $donneesSQL = NULL;
                        break;

                    case 'addedStep':
                    case 'addedPart':
                    case 'modifiedPart':
                    case 'deletePart':
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT name, alias, html, javascript, css FROM theme WHERE id=?", array($id));

                        list($name, $alias, $html, $javascript, $css) = $donneesSQL[0];

                        $donneesSQL = NULL;
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
                        $queryOK = insertUpdate($connection, "INSERT INTO theme (name, alias, html, javascript, css) VALUES (?,?,?,?,?)", array(array($name, $alias, $html, $javascript, $css)));
                        $id = getLastId($connection);
                        break;
                    case 'addedStep':
                        break;
                    case 'addedPart':
                        break;
                    case 'modified':
                        $queryOK = insertUpdate($connection, "UPDATE theme SET name=?, alias=?, html=?, javascript=?, css=? WHERE id=?", array(array($name, $alias, $html, $javascript, $css, $id)));
                        break;
                    case 'modifiedPart':
                        break;
                    case 'delete':
                        $queryOK = insertUpdate($connection, "DELETE FROM theme WHERE id=?", array(array($id)));
                        break;
                    case 'deletePart':
                        break;
                    case 'enable':
                        $queryOK = insertUpdate($connection, "UPDATE theme SET enabled=1 WHERE id=?", array(array($id)));
                        break;
                    case 'disable':
                        $queryOK = insertUpdate($connection, "UPDATE theme SET enabled=0 WHERE id=?", array(array($id)));
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
                        $contentView = 'modules/themes/view.php';
                        break;

                    case 'add':
                        $actionDisplay = "Ajouter";
                        $action = 'added';
                        $contentView = 'modules/themes/view_modify.php';
                        break;

                    case 'addedStep':
                        break;

                    case 'addedPart':
                    case 'modifiedPart':
                    case 'deletePart':
                    case 'modify':
                        $actionDisplay = "Modifier";
                        $action = 'modified';
                        $contentView = 'modules/themes/view_modify.php';
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
                        $themeDir = '../modules/themes/' . $id;
                        if (!is_dir($themeDir)) {
                            mkdir($themeDir, 0755, true);
                        }

                        if (!empty($javascript)) {
                            $fp = fopen('../modules/themes/' . $id . '/theme.js', 'w');
                            fwrite($fp, $javascript);
                            fclose($fp);
                            if (isset($fileJS) && !empty($fileJS)) {
                                array_push($fileJS, 'modules/themes/' . $id . '/theme.js');
                            } else {
                                $fileJS = array('modules/themes/' . $id . '/theme.js');
                            }
                        } else {
                            if (file_exists('../modules/themes/' . $id . '/theme.js')) {
                                unlink('../modules/themes/' . $id . '/theme.js');
                            }
                        }

                        if (!empty($css)) {
                            $fp = fopen('../modules/themes/' . $id . '/theme.css', 'w');
                            fwrite($fp, $css);
                            fclose($fp);
                            if (isset($fileCSS) && !empty($fileCSS)) {
                                array_push($fileCSS, 'modules/themes/' . $id . '/theme.css');
                            } else {
                                $fileCSS = array('modules/themes/' . $id . '/theme.css');
                            }
                        } else {
                            if (file_exists('../modules/themes/' . $id . '/theme.css')) {
                                unlink('../modules/themes/' . $id . '/theme.css');
                            }
                        }

                        if (!empty($html)) {
                            $arrayTags = '[modula_element:content]';
                            $arrayIncludes = '<?php include $page; ?>';
                            $html = str_replace($arrayTags, $arrayIncludes, $html);

                            $htmlFinal = '<!DOCTYPE html><html><head><meta charset="utf-8" />';
                            if (isset($fileCSS) && !empty($fileCSS)) {
                                foreach ($fileCSS as $value) {
                                    $htmlFinal .= '<link type="text/css" rel="stylesheet" href="' . $value . '" />';
                                }
                            }
                            if (isset($fileJS) && !empty($fileJS)) {
                                foreach ($fileJS as $value) {
                                    $htmlFinal .= '<script type="text/javascript" src="' . $value . '"></script>';
                                }
                            }
                            $htmlFinal .= '<title><?php echo $site["title"]; ?></title>
                                        </head>
                                        <body>';

                            $htmlFinal .= $html;

                            $htmlFinal .= '</body></html>';

                            $fp = fopen('../modules/themes/' . $id . '/views.php', 'w');
                            fwrite($fp, $html);
                            fclose($fp);
                        }
                        break;

                    case 'addedPart':
                    case 'modifiedPart':
                        break;

                    case 'delete':
                    case 'deletePart':
                        unlink('../modules/themes/' . $id . '/views.php');
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