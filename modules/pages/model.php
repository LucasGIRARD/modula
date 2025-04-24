<?php

function getPage() {
    global $site, $connection;
    $pagesPath = 'modules/pages/views/';
    $layoutsPath = 'modules/layout/views/';
    $baseSystemPath = $pagesPath . 'system/';


    if ($site['open'] == FALSE) {
        $systemPage = 'close';
    } elseif ($site['maintenance'] == TRUE) {
        $systemPage = 'maintenance';
    } else {
        if (isset($_GET['systemPage'])) {
            $systemPage = $_GET['systemPage'];
        } elseif (isset($_GET['page'])) {
            $donneesSQL = select($connection, "SELECT id FROM page WHERE name=?", array($_GET['page']));
            if (!empty($donneesSQL)) {
                $page = $pagesPath . $donneesSQL[0]['id'];
            } else {
                $systemPage = '404';
            }
            $donneesSQL = NULL;
        } elseif (isset($_GET['pageID'])) {
            $donneesSQL = select($connection, "SELECT name FROM page WHERE id=?", array($_GET['pageID']));
            if (!empty($donneesSQL)) {
                $page = $pagesPath . $_GET['pageID'];
            } else {
                $systemPage = '404';
            }
            $donneesSQL = NULL;            
        } else {
            $systemPage = 'home';
        }
    }

    if (isset($systemPage)) {
        switch ($systemPage) {
            case 'home':
                if (!empty($site['home'])) {
                    $page = $pagesPath . $site['home'];
                } else {
                    $page = $baseSystemPath . 'home';
                }
                break;
            case 'close':
                if (!empty($site['close'])) {
                    $page = $pagesPath . $site['close'];
                } else {
                    $page = $baseSystemPath . 'close';
                }
                break;
            case 'maintenance':
                if (!empty($site['maintenance'])) {
                    $page = $pagesPath . $site['maintenance'];
                } else {
                    $page = $baseSystemPath . 'maintenance';
                }
                break;
            case '403':
                if (!empty($site['403'])) {
                    $page = $pagesPath . $site['403'];
                } else {
                    $page = $baseSystemPath . '403';
                }
                break;
            case '404':
            default:
                if (!empty($site['404'])) {
                    $page = $pagesPath . $site['404'];
                } else {
                    $page = $baseSystemPath . '404';
                }
                break;
        }
    }

    $page = $page . '.php';

    return $page;
}

?>