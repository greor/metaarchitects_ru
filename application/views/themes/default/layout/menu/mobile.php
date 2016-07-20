<?php defined('SYSPATH') or die('No direct script access.'); 
	if (empty($menu)) {
		return;
	}
?>
	<nav class="mobile-nav hidden-lg">
		<ul class="slimmenu">
<?php
		echo '<li>', HTML::anchor(URL::base(), __('Portfolio'), array(
			'target' => '_self',
		)), '</li>';

		foreach ($menu as $_id => $_item) {
			$_has_children =  ! empty($_item['sub']);
			echo '<li>', HTML::anchor($_item['uri'], $_item['title'], array(
				'target' => $_item['target'],
				'class' => $_has_children ? 'sub-collapser' : '',
			));
			if ($_has_children) {
				echo '<ul>';
				foreach ($_item['sub'] as $_k => $_v) {
					echo '<li>', HTML::anchor($_v['uri'], $_v['title'], array(
						'class' => 'black ease',
						'target' => $_v['target']
					)), '</li>';
				}
				echo '</ul>';
			}
			echo '</li>';
		}
?>		
		</ul>
	</nav>
