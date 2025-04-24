<?php
function getModule($getModule) {
    //TODO : replace by SQL query
    $Modules = array("home");
    if (in_array($getModule, $Modules, true)) {
        $module = $getModule;
    } else {
        $module = "page";
        $page = "erreur";
    }
    return $module;
}
?>