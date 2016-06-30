<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sitemap extends Controller {

	protected $site_id;
	
	private $domain = 'http://meta-architects.ru';
	private $parsed_modules = array( 
		'news', 'projects'
	);
	private $sitemap_directory_base = 'upload/sitemaps';
	private $sitemap_directory;
	private $pages_uris = array();
	
	public function before()
	{
		parent::before();
		
		$this->sitemap_directory_base = str_replace('/', DIRECTORY_SEPARATOR, $this->sitemap_directory_base);
		$dirname = DOCROOT.$this->sitemap_directory_base.DIRECTORY_SEPARATOR;
		
		if ($this->request->action() == 'generate') {
			if (file_exists($dirname)) {
				Ku_Dir::remove($dirname);
			}
			Ku_Dir::make($dirname);
			Ku_Dir::make_writable($dirname);
		}
		
		$site = ORM::factory('site')
			->find();
		if ( ! $site->loaded()) {
			throw new HTTP_Exception_404();
		}
			
		ORM_Base::$site_id = $this->site_id;
		$this->site_id = $site->id;
		$this->sitemap_directory = $this->sitemap_directory_base.DIRECTORY_SEPARATOR.str_pad($this->site_id, 3, '0', STR_PAD_LEFT);
	}

	public function action_index()
	{
		if ( ! file_exists(DOCROOT.$this->sitemap_directory)) {
			throw new HTTP_Exception_404();
		}
		
		$this->response
			->headers('Content-Type', 'text/xml')
			->headers('cache-control', 'max-age=0, must-revalidate, public')
			->headers('expires', gmdate('D, d M Y H:i:s', time()).' GMT');
		try {
			$dir = new DirectoryIterator(DOCROOT.$this->sitemap_directory);
		
			$xml = new DOMDocument('1.0', Kohana::$charset);
			$xml->formatOutput = TRUE;
			$root = $xml->createElement('sitemapindex');
			$root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
			$xml->appendChild($root);

			foreach ($dir as $fileinfo) {
				if ($fileinfo->isDot() OR $fileinfo->isDir())
					continue;
				
				$_file_path = str_replace(DOCROOT, '', $fileinfo->getPathName());
				$_file_url = $this->domain.'/'.str_replace(DIRECTORY_SEPARATOR, '/', $_file_path);
				$sitemap = $xml->createElement('sitemap');
				$root->appendChild($sitemap);

				$sitemap->appendChild(new DOMElement('loc', $_file_url));
				
				$_last_mod = Sitemap::date_format($fileinfo->getCTime());
				$sitemap->appendChild(new DOMElement('lastmod', $_last_mod));
			}
			
		} catch (Exception $e) {
			echo Debug::vars(
				$e->getMessage()
			); die;
		};
		
		echo $xml->saveXML();
	}
	
	public function action_generate()
	{
		$_common_set = array();
		$this->pages_uris = Helper_Page::parse_to_base_uri( ORM::factory('page')->find_all() );
		$pages = $this->get_pages();
		
		foreach ($pages as $item) {
			$_set = array();
			if ($item['type'] == 'static') {
				$_set[] = $this->_page_item($item);
			} elseif ($item['type'] == 'module') {
				switch($item['data']) {
					case 'news':
						$_set = $this->_news_items($item);
						break;
					case 'projects':
						$_set = $this->_projects_items($item);
						break;
				}
			}
			
			if ($item['sm_separate_file'] == 1 AND ! empty($_set)) {
				$sitemap = new Sitemap;
				foreach ($_set as $_item) {
					$sitemap_url = new Sitemap_URL;
					$sitemap_url->set_loc($_item['loc'])
						->set_change_frequency($_item['changefreq'])
						->set_priority(str_replace(',', '.', $_item['priority']));
					if ( ! empty($_item['lastmod'])) {
						$_unix_time = strtotime($_item['lastmod']);
						$sitemap_url->set_last_mod($_unix_time);
					}
					$sitemap->add($sitemap_url);
					unset($sitemap_url);
				}

				$this->write_to_file($this->sitemap_directory.DIRECTORY_SEPARATOR.'part_'.uniqid().'.xml', urldecode($sitemap->render()));
				unset($sitemap);
			} else {
				$_common_set = array_merge($_common_set, $_set);
			}
		}
		
		if ( ! empty($_common_set)) {
			$sitemap = new Sitemap;
			foreach ($_common_set as $_item) {
				$sitemap_url = new Sitemap_URL;
				$sitemap_url->set_loc($_item['loc'])
					->set_change_frequency($_item['changefreq'])
					->set_priority(str_replace(',', '.', $_item['priority']));
				if ( ! empty($_item['lastmod'])) {
					$_unix_time = strtotime($_item['lastmod']);
					$sitemap_url->set_last_mod($_unix_time);
				}
				$sitemap->add($sitemap_url);
				unset($sitemap_url);
			}
			$this->write_to_file($this->sitemap_directory.DIRECTORY_SEPARATOR.uniqid('common_').'.xml', urldecode($sitemap->render()));
			unset($sitemap);
		}
	}
	
	private function get_pages()
	{
		return DB::select(
				'id', 'type', 'data', 'created', 'updated', 
				'sm_changefreq', 'sm_priority', 'sm_separate_file'
			)
			->from('pages')
			->where('delete_bit', '=', 0)
			->and_where('status', '>', 0)
			->and_where_open()
				->where('type', '=', 'static')
				->or_where_open()
					->where('type', '=', 'module')
					->and_where('data', 'IN', $this->parsed_modules)
				->or_where_close()
			->and_where_close()
			->order_by('sm_priority', 'desc')
			->execute();
	}
	
	private function write_to_file($file_name, $str)
	{
		$file_name = str_replace('/', DIRECTORY_SEPARATOR, $file_name);
		if (strpos($file_name, DOCROOT) !== 0) {
			$file_name = DOCROOT.$file_name;
		}
		$dirname = dirname($file_name);
		if ( ! file_exists($dirname)) {
			Ku_Dir::make($dirname);
		}
		Ku_Dir::make_writable($dirname);
		
		
		
		
		$handle = fopen($file_name, 'w');
		fwrite($handle, $str);
		fclose($handle);
	}
	
	private function _page_item($page)
	{
		$_uri = Arr::get($this->pages_uris, $page['id']);
		$_page_loc = ($_uri !== NULL) ? ($this->domain.URL::base().$_uri) : FALSE;
		$_page_last_mod = ($page['updated'] == '0000-00-00 00:00:00') ? $page['created'] : $page['updated'];
		return array(
			'loc' => $_page_loc,
			'lastmod' => (empty($_page_last_mod) ? 'monthly' : $_page_last_mod),
			'changefreq' => (empty($page['sm_changefreq']) ? 'monthly' : $page['sm_changefreq']),
			'priority' => (empty($page['sm_priority']) ? '0.5' : $page['sm_priority']),
		);
	}
	
	private function _news_items($page)
	{
		$return = array();
		$url_base = $this->domain.URL::base();
		$return[] = $this->_page_item($page);
		
		$item_link_tpl = $url_base.Page_Route::uri($page['id'], 'news', array(
			'uri' => '{uri}',
		));
		
		$db_news = ORM::factory('news')
			->limit(1000)	
			->find_all();
		
		$_date = date('Y-m-d H:i:s', strtotime('-1 month'));
		$stop = ($db_news->count() <= 0);
		while ( ! $stop) {
			$_item = $db_news->current();
			if ($_item != FALSE) {
				$_last_mod = ($_item->updated > $_item->public_date) ? $_item->updated : $_item->public_date;
				if ($_last_mod < $_date) {
					$_changefreq = 'never';
				} else {
					$_changefreq = $page['sm_changefreq'];
				}
				
				$return[] = array(
					'loc' => str_replace('{uri}', $_item->uri, $item_link_tpl),
					'lastmod' => (empty($_last_mod) ? 'monthly' : $_last_mod),
					'changefreq' => (empty($page['sm_changefreq']) ? 'monthly' : $page['sm_changefreq']),
					'priority' => (empty($page['sm_priority']) ? '0.5' : $page['sm_priority']),
				);
			} else {
				$stop = TRUE;
			}
			$db_news->next();
		}

		return $return;
	}
	
	private function _projects_items($page)
	{
		$return = array();
		$url_base = $this->domain.URL::base();
		$return[] = $this->_page_item($page);
		
		$item_link_tpl = $url_base.Page_Route::uri($page['id'], 'projects', array(
			'element_id' => '{element_id}',
		));
		
		$db_news = ORM::factory('project')
			->limit(1000)	
			->find_all();
		
		$_date = date('Y-m-d H:i:s', strtotime('-1 month'));
		$stop = ($db_news->count() <= 0);
		while ( ! $stop) {
			$_item = $db_news->current();
			if ($_item != FALSE) {
				$_last_mod = ($_item->updated > $_item->created) ? $_item->updated : $_item->created;
				if ($_last_mod < $_date) {
					$_changefreq = 'never';
				} else {
					$_changefreq = $page['sm_changefreq'];
				}
				
				$return[] = array(
					'loc' => str_replace('{element_id}', $_item->id, $item_link_tpl),
					'lastmod' => (empty($_last_mod) ? 'monthly' : $_last_mod),
					'changefreq' => (empty($page['sm_changefreq']) ? 'monthly' : $page['sm_changefreq']),
					'priority' => (empty($page['sm_priority']) ? '0.5' : $page['sm_priority']),
				);
			} else {
				$stop = TRUE;
			}
			$db_news->next();
		}

		return $return;
	}
	
}