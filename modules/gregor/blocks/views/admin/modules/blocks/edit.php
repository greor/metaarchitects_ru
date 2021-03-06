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
			'controller' => 'blocks',
			'action'     => 'edit',
			'id'         => $element->id,
			'query'      => Helper_Page::make_query_string($query_array)
		));
	} else {
		$action = Route::url('modules', array(
			'controller' => 'blocks',
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

/**** name ****/
		if ($ACL->is_allowed($USER, $element, 'add')) {
			echo View_Admin::factory('form/control', array(
				'field'    => 'name',
				'errors'   => $errors,
				'labels'   => $labels,
				'required' => $required,
				'controls' => Form::input('name', $element->name, array(
					'id'      => 'name_field',
					'class'   => 'input-xlarge',
				)),
			));
		}

/**** code ****/

		if ($ACL->is_allowed($USER, $element, 'add')) {
			echo View_Admin::factory('form/control', array(
				'field'    => 'code',
				'errors'   => $errors,
				'labels'   => $labels,
				'required' => $required,
				'controls' => Form::input('code', $element->code, array(
					'id'      => 'code_field',
					'class'   => 'input-xlarge',
				)),
			));
		}
		
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

/**** link ****/
		
		echo View_Admin::factory('form/control', array(
			'field'    => 'link',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::input('link', $element->link, array(
				'id'      => 'link_field',
				'class'   => 'input-xlarge',
			)),
		));
		
/**** image ****/
		
		echo View_Admin::factory('form/image', array(
			'field'          => 'image',
			'value'          => $element->image,
			'orm_helper'     => $wrapper,
			'errors'         => $errors,
			'labels'         => $labels,
			'required'       => $required,
			'help_text'  => $element->help_text
		));
			
/**** text ****/

		echo View_Admin::factory('form/control', array(
			'field'    => 'text',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::textarea('text', $element->text, array(
				'id'      => 'text_field',
				'class'   => 'text_editor_br',
			)),
		));

?>

	<div class="form-actions">
		<button class="btn btn-primary" type="submit" name="submit" value="save" ><?php echo __('Save'); ?></button>
		<button class="btn btn-primary" type="submit" name="submit" value="save_and_exit" ><?php echo __('Save and Exit'); ?></button>
		<button class="btn" name="cancel" value="cancel"><?php echo __('Cancel'); ?></button>
	</div>

</form>
