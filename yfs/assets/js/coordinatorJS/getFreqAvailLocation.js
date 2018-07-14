var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function (responses) {
        if (responses && responses.length > 0) {
            var addq = '';
            //for (i = 0 ; i < responses.length ; ++i) {
            var super_var1 = responses[0].address_components;
     /*       for (j = 0; j < super_var1.length; ++j) {
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

function updateMarkerPosition(latLng2) {
    document.getElementById('FreqAvaillatitude').value = latLng2.lat();
    document.getElementById('FreqAvaillongitude').value = latLng2.lng();
}

function initialize1() {
    var marker2;


//console.log("FreqAvaillatitude: "+document.getElementById('FreqAvaillatitude').value);
    if (document.getElementById('FreqAvaillatitude').value == "" || document.getElementById('FreqAvaillatitude').value == "") {

        if (navigator.geolocation) {
            var locationMarker = null;
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    if (locationMarker) {
                        return;
                    }

                    // Add a marker to the map using the position.
                    var latLng2 = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var map2 = new google.maps.Map(document.getElementById('FrequentAvailMapCanvas'), {
                        zoom: 16,
                        center: latLng2,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var input2 = document.getElementById('FreqAvailaddresssearch');
                    var autocomplete2 = new google.maps.places.Autocomplete(input);
                    autocomplete2.bindTo('bounds', map2)

                    marker2 = new google.maps.Marker({
                        position: latLng,
                        title: 'Point A',
                        map: map2,
                        draggable: true
                    });
                    updateMarkerPosition(latLng2);
                    geocodePosition(latLng2);
                    autocomplete.addListener('place_changed', function () {
                        var place2 = autocomplete2.getPlace();
                        if (!place2.geometry) {
                            return;
                        }
                        // If the place has a geometry, then present it on a map.
                        if (place2.geometry.viewport) {
                            map2.fitBounds(place1.geometry.viewport);
                        } else {
                            map2.setCenter(place1.geometry.location);
                            map2.setZoom(16);  // Why 17? Because it looks good.
                        }

                        marker2.setPosition(place2.geometry.location);
                        updateMarkerPosition(marker2.getPosition());
                        geocodePosition(marker2.getPosition());
                    });

                    google.maps.event.addListener(map2, 'click', function (event) {
                        marker2.setPosition(event.latLng2);
                        updateMarkerPosition(marker2.getPosition());
                        geocodePosition(marker2.getPosition());
                    });
                    google.maps.event.addListener(marker2, 'dragstart', function () {
                    });

                    google.maps.event.addListener(marker2, 'drag', function () {
                        updateMarkerPosition(marker2.getPosition());
                    });

                    google.maps.event.addListener(marker2, 'dragend', function () {
                        geocodePosition(marker2.getPosition());
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
//          var latLng = new google.maps.LatLng(17.385044, 78.486671);
//		   console.log(document.getElementById('FreqAvaillatitude').value);
//		   console.log(document.getElementById('FreqAvaillongitude').value);		   
var latLng2 = new google.maps.LatLng(document.getElementById('FreqAvaillatitude').value, document.getElementById('FreqAvaillongitude').value);		   


            var map2 = new google.maps.Map(document.getElementById('FrequentAvailMapCanvas'), {
                zoom: 16,
                center: latLng2,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var input2 = document.getElementById('FreqAvailaddresssearch');
            var autocomplete2 = new google.maps.places.Autocomplete(input2);
            autocomplete2.bindTo('bounds', map2)

            marker2 = new google.maps.Marker({
                position: latLng2,
                title: 'Your Location',
                map: map2,
                draggable: true
            });

            updateMarkerPosition(latLng2);
            geocodePosition(latLng2);
            autocomplete.addListener('place_changed', function () {
                var place2 = autocomplete.getPlace();
                if (!place2.geometry) {
                    return;
                }
                // If the place has a geometry, then present it on a map.
                if (place2.geometry.viewport) {
                    map2.fitBounds(place2.geometry.viewport);
                } else {
                    map2.setCenter(place2.geometry.location);
                    map2.setZoom(16);  // Why 17? Because it looks good.
                }

                marker2.setPosition(place2.geometry.location);
                updateMarkerPosition(marker2.getPosition());
                geocodePosition(marker2.getPosition());
            });
            google.maps.event.addListener(map2, 'click', function (event) {
                marker2.setPosition(event.latLng2);
                updateMarkerPosition(marker2.getPosition());
                geocodePosition(marker2.getPosition());
            });
            google.maps.event.addListener(marker2, 'dragstart', function () {
            });

            google.maps.event.addListener(marker2, 'drag', function () {
                updateMarkerPosition(marker2.getPosition());
            });

            google.maps.event.addListener(marker2, 'dragend', function () {
                geocodePosition(marker2.getPosition());
            });


        }
    }
    else {
        var latLng2 = new google.maps.LatLng(document.getElementById('FreqAvaillatitude').value, document.getElementById('FreqAvaillongitude').value);


        var map2 = new google.maps.Map(document.getElementById('FrequentAvailMapCanvas'), {
            zoom: 16,
            center: latLng2,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var input2 = document.getElementById('FreqAvailaddresssearch');
        var autocomplete = new google.maps.places.Autocomplete(input2);
        autocomplete.bindTo('bounds', map2)
        marker2 = new google.maps.Marker({
            position: latLng2,
            title: 'Point A',
            map: map2,
            draggable: true
        });

        updateMarkerPosition(latLng2);
        geocodePosition(marker2.getPosition());

        autocomplete.addListener('place_changed', function () {
            var place2 = autocomplete.getPlace();
            if (!place2.geometry) {
                return;
            }
            // If the place has a geometry, then present it on a map.
            if (place2.geometry.viewport) {
                map2.fitBounds(place2.geometry.viewport);
            } else {
                map2.setCenter(place2.geometry.location);
                map2.setZoom(16);  // Why 17? Because it looks good.
            }

            marker2.setPosition(place2.geometry.location);
            updateMarkerPosition(marker2.getPosition());
            geocodePosition(marker2.getPosition());
        });
        google.maps.event.addListener(map2, 'click', function (event) {
            marker2.setPosition(event.latLng2);
            updateMarkerPosition(marker2.getPosition());
            geocodePosition(marker2.getPosition());
        });
        google.maps.event.addListener(marker2, 'dragstart', function () {
        });

        google.maps.event.addListener(marker2, 'drag', function () {
            updateMarkerPosition(marker2.getPosition());
        });

        google.maps.event.addListener(marker2, 'dragend', function () {
            geocodePosition(marker2.getPosition());
        });
    }
}


// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize1);
