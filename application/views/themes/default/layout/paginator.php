<?php defined('SYSPATH') or die('No direct script access.');

	if (empty($paginator)) {
		return $paginator;
	}

?>
	<section class="redirector">
		<div class="separator-section" style="padding: 50px 0;">
			<div class="container">
				<div class="row">
					<article class="col-md-10 col-md-offset-1 text-center">
						<ul>
<?php
						if ( ! empty($paginator['previous'])) {
							echo '<li><a href="', $paginator['previous'], '"><i class="ion-arrow-left-c"></i></a></li>';
						}
						foreach ($paginator['items'] as $_item) {
							$_class = empty($_item['current']) ? 'hidden-xs' : 'active hidden-xs';
							echo '<li class="', $_class, '"><a href="', $_item['link'], '"><i style="font-style: normal;">', $_item['title'], '</i></a></li>';
						}
						if ( ! empty($paginator['next'])) {
							echo '<li><a href="', $paginator['next'], '"><i class="ion-arrow-right-c"></i></a></li>';
						}
?>						
						</ul>
					</article>
				</div>
			</div>
		</div>
	</section>