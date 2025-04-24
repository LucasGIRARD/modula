<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="styles/style.css" />
        <title>Tigers Gamerz</title>
    </head>
    <body>
        <div id="menu">
            <header>
                <img src="images/logo.png" alt="logo" />
            </header>
            <nav>
                <ul>
                    <li><a href="?page=home">Accueil</a></li>
                    <li><a href="?page=configuration">Configuration</a></li>
                    <li><a href="?page=news">News</a></li>
                    <li><a href="?page=recruit">Recrutement</a></li>
                    <li><a href="?page=members">Membre</a></li>
                    <li><a href="?page=servers">Serveur</a></li>
                    <li><a href="?page=match">Match</a></li>
                    <li><a href="?page=contact">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div id="body">
            <div id="content"><?php include('includes/' . $page . '.php'); ?></div>
        </div>
        <footer>
            <p>copyright</p>
        </footer>
    </body>
</html>