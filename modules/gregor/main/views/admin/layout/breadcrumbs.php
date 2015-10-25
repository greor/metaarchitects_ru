<?php defined('SYSPATH') or die('No direct access allowed.');

	if ( ! empty($breadcrumbs)):
?>
	<div class="row">
		<div class="span9">
			<ul class="breadcrumb kr-breadcrumb">
<?php
			$count_breadcrumbs = count($breadcrumbs);
			foreach ($breadcrumbs as $_item) {
				$count_breadcrumbs--;
				if ($count_breadcrumbs > 0) {
					echo '<li>', 
						(empty($_item['icon']) ? '' : '<i class="icon-folder-open"></i>&nbsp;'),
						HTML::anchor($_item['link'], $_item['title']),
						'<span class="divider">/</span></li>';
				} else {
					echo '<li>', 
						(empty($_item['icon']) ? '' : '<i class="icon-folder-open"></i>&nbsp;'),
						HTML::chars($_item['title']),
						'</li>';
				}
				
			}
?>				
			</ul>
		</div>
	</div>
<?php 
	endif;