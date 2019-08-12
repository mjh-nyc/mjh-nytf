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

	
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        
        //lazy load images off screen anything that has a lazy class
        jQuery('.lazy').unveil({
          offset: 100,
        });

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


        //sticky header
        $("header").stick_in_parent();


        //function to scroll to section
    		$('a.scroll').click(function() {
      		var whereto = $(this).attr('data-location');
      		var offset = $(this).attr('data-offset');
      		$('html, body').animate({
      			scrollTop: $("#"+whereto).offset().top
    			}, 1000);
    		});

        

  		
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
        //set buttons width
        if ($('.buttons').length > 0) {
          var maxWidth = 0;
          var countLimit = 2;
          $('.buttons a').each(function(i, index) {
            if (i < countLimit) {
              maxWidth += parseInt($(this).outerWidth()+40, 10);
            }
          });
          $('.buttons').css('width', maxWidth-40+'px');
        }

        //set feature row margin for features with text content on left

        $ref = $('.brand');
        function setFeatureOffset() {
          if ($( window ).width() > 768) { 
            $offset = $ref.offset();
            $offset_margin = $offset.left - 15;
            $( '.features' ).find( '.left .feature-content-wrapper' ).css('margin-left',$offset_margin+'px');
            $( '.features' ).find( '.right .feature-content-wrapper' ).css('margin-right',$offset_margin+'px');
            //also set the flex order
            $( '.features' ).find( '.left').css('order',1);
            $( '.features' ).find( '.right').css('order',2);
          } else {
            $( '.features' ).find( '.left .feature-content-wrapper' ).css('margin-left',0);
            $( '.features' ).find( '.right .feature-content-wrapper' ).css('margin-right',0);
            //also set the flex order
            $( '.features' ).find( '.feature-image').css('order',1);
            $( '.features' ).find( '.feature-content').css('order',2);
          }
        }
        function doneResizing(){
          setFeatureOffset();
        }
        var id;
        $(window).on('resize', function(){
            clearTimeout(id);
            id = setTimeout(doneResizing, 500);
        });
        
        //also fire on load: 
         setFeatureOffset();

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


})(jQuery); // Fully reference jQuery after this point.



