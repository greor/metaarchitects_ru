<?php defined('SYSPATH') or die('No direct script access.'); ?>

	<div  class="container">
	  
		<div class="row add-top-half">
			<article class="text-center col-md-10 col-md-offset-1">
				<h1 class="minimal-caps font4light black add-top-quarter">Архитектурная мастерская</h1>
			</article>
		</div>
	
		<div id="works-container" class="works-container works-masonry-container white-bg container clearfix">
<?php
		$page = Page_Route::page_by_name('projects');
		$link_tpl = Page_Route::uri($page['id'], 'projects', array(
			'element_id' => '{element_id}'
		));
		$orm_helper = ORM_Helper::factory('project');
		foreach ($projects as $_item):
			$_file = $orm_helper->file_uri('image', $_item->image);
			$_thumb = Thumb::uri('projects_'.$_item->size, $_file);
			$_link = str_replace('{element_id}', $_item->id, $link_tpl);
			$_filter_key = Ku_Text::slug($_item->category);
?>		
			<div class="works-item works-item-<?php echo $_item->size; ?> info logos ui <?php echo $_filter_key; ?>">
<?php
				echo HTML::image($_thumb, array(
					'title' => $_item->title,
					'alt' => $_item->title,
					'class' => 'img-responsive',
				));
?>			
				<a href="<?php echo $_link; ?>">
					<div class="works-item-inner valign">
						<h3 class="dark"><?php echo $_item->title; ?></h3>
<?php
						if ( ! empty($_item->category)) {
							echo '<p class="dark"><span class="dark">', $_item->category, '</span></p>';
						}
?>						
					</div>
				</a>
			</div>
<?php
		endforeach;
?>
		</div>
	</div>