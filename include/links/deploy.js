function deployHide(id) {
    if (id == "all") {
        dls=document.getElementsByTagName('dl');
        for (i=0;i<dls.length;i++){
            dls[i].style.display = "block";
            text = dls[i].previousElementSibling.childNodes[0].childNodes[0]
            text.nodeValue = "-"+text.nodeValue.substr(1);
        }
    }
    else if (id == "none") {
        dls=document.getElementsByTagName('dl');
        for (i=0;i<dls.length;i++){
            dls[i].style.display = "none";
            text = dls[i].previousElementSibling.childNodes[0].childNodes[0]
            text.nodeValue = "+"+text.nodeValue.substr(1);
        }
    }
    else {
        theDL = document.getElementById(id);
        text = theDL.previousElementSibling.childNodes[0].childNodes[0]
        if (theDL.style.display == "none"){
            theDL.style.display = "block";
            text.nodeValue = "-"+text.nodeValue.substr(1);
        }
        else {
            theDL.style.display = "none";
            text.nodeValue = "+"+text.nodeValue.substr(1);
        }
    }

}