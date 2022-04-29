@extends('layouts.app')

@section('content')

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card ">
                <div class="card-header card-header-primary">{{ __('Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        <input type="hidden" name="role" value="user">
                        <div class="form-group bmd-form-group">
                            <label for="name" class="bmd-label-floating">Full {{ __('Name') }} </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required autocomplete="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group bmd-form-group">
                            <label for="email"  class="bmd-label-floating">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  auth()->user()->email }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="phone"  class="bmd-label-floating">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ auth()->user()->phone }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="address"  class="bmd-label-floating">{{ __('Address') }}</label>
                            <input id="address" type="text" class="form-control @error('text') is-invalid @enderror" name="address" value="{{  auth()->user()->address }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <small class="text-danger">if you don't want to change password let empty</small>
                        <div class="form-group bmd-form-group">
                            <label for="password" class="bmd-label-floating">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group bmd-form-group">
                            <label for="password-confirm" class="bmd-label-floating">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        </div>

                        @if(auth()->user()->role == "user")
                        <div class="form-group ">
                            <label for="password-confirm" class="bmd-label-floating">Location On Map</label>

                        <input type="hidden"  value="{{auth()->user()->lat}}" id="latitude" name="lat">
                        <input type="hidden" value="{{auth()->user()->lng}}" id="longitude"  name="lng">
                        <div id="maps" style="height:400px;"></div>
                        </div>
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("scripts")
        @if(auth()->user()->lng == null)
        <script>
            $("#pac-input").focusin(function() {
                $(this).val('');
            });

            $('#latitude').val({{auth()->user()->lat ?? ''}});
            $('#longitude').val({{auth()->user()->lat ?? ''}});

            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('maps'), {
                    center: {lat: 24.740691, lng: 46.6528521 },
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });

                // move pin and current location
                infoWindow = new google.maps.InfoWindow;
                geocoder = new google.maps.Geocoder();
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos);
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(pos),
                            map: map,
                            title: 'موقعك الحالي'
                        });
                        markers.push(marker);
                        marker.addListener('click', function() {
                            geocodeLatLng(geocoder, map, infoWindow,marker);
                        });
                        // to get current position address on load
                        google.maps.event.trigger(marker, 'click');
                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

                var geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function(event) {
                    SelectedLatLng = event.latLng;
                    geocoder.geocode({
                        'latLng': event.latLng
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                deleteMarkers();
                                addMarkerRunTime(event.latLng);
                                SelectedLocation = results[0].formatted_address;
                                console.log( results[0].formatted_address);
                                splitLatLng(String(event.latLng));
                                $("#pac-input").css('display','block').val(results[0].formatted_address);
                            }
                        }
                    });
                });
                function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
                    var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                    /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                    $('#latitude').val(markerCurrent.position.lat());
                    $('#longitude').val(markerCurrent.position.lng());

                    geocoder.geocode({'location': latlng}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                map.setZoom(8);
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map
                                });
                                markers.push(marker);
                                infowindow.setContent(results[0].formatted_address);
                                SelectedLocation = results[0].formatted_address;
                                $("#pac-input").val(results[0].formatted_address);

                                infowindow.open(map, marker);
                            } else {
                                window.alert('No results found');
                            }
                        } else {
                            window.alert('Geocoder failed due to: ' + status);
                        }
                    });
                    SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
                }
                function addMarkerRunTime(location) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                    markers.push(marker);
                }
                function setMapOnAll(map) {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                }
                function clearMarkers() {
                    setMapOnAll(null);
                }
                function deleteMarkers() {
                    clearMarkers();
                    markers = [];
                }

                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                $("#pac-input").val("أبحث هنا ");
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(100, 100),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));


                        $('#latitude').val(place.geometry.location.lat());
                        $('#longitude').val(place.geometry.location.lng());

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            }
            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }
            function splitLatLng(latLng){
                var newString = latLng.substring(0, latLng.length-1);
                var newString2 = newString.substring(1);
                var trainindIdArray = newString2.split(',');
                var lat = trainindIdArray[0];
                var Lng  = trainindIdArray[1];

                $("#latitude").val(lat);
                $("#longitude").val(Lng);
            }
    </script>
        @else
            <script>


                $("#pac-input").focusin(function() {
                    $(this).val('');
                });
                // This example adds a search box to a map, using the Google Place Autocomplete
                // feature. People can enter geographical searches. The search box will return a
                // pick list containing a mix of places and predicted search terms.

                // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                function initAutocomplete() {
                    var map = new google.maps.Map(document.getElementById('maps'), {
                        center: { lat: {{auth()->user()->lat}},
                            lng: {{auth()->user()->lng}}},
                        zoom: 30,
                        mapTypeId: 'roadmap'
                    });
                    infoWindow = new google.maps.InfoWindow;
                    geocoder = new google.maps.Geocoder();

                    marker = new google.maps.Marker({
                        position: { lat: {{auth()->user()->lat}},
                            lng: {{auth()->user()->lng}}},
                        map: map,
                        title: '{{ auth()->user()->address }}',
                        icon: 'https://cdn2.iconfinder.com/data/icons/picons-basic-2/57/basic2-059_pin_location-128.png'

                    });
                    // move pin and current location
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            map.setCenter(pos);
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(pos),
                                map: map,
                                title: 'موقعك الحالي'
                            });
                            markers.push(marker);
                            marker.addListener('click', function() {
                                geocodeLatLng(geocoder, map, infoWindow,marker);
                            });
                            // to get current position address on load
                            google.maps.event.trigger(marker, 'click');
                        }, function() {
                            handleLocationError(true, infoWindow, map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        console.log('dsdsdsdsddsd');
                        handleLocationError(false, infoWindow, map.getCenter());
                    }

                    var geocoder = new google.maps.Geocoder();
                    google.maps.event.addListener(map, 'click', function(event) {
                        SelectedLatLng = event.latLng;
                        geocoder.geocode({
                            'latLng': event.latLng
                        }, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    deleteMarkers();
                                    addMarkerRunTime(event.latLng);
                                    SelectedLocation = results[0].formatted_address;
                                    console.log( results[0].formatted_address);
                                    splitLatLng(String(event.latLng));
                                    $('#address').val(results[0].formatted_address)
                                    $("#pac-input").css('display','block').val(results[0].formatted_address);
                                }
                            }
                        });
                    });
                    function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
                        var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                        /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                        $('#latitude').val(markerCurrent.position.lat());
                        $('#longitude').val(markerCurrent.position.lng());

                        geocoder.geocode({'location': latlng}, function(results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    map.setZoom(8);
                                    var marker = new google.maps.Marker({
                                        position: latlng,
                                        map: map
                                    });
                                    markers.push(marker);
                                    infowindow.setContent(results[0].formatted_address);
                                    SelectedLocation = results[0].formatted_address;
                                    $("#pac-input").val(results[0].formatted_address);

                                    infowindow.open(map, marker);
                                } else {
                                    window.alert('No results found');
                                }
                            } else {
                                window.alert('Geocoder failed due to: ' + status);
                            }
                        });
                        SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
                    }
                    function addMarkerRunTime(location) {
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map
                        });
                        markers.push(marker);
                    }
                    function setMapOnAll(map) {
                        for (var i = 0; i < markers.length; i++) {
                            markers[i].setMap(map);
                        }
                    }
                    function clearMarkers() {
                        setMapOnAll(null);
                    }
                    function deleteMarkers() {
                        clearMarkers();
                        markers = [];
                    }

                    // Create the search box and link it to the UI element.
                    var input = document.getElementById('pac-input');
                    $("#pac-input").val("أبحث هنا ");
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener('bounds_changed', function() {
                        searchBox.setBounds(map.getBounds());
                    });

                    var markers = [];
                    // Listen for the event fired when the user selects a prediction and retrieve
                    // more details for that place.
                    searchBox.addListener('places_changed', function() {
                        var places = searchBox.getPlaces();

                        if (places.length == 0) {
                            return;
                        }

                        // Clear out the old markers.
                        markers.forEach(function(marker) {
                            marker.setMap(null);
                        });
                        markers = [];

                        // For each place, get the icon, name and location.
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function(place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }
                            var icon = {
                                url: place.icon,
                                size: new google.maps.Size(100, 100),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                            };

                            // Create a marker for each place.
                            markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));


                            $('#latitude').val(place.geometry.location.lat());
                            $('#longitude').val(place.geometry.location.lng());

                            if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }
                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map);
                }
                function splitLatLng(latLng){
                    var newString = latLng.substring(0, latLng.length-1);
                    var newString2 = newString.substring(1);
                    var trainindIdArray = newString2.split(',');
                    var lat = trainindIdArray[0];
                    var Lng  = trainindIdArray[1];

                    $("#latitude").val(lat);
                    $("#longitude").val(Lng);

                }

            </script>
        @endif
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK6qwaZ7qTw2m755D9dC-jqhR7hoTKkm8&libraries=places&callback=initAutocomplete&language=ar&region=EG
         async defer"></script>
@endsection
