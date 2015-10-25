
imagesLoaded( document.querySelector('body'), function( instance ) {
  
		
		$( function() {

		  var $container = $('.wall-showcase').packery();

		  $container.on( 'click', '.item', function( event ) {
		    $container.packery( 'fit', event.target, 80, 80 );
		  });

		});


		$('.works-filter li a').click(function(){
			var filterTarg = $(this).attr('data-filter');
			$('.works-item').addClass('works-item-fade');
			$(filterTarg).removeClass('works-item-fade');
		})

});
