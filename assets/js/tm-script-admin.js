'use strict';

const body = document.body;
const isHomeSettingsPage = document.getElementById('home-settings') ? true : '';
const isAttractEditPage = document.getElementById('tm_attract_details') ? true : '';

/*
 *  Init
 */
window.onload = function() { 

    // Toggle media uploader on button click
    toggleMediaUploader();

    // Home page settings
    if (isHomeSettingsPage) combineTeasersData();

    // Single attraction edit page
    if (isAttractEditPage) initMap(); 

};

/*
 *  General
 */

// Toggle media uploader on button click
const toggleMediaUploader = function() {
    const mediaUploaderBtns = document.querySelectorAll('.tm-media-upload');
    if (mediaUploaderBtns) {
        mediaUploaderBtns.forEach(function(e) {
            e.addEventListener('click', function() {
                setMediaUploader(e.dataset.target);
            });
        });
    }
};

/*
 *  Home page settings
 */
const combineTeasersData = () => {
    const homePageSettingsForm = document.querySelector('form[action="options.php"]');
    const homeTeasers = document.querySelectorAll('.home-teaser');
    if (homePageSettingsForm && homeTeasers) {
        homePageSettingsForm.addEventListener('submit', function() {
            for (let i = 1; i <= homeTeasers.length; i++) {
                const image = document.getElementById('home-teaser-image-' + i).value;
                const title = document.getElementById('home-teaser-title-' + i).value;
                const link = document.getElementById('home-teaser-link-' + i).value;
                const color = document.getElementById('home-teaser-color-' + i).value;
                const dataInput = document.getElementById('home-teaser-' + i);
                const data = {                
                    'image': image,
                    'title': title,
                    'link':  link,
                    'color': color
                };                      
                dataInput.value = JSON.stringify(data);
            }
        });
    }
};

// Get attraction coordinates using Google Maps
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
 *  Media uploader
 */
const setMediaUploader = (target) => {

    let mediaUploader;
    let mediaImage = document.getElementById(target);
    let mediaPreview = document.getElementById(target + '-preview');
    let mediaRemoveBtn = document.getElementById(target + '-remove');
    let attachment = '';
    
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
        mediaImage.value = attachment.id;
        mediaPreview.style.backgroundImage = 'url(' + attachment.url + ')';
        mediaPreview.classList.add('visible');
        mediaRemoveBtn.classList.add('visible');
    });

    mediaUploader.open();

    mediaRemoveBtn.addEventListener('click', function (e) {
        e.preventDefault();
        mediaImage.value = '';
        mediaPreview.style.backgroundImage = 'url()';
        mediaPreview.classList.remove('visible');
        mediaRemoveBtn.classList.remove('visible');
    });

};