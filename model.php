<?php

function getPage($getPage) {
    $pages = array("home");
    if (in_array($getPage, $pages, true)) {
        $page = $getPage;
    } else {
        $page = "erreur";
    }
    return $page;
}

function getModule($getModule) {
    $Modules = array("news", "member", "recruit", "server", "match", "contact", "register", "connect", "away", "account", "page", "cv", "portefolio", "download", "contact", "links");
    if (in_array($getModule, $Modules, true)) {
        $module = $getModule;
    } else {
        $module = "page";
        $page = "erreur";
    }
    return $module;
}




?>