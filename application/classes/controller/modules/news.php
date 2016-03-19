<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Modules_News extends Controller_Front {
	
	private $limit = 5;
	
	public function before()
	{
		parent::before();
		
		if ($this->request->param('uri')) {
			$this->request
				->action('detail');
		}
	}
	
	public function action_index()
	{
		$orm = ORM::factory('news');
		
		$paginator_orm = clone $orm;
		$paginator = new Paginator('layout/paginator');
		$paginator
			->per_page($this->limit)
			->count($paginator_orm->count_all());
		unset($paginator_orm);
		
		$list = $orm
			->paginator($paginator)
			->find_all()
			->as_array();
		
		$this->template
			->set_filename('modules/news/list')
			->set('list', $list)
			->set('paginator', $paginator);
		
		$this->title = $this->request->page['title'];
	}
	
	public function action_detail()
	{
		$uri = $this->request->param('uri');
		$orm = ORM::factory('news')
			->where('uri', '=', $uri)
			->find();
		
		if ( ! $orm->loaded()) {
			throw new HTTP_Exception_404();
		}
		
		$this->template
			->set_filename('modules/news/detail')
			->set('orm', $orm)
			->set('siblings', $this->get_siblings($orm));
		
		$this->title = $orm->title;
	}
	
	private function get_siblings(ORM $orm)
	{
		$orm_next = clone $orm;
		$orm_next
			->clear()
			->where('id', '!=', $orm->id)
			->where('public_date', '>', $orm->public_date)
			->order_by('public_date', 'asc')
			->limit(1)
			->find();
		
		$orm_prev = clone $orm;
		$orm_prev
			->clear()
			->where('id', '!=', $orm->id)
			->where('public_date', '<', $orm->public_date)
			->order_by('public_date', 'desc')
			->limit(1)
			->find();
		
		return array(
			'prev' => $orm_prev,
			'next' => $orm_next,
		);
	}
	
	protected function get_page_meta()
	{
		switch ($this->request->action()) {
			case 'detail':
				$uri = $this->request->param('uri');
				$data = ORM::factory('news')
					->where('uri', '=', $uri)
					->find()
					->as_array();
				
				$result = $this->extract_meta($data);
				break;
			case 'index':
			default:
				$result = parent::get_page_meta();
		}
		
		return $result;
	}
	
}