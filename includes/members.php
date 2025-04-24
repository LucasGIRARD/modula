<?php
if (isset($_GET['id'])) {
    if (!is_numeric($_GET['id'])) {
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php");
    } else {
        $idPageMember = $_GET['id'];
    }
} else {
    $idPageMember = 1;
}
$memberPerPage = 100;
$firstLimit = ($idPageMember - 1) * $memberPerPage;
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT COUNT(*) AS nbMember FROM member");
$donnees = mysql_fetch_array($donneesSQL);
$totalMember = $donnees['nbMember'];
$nbPages = ceil($totalMember / $memberPerPage);
$donneesSQL = mysql_query("SELECT id, nick FROM member AS m ORDER BY m.id DESC LIMIT  $firstLimit, $memberPerPage");
mysql_close($DBC);
?>
<div id="members">
    <nav id="submenu">
        <ul>
            <li><a href='?page=members'>TOUS</a></li>
            <li id='last'><a href='?page=memberscs'>CS</a></li>
        </ul>
    </nav>
    <br />
    <div class="lineup">
        <ul>
            <?php
            while ($donnees = mysql_fetch_array($donneesSQL)) {
                echo '<li><a href="?page=member&id=' . $donnees['id'] . '">' . $donnees['nick'] . '</a></li>';
            }
            ?>

        </ul>
        <div class="navnews">
            <?php
            if ($nbPages > 1) {
                echo 'Page : ';
                for ($i = 1; $i <= $nbPages; $i++) {
                    echo '<a href="?page=news&id=' . $i . '">' . $i . '</a> ';
                }
            }
            ?>
        </div>
    </div>
</div>