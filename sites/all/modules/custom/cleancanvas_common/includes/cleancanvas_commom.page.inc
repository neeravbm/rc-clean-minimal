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

/**
 * Second User Register
 */
function user_register_second() {
	$variables = array();
  $variables['register_form'] = drupal_get_form("user_register_form");
  return theme('user_register_second',$variables);	
}

/**
 * Second User Login
 */
function user_login_second() {
	$variables = array();
  $variables['login_form'] = drupal_get_form("user_login");
  return theme('user_login_second',$variables);		
}
