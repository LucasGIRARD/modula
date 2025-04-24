<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link type="text/css" rel='stylesheet' href='theme/default/style/default.css' />
        <title><?php echo $configuration['title']; ?></title>
        <style>
            /*
            #31568D : bleu gris
            #B9B9BD : gris
            */
            .leftColumn3 {
                padding-left: 5px;
                display: inline-block;
                width: 33%;
            }

            .middleColumn3 {
                text-align: center;
                display: inline-block;
                width: 33%;
            }

            .rightColumn3 {
                display: inline-block;
                text-align: right;
                width: 29.6%;
                vertical-align: top;
            }
            
            .hidden {
                display: none;
            }


            html {
                height: 100%;
            }

            body {
                margin: 0px;
                height: 100%;
                min-width: 765px;
            }

            a {
                color: #FF8027;
            }

            footer {
                border-top: 5px solid #B9B9BD;
                background-color: #31568D;                

                height: 22px;
                min-width: 300px;
                width: 100%;
                padding: 2px 0px;

                position: fixed;
                bottom: 0px;                
            }

            footer img {
                vertical-align: bottom;
            }


            #menu {
                padding: 10px;
                border-right: 5px solid #B9B9BD;
                float: left;  
                height: 100%;
                position: fixed;
                overflow-y: auto;
            }

            #menu .nav {
                padding-left: 15px;
            }

            ul {
                list-style-type: none;
                padding:0px;
            }
            
            ul ul {
                padding-left: 15px;
            }

            #menu, #body {
                height: -moz-calc(100% + 41px);
                height: -webkit-calc(100% + 41px);
                height: calc(100% - 41px); 
            }

            #body {
                padding: 10px; 
                padding-left: 250px;                         
            }

            #content {
                height: 100%;
                word-break: break-all;
            }




            textarea {
                width:99%;
                height:200px;
            }

        </style>
    </head>
    <body>
        <div id="menu">
            <header>
                <img src="theme/<?php echo $configuration['themeName']; ?>/img/logo.png" alt="logo" />
            </header>
            <div class="nav">
                <?php echo $menu; ?>
            </div>
            <br /><br />
        </div>
        <div id="body">
            <br />
<?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>
            <div id='content'>
                <?php 
                if (!empty($contentView)) {
                    include $contentView;
                }                
                ?>
                <br /><br />
            </div>            
        </div>
        <footer>
            <div class="leftColumn3">© 2012 Lucas Girard - Tous droits réservés.</div>
            <div class="middleColumn3">
                <a href="http://validator.w3.org/check?uri=referer"><img src="theme/<?php echo $configuration['themeName']; ?>/img/valid-html5-blue-v.png" alt="Valid XHTML 1.1" height="22" /></a>
                <a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;height:22px" src="http://www.w3.org/Icons/valid-css-blue.gif" alt="CSS Valide !" /></a>
            </div>
            <div class="rightColumn3"><a href="#" >remonter</a></div>
        </footer>
    </body>
</html>