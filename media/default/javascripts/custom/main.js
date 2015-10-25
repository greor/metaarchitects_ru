// MAIN.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is main JS file that contains custom JS scipts and initialization used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: EIGHT.
// Author: Designova.
// Version 1.0 - Initial Release
// Website: http://www.Designova.net 
// Copyright: (C) 2015 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

     
    //Detecting viewpot dimension
     var vH = $(window).height();
     var vW = $(window).width();


     //Adjusting Intro Components Spacing based on detected screen resolution
     $('.fullheight').css('height',vH);
     $('.halfheight').css('height',vH/2);
     $('.fullwidth').css('width',vW);
     $('.halfwidth').css('width',vW/2);
  
    $('.page-fold.subtle').next().css('margin-top',vH);

    //Mobile Menu (multi level)
    $('ul.slimmenu').slimmenu({
        resizeWidth: '1200',
        collapserTitle: 'menu',
        easingEffect:'easeInOutQuint',
        animSpeed:'medium',
    });




});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







  

