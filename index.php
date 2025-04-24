<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Tigers Gamerz</title>
        <script>
            /*************************************************
     Fonction de definition de l'object xhr
             **************************************************/
            function new_xhr(){
                var xhr_object = null;
                if(window.XMLHttpRequest) // Firefox et autres
                    xhr_object = new XMLHttpRequest();
                else if(window.ActiveXObject){ // Internet Explorer
                    try {
                        xhr_object = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                else { // XMLHttpRequest non supporté par le navigateur
                    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
                    xhr_object = false;
                }
                return xhr_object;
            }
            /*****************************************************
     Fonction qui va recharger le contenu
             ******************************************************/

            /*  function load_page(select) {
                var xhr2 = new_xhr();//On crée un nouvel objet XMLHttpRequest

                xhr2.onreadystatechange = function(){
                    if ( xhr2.readyState == 4 ){//Actions executées une fois le chargement fini
                        if(xhr2.status  != 200){//Message si il se produit une erreur
                            document.getElementById("content").innerHTML ="Error code " + xhr2.status;
                        } else {//On met le contenu du fichier externe dans la div "content"
                            document.getElementById("content").innerHTML = xhr2.responseText;
                        }
                    } else {//Message affiché pendant le chargement
                        document.getElementById("content").innerHTML = "Chargement en cours ...<br /><img src='loading.gif' alt=''/>";
                    }
                }
                xhr2.open( "GET", select.split('!')[1], true);
                xhr2.send(null);
            }*/



            function load_page(select, div) {
                var xhr2 = new_xhr();//On crée un nouvel objet XMLHttpRequest

                xhr2.onreadystatechange = function(){
                    if ( xhr2.readyState == 4 ){//Actions executées une fois le chargement fini
                        if(xhr2.status  != 200){//Message si il se preduit une erreur
                            document.getElementById(div).innerHTML ="Error code " + xhr2.status;
                        } else {//On met le contenu du fichier externe dans la div                          
                            document.getElementById(div).innerHTML = xhr2.responseText;                            
                            
                            if(window.ActiveXObject){
                               
                            }
                            else {
                                window.history.pushState(page, page, page);
                            }
                        }
                    } else {//Message affiché pendant le chargement
                        document.getElementById(div).innerHTML = "Chargement en cours ...<br /><img src='loading.gif' alt=''/>";
                    }
                }
                var page = select.split('=')[1]+".html";
                xhr2.open( "GET", page, true);
                xhr2.send(null);
            }


        </script>
    </head>
    <body>
        <div id="body">
            <header>
                <img src="banniere.png" alt="bannière" />
            </header>
            <nav id="menu">
                <ul>
                    <li><a href="?page=news" onclick="load_page(this.href, 'content');return false;">News</a></li>
                    <li><a href="?page=recruit" onclick="load_page(this.href, 'content');return false;">Recrutement</a></li>
                    <li><a href="?page=members" onclick="load_page(this.href, 'content');return false;">Membres</a></li>
                    <li><a href="?page=servers" onclick="load_page(this.href, 'content');return false;">Serveurs</a></li>
                    <li><a href="?page=calendar" onclick="load_page(this.href, 'content');return false;">Calendrier</a></li>
                    <li><a href="?page=match" onclick="load_page(this.href, 'content');return false;">Matches</a></li>
                    <li id="last"><a href="?page=contact" onclick="load_page(this.href, 'content');return false;">Contact</a></li>
                </ul>
            </nav>
            <div id="content"></div>
            <footer>
                <p>copyright</p>
            </footer>
        </div>
    </body>
</html>