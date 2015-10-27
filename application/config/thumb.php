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
	
	
	'projects_400x200' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 200,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 200,
		),
		'quality' => 90
	),
	'projects_400x300' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 300,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 300,
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
	'projects_400x450' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 450,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 450,
		),
		'quality' => 90
	),
	'projects_400x500' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 500,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 500,
		),
		'quality' => 90
	),
	'projects_400x600' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 600,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 600,
		),
		'quality' => 90
	),
	'projects_400x700' => array(
		'path' => 'upload/images/',
		'resize' => array(
			'width' => 400,
			'height' => 700,
			'master' => Image::INVERSE,
		),
		'crop' => array(
			'width' => 400,
			'height' => 700,
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
	
);