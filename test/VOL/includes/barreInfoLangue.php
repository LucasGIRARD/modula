<?php
if (!empty($_SERVER["QUERY_STRING"])) {
    $adressePage = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"] . '?' . $_SERVER["QUERY_STRING"];
    if (strstr($adressePage, 'langue=en')) {
        $adresseFR = str_replace("langue=en", "langue=fr", $adressePage);
        $adresseEN = $adressePage;
    }
    elseif (strstr($adressePage, 'langue=fr')) {
        $adresseEN = str_replace("langue=fr", "langue=en", $adressePage);
        $adresseFR = $adressePage;
    }
    else {
     $adresseFR = $adressePage.'&amp;langue=fr';
     $adresseEN = $adressePage.'&amp;langue=en';
    }
} else {
    $adressePage = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
     $adresseFR = $adressePage.'?langue=fr';
     $adresseEN = $adressePage.'?langue=en';
}
$SQL_contenu = mysql_query("SELECT contenu_page FROM VOL_page WHERE langue='".$langue."' AND nom_page='info' ") or die(mysql_error());
$tableau_contenu = mysql_fetch_array($SQL_contenu);
if (!empty($tableau_contenu[0])){
        echo "<div id='info-langue-i'>
    <table>
        <tr>
            <td id='info'>". $tableau_contenu[0] ."</td>
            <td id='langue'><a href='". $adresseFR ."'><img id='FR' alt='' src='images/France.gif' /></a> <a href='". $adresseEN ."'><img id='EN' alt='' src='images/Anglophone.png' /></a></td>
        </tr>
    </table>
</div>";
}else{
        echo "<div id='info-langue'>
    <table>
        <tr>
            <td id='info'></td>
            <td id='langue'><a href='". $adresseFR ."'><img id='FR' alt='' src='images/France.gif' /></a> <a href='". $adresseEN ."'><img id='EN' alt='' src='images/Anglophone.png' /></a></td>
        </tr>
    </table>
</div>";
}

?>
