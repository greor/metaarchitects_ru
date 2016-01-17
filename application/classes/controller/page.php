<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Page extends Controller_Front {

	public function before()
	{
		if ($this->request->action() == 'static') {
			$this->template = $this->request->action();
		} else {
			$this->auto_render = FALSE;
		}

		parent::before();
	}

	public function action_static()
	{
		$this->breadcrumbs[] = array(
			'title' => $this->request->page['title']
		);
		$this->breadcrumbs_title = $this->request->page['title'];
		
		$orm = ORM::factory('page', $this->page_id);
		if ( ! $orm->loaded())
			throw new HTTP_Exception_404;
		
		$meta = $this->extract_meta($orm->as_array());
		$this->set_page_meta($meta);
		
		$text = $orm->text;
		$this->title = $orm->title;
		
		if (preg_match('/{{ALBUM::([0-9]+?)}}/iu', $text, $matches)) {
			
			$photo_album_orm = ORM::factory('photo_Category', (int) $matches[1]);
			
			if ($photo_album_orm->loaded()) {
				$photos = $photo_album_orm
					->photo
					->find_all()
					->as_array();
				
				$html = View_Theme::factory('layout/photo_album', array(
					'items' => $photos,
				))->render();
			} else {
				$html = '';
			}
			
			$text = str_replace($matches[0], $html, $text);
		}
			
			
		$this->template
			->set('page', $orm)
			->set('text', $text);
		
		
		$this->switch_on_plugin('parallax');
		$this->switch_on_plugin('venobox');
		$this->switch_on_plugin('inner-photo');
	}

	public function action_page()
	{
		Request::current()->redirect( 
			URL::base().Page_Route::dynamic_base_uri($this->request->page['data']), 
			301
		);
	}

	public function action_url()
	{
		Request::current()->redirect( $this->request->page['data'], 301 );
	}

}