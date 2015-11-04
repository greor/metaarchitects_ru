<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Modules_Projects extends Controller_Front {
	
	public $template = 'modules/projects/detail';
	
	public function before()
	{
		$id = $this->request->current()->param('element_id');
		if (empty($id)) {
			$this->request->current()
				->redirect(URL::base());
		}
	
		parent::before();
	}
	
	public function action_index()
	{
		$id = (int) $this->request->param('element_id');
		$orm = ORM::factory('project')
			->where('id', '=', $id)
			->find();
		
		if ( ! $orm->loaded()) {
			throw new HTTP_Exception_404();
		}
		
		$photo = $orm->photo_album
			->photo
			->find_all()
			->as_array();
		
		$this->template
			->set('orm', $orm)
			->set('photo', $photo);
		
			
		$this->switch_on_plugin('page_project');
		$this->switch_on_plugin('venobox');
		$this->switch_on_plugin('parallax');
		$this->switch_on_plugin('owl');
		$this->switch_on_plugin('bxslider');
		$this->switch_on_plugin('imagesloaded');
		$this->switch_on_plugin('packery');
	}
}