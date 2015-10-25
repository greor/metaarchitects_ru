<?php defined('SYSPATH') or die('No direct script access.');

function array_merge_recursive_distinct(array & $array1, array & $array2) {
	$merged = $array1;

	foreach ($array2 as $key => & $value) {
		if (is_array($value) && isset($merged[ $key ]) && is_array($merged[ $key ])) {
			$merged[ $key ] = array_merge_recursive_distinct($merged[ $key ], $value);
		} else {
			$merged[ $key ] = $value;
		}
	}

	return $merged;
}


/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::remove_route('sitemap_index');
Route::remove_route('sitemap');

Route::set('home', '(?<query>)')
	->defaults(array(
		'directory'	 =>	'modules',
		'controller' => 'home',
		'action'     => 'index',
	));

Route::set('modules', 'admin/modules/<controller>(/<action>(/<id>))(?<query>)')
	->defaults(array(
		'directory'	 =>	'admin/modules',
		'action'     => 'index',
	));

Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))(?<query>)')
	->defaults(array(
		'directory'	 =>	'admin',
		'controller' => 'home',
		'action'     => 'index',
	));

Route::set('admin_error', 'admin/error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
	->defaults(array(
		'directory'	 =>	'admin',
		'controller' => 'error'
	));

Route::set('widgets', 'widgets/<controller>(/<action>(/<id>))(?<query>)')
	->defaults(array(
		'directory'	 =>	'widgets',
		'action'     => 'index',
	));

Route::set('uploader', 'uploader(?<query>)')
	->defaults(array(
		'controller' => 'uploader',
		'action'     => 'index',
	));
	
Route::set('sitemap', 'Sitemap.xml(/<action>)(?<query>)')
	->defaults(array(
		'controller' => 'sitemap',
		'action'     => 'index',
	));

Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
	->defaults(array(
		'controller' => 'error'
	));

//Route::set('default', '(<controller>(/<action>(/<id>)))')
//	->defaults(array(
//		'controller' => 'default',
//		'action'     => 'index',
//	));
