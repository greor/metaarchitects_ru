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
			collapserTitle : '<a class="logo" href="/"></a>',
			easingEffect : 'easeInOutQuint',
			animSpeed : 'medium',
		});
		
		var $modal = $("#feedback-modal");
		if ($modal.length) {
			var $form = $("#feedback-form");
			
			$(".js-submit").on("click", function(){
				$form.find(".error")
					.removeClass("error");
				
				$form.find(":input").each(function(){
					var $this = $(this);
					if ( ! $this.val()) {
						$this.closest(".form-row")
						.addClass("error");
					}
				});
				
				if ($form.find(".error").length) {
					return;
				}
				
				// показать лоадер
				// в случае успешной отправки показать показать сообщение, что отправили
				// в случае ошибки показать сообщение с просьбой перезвонить по номеру
				
				
				$modal.modal("hide");
			});
			
			$modal.on("show.bs.modal", function (e) {
				$form.find(".error")
					.removeClass("error");
				$form.find(":input")
					.val("");
			});
		}
		
	});
})();

