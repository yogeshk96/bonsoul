function initializeMap(lat, lng, $selector) {
    var directionsDisplay = new google.maps.DirectionsRenderer();
    venuePosition = new google.maps.LatLng(lat, lng);
    var settings = {
        zoom: 14,
        center: venuePosition,
        mapTypeControl: false,
        navigationControl: false,
        zoomControl: false,
        streetViewControl: false,
        panControl: false,
        scrollWheel: true,
        draggable: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    window.map = new google.maps.Map($($selector)[0], settings);
    directionsDisplay.setMap(map);

    var venueMarker = new google.maps.Marker({
        position: venuePosition,
        map: map,
        id: 'Alpha',
        title: $('#venueName').val()
    });

    $('a[href="#venueMap"]').on('shown.bs.tab', function () {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(venuePosition);
    });
}