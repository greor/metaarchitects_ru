
/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

		if( !device.tablet() && !device.mobile() ) {
			
			 $(function(){
		      $(".player").mb_YTPlayer();
		    });
						
		} else {
			
			/* displays a poster image if mobile device is detected*/ 
			$('body, .mastwrap').addClass('poster-img');
			
		}
   		
        
   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







	

