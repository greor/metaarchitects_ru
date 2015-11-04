<?php defined('SYSPATH') or die('No direct script access.'); 

	if ( ! empty($item['image'])) {
		$parallax = URL::base().Thumb::uri('parallax', $item['image']);
	
		echo '<section class="page-fold wallpaper subtle fullheight" style="font-size: 0; background-image: url(', $parallax, ')">';
	
		if ( ! empty($item['title'])) {
			echo '
					<div class="valign">
						<div class="container">
							<div class="row">
								<article class="text-center col-md-12">
									<h1 class="page-heading font4bold black parallax-my-bg">', $item['title'], '</h1>
				';
				
			if ( ! empty($page->parallax_descr)) {
				echo '<br><h4 class="sub-heading-minor font4light dark parallax-my-bg">', $item['descriprion'], '</h4>';
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