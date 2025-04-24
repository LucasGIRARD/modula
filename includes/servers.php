<?php
require_once 'gameq/GameQ.php';

include 'includes/SQL.php';
$connection = openSQLConnexion();
$donneesSQL = select($connection,"SELECT IP, port FROM server WHERE TYPE_SERVER_id=1 ORDER BY number");
closeSQLConnexion($connection);

$i = 1;
foreach ($donneesSQL as $donnees) {
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
                ?>
            <li><a href='#'>FFA</a></li>
               <li><a href='#'>TS</a></li>
            <li><a href='#'>HLTV</a></li>
            <li><a href='#'>WAR</a></li>
            <li id='last'><a href='#'>COTISATION</a></li>
            <?php
            }
            else {                
                ?>
            <li id='last'><a href='#'>FFA</a></li>
                <?php
            }
            ?>
            
        </ul>
    </nav>
    <br />
    <?php
    foreach ($results as $id => $data) {
        ?>
    <div class='server'>
            <?php echo $data['hostname']; ?><br />
        IP : <?php echo $data['gq_address']; ?>:<?php echo $data['gq_port']; ?><br />
        Map : <?php echo $data['map']; ?><br />
        Prochaine Map : <?php echo $data['amx_nextmap']; ?><br />
        Temps :
        <?php
        if ($data['amx_timeleft'] != '00:00') {
            ?>
            <?php echo $data['amx_timeleft']; ?>/<?php echo $data['mp_timelimit']; ?><br />
            <?php
        } else {
            ?>
            illimité<br />
            <?php
        }
        ?>
        Joueurs : <?php echo $data['num_players']; ?>/<?php echo $data['max_players']; ?><br />
        <div  class='serversPlayers'>
            <?php
        if ($data['num_players'] > 0) {
            foreach ($data['players'] as $player) {
                $time = date('H:i:s', $player['time']);                
                echo $player['name'] . ' | ' . $player['score'] . ' | ' . $time . '<br />';                
            }
        } else {
            ?>
            aucun joueur en ligne
            <?php
        }
        ?>
        </div><a href = 'steam://connect/<?php echo $data['gq_address']; ?>:<?php echo $data['gq_port']; ?>'>Rejoindre</a></div>
        <?php
    }
    ?>
</div>