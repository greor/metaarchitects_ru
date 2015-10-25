/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

	

    $("#team-carousel").owlCarousel({
        navigation : true,
        pagination: false,
        responsive: true,
        items: 1,
        touchDrag: true,
        navigationText: false,
        mouseDrag: true,
        itemsDesktop: [3000,2],
        itemsDesktopSmall: [1440,2],
        itemsTablet:[1024,2],
        itemsTabletSmall: [640,2],
        itemsMobile: [360,2],
        autoPlay: false,
        autoHeight: false,
      });


   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







	

