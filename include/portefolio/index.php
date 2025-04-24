<?php

$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT COUNT(*) FROM portfolio");
if($donneesSQL[0][0] == 0){
    $message = "Auncun portefolio";
    //TODO : redirection page affiche $message
}
if(isset($_GET['id'])){
    if (!in_array($_GET['id'], $donneesSQL)){
        $message = "Ce portefolio n'existe pas";
        //TODO : redirection page affiche $message
    }
    $donneesSQL = select($connection,"SELECT p.id AS catId, p.name AS catName, pe.id, pe.name, link, type, technology, comment FROM portfolio AS p LEFT JOIN portfolio_element AS pe ON (pe.PORTFOLIO_id  = p.id) WHERE PORTFOLIO_id=?",array($_GET['id']));
}
else {
    $donneesSQL = select($connection,"SELECT p.id  AS catId, p.name AS catName, pe.id, pe.name, link, type, technology, comment FROM portfolio AS p LEFT JOIN portfolio_element AS pe ON (pe.PORTFOLIO_id  = p.id)");
}

//TODO : multi porte folio + sous-menu
closeSQLConnexion($connection);

include 'include/portefolio/view.php';
?>
