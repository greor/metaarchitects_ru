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
		
		$this->template
			->set('orm', $orm);
	}
}