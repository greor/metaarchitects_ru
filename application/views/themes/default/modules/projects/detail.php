<?php defined('SYSPATH') or die('No direct script access.'); 

	$orm_helper = ORM_Helper::factory('project');
	if ( ! empty($orm->parallax)) {
		$src = $orm_helper->file_uri('parallax', $orm->parallax);
		$parallax = URL::base().Thumb::uri('parallax', $src);
		
		echo '<section class="page-fold wallpaper subtle fullheight" style="font-size: 0; background-image: url(', $parallax, ')">', 
			$orm->title, '</section>';
	}
?>
	<section class="page-section white-bg">
		<div class="container">
			<div class="row">
				<article class="text-center col-md-12">
					<h1 class="minimal-caps font4 black add-top-quarter"><?php echo $orm->title; ?></h1>
					<div class="inner-spacer color-bg"></div>
<?php 
						echo '<br><br>', $orm->text; 
?>
				</article>
			</div>
		</div>
		
<?php if (0): ?>
		<div class="container">
			<div id="wall-showcase" class="wall-showcase">
				<!-- start : works-item -->
				<div class="works-item wall-showcase-item product-showcase-item-01 w2 zoom web ui">
					<a class="venobox" data-gall="portfolio-gallery" href="http://placehold.it/700x600">
						<div class="works-item-inner valign">
							<h3 class="dark font4">Image Title</h3>
							<p class="dark"><span class="dark font1">subtitle</span></p>
						</div>
					</a>
				</div>
				<!-- end : works-item -->
			</div>
		</div>
<?php endif; ?>	
	</section>
