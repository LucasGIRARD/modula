/*
example de lien
<a href="?page=news" onclick="load_page(this.href, 'content');return false;">
*/
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
/*
function load_page(select) {
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
                /*test            
                if(window.ActiveXObject){
                               
                }
                else {
                    window.history.pushState(page, page, page);
                }
                fin test*/
            }
        } else {//Message affiché pendant le chargement
            document.getElementById(div).innerHTML = "Chargement en cours ...<br /><img src='loading.gif' alt=''/>";
        }
    }
    var page = select.split('=')[1]+".html";
    xhr2.open( "GET", page, true);
    xhr2.send(null);
}