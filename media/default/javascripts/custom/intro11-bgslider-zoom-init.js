// BGSLIDER-INIT.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is  JS file that activates a type of BG Image Slideshow used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: DIGNITY.
// Author: Designova.
// Website: http://www.designova.net 
// Copyright: (C) 2013 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

    //BG SLIDESHOW WITH ZOOM EFFECT
    $.mbBgndGallery.buildGallery({
                containment:".mastwrap",
                timer:500,
                effTimer:8000,
                controls:false, //updated in v1.1
                grayScale:false,
                shuffle:false,
                preserveWidth:false,
                preserveTop: true,
                effect:"zoom",
	//effect:{enter:{transform:"scale("+(1+ Math.random()*2)+")",opacity:0},exit:{transform:"scale("+(Math.random()*2)+")",opacity:0}},

                // If your server allow directory listing you can use:
                // (however this doesn't work locally on your computer)

                //folderPath:"testImage/",

                // else:

                 images:[
                 "http://placehold.it/1500x1000",
                 "http://placehold.it/1500x1000",
                 "http://placehold.it/1500x1000",
                 ],

                onStart:function(){},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });


   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







	

