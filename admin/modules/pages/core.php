<?php

include 'modules/pages/model.php';

$errorPage = '404';
$defaultPage = 'home';

$pagesCore[0] = 'home';
$pagesCore[1] = 'configuration';
$pagesCore[2] = 'modules';
$pagesCore[3] = 'credits';



$donneesSQL = select($connection, "SELECT id, alias FROM module");

foreach ($donneesSQL as $value) {
    $modulesCore[$value['id']] = $value['alias'];
}

$donneesSQL = NULL;

$page = getPage($pagesCore, $modulesCore, $errorPage, $defaultPage);



if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'listing';
}

/*
initVars
initLists


post
verifyPost


getDB
pushDB


view


file
*/




switch ($action) {
    case 'listing':
        $moduleAction[0] = 'getDB';
        $moduleAction[1] = 'view';
        break;
    case 'add':
        $moduleAction[0] = 'initVars';
        $moduleAction[1] = 'initLists';
        $moduleAction[2] = 'view';
        break;
    case 'added':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'file';
        $moduleAction[4] = 'getDB';
        $moduleAction[5] = 'view';
        break;
    case 'addedStep':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[4] = 'getDB';
        $moduleAction[5] = 'initVars';
        $moduleAction[6] = 'initLists';
        $moduleAction[7] = 'view';
        break;
    case 'addedPart':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'file';
        $moduleAction[3] = 'initLists';
        $moduleAction[4] = 'getDB';
        $moduleAction[5] = 'view';
        break;
    case 'modify':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'getDB';
        $moduleAction[3] = 'initLists';
        $moduleAction[4] = 'view';
        break;
    case 'modified':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'file';
        $moduleAction[4] = 'getDB';
        $moduleAction[5] = 'view';
        break;
    case 'modifiedPart':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'file';
        $moduleAction[3] = 'initLists';
        $moduleAction[4] = 'getDB';
        $moduleAction[5] = 'view';
        break;
    case 'delete':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'file';
        $moduleAction[4] = 'getDB';
        $moduleAction[5] = 'view';
        break;
    case 'deletePart':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'file';
        $moduleAction[3] = 'getDB';
        $moduleAction[4] = 'view';
        break;
    case 'enable':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'getDB';
        $moduleAction[4] = 'view';
        break;
    case 'disable':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'getDB';
        $moduleAction[4] = 'view';
        break;
    case 'parameters':
        $moduleAction[0] = 'getDB';
        $moduleAction[1] = 'initLists';
        $moduleAction[2] = 'view';
        break;
    case 'modifiedParameters':
        $moduleAction[0] = 'post';
        $moduleAction[1] = 'verifyPost';
        $moduleAction[2] = 'pushDB';
        $moduleAction[3] = 'getDB';
        $moduleAction[4] = 'view';
        break;
    default:
        $moduleAction[0] = 'erreur';
        break;
}
?>