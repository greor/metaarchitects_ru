<?php defined('SYSPATH') or die('No direct access allowed.');
	
	$query_array = array();
	$p = Request::current()->query( Paginator::QUERY_PARAM );
	if ( ! empty($p)) {
		$query_array[ Paginator::QUERY_PARAM ] = $p;
	}

	$element = $wrapper->orm();
	$labels = $element->labels();
	$required = $element->required_fields();

	if ( $element->loaded() ) {
		$action = Route::url('modules', array(
			'controller' => 'service',
			'action'     => 'edit',
			'id'         => $element->id,
			'query'      => Helper_Page::make_query_string($query_array)
		));
	} else {
		$action = Route::url('modules', array(
			'controller' => 'service',
			'action'     => 'edit',
			'query'      => Helper_Page::make_query_string($query_array)
		));
	}

	echo View_Admin::factory('layout/error')
		->set('errors', $errors);
?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" class="form-horizontal kr-form-horizontal" >
<?php

/**** active ****/

		echo View_Admin::factory('form/control', array(
			'field'    => 'active',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::hidden('active', '').Form::checkbox('active', '1', (bool) $element->active, array(
				'id' => 'active_field',
			)),
		));

/**** title ****/

		echo View_Admin::factory('form/control', array(
			'field'    => 'title',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::input('title', $element->title, array(
				'id'      => 'title_field',
				'class'   => 'input-xlarge',
			)),
		));

/**** uri ****/

		echo View_Admin::factory('form/control', array(
			'field'    => 'uri',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::input('uri', $element->uri, array(
				'id'      => 'uri_field',
				'class'   => 'input-xlarge',
			)),
		));

/**** icon ****/

		echo View_Admin::factory('form/image', array(
			'field'          => 'icon',
			'value'          => $element->icon,
			'orm_helper'     => $wrapper,
			'errors'         => $errors,
			'labels'         => $labels,
			'required'       => $required,
		));

/**** image ****/

		echo View_Admin::factory('form/image', array(
			'field'          => 'image',
			'value'          => $element->image,
			'orm_helper'     => $wrapper,
			'errors'         => $errors,
			'labels'         => $labels,
			'required'       => $required,
			'help_text'      => '555x300px',
		));
		
/**** announcement ****/
		
		echo View_Admin::factory('form/control', array(
			'field'    => 'announcement',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::textarea('announcement', $element->announcement, array(
				'id'      => 'announcement_field',
				'class'   => 'text_editor_br',
			)),
		));
		
/**** text ****/

		echo View_Admin::factory('form/control', array(
			'field'    => 'text',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::textarea('text', $element->text, array(
				'id'      => 'text_field',
				'class'   => 'text_editor',
			)),
		));

/**** additional params block ****/

		echo View_Admin::factory('form/seo', array(
			'item'     => $element,
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
		));

?>

	<div class="form-actions">
		<button class="btn btn-primary" type="submit" name="submit" value="save" ><?php echo __('Save'); ?></button>
		<button class="btn btn-primary" type="submit" name="submit" value="save_and_exit" ><?php echo __('Save and Exit'); ?></button>
		<button class="btn" name="cancel" value="cancel"><?php echo __('Cancel'); ?></button>
	</div>

</form>
