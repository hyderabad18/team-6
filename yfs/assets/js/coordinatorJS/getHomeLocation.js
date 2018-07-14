var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function (responses) {
        if (responses && responses.length > 0) {
            var addq = '';
            //for (i = 0 ; i < responses.length ; ++i) {
            var super_var1 = responses[0].address_components;
          /*  for (j = 0; j < super_var1.length; ++j) {
                var super_var2 = super_var1[j].types;
                for (k = 0; k < super_var2.length; ++k) {
                    if (super_var2[k] == "sublocality_level_1") {
                        addq = addq + ' locality : ' + super_var1[j].long_name + ' |';
                    }
                    if (super_var2[k] == "administrative_area_level_2") {
                        addq = addq + ' city : ' + super_var1[j].long_name + ' |';
                    }
                    if (super_var2[k] == "administrative_area_level_1") {
                        addq = addq + ' state : ' + super_var1[j].long_name + ' |';
                    }
                    if (super_var2[k] == "country") {
                        addq = addq + ' country : ' + super_var1[j].long_name + ' |';
                        document.getElementById('country').value = super_var1[j].long_name;
                    }
                    if (super_var2[k] == "postal_code") {
                        addq = addq + ' zipcode : ' + super_var1[j].long_name;
                        document.getElementById('zipcode').value = super_var1[j].long_name;
                    }
                }
            }*/
         //   document.getElementById('display_add').innerHTML = addq;
        }
    });
}

function updateMarkerPosition(latLng) {
    document.getElementById('homelatitude').value = latLng.lat();
    document.getElementById('homelongitude').value = latLng.lng();
}

function initialize() {
    var marker;

//console.log("homelatitude: "+document.getElementById('homelatitude').value);
    if (document.getElementById('homelatitude').value == "" || document.getElementById('homelatitude').value == "") {

        if (navigator.geolocation) {
            var locationMarker = null;
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    if (locationMarker) {
                        return;
                    }

                    // Add a marker to the map using the position.
                    var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var map = new google.maps.Map(document.getElementById('homeLocationMapCanvas'), {
                        zoom: 16,
                        center: latLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var input = document.getElementById('homeaddresssearch');
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
                },
                {
                    timeout: (5 * 1000),
                    maximumAge: (1000 * 60 * 15),
                    enableHighAccuracy: true
                }
            );
        } else {
//		   console.log("homelatitude: "+document.getElementById('homelatitude').value);
//		   console.log("homelongitude: "+document.getElementById('homelongitude').value);	
            var latLng2 = new google.maps.LatLng(document.getElementById('FreqAvaillatitude').value, document.getElementById('FreqAvaillongitude').value);
//var latLng = new google.maps.LatLng(17.385044, 78.486671);

            var map2 = new google.maps.Map(document.getElementById('FreqAvailLocationMapCanvas'), {
                zoom: 16,
                center: latLng2,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var input2 = document.getElementById('homeaddresssearch');
            var autocomplete2 = new google.maps.places.Autocomplete(input2);
            autocomplete.bindTo('bounds', map2)

            marker2 = new google.maps.Marker({
                position: latLng2,
                title: 'Your Location',
                map: map2,
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
        var latLng = new google.maps.LatLng(document.getElementById('homelatitude').value, document.getElementById('homelongitude').value);


        var map = new google.maps.Map(document.getElementById('homeLocationMapCanvas'), {
            zoom: 16,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var input = document.getElementById('homeaddresssearch');
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
