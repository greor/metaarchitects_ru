<?php defined('SYSPATH') or die('No direct script access.');

return array (
	'projects' => array(
		'uri_callback' => '/<element_id>(?<query>)',
		'defaults' => array(
			'directory' => 'modules',
			'controller' => 'projects',
			'action' => 'index',
		)
	),
);

