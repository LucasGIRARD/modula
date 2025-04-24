<?php
if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idMatch = $_GET['id'];
    }
} else {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}

include 'includes/SQL.php';
$connection = openSQLConnexion();
$donneesSQL2 = select($connection, "SELECT side1CT, resultSide1Us, resultSide2Us, resultSide1Them, resultSide2Them, rapport, name FROM map WHERE MATCH_id=?", array($idMatch));
$donneesSQL1 = select($connection, "SELECT DATE_FORMAT(c.schedule,'%d/%m/%Y | %H:%i') AS schedule, l.name AS 'lineup', o.name AS 'opponent', site, network, t.name AS 'type' FROM confrontation AS c LEFT JOIN lineup AS l ON ( LINEUP_id = l.id ) LEFT JOIN opponent AS o ON ( OPPONENT_id = o.id ) LEFT JOIN type_confrontation AS t ON ( TYPE_id = t.id ) WHERE c.id=?", array($idMatch));
closeSQLConnexion($connection);
$donnees=$donneesSQL1[0];
$donneesSQL=null;
?>
<div id='match'>
    <span class='key'>Date : </span><?php echo $donnees['schedule']; ?><br />
    <span class='key'>Lineup : </span><?php echo $donnees['lineup']; ?><br />
    <span class='key'>Adversaire : </span>
    <?php
    if (!empty($donnees['site'])) {
        echo "<a href='http://" . $donnees['site'] . "'>" . $donnees['opponent'] . "</a>";
    } else {
        echo $donnees['opponent'];
    }
    ?>
    <br />
    <span class='key'>Réseau : </span><?php echo $donnees['network']; ?><br />
    <span class='key'>Type : </span><?php echo $donnees['type']; ?><br />
    <span class='key'>Nombre de map : </span><?php echo count($donneesSQL); ?><br />
    <?php
    $i = 1;
    foreach ($donneesSQL2 as $donnees) {
        if ($donnees['side1CT'] == '1') {
            $side = "CT";
        } elseif ($donnees['side1CT'] == '0') {
            $side = "Terro";
        } else {
            $side = "Non renseigné";
        }
        if (!empty($donnees['name'])) {
            $name = $donnees['name'];
        } else {
            $name = "Non renseigné";
        }
        if ($donnees['side1CT'] == '1') {
            $side = "CT";
        } elseif ($donnees['side1CT'] == '0') {
            $side = "Terro";
        } else {
            $side = "Non renseigné";
        }
        if (!empty($donnees['resultSide1Us'])) {
            $resultSide1Us = $donnees['resultSide1Us'];
        } else {
            $resultSide1Us = "Non renseigné";
        }
        if (!empty($donnees['resultSide1Them'])) {
            $resultSide1Them = $donnees['resultSide1Them'];
        } else {
            $resultSide1Them = "Non renseigné";
        }
        if (!empty($donnees['resultSide2Us'])) {
            $resultSide2Us = $donnees['resultSide2Us'];
        } else {
            $resultSide2Us = "Non renseigné";
        }
        if (!empty($donnees['resultSide2Them'])) {
            $resultSide2Them = $donnees['resultSide2Them'];
        } else {
            $resultSide2Them = "Non renseigné";
        }
        if (!empty($donnees['rapport'])) {
            $rapport = $donnees['rapport'];
        } else {
            $rapport = "Non renseigné";
        }
        ?>
        <div class='map'><span class='key'>Map N° <?php echo $i; ?></span><br />
            <span class='key'>Nom de la map : </span><?php echo $name; ?><br />
            <span class='key'>Premier side : </span><?php echo $side; ?><br />
            <span class='key'>Résultat 1<sup>er</sup> side : </span><?php echo $resultSide1Us; ?>/<?php echo $resultSide1Them; ?><br />
            <span class='key'>Résultat 2<sup>ème</sup> side : </span><?php echo $resultSide2Us; ?>/<?php echo $resultSide2Them; ?><br />
            <span class='key'>Rapport : </span><?php echo $rapport; ?></div>
        <?php
        $i++;
    }
    ?>
</div>