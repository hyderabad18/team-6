var geocoder1 = new google.maps.Geocoder();

function geocodePosition(pos) {
    geocoder1.geocode({
        latLng: pos
    }, function (responses) {
        if (responses && responses.length > 0) {
            var addq = '';
            //for (i = 0 ; i < responses.length ; ++i) {
            var super_var1 = responses[0].address_components;
            for (j = 0; j < super_var1.length; ++j) {
                var super_var2 = super_var1[j].types;
                for (k = 0; k < super_var2.length; ++k) {
                    if (super_var2[k] == "sublocality_level_1") {
                        addq = addq + ' locality : ' + super_var1[j].long_name + ' |';
						document.getElementById('address').value = super_var1[j].long_name;
                    }
                    if (super_var2[k] == "administrative_area_level_2") {
                        addq = addq + ' city : ' + super_var1[j].long_name + ' |';
						document.getElementById('city').value = super_var1[j].long_name;
                    }
                    if (super_var2[k] == "administrative_area_level_1") {
                        addq = addq + ' state : ' + super_var1[j].long_name + ' |';
						document.getElementById('state').value = super_var1[j].long_name;
                    }
                    if (super_var2[k] == "country") {
                        addq = addq + ' country : ' + super_var1[j].long_name + ' |';
                        document.getElementById('country').value = super_var1[j].long_name;
                    }
                    if (super_var2[k] == "postal_code") {
                        addq = addq + ' zipcode : ' + super_var1[j].long_name;
						if(document.getElementById('zipcode') != null)
	                        document.getElementById('zipcode').value = super_var1[j].long_name;
                    }
                }
            }
			if(document.getElementById('display_add') != null)
	            document.getElementById('display_add').innerHTML = addq;
        }
    });
}

function updateMarkerPosition(latLng) {
	document.getElementById('address').value = "";
	document.getElementById('city').value = "";
	document.getElementById('state').value = "";
	document.getElementById('country').value = "";
	document.getElementById('zipcode').value = "";
    document.getElementById('latitude').value = latLng.lat();
    document.getElementById('longitude').value = latLng.lng();
}

function initialize() {
    var marker;


    if (document.getElementById('latitude').value == "" || document.getElementById('longitude').value == "") {

        if (navigator.geolocation) {
            var locationMarker = null;
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    if (locationMarker) {
                        return;
                    }

                    // Add a marker to the map using the position.
                    var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                        zoom: 16,
                        center: latLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var input = document.getElementById('addresssearch');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo('bounds', map)

                    marker = new google.maps.Marker({
                        position: latLng,
                        title: 'Point A',
                        map: map,
                        draggable: true
                    });
                    updateMarkerPosition(latLng);
                    geocodePosition(latLng);
                    autocomplete.addListener('place_changed', function () {
                        var place = autocomplete.getPlace();
                        if (!place.geometry) {
                            return;
                        }
                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(16);  // Why 17? Because it looks good.
                        }

                        marker.setPosition(place.geometry.location);
                        updateMarkerPosition(marker.getPosition());
                        geocodePosition(marker.getPosition());
                    });

                    google.maps.event.addListener(map, 'click', function (event) {
                        marker.setPosition(event.latLng);
                        updateMarkerPosition(marker.getPosition());
                        geocodePosition(marker.getPosition());
                    });
                    google.maps.event.addListener(marker, 'dragstart', function () {
                    });

                    google.maps.event.addListener(marker, 'drag', function () {
                        updateMarkerPosition(marker.getPosition());
                    });

                    google.maps.event.addListener(marker, 'dragend', function () {
                        geocodePosition(marker.getPosition());
                    });
                },
                function (error) {
					var latLng = new google.maps.LatLng(null,null);
                    var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                        zoom: 16,
                        center: latLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var input = document.getElementById('addresssearch');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo('bounds', map)

                    marker = new google.maps.Marker({
                        position: latLng,
                        title: 'Point A',
                        map: map,
                        draggable: true
                    });
                    updateMarkerPosition(latLng);
                   // geocodePosition(latLng);
                    autocomplete.addListener('place_changed', function () {
                        var place = autocomplete.getPlace();
                        if (!place.geometry) {
                            return;
                        }
                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(16);  // Why 17? Because it looks good.
                        }

                        marker.setPosition(place.geometry.location);
                        updateMarkerPosition(marker.getPosition());
                        geocodePosition(marker.getPosition());
                    });

                    google.maps.event.addListener(map, 'click', function (event) {
                        marker.setPosition(event.latLng);
                        updateMarkerPosition(marker.getPosition());
                        geocodePosition(marker.getPosition());
                    });
                    google.maps.event.addListener(marker, 'dragstart', function () {
                    });

                    google.maps.event.addListener(marker, 'drag', function () {
                        updateMarkerPosition(marker.getPosition());
                    });

                    google.maps.event.addListener(marker, 'dragend', function () {
                        geocodePosition(marker.getPosition());
                    });
                },
                {
                    timeout: (5 * 1000),
                    maximumAge: (1000 * 60 * 15),
                    enableHighAccuracy: true
                }
            );
        } else {
            //var latLng = new google.maps.LatLng(document.getElementById('latitude').value, document.getElementById('longitude1').value);


            var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom: 16,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var input = document.getElementById('addresssearch');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map)

            marker = new google.maps.Marker({
                position: latLng,
                title: 'Your Location',
                map: map,
                draggable: true
            });

            updateMarkerPosition(latLng);
            geocodePosition(latLng);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(16);  // Why 17? Because it looks good.
                }

                marker.setPosition(place.geometry.location);
                updateMarkerPosition(marker.getPosition());
                geocodePosition(marker.getPosition());
            });
            google.maps.event.addListener(map, 'click', function (event) {
                marker.setPosition(event.latLng);
                updateMarkerPosition(marker.getPosition());
                geocodePosition(marker.getPosition());
            });
            google.maps.event.addListener(marker, 'dragstart', function () {
            });

            google.maps.event.addListener(marker, 'drag', function () {
                updateMarkerPosition(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragend', function () {
                geocodePosition(marker.getPosition());
            });


        }
    }
    else {
        var latLng = new google.maps.LatLng(document.getElementById('latitude').value, document.getElementById('longitude').value);


        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: 16,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var input = document.getElementById('addresssearch');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map)
        marker = new google.maps.Marker({
            position: latLng,
            title: 'Point A',
            map: map,
            draggable: true
        });

        updateMarkerPosition(latLng);
        geocodePosition(marker.getPosition());

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(16);  // Why 17? Because it looks good.
            }

            marker.setPosition(place.geometry.location);
            updateMarkerPosition(marker.getPosition());
            geocodePosition(marker.getPosition());
        });
        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng);
            updateMarkerPosition(marker.getPosition());
            geocodePosition(marker.getPosition());
        });
        google.maps.event.addListener(marker, 'dragstart', function () {
        });

        google.maps.event.addListener(marker, 'drag', function () {
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function () {
            geocodePosition(marker.getPosition());
        });
    }
}


// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
