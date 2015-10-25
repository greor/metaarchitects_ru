<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'left_menu'	=>	array(
		'properties' => array(
			'title' =>	__('Properties list'),
			'link' => Route::url('admin', array(
				'controller' => 'properties'
			)),
			'sub' => array()
		),
	),
);
