<?php defined('SYSPATH') or die('No direct script access.'); 

	$query_array = array();
	$p = Request::current()->query(Paginator::QUERY_PARAM);
	if ($p) {
		$query_array[Paginator::QUERY_PARAM] = $p;
	}
	$query = empty($query_array) ? NULL : http_build_query($query_array);

	$list_link = URL::base().Page_Route::uri($PAGE_ID, 'news', array(
		'query' => $query,
	));
?>

	<section class="page-section white-bg">
		<div class="container">
			<div class="row">
				<article class="text-left col-md-12">
					<h1 class="minimal-caps font4 black add-top-quarter"><?php echo HTML::chars($orm->title); ?></h1>
					<div class="inner-spacer color-bg"></div>
<?php 
					if ( ! empty($orm->image)) {
						$src = ORM_Helper::factory('news')->file_uri('image', $orm->image);
						
						$size = getimagesize(DOCROOT.$src);
						if ($size[0] > 930) {
							$thumb = Thumb::uri('news_930', $src);
						} else {
							$thumb = $src;
						}
						
						echo HTML::image($thumb, array(
							'class' => 'img-responsive add-top-half',
							'alt' => $orm->title,
						));
					}
					echo '<br><br>', $orm->text;
?>				
				</article>
			</div>
		</div>
	</section>

	<section class="redirector">
		<div class="separator-section" style="padding: 50px 0;">
			<div class="container">
				<div class="row">
					<article class="col-md-10 col-md-offset-1 text-center">
						<ul>
<?php
							$prev_orm = Arr::get($siblings, 'prev');
							if ( ! empty($prev_orm) AND $prev_orm->loaded())  {
								$link = URL::base().Page_Route::uri($PAGE_ID, 'news', array(
									'uri' => $prev_orm->uri
								));
								echo '<li><a href="', $link, '" title="', HTML::chars($prev_orm->title), '"><i class="ion-arrow-left-c"></i></a></li>';
							}
?>
							<li><a href="<?php echo $list_link; ?>" title="К списку статей"><i class="ion-grid black"></i></a></li>
<?php
							$next_orm = Arr::get($siblings, 'next');
							if ( ! empty($next_orm) AND $next_orm->loaded())  {
								$link = URL::base().Page_Route::uri($PAGE_ID, 'news', array(
									'uri' => $next_orm->uri
								));
								echo '<li><a href="', $link, '" title="', HTML::chars($next_orm->title), '"><i class="ion-arrow-right-c"></i></a></li>';
							}
?>
						</ul>
					</article>
				</div>
			</div>
		</div>
	</section>