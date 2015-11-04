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
