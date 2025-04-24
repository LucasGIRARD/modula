function nb_aleatoire(min, max) {
    var nb = min + (max-min+1)*Math.random();
    return Math.floor(nb);
}

function lauch() {
    var Chiffre = nb_aleatoire(1, 100);
    var i=0;
    var ChiffreUtilisateur;
    var Message = "Entrez un chiffre entre 1 et 100.";
    do
    {
        ChiffreUtilisateur = prompt(Message);
        if(Chiffre > ChiffreUtilisateur)
            Message = "C'est plus!";
        else
            Message = "C'est moins!";

        i++
    }
    while(ChiffreUtilisateur != Chiffre && ChiffreUtilisateur != null);
    if (ChiffreUtilisateur == null){
        alert("Partie abandonnée au bout de "+ i +" fois, le chiffre était "+Chiffre+", dommage!");
    }
    else {
        alert("Partie gagnée en "+ i +" fois, bravo!");
    }
    
}
