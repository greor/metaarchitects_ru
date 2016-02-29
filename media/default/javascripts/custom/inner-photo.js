(function(){
	"use strict";
	$(function ($) {
		var template = "<div class=\"inner-photo-slider-wrapper\">"+$("#mobile-slider").html()+"</div>";
		
		$("#mobile-slider").parent()
			.append(template);
		
		 $('.venobox-bxslider').venobox({
			 numeratio: true
		 }); 
		 
		 if ($('#inner-photo-slider .bx-carusel-holder').length) {
			 var slider = $('#inner-photo-slider .bx-carusel-holder').bxSlider({
				 slideWidth: 210,
				 minSlides: 1,
				 maxSlides: 3,
				 slideMargin: 10,
				 pager: false,
				 prevText: '<i class="glyphicon glyphicon-chevron-left"></i>',
				 nextText: '<i class="glyphicon glyphicon-chevron-right"></i>',
				 nextSelector: "#inner-photo-slider .bx-carusel-controls .bx-next-holder",
				 prevSelector: "#inner-photo-slider .bx-carusel-controls .bx-prev-holder"
			 });
			 $(window).resize(function(){
				 slider.reloadSlider();
			 });
		 }
		
	});
})();