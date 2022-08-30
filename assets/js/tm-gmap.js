'use strict';

/***************/
/* Google Maps */
/***************/
// const hasMap = $('.tm-map').length > 0 ? true : false;
const attractMapContainer = document.querySelector('#tm-attract-map');
const singleMapContainers = document.querySelectorAll('.tm-side-box__map');
const mapTypeStyles = JSON.parse(tm_gmap_globals.gmap_style);

function initMap(locationsData) {

    let mapZoom = 11;
    if (window.innerWidth <= 900) mapZoom = 10;
    
    const mapOptions = {
        center: {
            lat: 46.3610867,
            lng: -72.969765
        },
        zoom: mapZoom,
        mapTypeId: "roadmap",
        mapTypeControl: false,
        clickableIcons: false,
        styles: mapTypeStyles,
    };

    let markerOptions,
        marker,
        infoWindow,
        infoWindowContent;

    if (attractMapContainer) {

        const attractMap = new google.maps.Map(attractMapContainer, mapOptions);
        const locations = locationsData;

        for (let loc of locations) {
            markerOptions = {
                position: new google.maps.LatLng(loc.lat, loc.lng),
                optimized: true,
            };
            marker = new google.maps.Marker(markerOptions);
            marker.setMap(attractMap);
            marker.setIcon(tm_gmap_globals.dir_icons + 'marker-green.svg');

            infoWindow = new google.maps.InfoWindow();

            (function(marker, loc) {
                google.maps.event.addListener(marker, "click", function(e) {
                    infoWindowContent = "<div class='marker' style = 'width:150px;min-height:100px'>";
                    infoWindowContent += "<h4 class='marker__title'>" + loc.title + "</h4>";
                    infoWindowContent += "<span class='marker__address'><a href='" + loc.gmap + "' target='_blank'>" + loc.address + "</a></span>";
                    infoWindowContent += "<span class='marker__phone'><a href='tel:+1" + loc.phone.replace(/\-|\s/g, "") + "'>" + loc.phone + "</a></span>";
                    infoWindowContent += "<span class='marker__website'><a href='" + loc.website + "' target='_blank'>Site web</a></span>";
                    infoWindowContent += "</div>";
                    infoWindow.setContent(infoWindowContent);
                    infoWindow.open(attractMap, marker);
                });
            })(marker, loc);

        }
    }

    if (singleMapContainers) {

        const locations = [
            // BIT
            {
                "lat": 46.1957065,
                "lng": -73.0032763,
                "iconColor": "green-dark",
                "mapURLID": "QRgWCveBcnfDEMKj9"
            },
            // BAT St-Alexis
            {
                "lat": 46.4624874,
                "lng": -73.1435369,
                "iconColor": "blue",
                "mapURLID": "MYRFT2fC5P986Gyk6"
            },
            // BAT St-Élie
            {
                "lat": 46.1957065,
                "lng": -73.0032763,
                "iconColor": "yellow",
                "mapURLID": "fJHaygKpExVY9tu18"
            },
        ];

        for (let i = 0; i < singleMapContainers.length; i++) {

            let map = singleMapContainers[i];
            let lat = locations[i].lat;
            let lng = locations[i].lng;
            let iconColor = locations[i].iconColor;    
            let mapURLID = locations[i].mapURLID;      
            let mapOptions = {
                center: {
                    lat: lat,
                    lng: lng
                },
                zoom: 11,
                mapTypeId: "roadmap",
                mapTypeControl: false,
                clickableIcons: false,
                styles: mapTypeStyles,
            };
            let singleMap = new google.maps.Map(map, mapOptions);            
            markerOptions = {
                position: new google.maps.LatLng(lat, lng),
                optimized: true,
            };
            marker = new google.maps.Marker(markerOptions);
            marker.setIcon(tm_globals.dir_icons + 'marker-' + iconColor + '.svg');
            marker.setMap(singleMap);

            (function(marker) {
                google.maps.event.addListener(marker, "click", function(e) {
                    window.open('https://goo.gl/maps/' + mapURLID, '_blank');
                });
            })(marker);

        }

    }
}



///////////////////////////////////////////////

(function ($) {

    // Get Map Locations
    function getMapLocations(category = 0) {

        $.ajax({
            type: 'post',
            dataType: 'html',
            url: tm_gmap_globals.ajax_url,
            cache: true,
            //global: false, // no loading animation
            data: {
                action: 'tm_get_map_locations',
                _ajax_nonce: tm_gmap_globals.nonce,
                post_type: 'attraction',
                category: category
            },
            success: function (response) {                
                response = JSON.parse(response);
                let loc = response.locations;
                initMap( Object.keys(loc).map((key) => loc[key]) );
                // console.log(loc);
            },
            error: function (response) {
                console.log('ERROR :' + response);
            },
        });

    } 

    // Load Map in listing
    $(window).on('load', function() {
        let catID = $('#listing').data('initial-cat');
        getMapLocations(catID);
    });

    // Dynamic Category Change
    const hasMap = $('.tm-map').length > 0 ? true : '';
    for (let i = 0; i < $('.tm-cat').length; i++) {
        let cat = $('.tm-cat')[i];
        cat.addEventListener('click', function(e) {
            e.preventDefault();
            let catID = this.dataset.catid;
            if (hasMap) getMapLocations(catID);
        });   
    }

})(jQuery);