<?php

function getPage($pages, $modules, $errorPage, $defaultPage) {
    if (isset($_GET['page'])) {
        $askedPage = $_GET['page'];
        if (in_array($askedPage, $pages)) {
            $page = $askedPage;
        } else {
            $page = $errorPage;
        }
    } else {
        if (isset($_GET['module'])) {
            $askedPage = $_GET['module'];
            if (in_array($askedPage, $modules)) {
                $page = 'modules/'.$askedPage;
            } else {
                $page = $errorPage;
            }
        } else {
            $page = $defaultPage;
        }
    }
    return $page;
}

?>
