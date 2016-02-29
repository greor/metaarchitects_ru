<?php defined('SYSPATH') or die('No direct script access.'); 

	$labels = array(
		'vkontakte_link' => __('VKontakte'),
		'twitter_link' => __('Twitter'),
		'facebook_link' => __('Facebook'),
		'youtube_link' => __('Youtube'),
		'odnoklassniki_link' => __('Odnoklassniki'),
		'google_link' => __('Google+'),
		'instagram_link' => __('Instagram'),
	);
	$class = array(
		'vkontakte_link' => 'vk',
		'twitter_link' => 'tw',
		'facebook_link' => 'fb',
		'youtube_link' => 'yt',
		'odnoklassniki_link' => 'ok',
		'google_link' => 'g',
		'instagram_link' => 'in',
	);
	
	$links = array_intersect_key($SITE, array(
		'vkontakte_link' => TRUE,
		'twitter_link' => TRUE,
		'facebook_link' => TRUE,
		'youtube_link' => TRUE,
		'odnoklassniki_link' => TRUE,
		'google_link' => TRUE,
		'instagram_link' => TRUE,
	));
	
	$links = array_filter($links);
	
	if (empty($links)) {
		return;
	}

?>
	<ul class="social-nav font4 black">
<?php
	foreach ($links as $_key => $_link) {
		echo '<li>', HTML::anchor($_link, $labels[$_key], array(
			'target' => '_blank',
			'class' => $class[$_key]
		)), '</li>';
	}
?>	
	</ul>
	
	