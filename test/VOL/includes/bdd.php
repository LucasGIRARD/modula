<?php
$SQL_contenu = mysql_query("SELECT contenu_page FROM VOL_page WHERE langue='".$langue."' AND nom_page='".$page."' ") or die(mysql_error());
$tableau_contenu = mysql_fetch_array($SQL_contenu);
echo $tableau_contenu[0];
?>