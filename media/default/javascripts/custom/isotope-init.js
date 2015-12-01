/*global $:false */
/*global window: false */

(function() {
	"use strict";

	$(function($) {

		$(window).load(function() {

			var $container = $('.works-container');

			$container.isotope({
				// options
				itemSelector : '.works-item',
				layoutMode : 'masonry',
				transitionDuration : '0.8s'
			});

			var filter_marker = false;
			$('.works-filter li a').click(function() {
				filter_marker = true;
				
				$('.works-filter li a').removeClass('active');
				$(this).addClass('active');

				var selector = $(this).attr('data-filter');
				$('.works-container').isotope({
					filter : selector
				});
				setTimeout(function(){
					filter_marker = false;
				}, 0);
				return false;
			});

			// window resize and layout regenerate
			$(window).resize(function() {
				if (filter_marker) {
					$container.isotope({
						itemSelector : '.works-item',
						layoutMode : 'masonry',
						transitionDuration : '0.8s'
					});
				}
			});

		});

	});
	// $(function ($) : ends

})();
// JSHint wrapper $(function ($) : ends

