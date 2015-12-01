<?php defined('SYSPATH') or die('No direct script access.'); ?>

	<div class="works-filter-wrap">
		<ul class="works-filter clearfix font4light">
			<li><a id="all" href="#" data-filter="*" class="active"><span>Все</span></a></li> 
<?php
			foreach ($filter as $_k => $_v) {
				echo '<li><a href="#" data-filter=".', $_k, '"><span>', $_v, '</span></a></li>';
			}	
?>		
		</ul>
	</div>

