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
				
				$form.addClass("js-sending");
				
				$.ajax({
					url: $form.data("action"),
					method: "post",
					dataType: 'json',
					data: $form.serializeArray()
				}).done(function(response){
					if(response.errors.length) {
						for (var i = 0; i < response.errors.length; i++) {
							$form.find("[name="+response.errors[i]+"]")
								.closest(".form-row").addClass("error");
						}
					} else {
						alert("Спасибо за сотрудничество, мы свяжемся с вами в ближайшее время!");
						setTimeout(function(){
							$modal.modal("hide");
						});
					}
				}).fail(function(jqXHR, textStatus, errorThrown){
					alert("Приносим извинения за временный неполадки! Вы можете напрямую связаться с нами по телефону 8-921-550-54-84 и задать все интересующие вопросы!");
					
					setTimeout(function(){
						$modal.modal("hide");
					});
				}).always(function(){
					$form.removeClass("js-sending");
				});
			});
			
			$modal.on("show.bs.modal", function (e) {
				$form.find(".error")
					.removeClass("error");
				$form.find(":input")
					.val("");
			});
			$modal.on("hide.bs.modal", function (e) {
				return ! $form.hasClass("js-sending");
			});
			
			$form.find("[name=phone]").on("keypress", function(e){
				var keyCode = null;
				if (e.which == null) { // IE
					keyCode = e.keyCode;
				} else if (e.which != 0 && e.charCode != 0) { // все кроме IE
					keyCode = e.which;
				}
				
				keyCode = (keyCode < 32) ? null : keyCode;
				if (keyCode === null) {
					return;
				}
				var char = String.fromCharCode(keyCode);
				if ((keyCode < 48 || keyCode > 57) && char !== "+" && char !== "-") {
					e.preventDefault();
				} 
			});
		}
		
	});
})();

