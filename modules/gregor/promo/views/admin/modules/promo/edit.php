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
			'controller' => 'promo',
			'action'     => 'edit',
			'id'         => $element->id,
			'query'      => Helper_Page::make_query_string($query_array)
		));
	} else {
		$action = Route::url('modules', array(
			'controller' => 'promo',
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

/**** public_date ****/
		
		if ( $element->loaded() AND Valid::date($element->public_date) ) {
			$_date_ts = strtotime($element->public_date);
			$_date_date = date('Y-m-d', $_date_ts);
			$_date_time = date('H:i', $_date_ts);
		} else {
			$_date_date = date('Y-m-d');
			$_date_time = date('H:i');
		}
		echo View_Admin::factory('form/control', array(
				'field'     => 'public_date',
				'errors'    => $errors,
				'labels'    => $labels,
				'required'  => $required,
				'controls'  => Form::input('multiple_date_p', $_date_date, array(
					'id'       => 'public_date_field',
					'class'    => 'multiple_date',
				)).Form::input('multiple_time_p', $_date_time, array(
					'class'    => 'multiple_time',
				)),
		));		

/**** hidden_date ****/
		
		if ( $element->loaded() AND Valid::date($element->hidden_date)) {
			$_date_ts = strtotime($element->hidden_date);
			$_date_date = date('Y-m-d', $_date_ts);
			$_date_time = date('H:i', $_date_ts);
		} else {
			$_date_date = '';
			$_date_time = '';
		}
		echo View_Admin::factory('form/control', array(
				'field'     => 'hidden_date',
				'errors'    => $errors,
				'labels'    => $labels,
				'required'  => $required,
				'controls'  => Form::input('multiple_date_h', $_date_date, array(
					'id'       => 'hidden_date_field',
					'class'    => 'multiple_date',
				)).Form::input('multiple_time_h', $_date_time, array(
					'class'    => 'multiple_time',
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

/**** url ****/

		echo View_Admin::factory('form/control', array(
			'field'    => 'url',
			'errors'   => $errors,
			'labels'   => $labels,
			'required' => $required,
			'controls' => Form::input('url', $element->url, array(
				'id'      => 'url_field',
				'class'   => 'input-xlarge',
			)),
		));

/**** background ****/

// 		echo View_Admin::factory('form/image', array(
// 			'field'          => 'background',
// 			'value'          => $element->background,
// 			'orm_helper'     => $wrapper,
// 			'errors'         => $errors,
// 			'labels'         => $labels,
// 			'required'       => $required,
// 			'help_text'      => '1920x635px'
// 		));
		
/**** image ****/
		
		echo View_Admin::factory('form/image', array(
			'field'          => 'image',
			'value'          => $element->image,
			'orm_helper'     => $wrapper,
			'errors'         => $errors,
			'labels'         => $labels,
			'required'       => $required,
			'help_text'      => '560x325px'
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

/**** settings ****/
		
// 		echo View_Admin::factory('form/revolution_settings', array(
// 			'field'    => 'settings',
// 			'labels'   => $labels,
// 			'values'   => $element->settings
// 		));

?>
	<div class="form-actions">
		<button class="btn btn-primary" type="submit" name="submit" value="save" ><?php echo __('Save'); ?></button>
		<button class="btn btn-primary" type="submit" name="submit" value="save_and_exit" ><?php echo __('Save and Exit'); ?></button>
		<button class="btn" name="cancel" value="cancel"><?php echo __('Cancel'); ?></button>
	</div>
</form>
<script>
	$(document).ready(function(){
		$('.multiple_time').timepicker({});
		$('.multiple_date').datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
