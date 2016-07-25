<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Controller_Template {

	public $template = 'empty';
	
	/* Common config */
	protected $config = 'site';

	/* Page templates */
	protected $layout = 'layout/template';
	protected $layout_ajax = 'layout/template-ajax';

	/* Template vars */
	protected $body_class = '';
	protected $title;
	protected $breadcrumbs = array();
	protected $page_meta;
	protected $page_header = array();
	protected $open_graph = array();
	protected $open_fileds = array( 'title', 'type', 'image', 'description', 'url', 'site_name' );
	protected $title_delimiter = ' - ';
	
	protected $_css = array();
	protected $_js = array();
	protected $plugins = array();
	protected $without_layout = FALSE;

	protected $media;
	protected $no_img = 'images/default/no_img.jpg';
	protected $_0_gif = 'images/default/0.gif';
	
	protected $top_filter = array();

	/* Internal vars */
	protected $site;
	
	protected $page_id;
	protected $_menu = NULL;

	/* Cache settings */
	protected $ttl = 60;

	public function before()
	{
		if ($this->auto_render === TRUE) {
			$template = $this->template;
			$this->template = NULL;
			parent::before();
			$this->template = View_Theme::factory($template);
		} else {
			parent::before();
		}

		$this->site = ORM::factory('site')
			->find()
			->as_array();
		
		$this->config = Kohana::$config
			->load($this->config)->as_array();

		$this->media = '/media/'.$this->config['theme'].'/';
		$this->no_img = trim($this->media.$this->no_img, '/');
		$this->_0_gif = $this->media.$this->_0_gif;

		if ( $this->request->page !== NULL ) {
			$this->page_id = $this->request->page['id'];
		}
		
		$this->breadcrumbs = $this->breadcrumbs();
	}

	public function after()
	{
		$this->_generate_plugins();
		
		View::set_global('BODY_CLASS', $this->body_class);
		View::bind_global('TITLE', $this->title);
		View::bind_global('PAGE_META', $this->page_meta);
		View::set_global('MEDIA', $this->media);
		View::set_global('CSS', $this->_get_css());
		View::set_global('JS', $this->_get_js());
		View::set_global('IS_AJAX', (bool) $this->request->is_ajax());
		View::set_global('CONFIG', $this->config);
		View::set_global('NO_IMG', $this->no_img );
		View::set_global('_0_GIF', $this->_0_gif );
		View::set_global('PAGE_ID', $this->page_id );
		View::set_global('SITE', $this->site);
		View::set_global('BREADCRUMBS', $this->breadcrumbs);

		if (Request::current()->is_initial()) {
			if ($this->auto_render === TRUE AND ! $this->without_layout) {
				$this->render_layout();
			}
// 			$this->set_cache_headers();
		}

		parent::after();
	}
	
	protected function render_layout()
	{
		$this->generate_og_tags();
		if ($this->request->is_initial()) {
			$this->page_meta = Arr::extract($this->site, array( 
				'title_tag', 
				'keywords_tag', 
				'description_tag'
			 ));
			
			$meta = $this->get_page_meta();
			if ( ! empty($meta['title_tag'])) {
				$this->title = $meta['title_tag'];
			} elseif ( ! empty($this->title)) {
				$this->title = $this->title.$this->title_delimiter.$this->page_meta['title_tag'];
			} else {
				$this->title = $this->page_meta['title_tag'];
			}
			
			$this->set_page_meta($meta);
		}

		$content = $this->template
			->render();
		
		$data = array(
			'content' => $content,
			'menu' => $this->get_top_menu(),
			'TOP_FILTER' => $this->top_filter
		);
		if ( ! $this->request->is_ajax()) 	{
			$data['page_header'] = $this->page_header;
			$data['og_tags'] = $this->open_graph;
			$this->template = View_Theme::factory($this->layout, $data);
		} else {
			$this->template = View_Theme::factory($this->layout_ajax, $data);
		}
	}
	
	protected function set_cache_headers()
	{
		if ($this->ttl) {
			$this->response
			->headers('cache-control', 'public, max-age='.$this->ttl)
			->headers('expires', gmdate('D, d M Y H:i:s', time()+$this->ttl).' GMT');
		} else {
			$this->response
			->headers('cache-control', 'max-age=0, must-revalidate, public')
			->headers('expires', gmdate('D, d M Y H:i:s', time()).' GMT');
		}
	}
	
	protected function remove_escape_sequenced($string)
	{
		return str_replace( array("\r\n","\r","\n","\t") , '', $string);
	}
	
	private function generate_og_tags()
	{
		$url_base = URL::base(TRUE);
		foreach ($this->open_fileds as $name) {
			if ( ! empty($this->open_graph[ $name ])) {
				$this->open_graph[$name] = $this->open_graph[ $name ];
				continue;
			}
			switch ($name) {
				case 'title':
					$this->open_graph['title'] = $this->title;
					break;
				case 'type':
					$this->open_graph['type'] = 'website';
					break;
				case 'image':
					$this->open_graph['image'] = $url_base.$this->media.'images/logo_social.jpg';
					break;
				case 'description':
					if (empty($this->site['description_tag']))
						continue 2;
					$this->open_graph['description'] = $this->site['description_tag'];
					break;
				case 'url':
					$_query = $this->request->query();
					$_query = empty($_query) ? '' : '?'.http_build_query($_query);
					$this->open_graph['url'] = $url_base.$this->request->uri().$_query;
					break;
				case 'site_name':
					if (empty($this->site['name']))
						continue 2;
					$this->open_graph['site_name'] = $this->site['name'];
					break;
			}
		}
	}
	
	protected function og_extract_site() {
		if (empty($this->site))
			throw new HTTP_Exception_404();
		foreach ($this->open_fileds as $name) {
			switch ($name) {
				case 'description':
					if (empty($this->site['description_tag']))
						continue 2;
					$this->open_graph['description'] = $this->site['description_tag'];
					break;
				case 'site_name':
					if (empty($this->site['name']))
						continue 2;
					$this->open_graph['site_name'] = $this->site['name'];
					break;
			}
		}
	}

	protected function set_page_meta(array $meta = NULL)
	{
		if ( ! empty($meta)) {
			if ( ! empty($meta['title_tag'])) {
				$this->page_meta['title_tag'] = $meta['title_tag'];
			}
			if ( ! empty($meta['keywords_tag'])) {
				$this->page_meta['keywords_tag'] = $meta['keywords_tag'];
			}
			if ( ! empty($meta['description_tag'])) {
				$this->page_meta['description_tag'] = $meta['description_tag'];
			}
		}
	}

	protected function get_page_meta()
	{
		return $this->load_meta('page', $this->page_id);
	}

	protected function load_meta($model_name, $id)
	{
		if ($id) {
			$meta = ORM::factory($model_name)
				->select('title_tag', 'keywords_tag', 'description_tag')
				->where('id', '=', $id)
				->find()
				->as_array();

			return array_filter($meta, 'strlen');
		}
		return array();
	}

	protected function extract_meta(array $values)
	{
		$meta = Arr::extract($values, array('title_tag', 'keywords_tag', 'description_tag'), '');
		return array_filter($meta, 'strlen');
	}

	protected function merge_meta(array $meta_1, array $meta_2)
	{
		if (empty($meta_2['title_tag'])) {
			$meta_2['title_tag'] = '';
		}
		return array_merge($meta_1, $meta_2);
	}

	protected function check_refferer()
	{
		$referrer = str_replace(array( 'http://', 'https://', 'www.'), '', Request::current()->referrer());
		$site_name = str_replace(array( 'http://', 'https://', 'www.'), '', URL::base(TRUE));
		return strpos($referrer, $site_name) === 0;
	}

	protected function get_top_menu()
	{
		if ($this->_menu !== NULL)
			return $this->_menu;

		if ( ! DONT_USE_CACHE) {
			try {
				$this->_menu = Cache::instance('file-struct')
					->get('top-menu');
			}
			catch (ErrorException $e) {};
		}

		if( $this->_menu === NULL ) {
			$page_statuses = Kohana::$config
				->load('_pages.status_codes');

			$pages = ORM::factory('page')
				->select('id', 'parent_id', 'uri', 'title', 'level', 'position', 'name', 'type', 'data', 'megamenu')
				->where('status', '=', $page_statuses['active'])
				->and_where('level', '<', 3)
				->order_by('level', 'asc')
				->order_by('position', 'asc')
				->find_all();

			$this->_menu = $this->_parse_menu_item($pages);

			if ( ! DONT_USE_CACHE) {
				try {
					Cache::instance('file-struct')
						->set('top-menu', $this->_menu, Date::DAY);
				}
				catch (ErrorException $e) {};
			}
		}

		return $this->_menu;
	}
	
	private function breadcrumbs()
	{
		$return = array();
		$url_base = URL::base();
	
		if ( ! empty($this->page_id)) {
			$current_page_id = $this->page_id;
			$stop = FALSE;
	
			while ( ! $stop) {
				$_tmp = Page_Route::page_by_id($current_page_id);
	
				$return[] = array(
					'title' => $_tmp['title'],
					'link'  => $url_base.$_tmp['url']
				);
	
				$current_page_id = $_tmp['parent_id'];
	
				if ($current_page_id == 0) {
					$stop = TRUE;
				}
			}
		}
	
		$return[] = array(
			'title' => __('Home page'),
			'link'  => $url_base
		);
	
		return array_reverse($return);
	}

	private function _parse_menu_item($pages)
	{
		$return = array();

		$current_url = Request::current()->uri();
		foreach ($pages as $item) {
			$return_item = array(
				'name' => $item->name,
				'title' => $item->title,
				'target' => '_self',
				'is_dynamic' => FALSE,
			);
			if ( $item->type == 'url' AND strpos($item->data, '//') !== FALSE) {
				$return_item['target'] = '_blank';
			}
			if ($item->megamenu) {
				$return_item['megamenu'] = $this->_get_megamenu($item->id);
			}
			$return_item['sub'] = array();
			
			// тут добавляем элементы "подменю"
			
			if (isset( $return[ $item->parent_id ] )) {
				$return_item['uri'] = $return[ $item->parent_id ]['uri'].'/'.$item->uri;
				$return[ $item->parent_id ]['sub'][ $item->id ] = $return_item;
			} elseif ( $item->parent_id == 0 ) {
				$return_item['uri'] = $item->uri;
				$return[ $item->id ] = $return_item;
			}
		}

		return $return;
	}
	
	private function _get_megamenu($page_id) {
		$retrun = array();
		$columns = ORM::factory('megamenu_Column')
			->where('page_id', '=', $page_id)
			->find_all()
			->as_array('id');
		foreach ($columns as $_item) {
			$_key = $_item->id;
			$retrun[$_key] = $_item->as_array();
			$retrun[$_key]['rows'] = array();
		}
			
		if (empty($retrun)) {
			return FALSE;
		}
		$rows = ORM::factory('megamenu_Row')
			->where('column_id', 'IN', array_keys($retrun))
			->find_all();
		
		foreach ($rows as $_item) {
			$_key = $_item->column_id;
			if ( ! array_key_exists($_key, $retrun)) {
				continue;
			}
			
			$retrun[$_key]['rows'][] = $_item->as_array();
		}
			
		return $retrun;
	}
	
	private function _get_css()
	{
		$css = array();
		foreach ($this->_css as $_css) {
			if (strpos($_css, '/media/') !== 0) {
				$_css = $this->media.$_css;
			}
			$css[] = $_css;
		}
		return $css;
	}
	
	private function _get_js()
	{
		$js = array();
		foreach ($this->_js as $_js) {
			if (strpos($_js, '/media/') !== 0) {
				$_js = $this->media.$_js;
			}
			$js[] = $_js;
		}
		return $js;
	}
	
	private function _generate_plugins()
	{
		$plugins = $this->_tpl_plugins();
		foreach ($plugins as $_name => $_conf) {
			if ( ! in_array($_name, $this->plugins))
				continue;
			
			if (array_key_exists('css', $_conf)) {
				$this->_css = array_merge($this->_css, $_conf['css']);
			}
			if (array_key_exists('js', $_conf)) {
				$this->_js = array_merge($this->_js, $_conf['js']);
			}
		}
	}
	
	protected function switch_on_plugin($name)
	{
		if ( ! in_array($name, $this->plugins)) {
			$this->plugins[] = $name;
		}
	}
	
	private function _tpl_plugins()
	{
		return array(
			'isotope' => array(
				'js' => array('javascripts/libs/isotope.js', 'javascripts/custom/isotope-init.js'),
			),
			'venobox' => array(
				'css' => array('stylesheets/venobox.css'),
				'js' => array('javascripts/libs/venobox.min.js', 'javascripts/custom/venobox-init.js'),
			),
			'parallax' => array(
				'css' => array('stylesheets/parallax.css'),
				'js' => array('javascripts/libs/jquery.parallax-1.1.3.js', 'javascripts/custom/parallax-init.js'),
			),
			'owl' => array(
				'css' => array('stylesheets/owl.carousel.css', 'stylesheets/owl.theme.css'),
				'js' => array('javascripts/libs/owl.carousel.js', 'javascripts/custom/owl-init.js'),
			),
			'bxslider' => array(
				'css' => array('stylesheets/jquery.bxslider.css'),
				'js' => array('javascripts/libs/jquery.bxslider.min.js'),
			),
			'imagesloaded' => array(
				'js' => array('javascripts/libs/imagesloaded.pkgd.min.js'),
			),
			'packery' => array(
				'js' => array('javascripts/libs/packery.pkgd.min.js', 'javascripts/custom/packery-wall-init.js'),
			),
			'inner-photo' => array(
				'js' => array('javascripts/libs/jquery.bxslider.min.js', 'javascripts/custom/inner-photo.js'),
			),

			
			
			
			'page_home' => array(
				'css' => array('stylesheets/intro03.css?v=2'),
			),
			'page_project' => array(
				'css' => array('stylesheets/intro12.css?v=2'),
			),
			
			
			
			
		);
	}

} 