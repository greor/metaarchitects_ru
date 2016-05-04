<?php defined('SYSPATH') or die('No direct script access.'); 

	$orm_helper = ORM_Helper::factory('page');
	$parralax_image = '';
	if ( ! empty($page->image)) {
		$parralax_image = $orm_helper->file_uri('image', $page->image);
	} 

	echo View_Theme::factory('layout/parallax', array(
		'item' => array(
			'image' => $parralax_image,
			'title' => $page->parallax_title,
			'descriprion' => $page->parallax_descr,
		)
	));
?>
	<section class="page-section white-bg">
		<div class="container">
			<div class="row">
				<article class="col-md-12">
					<div class="text-center">
						<h1 class="minimal-caps font4 black add-top-quarter"><?php echo $page->title; ?></h1>
						<div class="inner-spacer color-bg"></div>
					</div>
					<br><br>
					<div class="text-justify-important text-content">
<?php 
						echo $text; 
?>
					</div>
				</article>
			</div>
		</div>
<?php
		if ($PAGE_ID == 1):
?>		
		<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
		<div class="container">
			<div id="map" style="width: 100%; height: 500px"></div>
			<script type="text/javascript">
				ymaps.ready(init);
				var myMap;
				var myPlacemark;

				function init(){     
					myMap = new ymaps.Map("map", {
						center: [59.9328, 30.3770],
						zoom: 17,
						controls: ["geolocationControl", "rulerControl", "zoomControl", "trafficControl"]
					});

					myPlacemark = new ymaps.Placemark([59.9328, 30.3770], { 
			            hintContent: 'ООО "META"', 
			            balloonContent: 'Архитектурная мастерская "META"' 
			        });
					myMap.geoObjects.add(myPlacemark);
				}
			</script>
		</div>
		<br>
		<br>
<?php 
		endif;
		echo View_Theme::factory('layout/share');
?>	
	</section>