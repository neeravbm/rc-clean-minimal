<?php
/**
 * Common functions
 */

/**
 * Display all portfolio option links 
 */
function _portfolio_links(){
	$output = array();
	$entity_type = 'node';
	$bundle_name = 'portfolio';
	$allowed_values = array();
	$field_name = 'field_portfolio_category';
	$field_info = field_info_field($field_name);
	if (isset($field_info['settings']['allowed_values'])) {
		$allowed_values = $field_info['settings']['allowed_values'];
		if (sizeof($allowed_values) > 0) {
			$output = theme('portfolio_category_links', array('allowed_values' => $allowed_values));	
		}
	}
	return $output;
}
