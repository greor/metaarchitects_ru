<?php defined('SYSPATH') or die('No direct script access.');

class Model_Project extends ORM_Base {
	
	protected $_sorting = array('position' => 'ASC');
	protected $_deleted_column = 'delete_bit';
	protected $_active_column = 'active';

	public function labels()
	{
		return array(
			'title' => 'Title',
			'image' => 'Image',
			'parallax' => 'Parallax',
			'parallax_title' => 'Parallax title',
			'parallax_descr' => 'Parallax descr',
			'size' => 'Size',
			'active' => 'Active',
			'position' => 'Position',
			'category' => 'Category',
			'text' => 'Text',
			'title_tag' => 'Title tag',
			'keywords_tag' => 'Keywords tag',
			'description_tag' => 'Desription tag',
		);
	}

	public function rules()
	{
		return array(
			'id' => array(
				array('digit'),
			),
			'title' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'image' => array(
				array('max_length', array(':value', 255)),
			),
			'parallax' => array(
				array('max_length', array(':value', 255)),
			),
			'parallax_title' => array(
				array('max_length', array(':value', 255)),
			),
			'parallax_descr' => array(
				array('max_length', array(':value', 255)),
			),
			'category' => array(
				array('max_length', array(':value', 255)),
			),
			'size' => array(
				array('max_length', array(':value', 255)),
			),
			'position' => array(
				array('digit'),
			),
			'title_tag' => array(
				array('max_length', array(':value', 255)),
			),
			'keywords_tag' => array(
				array('max_length', array(':value', 255)),
			),
			'description_tag' => array(
				array('max_length', array(':value', 255)),
			),
		);
	}

	public function filters()
	{
		return array(
			TRUE => array(
				array('trim'),
			),
			'title' => array(
				array('strip_tags'),
			),
			'category' => array(
				array('strip_tags'),
			),
			'title_tag' => array(
				array('strip_tags'),
			),
			'keywords_tag' => array(
				array('strip_tags'),
			),
			'description_tag' => array(
				array('strip_tags'),
			),
			'active' => array(
				array(array($this, 'checkbox'))
			),
		);
	}
}
