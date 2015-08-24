<?php

/**
 * Implements hook_css_alter().
 */
function cleancanvas_css_alter(&$css) {
  // Remove Drupal core css
  $exclude = array(
    'modules/aggregator/aggregator.css' => FALSE,
    'modules/block/block.css' => FALSE,
    'modules/book/book.css' => FALSE,
    'modules/comment/comment.css' => FALSE,
    'modules/dblog/dblog.css' => FALSE,
    //'modules/field/theme/field.css' => FALSE,
    'modules/file/file.css' => FALSE,
    'modules/filter/filter.css' => FALSE,
    'modules/forum/forum.css' => FALSE,
    'modules/help/help.css' => FALSE,
    'modules/menu/menu.css' => FALSE,
    'modules/node/node.css' => FALSE,
    'modules/openid/openid.css' => FALSE,
    'modules/poll/poll.css' => FALSE,
    'modules/profile/profile.css' => FALSE,
    'modules/search/search.css' => FALSE,
    'modules/statistics/statistics.css' => FALSE,
    'modules/syslog/syslog.css' => FALSE,
    'modules/system/admin.css' => FALSE,
    'modules/system/maintenance.css' => FALSE,
    'modules/system/system.css' => FALSE,
    'modules/system/system.admin.css' => FALSE,
    'modules/system/system.base.css' => FALSE,
    'modules/system/system.maintenance.css' => FALSE,
    'modules/system/system.messages.css' => FALSE,
    'modules/system/system.menus.css' => FALSE,
    'modules/system/system.theme.css' => FALSE,
    'modules/taxonomy/taxonomy.css' => FALSE,
    'modules/tracker/tracker.css' => FALSE,
    'modules/update/update.css' => FALSE,
    'modules/user/user.css' => FALSE,
    'misc/vertical-tabs.css' => FALSE,
    // Remove contrib module CSS
    drupal_get_path('module', 'views') . '/css/views.css' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}


/**
 * Implements hook_preprocess_page().
 */
function cleancanvas_preprocess_page(&$vars) {
	$arg = arg();
  $page = $vars['page'];
  if (!empty($page['sidebar_first']) && !empty($page['sidebar_second'])) {
    $vars['sidebar_column_classes'] = 'col-sm-3';
    $vars['content_column_classes'] = 'col-sm-6';
  }
  elseif (empty($page['sidebar_first']) && empty($page['sidebar_second'])) {
    $vars['content_column_classes'] = 'col-sm-12';
  }
  elseif (!empty($page['sidebar_first'])) {
    $vars['sidebar_column_classes'] = 'col-sm-4';
    $vars['content_column_classes'] = 'col-sm-8';
  }
  elseif (!empty($page['sidebar_second'])) {
    $vars['sidebar_column_classes'] = 'col-sm-4';
    $vars['content_column_classes'] = 'col-sm-8';
  }
  
  // add page id base on content type;
  $vars['pages_id']  = NULL;
  if(isset($vars['node'])) {
		$node = $vars['node'];
		if($node->type == 'blog_post') {
			$vars['pages_id'] = $node->type;	
		}
		else if ($node->nid == 19) {
			$vars['pages_id'] = 'contact';
		}
		else if ($node->nid == 23) {
			$vars['pages_id'] = 'coming_soon';
		}
  }
  else if ($arg[0] == 'blog' && sizeof($arg) == 1) {
		$vars['pages_id'] = 'blog';	
	}
	else if ($arg[0] == 'user' && sizeof($arg) == 1 && user_is_anonymous()) {
		$vars['pages_id'] = 'sign_up2';	
	}
	else if ($arg[0] == 'user' && sizeof($arg) == 2 && user_is_anonymous()) {
		$vars['pages_id'] = 'sign_up2';	
	}
	else if ($arg[0] == 'comment' && (sizeof($arg) == 4 || sizeof($arg) == 3)) {
		$vars['pages_id'] = 'blog_post';	
	}
	else if ($arg[0] == 'search') {
		$vars['pages_id'] = 'blog_post';	
	}
	
}

/**
 * Implements hook_js_alter()
 * Used to move all JS to footer
 */
function cleancanvas_two_js_alter(&$javascript) {
  // Change the default scope of all other scripts to footer.
  // We assume if the script is scoped to header it was done so by default.
  foreach ($javascript as $key => &$script) {
    if ($script['scope'] == 'header') {
      $script['scope'] = 'footer';
    }
  }
}


/**
 * Implements hook__preprocess_menu_link().
 * 
 * Used to add class in menu for dropdown toggle functionality
 */
function cleancanvas_preprocess_menu_link(&$vars){
  global $user;
  $element = &$vars['element'];
  if($element['#original_link']['expanded'] == 1 && $element['#original_link']['menu_name'] == 'main-menu'){
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
  }
}

/**
 * Override or insert variables into the page template.
 */
function cleancanvas_process_page(&$vars) {
  $arg = arg();
  if (user_is_anonymous()) {
		$vars['tabs'] = NULL;
	}
  
  if(drupal_is_front_page()) {
    $vars['navbar_classes'] = "navbar navbar-inverse navbar-fixed-top";
  }
  else {
		$vars['navbar_classes'] = "navbar navbar-inverse navbar-static-top";
	}
  // hide page title from node page
  if(isset($vars['node'])) {
		if ($vars['node']->type == 'blog_post') {
			$vars['title'] = null;
	  }
		else if ($arg[0] == 'node' && $arg[1] == '18') {
			$vars['title'] = NULL;
		}
		else if ($arg[0] == 'node' && $arg[1] == '20') {
			$vars['title'] = NULL;
		}
		else if ($arg[0] == 'node' && $arg[1] == '25') {
			$vars['title'] = NULL;
		}
		else if ($arg[0] == 'node' && $arg[1] == '17') {
			$vars['title'] = NULL;
		}
		else if ($vars['node']->type == 'pricing') {
			$vars['title'] = NULL;
		}
		else if ($arg[0] == 'node' && $arg[1] == '23') {
			$vars['title'] = NULL;
			$vars['tabs'] = NULL;
		}
	}
	else if ($arg[0] == 'user' && sizeof($arg) == 2 && user_is_anonymous()) {
	  $vars['title'] = NULL;
  }
	else if ($arg[0] == 'blog' && sizeof($arg) == 1) {
		$vars['title'] = NULL;
	}
	else if ($arg[0] == 'user' && sizeof($arg) == 1 && user_is_anonymous()) {
		$vars['title'] = NULL;
	}
}



/**
 * Implements hook_preprocess_node().
 */
function cleancanvas_preprocess_node(&$vars) {
	if ($vars['view_mode'] == 'teaser') {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->type . '__teaser'; 
  }
  
  if ($vars['type'] == 'blog_post') {
		  
		  $node = node_load($vars['nid']);
		  
		  $body = field_get_items('node', $node, 'body');
      $body = $body[0]['value'];
		  
		  // User details
			$uid = $vars['uid'];
			$userload = user_load($uid);

			$first_name = field_get_items('user', $userload, 'field_first_name');
			$username[] = $first_name[0]['value'];

			$last_name = field_get_items('user', $userload, 'field_last_name');
			$username[] = $last_name[0]['value'];
      
      $designation = field_get_items('user', $userload, 'field_designation');
      $designation = $designation[0]['value'];
			$username = array_filter($username);
			if (sizeof($username) > 0) {
				$name = implode(' ', $username);
				$vars['username'] = l($name, 'user/' . $userload->uid);
			}
			else {
				$vars['username'] = l($userload->name, 'user/' . $userload->uid);
			}
			
			// image
			$blog_image = field_view_field('node', $node, 'field_image',
      array(
        'label' => 'hidden',
        'settings' => array(
          'image_style' => '',
          'image_link' => 'content',
          'alt' => !empty($node->title) ? check_plain($node->title) : '',
          'title' => !empty($node->title) ? check_plain($node->title) : '',
          'attributes' => array(
            'class' => array('img-responsive'),
           ),
         )
      ));
      $vars['blog_image'] = drupal_render($blog_image);
      $vars['blog_body'] = truncate_utf8(strip_tags($body), 200, FALSE, FALSE, 1);
      // Date
			$vars['blog_submitted'] = date('D, jM');
			$vars['blog_designation'] = $designation;
	 }
}

/**
* hook_form_FORM_ID_alter()
* 
* Used to hide some fields from comments form
*/
function cleancanvas_form_comment_form_alter(&$form, &$form_state) {
  $form['author']['homepage']['#access'] = FALSE;
  $form['author']['name']['#title'] = 'Name';
  $form['author']['homepage']['#access'] = FALSE;
  $form['comment_body'][$form['comment_body']['#language']][0]['#attributes'] = array('class' => array('form-control'));
  $form['actions']['submit']['#value'] = t('Add Commnet');
}

/**
* hook_form_alter()
*/
function cleancanvas_form_alter(&$form, &$form_state, $form_id){
  if($form_id == "views_exposed_form"){
    unset($form['#info']['filter-search_api_views_fulltext']['label']);
    if (isset($form['keyword'])) {
      $form['keyword']['#attributes'] = array('placeholder' => array('Search'), 'class' => array('form-control'));
    }
  }
  if($form_id == 'user_register_form') {
	  $form['#attributes']['class'][] = 'form-inline';
	  $form['actions']['submit']['#value'] = t('sign up');
	  $form['alreadyreg'] = array(
			'#type' => 'item',
			'#markup' => '<div class="col-md-12 dosnt"><span>'.t('Already have an account?').'</span> '.l(t('Sign in'),'user/login').'</div>',
			'#weight' => 101,
    );
	}
	if($form_id == 'user_login') {
	  $form['#attributes']['class'][] = 'form-inline';
	  $form['actions']['submit']['#value'] = t('sign in');
	  $form['remember_me']['#weight'] = 101;
	  $form['links'] = array(
      array(
        '#markup' => l(t('Forgot your password?'),'user/password', array('attributes' => array ('class' => 'top-login-links'))),
      ),
      '#attributes' => array('class' => 'remember'),
      '#weight' => 102,
      '#prefix' => '<div class="remember">',
      '#suffix' => '</div>',
    );
	  $form['donot_account'] = array(
			'#type' => 'item',
			'#markup' => '<div class="dosnt"><span>'.t('Don’t have an account?').'</span> '.l(t('Sign up'),'user/register').'</div>',
			'#weight' => 101,
    );
	}
}

/**
* hook_block_view_alter()
* 
* User to alter content of block in top bar region.
*/
function cleancanvas_block_view_alter(&$data, $block) {
	$arg = arg();
	if ($block->region == 'top_bar_left') {
		if (isset($arg[1]) && is_numeric($arg[1]) && $arg[0] == 'node') {
		  $node = menu_get_object();
		  if ($node->type == 'blog_post') {
			   drupal_set_title('Blog Post');	
			}
	  }
    $data['content'] = '<h1 class="page-header">'.drupal_get_title().'</h1>';
  }
}

/**
* hook_preprocess_comment()
* 
* User to alter comment variables.
*/
function cleancanvas_preprocess_comment(&$vars) {
	$comment = $vars['elements']['#comment'];
  $node = $vars['elements']['#node'];
  if (isset($node) && $node->type == 'blog_post') {
		 $vars['created'] = date('D, jM');
	}
	$vars['author'] = theme('username', array('account' => $comment));
}

