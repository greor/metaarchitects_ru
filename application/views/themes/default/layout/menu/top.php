<?php defined('SYSPATH') or die('No direct script access.'); 
	
	if (empty($menu)) {
		return;
	}
?>
	<section class="menu-panel fullheight">
		<div class="row">
			<article class="col-md-8 fullheight nav-list-holder menu-bg">
				<div class="valign">
					<nav class="nav-item-wrap">
						<ul class="main-nav-menu main-nav-menu-effect font4light">
<?php
						echo '<li class="trigger-sub-nav">', HTML::anchor(URL::base(), __('Portfolio'), array(
							'target' => '_self',
							'class' => 'main-nav-link white',
							'data-sub-nav-target' => '00',
							'data-has-childrens' => ''
						)), '</li>';
						
						$list = array();
						$_str = '';
						foreach ($menu as $_id => $_item) {
							$_key = str_pad($_id, 2, '0', STR_PAD_LEFT);
							
							$_has_childrens = FALSE;
							if ( ! empty($_item['sub'])) {
								$_str .= '<div class="sub-nav sub-nav-'.$_key.'">';
								foreach ($_item['sub'] as $_k => $_v) {
									$_str .= HTML::anchor($_v['uri'], $_v['title'], array(
										'target' => $_v['target']
									));
								}
								$_str .= '</div>';
								$_has_childrens = TRUE;
							}
							
							echo '<li class="trigger-sub-nav">', HTML::anchor($_item['uri'], $_item['title'], array(
								'target' => $_item['target'],
								'class' => 'main-nav-link white',
								'data-sub-nav-target' => $_key,
								'data-has-childrens' => $_has_childrens
							)), '</li>';
							
						}
?>						
						</ul>
					</nav>
				</div>
			</article>
			<article class="col-md-4 fullheight sub-nav-holder black-bg">
				<div class="valign">
<?php
					echo $_str;
?>
				</div>
			</article>
		</div>
	</section>
