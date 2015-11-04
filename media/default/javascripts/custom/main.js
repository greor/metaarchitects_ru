(function() {
	"use strict";

	$(function($) {
		function setSize() {
			// Detecting viewpot dimension
			var vH = $(window).height();
			var vW = $(window).width();
			
			// Adjusting Intro Components Spacing based on detected screen
			// resolution
			$('.fullheight').css('height', vH);
			$('.halfheight').css('height', vH / 2);
			$('.fullwidth').css('width', vW);
			$('.halfwidth').css('width', vW / 2);
			
			$('.page-fold.subtle').next().css('margin-top', vH);
		};
			
		setSize();
		$(window).resize(setSize);
			
			
		// Mobile Menu (multi level)
		$('ul.slimmenu').slimmenu({
			resizeWidth : '1200',
			collapserTitle : 'menu',
			easingEffect : 'easeInOutQuint',
			animSpeed : 'medium',
		});
	});
})();

