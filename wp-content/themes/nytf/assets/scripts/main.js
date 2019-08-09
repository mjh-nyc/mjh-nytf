/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

	var mapStyles = [ { "featureType": "all", "elementType": "labels.text.fill", "stylers": [ { "saturation": 36 }, { "color": "#333333" }, { "lightness": 40 } ] }, { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" }, { "lightness": 16 } ] }, { "featureType": "all", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [ { "color": "#fefefe" }, { "lightness": 20 } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "color": "#fefefe" }, { "lightness": 17 }, { "weight": 1.2 } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "color": "#f5f5f5" }, { "lightness": 20 } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#f5f5f5" }, { "lightness": 21 } ] }, { "featureType": "poi.attraction", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "poi.park", "elementType": "all", "stylers": [ { "visibility": "on" }, { "hue": "#ff0000" } ] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [ { "color": "#dedede" }, { "lightness": 21 } ] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#e5e5e5" }, { "visibility": "on" } ] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" }, { "lightness": 17 } ] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "lightness": 29 }, { "weight": 0.2 } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#ffffff" }, { "lightness": 18 } ] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [ { "color": "#ffffff" }, { "lightness": 16 } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit", "elementType": "geometry", "stylers": [ { "color": "#f2f2f2" }, { "lightness": 19 } ] }, { "featureType": "transit.line", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.line", "elementType": "labels.text", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.station.bus", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.station.rail", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "transit.station.rail", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#7d7d7d" } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "color": "#e9e9e9" }, { "lightness": 17 } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#c1ebff" } ] } ];

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {


        $('.menu-link').bigSlide({
          side: 'right',
          easyClose: 'true'
        });

        /*navigation toggles*/
        $('#menu-primary-navigation .menu-item-has-children > a').bind('click', function(event) {
            event.preventDefault();
            $(this).parent().toggleClass('open').find('ul').slideToggle();
        });
        //automatically expand parent if we're on a subpage
        $('#menu-primary-navigation .current-menu-parent').toggleClass('open').find('ul').slideToggle();





        //function to scroll to section
    		$('a.scroll').click(function() {
      		var whereto = $(this).attr('data-location');
      		var offset = $(this).attr('data-offset');
      		$('html, body').animate({
      			scrollTop: $("#"+whereto).offset().top
    			}, 1000);
    		});

        //initialize swiper when document ready
      	if (!$('body').hasClass('timeline')) {
      		var mySwiper = new Swiper ('.swiper-container', {
       	 		// Optional parameters
        			pagination: '.swiper-pagination',
          		effect: 'coverflow',
          		grabCursor: true,
          		centeredSlides: true,
          		slidesPerView: 2,
          		coverflow: {
              		rotate: 50,
              		stretch: 0,
              		depth: 100,
              		modifier: 1,
              		slideShadows : true
          		}
          	});
        }

  		
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {

        
      },

      finalize: function() {
       
      }
    },
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

  function showMap() {

}


})(jQuery); // Fully reference jQuery after this point.



