<?php defined('SYSPATH') or die('No direct script access.'); 

	if (empty($items)) {
		return;
	}

?>

	<div class="inner-photo-album col-md-6 visible-md-block visible-lg-block">
		<ul>
<?php
		$orm_helper = ORM_Helper::factory('photo');
		$url_base = URL::base();
		
		foreach ($items as $_orm) {
			$_src = $orm_helper->file_uri('image', $_orm->image);
			$_thumb = $url_base.Thumb::uri('list_445x380', $_src);
			$_img = $url_base.Thumb::uri('list_800x600', $_src);
			
			$_html = HTML::image($_thumb, array(
				'alt' => $_orm->title,
				'title' => $_orm->title,
			));
			
			echo '<li class="col-md-6">', HTML::anchor($_img, $_html, array(
				'class' => 'venobox',
				'data-gall' => 'portfolio-gallery',
				'title' => $_orm->title
			)), '</li>';
		}
?>		
		</ul>
	
	</div>	

	
	<script id="mobile-slider" type="template/html">
		<div id="inner-photo-slider" class="visible-xs visible-sm">
			<div class="bx-carusel-holder">
<?php
				$orm_helper = ORM_Helper::factory('photo');
				$url_base = URL::base();
				foreach ($items as $_orm):
					$_src = $orm_helper->file_uri('image', $_orm->image);
					$_thumb = $url_base.Thumb::uri('list_400x400', $_src);
					$_img = $url_base.Thumb::uri('list_800x600', $_src);
					
					$_html = HTML::image($_thumb, array(
						'alt' => $_orm->title,
						'title' => $_orm->title,
						'class' => 'img-responsive',
					));
					
					echo '<div class="slide">', HTML::anchor($_img, $_html, array(
						'class' => 'venobox-bxslider',
						'data-gall' => 'portfolio-gallery',
						'title' => $_orm->title
					)), '</div>';
				endforeach;
?>		
			</div>
			<div class="bx-carusel-controls">
				<span class="bx-prev-holder"></span>
				<span class="bx-next-holder"></span>
			</div>
		</div>
	</script>
	
	
	
	
	
	