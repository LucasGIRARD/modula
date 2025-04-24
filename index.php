<?php
session_start();
if (isset($_GET['page'])) {
    
    $pages = array("news", "fullNews", "members", "member", "recruit", "recruitForm", "memberscs", "servers", "matchs", "match", "contact", "register", "connect", "work", "away", "awayForm", "account");
    if (in_array($_GET['page'], $pages, true)){
       $page = $_GET['page']; 
    }
    else {        
        $page = "news";
    }
} else {
    $page = "news";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="styles/style.css" />
        <title>CV - informaticien - analyste-développeur - Lucas Girard</title>
    </head>
    <body>
        <div id="body">
            <header>
                <img src="images/banniere.png" alt="bannière" />
            </header>
            <nav id="menu">
                <ul>
                    <li><a href="?page=news">News</a></li>
                    <?php
                    if (!isset($_SESSION['LU'])) {
                        echo "<li><a href='?page=recruit'>Recrutement</a></li>";
                    }
                    ?>
                    <li><a href="?page=members">Membres</a></li>
                    <li><a href="?page=servers">Serveurs</a></li>
                    <li><a href="?page=matchs">Matches</a></li>
                    <li><a href="?page=contact">Contact</a></li>
                                                            <?php
                    if (isset($_SESSION['LU'])) {
                        echo "<li><a href='?page=away'>Absence</a></li>";
                    }
                    ?>
                    <?php
                    if (!isset($_SESSION['pseudo'])) {
                        echo "<li><a href='?page=register'>Inscription</a></li><li id='last'><form action='?page=connect' method='post'>
    <input type='hidden' name='page' value='" . $page . "' />
    <input type='submit' id='unconnectButton' value='Connexion' />
</form></li>";
                    } else {
                        echo "<li><a href='?page=account'>Compte</a></li><li id='last'><form action='?page=work' method='post'>
    <input type='hidden' name='action' value='unconnect' />
    <input type='hidden' name='page' value='" . $page . "' />
    <input type='submit' id='unconnectButton' value='Déconnexion' />
</form></li>";
                    }
                    ?>
                </ul>
            </nav>
            <div id="content"><?php include 'includes/' . $page . '.php'; ?></div>
            <footer>
                <p>copyright</p>
            </footer>
        </div>
    </body>
</html>