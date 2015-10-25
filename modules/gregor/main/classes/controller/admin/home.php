<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Home extends Controller_Admin_Front {

	public $template = 'home';

	public function action_index()
	{
// 		$helper_propery = new Helper_Property('catalog', 2);
// 		$helper_propery->load_config('catalog.properties');
// 		$helper_propery->set_user_id($this->user->id);
// 		$helper_propery->set('social_vk', 'http://vk.com/feed');
// 		$helper_propery->set('channel_main.kbps-64', 'http://vk.com/feed');
// 		$helper_propery->set('channel_main', array(
// 			'title' => 'TITLE',
// 			'code' => 'CODE',
// 			'kbps-64' => 'http://vk.com/feed',
// 		));
// 		$helper_propery->set('player_type', array(
// 			array(
// 				'key' => 'key_1',
// 				'value' => 'Value 1',
// 				'position' => 4
// 			)
// 		));
// 		$helper_propery->set('player_type', array(
// 			'key_1'
// 		));
// 		$helper_propery->set('player_type', FALSE);
		
// 		$r = $helper_propery->get('social_vk');
// 		$r = $helper_propery->get('channel_main.kbps-64');
// 		$r = $helper_propery->get('channel_main');
// 		$r = $helper_propery->get('player_type');
		
// 		var_dump($r); die;
		
// 		$helper_propery->remove('player_type');
		
		$this->template
			->set('logo', $this->admin_config['logo']);
	}
} 
