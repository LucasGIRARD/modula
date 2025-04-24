<?php
include_once '../dev.php';

ini_set('arg_separator.output', '&amp;');
//session_cache_limiter('private_no_expire');
//session_cache_limiter('private_no_expire, must-revalidate');
session_start();
include_once '../include/SQL.php';
$connection = openSQLConnexion();

$donneesSQL = select($connection,"SELECT c.open, c.title, c.headingTitle, c.footerCopyright, THEME_id AS theme,t.name AS themeName FROM configuration AS c LEFT JOIN theme AS t ON c.THEME_id = t.id ORDER BY c.id LIMIT 1");

$configuration['title'] = $donneesSQL[0]['title'];
$configuration['open'] = $donneesSQL[0]['open'];
$configuration['headingTitle'] = $donneesSQL[0]['headingTitle'];
$configuration['footerCopyright'] = $donneesSQL[0]['footerCopyright'];
$configuration['theme'] = $donneesSQL[0]['theme'];
$configuration['themeName'] = $donneesSQL[0]['themeName'];

$donneesSQL = NULL;

include_once 'modules/pages/core.php';

include_once 'modules/menus/core.php';
/*
unset($donneesSQL);
unset($moduleAction);
unset($value);
unset($action);
unset($pagesCore);
unset($modulesCore);
unset($errorPage);
unset($defaultPage);
*/

include_once 'theme/'.$configuration['themeName'].'/index.php';

closeSQLConnexion($connection);
?>