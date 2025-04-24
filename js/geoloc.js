var geocoder;
function geo() {

    if (navigator.geolocation) {
	showLoading();
	initialize();
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
		
    }
    
}
//Get the latitude and the longitude;
function successFunction(position) {
    
	var lat = position.coords.latitude;
    var lng = position.coords.longitude;
	
    codeLatLng(lat, lng);	
}

function errorFunction(){
    alert("Geocoder a échoué.");
}

function initialize() {
    geocoder = new google.maps.Geocoder();
}

function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({
        'latLng': latlng
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            console.log(results)
            if (results[1]) {
                for (i=0;i<results[1]["address_components"].length;i++){
                    results[1]
                    if (results[1]["address_components"][i]["types"][0] == "postal_code") {
                        postalCode = results[1]["address_components"][i]["long_name"];
                    }
                    if (results[1]["address_components"][i]["types"][0] == "locality") {
                        town = results[1]["address_components"][i]["long_name"];
                    }
                    if (results[1]["address_components"][i]["types"][0] == "administrative_area_level_1") {
                        county = results[1]["address_components"][i]["long_name"];
                    }
                    if (results[1]["address_components"][i]["types"][0] == "administrative_area_level_2") {
                        district = results[1]["address_components"][i]["long_name"];
                    }
                    if (results[1]["address_components"][i]["types"][0] == "country") {
                        country = results[1]["address_components"][i]["long_name"];
                    }
                }
				closeLoading();
                alert("Code Postal : "+postalCode+"\nVille : "+town+"\nPays : "+country+"\nRégion : "+district+"\nDépartement : "+county);
            } else {
			closeLoading();
                alert("Aucun résult trouvé.");
            }
        } else {
		closeLoading();
            alert("Geocoder a échoué pour la raison suivante raison : " + status);
        }
    });
}