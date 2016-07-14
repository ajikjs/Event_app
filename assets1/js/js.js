// Inview plugin settings
//     jQuery(document).ready(function($) {
//        "use strict"; 
//         var fadeL = jQuery('.fadeInL');
//         var fadeR = jQuery('.fadeInR');
//         var fadeDown = jQuery('.fadeInDown');
//         var fadeIn = jQuery('.fadeInIn');
//         var fadeUp = jQuery('.fadeInUp');

//         var progressBar = jQuery('.progress-inner'); 
//         var scaleIn = jQuery('.scaleIn');
//         var rotateLR = jQuery('.rotateLR');
//         var rotateIn = jQuery('.rotateIn');
//         var rotateInX = jQuery('.rotateInX');

//         var browser = false;
//         var p = navigator.platform;

//         if (p === 'iPad' || p === 'iPhone' || p === 'iPod') {
//             browser = true;
//         }

//         if (browser === false) {

//             fadeL.css({visibility: 'hidden'});
//             fadeR.css({visibility: 'hidden'});
//             fadeDown.css({visibility: 'hidden'});
//             fadeIn.css({visibility: 'hidden'});
//             fadeUp.css({visibility: 'hidden'});

//             progressBar.css({visibility: 'hidden'});
//             scaleIn.css({visibility: 'hidden'});
//             rotateLR.css({visibility: 'hidden'});
//             rotateIn.css({visibility: 'hidden'});
//             rotateInX.css({visibility: 'hidden'});
            
//             fadeL.on('inview', function (event, visible) {
//                 if (visible) {
//                     jQuery(this).addClass('fadeL');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             fadeR.on('inview', function (event, visible) {
//                 if (visible) {
//                     jQuery(this).addClass('fadeR');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             fadeDown.on('inview', function (event, visible) {
//                 if (visible) {
//                     jQuery(this).addClass('fadeDown');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             fadeIn.on('inview', function (event, visible) {
//                 if (visible) {
//                     jQuery(this).addClass('fadeIn');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             fadeUp.on('inview', function (event, visible) {
//                 if (visible) {
//                     jQuery(this).addClass('fadeUp');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });

//             progressBar.on('inview', function (event, visible) { 
//                 if (visible) {
//                     jQuery(this).addClass('progress-bar-filled');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             scaleIn.on('inview', function (event, visible) { 
//                 if (visible) {
//                     jQuery(this).addClass('scale-In');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             rotateLR.on('inview', function (event, visible) { 
//                 if (visible) {
//                     jQuery(this).addClass('rotate-LR');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             rotateIn.on('inview', function (event, visible) { 
//                 if (visible) {
//                     jQuery(this).addClass('rotate-In');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//             rotateInX.on('inview', function (event, visible) { 
//                 if (visible) {
//                     jQuery(this).addClass('rotate-InX');
//                     jQuery(this).css({visibility: 'visible'});
//                 }
//             });
//         }
// });
// End inview settings

// Isotope
//$(function () {
jQuery(document).ready(function($) {
    "use strict";

    //Define your containers and option sets
    var $container = [$('#container-ev-1'), $('#container-ev-2'), $('#container-ev-3')], $optionSets = [$('#options-1 .option-set'), $('#options-2 .option-set'), $('#options-3 .option-set')];

    //Initialize isotope on each container
    $.each($container, function (j) {
        this.isotope({
            itemSelector : '.element'
        });
    });

    //Initialize filter links for each option set
    $.each($optionSets, function (index, object) {

        var $optionLinks = object.find('a');

        $optionLinks.click(function () {
            var $this = $(this), $optionSet = $this.parents('.option-set'), options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            // don't proceed if already selected
            if ($this.hasClass('selected')) {
                return false;
            }

            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            // make option object dynamically, i.e. { filter: '.my-filter-class' }

            // parse 'false' as false boolean
            value = value === 'false' ? false : value;
            options[key] = value;
            if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
              // changes in layout modes need extra logic
                changeLayoutMode($this, options);
            } else {
              // otherwise, apply new options

                $container[index].isotope(options);
            }

            return false;
        });
    });
    // resize images on window resize !!
    $(window).resize(function(){ $('.event-list ul').isotope('reLayout'); });
    // prevent images to stack on load !!
    $(window).load(function(){ $('.event-list ul').isotope('reLayout'); });
});
// End Isotope

// Page load animation
(function(jQuery) {
    "use strict"; 
    jQuery(window).load(function() {
        $("#loadanimation").delay(150).fadeOut();
        $("#preloader").delay(200).fadeOut("slow");
    });
 })(jQuery);
 // End Page load animation

// Jquery Player
jQuery(document).ready(function($) {
    "use strict"; 
    var list = $(".jp-playlist");
    $(".toggle").toggle(function(){
        list.show();
    },function(){
        list.hide();
    });

    if (list.hasClass("jp-single")) {
        list.show();
    } else {
        list.hide();
    }
    
});
// End Jquery Player



// Homepage masonry blog posts
$(window).bind("load", function() {
        "use strict";
   
        var triggerM = $('.masonry-trigger');
        var container = $('#content');
        function startMasonry(){

            container.masonry({
                gutter: 0,
                itemSelector: '.blog-post',
                columnWidth: '.blog-post',
                isInitLayout: true
            }); 
        }
            
        if(triggerM.css("display") == "block") {
            startMasonry();
        }
            
        $(window).resize(function(){
            if(triggerM.css("display") == "block") {
                startMasonry();

            } else if(triggerM.css("display") == "none") {
                startMasonry();
                container.masonry('destroy');
            }
        });
});
// End Masonry Blog


jQuery(document).ready(function($) {
    "use strict"; 

  $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');

  $(".button").on("click", function() {

    var $button = $(this);
    var oldValue = $button.parent().find("input").val();

    if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
       // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
        } else {
        newVal = 0;
      }
      }

    $button.parent().find("input").val(newVal);

  });

});