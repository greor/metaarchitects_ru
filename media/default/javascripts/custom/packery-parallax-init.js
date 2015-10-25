
/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {



imagesLoaded( document.querySelector('body'), function( instance ) {
  
	
		var $container = $('#parallax-random-grid-container');
		// init
		$container.packery({
		  itemSelector: '.works-item',
		  "columnWidth": ".gutter-sizer",
		});

		$('.works-filter li a').click(function(){
			var filterTarg = $(this).attr('data-filter');
			$('.works-item').addClass('works-item-fade');
			$(filterTarg).removeClass('works-item-fade');
		})



		if( !device.tablet() && !device.mobile() ) {

			/* if non-mobile device is detected*/ 
			
			//stellar parallax init

			  $.stellar({
			  // Set scrolling to be in either one or both directions
			  horizontalScrolling: false,
			  verticalScrolling: true,

			  // Set the global alignment offsets
			  horizontalOffset: 0,
			  verticalOffset: 0,

			  // Refreshes parallax content on window load and resize
			  responsive: false,

			  // Select which property is used to calculate scroll.
			  // Choose 'scroll', 'position', 'margin' or 'transform',
			  // or write your own 'scrollProperty' plugin.
			  scrollProperty: 'scroll',

			  // Select which property is used to position elements.
			  // Choose between 'position' or 'transform',
			  // or write your own 'positionProperty' plugin.
			  positionProperty: 'position',

			  // Enable or disable the two types of parallax
			  parallaxBackgrounds: true,
			  parallaxElements: true,

			  // Hide parallax elements that move outside the viewport
			  hideDistantElements: false,

			  // Customise how elements are shown and hidden
			  hideElement: function($elem) { $elem.hide(); },
			  showElement: function($elem) { $elem.show(); }
			});
			
						
		} else {
			
			/* if mobile device is detected*/ 
			
		}


		

});


		
   		
        
   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







	

