<?php

//$link = mysql_connect('mysql5-27.perso', 'versonoptique', 'A56Z45');
$link = mysql_connect('mysql51-31.perso', 'lucasgirmysql', '0DtRh3Ib');

function connect() {
    global $link;
    if (!$link) {
        die('Connexion impossible : ' . mysql_error());
    } else {
        mysql_select_db("lucasgirmysql") or die(mysql_error());
    }
}

function disconnect() {
    global $link;
    mysql_close($link);
}

function select($requete) {

    $resultatSQL = mysql_query($requete) or die(mysql_error());

// R�cup�ration des lignes de r�sultat dans un tableau
    $tab = array();
    while ($ligne = mysql_fetch_array($resultatSQL)) {
        $tab[] = $ligne;
    }

    mysql_free_result($resultatSQL);



    return $tab;
}

function selectSelect($type, $txttype) {

    $tableauNom = select("SELECT id_$type, nom_$type FROM VOL_$type");
    $champ = "<p>$txttype :</p><div><select name='$type'>";

    if (isset($_POST[$type])) {
        $champ .= "<option value=''></option>";
        foreach ($tableauNom as $ligneTableauNom) {
            if ($_POST[$type] == $ligneTableauNom["id_$type"]) {
                $champ .= "<option value='" . $ligneTableauNom["id_$type"] . "' selected='selected'>" . $ligneTableauNom["nom_$type"] . "</option>";
            } else {
                $champ .= "<option value='" . $ligneTableauNom["id_$type"] . "'>" . $ligneTableauNom["nom_$type"] . "</option>";
            }
        }
    } else {
        $champ .= "<option value='' selected='selected'></option>";
        foreach ($tableauNom as $ligneTableauNom) {
            $champ .= "<option value='" . $ligneTableauNom["id_$type"] . "'>" . $ligneTableauNom["nom_$type"] . "</option>";
        }
    }

    $champ .=" </select></div>";

    return $champ;
}

function checkboxSelect($type, $txttype) {
    $tableauNom = select("SELECT id_$type, nom_$type FROM VOL_$type ORDER BY nom_$type");
    $champ = "<p>$txttype :</p><div style='max-height:85px;overflow: auto;'>";
    
    foreach ($tableauNom as $ligneTableauNom) {
        if (isset($_POST[$type][$ligneTableauNom["id_$type"]])) {
            $champ .= "<input type='checkbox' name='" . $type . "[" . $ligneTableauNom["id_$type"] . "]' id='" . $ligneTableauNom["nom_$type"] . "' checked='checked' /> <label for='" . $ligneTableauNom["nom_$type"] . "'>" . $ligneTableauNom["nom_$type"] . "</label><br />";
        } else {
            $champ .= "<input type='checkbox' name='" . $type . "[" . $ligneTableauNom["id_$type"] . "]' id='" . $ligneTableauNom["nom_$type"] . "' /> <label for='" . $ligneTableauNom["nom_$type"] . "'>" . $ligneTableauNom["nom_$type"] . "</label><br />";
        }
    }
    $champ .='</div>';

    return $champ;
}

function lunette() {
    $requete = " WHERE VOL_lunette.active = '1'";
    if (isset($_POST['marque'])) {
        $i = 0;
        foreach ($_POST['marque'] as $id => $value) {
            if ($i > 0) {
                $requete .= " OR VOL_lunette.id_marque ='" . $id . "'";
            }
            else {
                $requete .= " AND (VOL_lunette.id_marque ='" . $id . "'";
                $i++;
            }
        }
         $requete .= ")";
    }
    if (isset($_POST['genre']) && strlen($_POST['genre']) > 0) {
        $requete .= " AND VOL_lunette.id_genre ='" . $_POST['genre'] . "'";
    }
    if (isset($_POST['type']) && strlen($_POST['type']) > 0) {
        $requete .= " AND VOL_lunette.id_type ='" . $_POST['type'] . "'";
    }
    $requete .= " ORDER BY VOL_lunette.id_marque, VOL_lunette.id_lunette";


    $requeteNbr = "SELECT COUNT(*) AS nb_lunette FROM VOL_lunette" . $requete;

    $nombreLunettePPage = 30;
    $totalLunette = select($requeteNbr);
    $totalLunette = $totalLunette[0]['nb_lunette'];
    $nombreDePages = ceil($totalLunette / $nombreLunettePPage);




    if (isset($_GET['sp'])) {
        // On r�cup�re le num�ro de la page indiqu� dans l'adresse (livreor.php?page=4)
        $sp = intval($_GET['sp']);
    } else { // La variable n'existe pas, c'est la premi�re fois qu'on charge la page {
        $sp = 1; // On se met sur la page 1 (par d�faut)
    }
// On calcule le num�ro du premier message qu'on prend pour le LIMIT de MySQL
    $premierMessageAafficher = ($sp - 1) * $nombreLunettePPage;
    $requete .= " LIMIT $premierMessageAafficher, $nombreLunettePPage";
    $requeteSelect = "SELECT VOL_lunette.id_lunette, VOL_lunette.timestamp, VOL_lunette.id_marque, VOL_marque.nom_marque, VOL_lunette.id_genre, VOL_lunette.id_type, VOL_type.nom_type FROM VOL_lunette JOIN VOL_marque ON VOL_marque.id_marque = VOL_lunette.id_marque JOIN VOL_type ON VOL_type.id_type = VOL_lunette.id_type" . $requete;
    $tableauNom = select($requeteSelect);
    $exIdMarque = "";
    $tableauLunette = '';

    $i = 1;
    foreach ($tableauNom as $ligneTableauNom) {
        if ($exIdMarque != "" && $exIdMarque != $ligneTableauNom['id_marque']) {
            $tableauLunette .= "</tr></table><table class='listeLunetteMarque'><tr><td>" . $ligneTableauNom['nom_marque'] . "<hr /></td></tr></table><table><tr>";
            $i = 1;
        } elseif ($exIdMarque != $ligneTableauNom['id_marque']) {
            $tableauLunette .= "<table class='listeLunetteMarque'><tr><td>" . $ligneTableauNom['nom_marque'] . "<hr /></td></tr></table><table><tr>";
        }
        $tableauLunette .= "<td> <a href='images/lunettes/normal/" . $ligneTableauNom['nom_marque'] . "-" . $ligneTableauNom['nom_type'] . "-" . $ligneTableauNom['id_lunette'] . ".jpg' rel='shadowbox[lunette]' title='" . $ligneTableauNom['nom_marque'] . "'> <img src='images/lunettes/mini/" . $ligneTableauNom['nom_marque'] . "-" . $ligneTableauNom['nom_type'] . "-" . $ligneTableauNom['id_lunette'] . ".jpg' alt=''> </a> <br /> </td>";
        $exIdMarque = $ligneTableauNom['id_marque'];
        if ($i == '7') {
            $tableauLunette .= "</tr><tr>";
            $i = 1;
        }
        $i++;
    }
    if ($totalLunette > 0) {
        $tableauLunette .= "</tr></table>";
    }



    if ($totalLunette > $nombreLunettePPage) {

        $tableauLunette .= '<br /><br /><center>Page : ';
        for ($i = 1; $i <= $nombreDePages; $i++) {
            $tableauLunette .= '<a href="index.php?page=lunettes&amp;sp=' . $i . '">' . $i . '</a> ';
        }
        $tableauLunette .= '</center>';
    }

    return $tableauLunette;
}

?>     