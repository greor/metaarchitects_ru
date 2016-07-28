<?php defined('SYSPATH') or die('No direct script access.'); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74944758-1', 'auto');
  ga('send', 'pageview');

</script>

<script>
	function trackEventGoogle(category, action, label, value) {
		if (window.ga) {
			ga(function() {
				var trackers = ga.getAll();
				for (var i = 0; i < trackers.length; ++i) {
					var fieldsObject = {
						eventCategory: category,
						eventAction: action
					};
					if (label) {
						fieldsObject.eventLabel = label;
					}
					if (value) {
						fieldsObject.eventValue = value;
					}
					
					trackers[i].send('event', fieldsObject);
				}
			});
		}
	}
</script>