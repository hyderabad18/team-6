function updateMarkerPosition(vLatitude, vLongitude, latLng) 
{
	document.getElementById(vLatitude).value = latLng.lat();
	document.getElementById(vLongitude).value = latLng.lng();
}

function initialize()
{
	if(document.getElementById("homelatitude") != null)
	{
		var latlng = new google.maps.LatLng(document.getElementById("homelatitude").value,document.getElementById("homelongitude").value);
		var homeOptions =
		{
			zoom: 17,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var HomeMap = new google.maps.Map(document.getElementById("homeLocationMapCanvas"), homeOptions);

		var HomeInput = document.getElementById('homeaddresssearch');
		var HomeAutocomplete = new google.maps.places.Autocomplete(HomeInput);
		HomeAutocomplete.bindTo('bounds', HomeMap)


		var HomeMarker = new google.maps.Marker(
		{
			position: latlng,
			map: HomeMap,
			title:"Home Address",
			draggable: true
	   });
		updateMarkerPosition("homelatitude", "homelongitude", latlng);

		HomeAutocomplete.addListener('place_changed', function () {
		var place = HomeAutocomplete.getPlace();
		if (!place.geometry) {
			return;
		}
		// If the place has a geometry, then present it on a map.
		if (place.geometry.viewport) {
			HomeMap.fitBounds(place.geometry.viewport);
		} else {
			HomeMap.setCenter(place.geometry.location);
			HomeMap.setZoom(17);  // Why 17? Because it looks good.
		}
		HomeMarker.setPosition(place.geometry.location);
		updateMarkerPosition("homelatitude", "homelongitude", HomeMarker.getPosition());
		});
	}

	if(document.getElementById("FreqAvaillatitude") != null)
	{
		var latlng2 = new google.maps.LatLng(document.getElementById("FreqAvaillatitude").value,document.getElementById("FreqAvaillongitude").value);

		var FreqAvailOptions =
		{
			zoom: 17,
			center: latlng2,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		};

		
		var FreqAvailMap = new google.maps.Map(document.getElementById("FrequentAvailMapCanvas"), FreqAvailOptions);

		var FreqAvailInput = document.getElementById('FreqAvailaddresssearch');
		var FreqAvailAutocomplete = new google.maps.places.Autocomplete(FreqAvailInput);
		FreqAvailAutocomplete.bindTo('bounds', FreqAvailMap)	

		var FreqAvailMarker = new google.maps.Marker(
		{
			position: latlng2,
			map: FreqAvailMap,
			title:"Frequently Available Address",
			draggable: true
		});
		updateMarkerPosition("FreqAvaillatitude", "FreqAvaillongitude", latlng2);
		/////////////
		FreqAvailAutocomplete.addListener('place_changed', function () {
			var place = FreqAvailAutocomplete.getPlace();
			if (!place.geometry) {
				return;
			}
			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
				FreqAvailMap.fitBounds(place.geometry.viewport);
			} else {
				FreqAvailMap.setCenter(place.geometry.location);
				FreqAvailMap.setZoom(16);  // Why 17? Because it looks good.
			}
			FreqAvailMarker.setPosition(place.geometry.location);
			updateMarkerPosition("FreqAvaillatitude", "FreqAvaillongitude", FreqAvailMarker.getPosition());
		});
	}
/////////////
	/*
	marker.setPosition(place.geometry.location);
	updateMarkerPosition(marker.getPosition());
	geocodePosition(marker.getPosition());
	});
	
	google.maps.event.addListener(map, 'click', function (event) {
	marker.setPosition(event.latLng);
	updateMarkerPosition(marker.getPosition());
	geocodePosition(marker.getPosition());
	});
	*/

}
google.maps.event.addDomListener(window, 'load', initialize);