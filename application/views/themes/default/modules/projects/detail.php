<?php defined('SYSPATH') or die('No direct script access.'); 

	$orm_helper = ORM_Helper::factory('project');
	$parralax_image = '';
	if ( ! empty($orm->parallax)) {
		$parralax_image = $orm_helper->file_uri('parallax', $orm->parallax);
	}
	
	echo View_Theme::factory('layout/parallax', array(
		'item' => array(
			'image' => $parralax_image,
			'title' => $orm->parallax_title,
			'descriprion' => $orm->parallax_descr,
		)
	));
?>
	<section class="page-section white-bg">
		<div class="container">
			<div class="row">
				<article class="text-center col-md-12">
					<h1 class="minimal-caps font4 black add-top-quarter"><?php echo $orm->title; ?></h1>
					<div class="inner-spacer color-bg"></div>
				</article>
			</div>
		</div>
		
<?php
		if ( ! empty($photo)):
?>		
			<div class="container">
				<div id="wall-showcase" class="wall-showcase" style="margin-bottom: 15px;">
<?php
				$orm_helper = ORM_Helper::factory('photo');
				$url_base = URL::base();
				foreach ($photo as $_item):
					$_src = $orm_helper->file_uri('image', $_item->image);
					$_thumb = $url_base.Thumb::uri('list_445x380', $_src);
					$_img = $url_base.Thumb::uri('list_800x600', $_src);
?>				
					<div class="works-item wall-showcase-item w2 zoom web ui" style="background: url(<?php echo $_thumb; ?>)">
						<a class="venobox" data-gall="portfolio-gallery" href="<?php echo $_img; ?>">
							<div class="works-item-inner valign">
								<h3 class="dark font4"><?php echo HTML::chars($_item->title); ?></h3>
<?php
								if ( ! empty($_item->text)):
?>								
									<p class="dark"><span class="dark font1"><?php echo HTML::chars($_item->text); ?></span></p>
<?php
								endif;
?>								
							</div>
						</a>
					</div>
<?php
				endforeach;
?>					
				</div>
			</div>
<?php
		endif;
?>		
		<div class="container">
			<div class="row">
				<article class="text-center col-md-12">
<?php 
						echo $orm->text; 
?>
				</article>
			</div>
		</div>
	</section>
