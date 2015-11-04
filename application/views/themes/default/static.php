<?php defined('SYSPATH') or die('No direct script access.'); 

	$orm_helper = ORM_Helper::factory('page');
	if ( ! empty($page->image)) {
		$src = $orm_helper->file_uri('image', $page->image);
		$parallax = URL::base().Thumb::uri('parallax', $src);
		
		echo '<section class="page-fold wallpaper subtle fullheight" style="font-size: 0; background-image: url(', $parallax, ')">';
		
		if ( ! empty($page->parallax_title)) {
			echo '
				<div class="valign">
					<div class="container">
						<div class="row">
							<article class="text-center col-md-12">
								<h1 class="page-heading font4bold black parallax-my-bg">', $page->parallax_title, '</h1>
			';
					
			if ( ! empty($page->parallax_descr)) {
				echo '<br><h4 class="sub-heading-minor font4light dark parallax-my-bg">', $page->parallax_descr, '</h4>';
			}
			echo '			
							</article>
						</div>
					</div>
				</div>
			';
		}
		
		echo '</section>';
	}
?>
	<section class="page-section white-bg">
		<div class="container">
			<div class="row">
				<article class="text-center col-md-12">
					<h1 class="minimal-caps font4 black add-top-quarter"><?php echo $page->title; ?></h1>
					<div class="inner-spacer color-bg"></div>
<?php 
						echo '<br><br>', $page->text; 
?>
				</article>
			</div>
		</div>
	</section>
