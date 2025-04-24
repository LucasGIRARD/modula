function showLoading() {
body = document.getElementsByTagName("body");
body = body[0];
body.innerHTML = "<div id='loading'>Chargement<br /><br /><img src='theme/default/image/loading.gif' alt='logo chargement'/><br /><br /><a href='javascript:closeLoading()'>[Fermer]</a></div><div id='cover'></div>"+body.innerHTML;
}
function closeLoading() {
body = document.getElementsByTagName("body");
body = body[0];
loding = document.getElementById("loading");
cover = document.getElementById("cover");
body.removeChild(loading);
body.removeChild(cover);
}