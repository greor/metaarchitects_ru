<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Modules extends Controller_Admin_Front {

	public $template = 'modules';

	public function action_index()
	{
		$this->title = __('Modules');
		$errors = array();

		$modules = array();
		$_modules = Kohana::$config
			->load('_modules');

		foreach ($_modules as $code => $config)
		{
			if ( ! Helper_Module::check_module($config['alias']))
				continue;

			$module_config = Kohana::$config
				->load('admin/modules/'.$code);
			$this->acl_inject($module_config->get('a2'));

			$_controller = empty($config['controller']) ? $code : $config['controller'];
			if ($this->acl->is_allowed($this->user, $_controller.'_controller', 'access')) {
				$modules[$code] = array(
					'code'	=> $code,
					'name'	=> __($config['name']),
					'url'	=>	Route::url('modules', array(
						'controller' => $_controller,
					)),
				);
			}
		}

		$this->template
			->set('errors', $errors)
			->set('title', __('Module list'))
			->set('modules', $modules);
	}

}
