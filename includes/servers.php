<?php
require_once 'gameq/GameQ.php';
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT IP, port FROM server WHERE TYPE_SERVER_id=1 ORDER BY number");
mysql_close($DBC);

$i = 1;
while ($donnees = mysql_fetch_array($donneesSQL)) {
    $servers['server' . $i] = array('cs', $donnees['IP'], $donnees['port']);
    $i++;
}

$gq = new GameQ();
$gq->addServers($servers);
$gq->setOption('timeout', 200);
$results = $gq->requestData();
?>
<div id="servers">
    <nav id="submenu">
        <ul>            
            <?php
            if (isset($_SESSION['LU'])) {
                echo "<li><a href='#'>FFA</a></li>
               <li><a href='#'>TS</a></li>
            <li><a href='#'>HLTV</a></li>
            <li><a href='#'>WAR</a></li>
            <li id='last'><a href='#'>COTISATION</a></li>";
            }
            else {
                echo "<li id='last'><a href='#'>FFA</a></li>";
            }
            ?>
            
        </ul>
    </nav>
    <br />
    <?php
    foreach ($results as $id => $data) {
        echo "<div class='server'>
            " . $data['hostname'] . "<br />
        IP : " . $data['gq_address'] . ":" . $data['gq_port'] . "<br />
        Map : " . $data['map'] . "<br />
        Prochaine Map : " . $data['amx_nextmap'] . "<br />
        Temps : ";
        if ($data['amx_timeleft'] != '00:00') {
            echo $data['amx_timeleft'] . "/" . $data['mp_timelimit'] . "<br />";
        } else {
            echo "illimité<br />";
        }
        echo "Joueurs : " . $data['num_players'] . "/" . $data['max_players'] . "<br />
        <div  class='serversPlayers'>";
        if ($data['num_players'] > 0) {
            foreach ($data['players'] as $player) {
                $time = date('H:i:s', $player['time']);
                echo $player['name'] . ' | ' . $player['score'] . ' | ' . $time . '<br />';
            }
        } else {
            echo "aucun joueur en ligne";
        }
        echo "</div><a href = 'steam://connect/" . $data['gq_address'] . ":" . $data['gq_port'] . "'>Rejoindre</a></div>";
    }
    ?>
</div>