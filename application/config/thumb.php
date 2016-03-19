<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'admin_image_300' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 300,
			'height' => 300,
			'master' => Image::AUTO,
		),
		'quality' => 100
	),
	'admin_image_100' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 100,
			'height' => 100,
			'master' => Image::AUTO,
		),
		'quality' => 90
	),
	
	
	'projects_400x400' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 400,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 400,
		),
		'quality' => 90
	),
	'projects_400x825' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 825,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 825,
		),
		'quality' => 90
	),
	'projects_800x387' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 800,
			'height' => 387,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 800,
			'height' => 387,
		),
		'quality' => 90
	),
	
	
	'parallax' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 1500,
			'height' => 1000,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 1500,
			'height' => 1000,
		),
		'quality' => 90
	),
	'list_400x400' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 400,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 400,
		),
		'quality' => 90
	),
	'list_445x380' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 445,
			'height' => 445,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 445,
			'height' => 445,
		),
		'quality' => 90
	),
	'list_800x600' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 800,
			'height' => 600,
			'master' => Image::AUTO,
		),
		'crop' => array(
			'width' => 800,
			'height' => 600,
		),
		'quality' => 90
	),
	
	'news_930' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 930,
			'master' => Image::WIDTH,
		),
		'crop' => array(
			'width' => 930,
		),
		'quality' => 90
	),
	
);