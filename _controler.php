/*
$modules = array('accueil', 'infrastructures', 'sites', 'observations');
if (isset($_SESSION['droits']) && ($_SESSION['droits'] == "A" || $_SESSION['droits'] == "B1")) {
    array_push($modules, 'formulaires');
}
$formulairesURL = array("formulaire-infrastructure", "formulaire-site", "formulaire-observation");

$module = (isset($_GET['module'])?$_GET['module']:'');
$page = (isset($_GET['page'])?$_GET['page']:'');

if (empty($module) || (!in_array($module, $modules) && ($_SESSION['droits'] != "A" && in_array($module, array('administration','validation'))))) {
    $module = 'accueil';
}

if (empty($page)) {
    $page = "index";
}

if ($module == "formulaires" || in_array($module, $formulairesURL)) {
    $moduleI = "formulaires";
} else {
    $moduleI = $module;
}
$pageI = $page;

if ((!in_array($moduleI, $modules) && $moduleI != 'administration' && $moduleI != 'validation')) {
    $pathPage = '404.html';
} else {
    $pathPage = 'modules/' . $moduleI . '/' . $pageI . '.php';
}
*/