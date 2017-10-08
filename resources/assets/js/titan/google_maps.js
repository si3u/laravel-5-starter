function initGoogleMap(selector, latitude, longitude, zoom_level)
{
    var mapCoords = new google.maps.LatLng(latitude, longitude);

    var mapOptions = {
        zoom: zoom_level,
        center: mapCoords,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

	var map = new google.maps.Map(document.getElementById(selector), mapOptions);
	
	addGoogleMapsMarker(map, latitude, longitude, '16');
	
    return map;
}

function addGoogleMapsMarker(map, latitude, longitude, icon, title )
{
    var marker = new google.maps.Marker({
        map: map,
        icon: '/images/pins/' + icon + '.png',
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(latitude, longitude),
		title: title
    });

    return marker;
}