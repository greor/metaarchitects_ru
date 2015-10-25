
imagesLoaded( document.querySelector('body'), function( instance ) {
  
		
		var $container = $('#stack-grid-container');
		// init
		$container.packery({
		  itemSelector: '.works-item',
		});

		$('.works-filter li a').click(function(){
			var filterTarg = $(this).attr('data-filter');
			$('.works-item').addClass('works-item-fade');
			$(filterTarg).removeClass('works-item-fade');
		})


});
