<?php defined('SYSPATH') or die('No direct script access.'); 

	if (empty($list)) {
		return;
	}
	
	$query_array = array();
	$p = Request::current()->query(Paginator::QUERY_PARAM);
	if ($p) {
		$query_array[Paginator::QUERY_PARAM] = $p;
	}
	$query = empty($query_array) ? NULL : http_build_query($query_array);
	
	$detail_tpl = URL::base().Page_Route::uri($PAGE_ID, 'news', array(
		'uri' => '{uri}',
		'query' => $query
	));
?>
	<section class="page-section white-bg">
		<div class="container">
			<section class="news-list-wrap">
<?php
			foreach ($list as $_orm):
				$_link = str_replace('{uri}', $_orm->uri, $detail_tpl);
?>
				<section class="news-list news-list-01">
					<a href="<?php echo $_link; ?>">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center">
									<h2 class="font2 black"><?php echo HTML::chars($_orm->title); ?></h2>
									<div class="inner-spacer color-bg"></div>
<?php
									if ( ! empty($_orm->announcement)) {
										echo '<p>', $_orm->announcement, '</p>';
									}
?>								
								</div>
							</div>
						</div>
					</a>
				</section>
<?php
			endforeach;
?>
			</section>
		</div>
	</section>
<?php 
	$link = URL::base().Page_Route::uri($PAGE_ID, 'news');
	echo $paginator->render($link);
