<?php defined('SYSPATH') or die('No direct access allowed.'); 

	$field = "properties[{$item['name']}]";
	$control_id = md5($field);
	$labels = array(
		$field => __('Value')
	);

	switch ($item['type']) {
		case 'structure':
			echo View_Admin::factory('form/property/structure', array(
				'item' => $item
			));
	
			break;
			
		case 'simple':
			echo View_Admin::factory('form/control', array(
				'field' => $field,
				'labels' => $labels,
				'control_id' => $control_id,
				'controls' => Form::input($field, $item['value'], array(
					'id' => $control_id,
					'class' => 'input-xlarge',
					'class' => 'input-xxlarge',
					'placeholder' => __($title)
				)),
			));
			break;
			
		case 'file':
			echo View_Admin::factory('form/property/file', array(
				'field' => $field,
				'labels' => $labels,
				'control_id' => $control_id,
				'value' => $item['value'],
			));
			break;
			
		case 'enum':
			
// 			if ($item['name'] == 'test') {
// 				var_dump($item); die;
// 			}
			
			
			if ($item['multiple']) {
				
				foreach ($item['set'] as $_conf) {
					$_key = $_conf['key'];
					$_field = "{$field}[{$_key}]";
					$_control_id = md5($_field);
					
					echo View_Admin::factory('form/control', array(
						'field' => $_field,
						'labels' => array(
							$_field => $_conf['value']
						),
						'control_id' => $_control_id,
						'controls' => Form::checkbox($_field, $_key, in_array($_key, $item['value']), array(
							'id' => $_control_id,
						)),
					));
				}
				
			} else {
				$_selected = reset($item['value']);
				
				$_field = "{$field}[]";
				$_control_id = md5($_field);
				
				foreach ($item['set'] as $_conf) {
					$options[$_conf['key']] = $_conf['value'];
				}
				
				echo View_Admin::factory('form/control', array(
					'field' => $_field,
					'labels' => array(
						$_field => __('Value')
					),
					'control_id' => $_control_id,
					'controls' => Form::select($_field, array(Helper_Property::ENUM_MARKER => '') + $options, $_selected, array(
						'id' => $_control_id,
						'class' => 'input-xxlarge',
					)),
				));
			}
			break;
	}

