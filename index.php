<?php
$time_start = microtime(true);
include_once 'dev.php';

ini_set('arg_separator.output', '&amp;');

session_start();
include_once 'include/SQL.php';
$connection = openSQLConnexion();

$donneesSQL = select($connection, "SELECT c.open, c.title, c.headingTitle, c.footerCopyright, THEME_id AS theme, PAGE_id_home, PAGE_id_maintenance, PAGE_id_403, PAGE_id_404, PAGE_id_close FROM configuration AS c ORDER BY c.id LIMIT 1");

list($site['open'], $site['title'], $site['headingTitle'], $site['footerCopyright'], $site['theme'], $site['home'], $site['maintenance'], $site['403'], $site['404'], $site['close']) = $donneesSQL[0];

$donneesSQL = NULL;

include_once 'modules/pages/core.php';

//include_once 'theme/' . $site['theme'] . '/index.php';
include_once 'modules/themes/views/' . $site['theme'] . '.php';

closeSQLConnexion($connection);
$time_end = microtime(true);
$time = $time_end - $time_start;
echo "affichage en $time secondes";
?>