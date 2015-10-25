<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form {
	
	/**
	 * Creates a select form input.
	 *
	 *     echo Form::select('country', $countries, $country);
	 *
	 * [!!] Support for multiple selected options was added in v3.0.7.
	 *
	 * @param   string  $name       input name
	 * @param   array   $options    available options
	 * @param   mixed   $selected   selected option string, or an array of selected options
	 * @param   array   $attributes html attributes
	 * @return  string
	 * @uses    HTML::attributes
	 */
	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL, array $disabled = array())
	{
		$disabled = array_filter($disabled);
		
		// Set the input name
		$attributes['name'] = $name;
	
		if (is_array($selected))
		{
			// This is a multi-select, god save us!
			$attributes['multiple'] = 'multiple';
		}
	
		if ( ! is_array($selected))
		{
			if ($selected === NULL)
			{
				// Use an empty array
				$selected = array();
			}
			else
			{
				// Convert the selected options to an array
				$selected = array( (string) $selected);
			}
		}
	
		if (empty($options))
		{
			// There are no options
			$options = '';
		}
		else
		{
			foreach ($options as $value => $name)
			{
				if (is_array($name))
				{
					// Create a new optgroup
					$group = array('label' => $value);
	
					// Create a new list of options
					$_options = array();
	
					foreach ($name as $_value => $_name)
					{
						// Force value to be string
						$_value = (string) $_value;
	
						// Create a new attribute set for this option
						$option = array('value' => $_value);
	
						if (in_array($_value, $selected))
						{
							// This option is selected
							$option['selected'] = 'selected';
						}
						
						if (in_array($_value, $disabled))
						{
							// Disable this option
							$option['disabled'] = 'disabled';
						}
	
						// Change the option to the HTML string
						$_options[] = '<option'.HTML::attributes($option).'>'.HTML::chars($_name, FALSE).'</option>';
					}
	
					// Compile the options into a string
					$_options = "\n".implode("\n", $_options)."\n";
	
					$options[$value] = '<optgroup'.HTML::attributes($group).'>'.$_options.'</optgroup>';
				}
				else
				{
					// Force value to be string
					$value = (string) $value;
	
					// Create a new attribute set for this option
					$option = array('value' => $value);
	
					if (in_array($value, $selected))
					{
						// This option is selected
						$option['selected'] = 'selected';
					}
					
					if (in_array($value, $disabled))
					{
						// Disable this option
						$option['disabled'] = 'disabled';
					}
	
					// Change the option to the HTML string
					$options[$value] = '<option'.HTML::attributes($option).'>'.HTML::chars($name, FALSE).'</option>';
				}
			}
	
			// Compile the options into a single string
			$options = "\n".implode("\n", $options)."\n";
		}
	
		return '<select'.HTML::attributes($attributes).'>'.$options.'</select>';
	}

} 

