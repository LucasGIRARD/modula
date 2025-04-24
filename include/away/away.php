<?php
if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idPageAway = $_GET['id'];
    }
} else {
    $idPageAway = 1;
}
$awayPerPage = 10;
$firstLimit = ($idPageAway - 1) * $awayPerPage;


include 'include/SQL.php';
$connection = openSQLConnexion();
$totalAway = select($connection,"SELECT COUNT(*) AS nbAway FROM away");
$nbPages = ceil($totalAway[0]['nbAway'] / $awayPerPage);
$donneesSQL = select($connection,"SELECT a.id, m.id as mid, DATE_FORMAT(departure, '%d/%m/%Y | %H:%i' ) AS departure, DATE_FORMAT(comeback, '%d/%m/%Y | %H:%i' ) AS comeback, message, nick FROM away AS a LEFT JOIN member AS m ON (MEMBER_id = m.id) ORDER BY departure DESC LIMIT  $firstLimit, $awayPerPage");
closeSQLConnexion($connection);

?>
<div class='away'>
<a href="?page=awayForm">Ajouter une absence</a><br /><br />
<?php
foreach ($donneesSQL as $donnees) {
    if(empty($donnees['message'])){
       $message = "Non renseigné";
    }
    else {
        $message = $donnees['message'];
    }
    echo "<div>".$donnees['nick']." est absent du ".$donnees['departure']." jusqu'au ".$donnees['comeback']."<br />pour la raison suivante : ".$message."</div>";
    if ($_SESSION['id'] == $donnees['mid']){
        echo "<form action='?page=work' method='post'>
    <input type='hidden' name='action' value='deleteAway' />
    <input type='hidden' name='id' value='".$donnees['id']."' />
    <input type='submit' id='buttonLink' value='Supprimer' />
</form>";
    }


}
if ($nbPages > 1) {
    echo '<br /><nav>Page : ';
    for ($i = 1; $i <= $nbPages; $i++) {
        echo '<a href="?page=away&id=' . $i . '">' . $i . '</a> ';
    }
    echo "</nav>";
}
?>
</div>