'use strict';

const htmlEl = document.querySelector('html');
const body = document.body;
const header = document.querySelector('header');
const navSmall = document.querySelector('.nav--small');
const navLarge = document.querySelector('.nav--large');
const navToggler = document.querySelector('.nav__toggler');
const postID = parseInt(document.querySelector('main').getAttribute('id').replace('post-', ''));
const isRetina = window.devicePixelRatio > 1 ? true : false;
const isHome = document.querySelector('body').classList.contains('home');
const isPost = document.querySelector('body').classList.contains('single-post');
// const is_archive = body.classList.contains('archive');

// Retina slides
const slide = document.getElementById('slide');
if (slide.classList.contains('has_retina')) {
    if (isRetina && window.innerWith > 767 ) {
        let retinaSlideUrl = slide.dataset['image-2x'];
        slide.style.backgroundImage = 'url(' + retinaSlideUrl + ')';
    }
}

// Detect Scroll
const stickyElements = [header, navLarge, navToggler];
window.addEventListener('scroll', function () {
    if (window.pageYOffset >= 300) {
        for (let i = 0; i < stickyElements.length; i++) {
            stickyElements[i].classList.add('sticky');
        }
    } else {
        for (let i = 0; i < stickyElements.length; i++) {
            stickyElements[i].classList.remove('sticky');
        }
    }
});

// Main menu toggler
const toggler = document.querySelector('.nav__toggler');
const smallMenu = document.querySelector('.nav--small');
const largeMenu = document.querySelector('.nav--large');
const largeMenuList = document.querySelector('.nav--large .nav__list');
const navIcons = document.querySelector('.nav__icons');
let hiddenIcons = document.querySelectorAll('.nav__icon.hidden');
let animated = false;
toggler.addEventListener('click', function () {  

    // Disable click during animation
    if (animated) return false;
    animated = true;
    setTimeout(function(){
        animated = false;
    }, 800);

    // Show/hide large navigation menu
    if (!this.classList.contains('active')) {
        setTimeout(function () {
            largeMenuList.classList.add('active');
            navIcons.classList.add('active');
            hiddenIcons.forEach(function(e){
                e.classList.remove('hidden');
            });
            smallMenu.classList.add('active');
        }, 400);
    } else {
        largeMenuList.classList.remove('active');
        navIcons.classList.remove('active');
        hiddenIcons.forEach(function(e){
            e.classList.add('hidden');
        });
        smallMenu.classList.remove('active');
    }  
    toggler.classList.toggle('active');
    largeMenu.classList.toggle('active');
    htmlEl.classList.toggle('noscroll--mobile');

});

// Mobile submenu dropdown
const menuWithChildren = document.querySelectorAll('.menu .has-children');
if (window.innerWidth <= 767) {
    for (let i = 0; i < menuWithChildren.length; i++) {
        if (window.innerWidth <= 767) {
            let toggler = menuWithChildren[i].querySelector('a');
                toggler.addEventListener('click', function (e) {
                    e.preventDefault();
                    let submenu = menuWithChildren[i].querySelector('.sub-menu');
                    submenu.classList.toggle('active');
                });
        }
    }
}

// Modal
const modal = document.querySelector('.tm-modal');
const modalOverlay = document.querySelector('.tm-overlay');
const modalCloseBtn = document.getElementById('modal-close');
const closeModal = function() {
    htmlEl.classList.remove('noscroll');
    modal.remove();
    modalOverlay.remove();
};
if (modal) {

    // No scrolling when modal is visible
    htmlEl.classList.add('noscroll');

    // Close modal with "X" button
    modalCloseBtn.addEventListener('click', function() {
        closeModal();
    });

    // Close modal with "ESC" key
    document.addEventListener('keydown', function (e) {
        if (e.keyCode === 27) closeModal();
    });

}

// Search Popup
const searchToggler = document.getElementById('search-toggler');
const searchPopup = document.querySelector('.tm-search-popup');
const searchClose = document.getElementById('tm-search-close');
const searchPopupOpen = function() {
    searchPopup.classList.add('active');
    document.getElementById('tm-search-input').focus();
    htmlEl.classList.add('noscroll');
};
const searchPopupClose = function() {
    searchPopup.classList.remove('active');
    htmlEl.classList.remove('noscroll');
};
searchToggler.addEventListener('click', function () {
    searchPopupOpen();
});
document.addEventListener('keydown', function (e) {
    if (e.keyCode === 27 && searchPopup.classList.contains('active')) {
        searchPopupClose();
    }
});
searchClose.addEventListener('click', function () {
    searchPopupClose();
});

// Top slide: replace image for HiRes devices
const slides = document.querySelectorAll('.slide');
window.onload = function() {
    if (window.innerWidth > 767 && isRetina) {
        for (let i = 0; i < slides.length; i++) {
            let slide2x = slides[i].dataset['image-2x'];
            slides[i].style.backgroundImage = 'url(' + slide2x + ')';
        }
    }
};

// Facebook Share
const facebookShareBtn = document.getElementById('facebook-share');
if (facebookShareBtn !== null) {    
    facebookShareBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const params = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=300';
        window.open(this.href, 'Facebook', params);
    });
}

// Cards slider

// Cards Slider: Set initial position
function setSliderPosition() {
    let viewport = window.innerWidth;
    let cardSliders = document.querySelectorAll('.cards__slider');
    for (let i = 0; i < cardSliders.length; i++) {
        let slider = cardSliders[i];
        let direction = slider.dataset.direction;
        let position;
        if (viewport >= 1000) position = 3;
        if (viewport < 1000) position = 4;
        if (viewport < 767) position = 2;
        if (viewport < 375) position = 1;
        if (direction === 'right') position = 0;
        slider.dataset.position = position;
    }
    
}
setSliderPosition();

// Cards Slider: Navigation
const cardSliderNav = document.querySelectorAll('.cards .nav-icon');
if (cardSliderNav !== null) {
    for (let i = 0; i < cardSliderNav.length; i++) {

        cardSliderNav[i].addEventListener('click', function (e) {

            e.preventDefault();
            let cards = cardSliderNav[i].parentNode;
            let cardSlider = cards.querySelector('.cards__slider');
            let cardTogglerLeft = cards.querySelector('.nav-icon--left');
            let cardTogglerRight = cards.querySelector('.nav-icon--right');
            let direction = cardSlider.dataset.direction;
            let cardWidth = cardSlider.querySelector('.card').offsetWidth;
            let columnGap = 30;
            let moveDistance = cardWidth + columnGap;       
            let offset = cardSlider.dataset.offset;    
            let viewport = window.innerWidth;
            let sliderEnd;
            let distanceMultiplier = 3;
            let position = Number(cardSlider.dataset.position);

            // Set how many times the slider moves and initial position
            if (viewport >= 1000) {
                sliderEnd = 3;   
            } 
            if (viewport < 1000) {
                sliderEnd = 4;
            }
            if (viewport < 767) {
                sliderEnd = 5;
                distanceMultiplier = 2;
            }
            if (viewport < 375) {
                sliderEnd = 5;
                distanceMultiplier = 1;
            }

            // Initial slider offset
            if (typeof offset === 'undefined') {
                offset = (direction === 'left') ? - (moveDistance * distanceMultiplier) : 0;             
            }
            offset = Number(offset);

            // Move slider
            if (cardSliderNav[i] === cardTogglerLeft) {
                offset += moveDistance;
                position--;  
  
                if (position === 0) {
                    cardSliderNav[i].classList.remove('active');
                    cardTogglerRight.classList.add('active');
                } else {
                    cardSliderNav[i].classList.add('active');
                    cardTogglerRight.classList.add('active');
                }
            
            }
            if (cardSliderNav[i] === cardTogglerRight) {
                offset -= moveDistance;
                position++;         
                  
                if (position === sliderEnd) {
                    cardSliderNav[i].classList.remove('active');
                    cardTogglerLeft.classList.add('active');
                } else {
                    cardSliderNav[i].classList.add('active');
                    cardTogglerLeft.classList.add('active');
                }
                
            }
            
            cardSlider.style.left = offset + 'px';
            cardSlider.dataset.position = position;
            cardSlider.dataset.offset = offset;

        });
    }
}

// Card Slider reset on window resize
window.addEventListener('resize', function(){

    setSliderPosition();
    const cards = document.querySelectorAll('.cards--has-slider');
    const navIcons = document.querySelectorAll('.nav-icon');

    setTimeout(function(){

        for (let i = 0; i < navIcons.length; i++) {
            navIcons[i].classList.remove('active');
        }
    
        if (cards !== null) {
            for (let i = 0; i < cards.length; i++) {
                let cardSlider = cards[i].querySelector('.cards__slider');
                let direction = cardSlider.dataset.direction;
                let position = direction === 'left' ? 3 : 0;
                let left = direction === 'left' ? -100 : 0;
                let navIcon = cards[i].querySelector('.nav-icon--' + direction);            
                cardSlider.dataset.position = position;
                cardSlider.style.left = left + '%';
                navIcon.classList.add('active');
                cardSlider.removeAttribute('data-offset');
            }
        }

    }, 500);

});

// Attraction filters dropdown
const filtersToggler = document.getElementById('filters-toggler');
const filtersContent = document.getElementById('filters-content');
if (filtersToggler !== null) {
    filtersToggler.addEventListener('click', function (e) {
        e.preventDefault();
        filtersToggler.classList.toggle('active');
        filtersContent.classList.toggle('active');
        let items = filtersContent.querySelectorAll('.filters__items--lvl-1');
        for (let i = 0; i < items.length; i++) {
            if (items[i].classList.contains('active')) {
                items[i].classList.remove('active');
                items[i].classList.add('inactive');                
            } else {
                items[i].classList.add('active');
                items[i].classList.remove('inactive');   
            }
            
        }
    });
}

// Attraction display mode switcher (cards & map)
const filtersModes = document.querySelectorAll('.filters__mode');
const attractItems = document.querySelectorAll('.tm-attract__item');
if (filtersModes !== null) {
    for (let i = 0; i < filtersModes.length; i++) {
        let mode = filtersModes[i];
        mode.addEventListener('click', function(){
            let target = mode.dataset.target;
            let sectionOn = document.querySelector('.tm-attract__item.active');
            let sectionOff = document.querySelector(target);
            let filterOn = document.querySelector('.filters__mode.active');
            let filterOff = document.querySelector('.filters__mode:not(.active)');
            sectionOn.classList.remove('active');
            sectionOff.classList.add('active');
            filterOn.classList.remove('active');
            filterOff.classList.add('active');
        });
    }
}

// Back to to button
const backToTop = document.getElementById("tm-back-to-top");
window.onscroll = function() {
    let windowTop = window.pageYOffset;
    if (windowTop > 800) {
        backToTop.classList.add("active");
    } else {
        backToTop.classList.remove("active");
    }
};
backToTop.addEventListener("click", function(e) {
    e.preventDefault();
    window.scroll({
        top: 0,
        left: 0,
        behavior: "smooth",
    });
});

// jQuery
(function ($) {

    // Load listing content
    const listing = $('#listing');
    const listingPostType = listing.data('post-type');
    const catSlug = tm_globals[listingPostType + '_cat_slug'];
    const resultsCount = $('#results-count');
    const slide = $('#slide');
    const titleTag = $('.text-block__big');
    let catID = listing.data('initial-cat');
    let page = 2;
    let firstQuery = true;
    let slideUrl = '';

    function loadListing(category = catID, loadmore = false) {

        if (!loadmore) {
            page = 1;
            if ( !firstQuery && filtersToggler !== null ) {
                filtersToggler.click();  
            }
        } else {
            if (page === 1) page = 2;
        }
        
        $.ajax({
            type: 'post',
            dataType: 'html',
            url: tm_globals.ajax_url,
            cache: false,
            //global: false, // no loading animation
            data: {
                action: 'tm_load_listing',
                _ajax_nonce: tm_globals.nonce,
                post_type: listingPostType,
                post_id: postID,
                category_id: category,
                city: selectedLocation, 
                page: page,
            },
            success: function (response) {

                response = JSON.parse(response);

                if (loadmore) {
                    listing.append(response.html);
                    page++;
                } else {
                    page = 2;
                    listing.removeClass('hidden');
                    listing.html(response.html);
                }   

                if (page > response.max) {
                    $('#loadmore').hide();
                } else {
                    $('#loadmore').show();
                }

                slideUrl = response.cat_slide_url;           
                if (slideUrl === '') slideUrl = tm_globals.default_slide;
            
                resultsCount.html(response.results_count);
                slide.css('background-image', 'url(' + slideUrl + ')');
                slide.data('image-id', response.cat_slide_id);

                if ((!firstQuery && !loadmore)) {
                    let newUrl = tm_globals.base_url + '/' + catSlug + '/' + response.slug;
                    window.history.pushState('', '', newUrl);
                    titleTag.text(response.title);
                }                
                firstQuery = false;
                
            },
            error: function (response) {
                console.log(response);
            },
        });

    }

    // Dynamic Category Change
    const tmCategories = $('.tm-cat');
    for (let i = 0; i < tmCategories.length; i++) {
        let cat = tmCategories[i];
        cat.addEventListener('click', function(e) {
            e.preventDefault();
            selectedLocation = 0; // reset location
            catID = this.dataset['catid'];
            listing.addClass('hidden');
            loadListing(catID);
            loadFilters(catID);
        });
    }

    // Sort content 
    const locationFilter = $('#location-filter');
    // const searchSmall = $('.tm-search-small');
    // const textBlockBody = $('.text-block__body');
    // const dynamicCards = $('.cards--dynamic');
    let selectedLocation;    

    function loadFilters(category = catID) {

        console.log('catID = ' + catID);
        
        $.ajax({
            type: 'post',
            dataType: 'html',
            url: tm_globals.ajax_url,
            cache: false,
            //global: false, // no loading animation
            data: {
                action: 'tm_listing_filter',
                _ajax_nonce: tm_globals.nonce,
                category_id: category
            },
            success: function (response) {   
                response = JSON.parse(response);                
                if (response.html) {
                    locationFilter.html(response.html);
                }
            },
            error: function (response) {
                console.log(response);
            },
        });

    }

    locationFilter.on('change', function() {
        selectedLocation = $(this).val();       
        loadListing(catID);
        loadFilters(catID);
    });

    // Load More
    $('#loadmore').click( function(e) {
        e.preventDefault();
        loadListing(catID, true);
    });

    // Loading animation
    $(document).on({
        ajaxStart: function () {
            $('#btn-loading').addClass('visible');            
        },
        ajaxStop: function () {
            $('#btn-loading').removeClass('visible');            
        },
    });

    // Load Listing
    if (!isHome && !isPost) {
        $(window).on('load', function() {
            if (firstQuery && listing.length > 0) loadListing();     
            if (locationFilter.length > 0) loadFilters();
        });
    }

})(jQuery);

// Mailchimp
(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';;
/*
* Translated default messages for the $ validation plugin.
* Locale: FR
*/
$.extend($.validator.messages, {
        required: "Ce champ est requis.",
        remote: "Veuillez remplir ce champ pour continuer.",
        email: "Veuillez entrer une adresse email valide.",
        url: "Veuillez entrer une URL valide.",
        date: "Veuillez entrer une date valide.",
        dateISO: "Veuillez entrer une date valide (ISO).",
        number: "Veuillez entrer un nombre valide.",
        digits: "Veuillez entrer (seulement) une valeur numérique.",
        creditcard: "Veuillez entrer un numéro de carte de crédit valide.",
        equalTo: "Veuillez entrer une nouvelle fois la même valeur.",
        accept: "Veuillez entrer une valeur avec une extension valide.",
        maxlength: $.validator.format("Veuillez ne pas entrer plus de {0} caractères."),
        minlength: $.validator.format("Veuillez entrer au moins {0} caractères."),
        rangelength: $.validator.format("Veuillez entrer entre {0} et {1} caractères."),
        range: $.validator.format("Veuillez entrer une valeur entre {0} et {1}."),
        max: $.validator.format("Veuillez entrer une valeur inférieure ou égale à {0}."),
        min: $.validator.format("Veuillez entrer une valeur supérieure ou égale à {0}.")
});}(jQuery));var $mcj = jQuery.noConflict(true);