
/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {


     var vW = $(window).width();

		$('.showcase05-carousel').owlCarousel({
		    stagePadding: 0,
		    loop:true,
		    margin:0,
		    nav:false,
		    dots:true,
		    mouseDrag:true,
		    touchDrag:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:1
		        },
		        1000:{
		            items:1
		        }
		    }
		})



	$( window ).resize(function() {

     	var vrW = $(window).width();
		$('.showcase05-carousel').owlCarousel({
		    stagePadding: 0,
		    loop:true,
		    margin:0,
		    nav:false,
		    dots:true,
		    mouseDrag:true,
		    touchDrag:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:1
		        },
		        1000:{
		            items:1
		        }
		    }
		})
	});
        
   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







	

