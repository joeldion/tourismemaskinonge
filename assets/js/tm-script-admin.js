'use strict';

window.onload = function() {
    // Call initMap() if editing attraction
    if (document.getElementById('tm_attract_details') !== null) initMap(); 
}

/*
 *  Get coordinates
 */
function initMap() {

    const address = document.getElementById('tm-attract-address');
    const city = document.getElementById('tm-attract-city');
    const postalCode = document.getElementById('tm-attract-postal-code');
    const fullAddress = document.getElementById('tm-attract-full-address');
    const addressFields = document.querySelectorAll('#tm-attract-address, #tm-attract-city, #tm-attract-postal-code');
    const coordinates = document.getElementById('tm-attract-coord');
    let geocoder = new google.maps.Geocoder();

    function getCoord() {

        fullAddress.value = address.value + ', ' + city.value + ' ' + postalCode.value + ' QC Canada';

        geocoder.geocode({
            'address': fullAddress.value,
        }, function(results) {
            let coord = results[0].geometry.viewport;
            let latObj = Object.values(coord)[0];
            let lngObj = Object.values(coord)[1];
            let lat = Object.values(latObj)[0];
            let lng = Object.values(lngObj)[1];
            let coordValue = lat + ',' + lng;
            coordinates.setAttribute('value', coordValue);              
        });

    }

    getCoord();

    for (let i = 0; i < addressFields.length; i++) {
        addressFields[i].addEventListener('change', function(){
            getCoord();
        });
    }

}

/*
 * Media Uploader
 */
(function ($) {

    let mediaUploader;

    const mediaUploadButtons = document.querySelectorAll('.tm-media-upload');
    for (let i = 0; i < mediaUploadButtons.length; i++) {
        let btn = mediaUploadButtons[i];
        let target = btn.dataset.target;
        let mediaImage = document.getElementById(target);
        let mediaPreview = document.getElementById(target + '-preview');
        let mediaRemoveBtn = document.getElementById(target + '-remove');
        let attachment = '';
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: tm_admin_globals.choose_an_image,
                button: {
                    text: tm_admin_globals.choose_this_image,
                },
                multiple: false,
            });

            mediaUploader.on('select', function () {
                attachment = mediaUploader.state().get('selection').first().toJSON();
                console.log(attachment);
                mediaImage.value = attachment.id;
                mediaPreview.style.backgroundImage = 'url(' + attachment.url + ')';
                mediaPreview.classList.add('visible');
                mediaRemoveBtn.classList.add('visible');
            });
    
            mediaUploader.open();

        });

        mediaRemoveBtn.addEventListener('click', function (e) {
            e.preventDefault();
            mediaImage.value = '';
            mediaPreview.style.backgroundImage = 'url()';
            mediaPreview.classList.remove('visible');
            mediaRemoveBtn.classList.remove('visible');
        });

    }

})(jQuery);