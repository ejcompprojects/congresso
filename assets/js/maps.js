function initMap(){
	var unesp = {lat: -22.121344, lng: -51.408993};
	var matarazzo = {lat: -22.120827, lng: -51.379465};

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: unesp
	});

	// var latLng = new google.maps.LatLng(results.features[i].latitude_hospedagem, results.features[i].longitude_hospedagem);

	var marker = new google.maps.Marker({
		position: unesp,
		map: map
	});

	var marker_2 = new google.maps.Marker({
		position: matarazzo,
		map: map
	});



}
