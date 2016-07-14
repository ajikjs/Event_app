// google map
(function($) {
"use strict";
    var myCenter=new google.maps.LatLng(44.4250417,26.0768966);
    function initialize()
    {
      var mapProp = {
        center:myCenter,
        //center:new google.maps.LatLng(44.42528,26,-26.076232),
        zoom:17,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
      var marker = new google.maps.Marker({
        position:myCenter,
      });

    marker.setMap(map);
    };
    google.maps.event.addDomListener(window, 'load', initialize);
})(jQuery);
// end google map
