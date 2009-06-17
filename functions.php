<?php

// Path constants
define('CMLIB', TEMPLATEPATH . '/library');

// Load Special Functiosn
require_once(CMLIB . '/cm_functions.php');

// Custom Widgets
if (!class_exists('WP_Widget')) {
require_once (CMLIB . '/cm_widgets_27.php');
} 
if (class_exists('WP_Widget')) {
require_once(CMLIB . '/cm_widgets.php');
}
// Load Widget Areas
require_once(CMLIB . '/cm_widget_areas.php');

// Load Theme Options
require_once(CMLIB . '/cm_theme_options.php');

// Use legacy.comments.php for WordPress 2.5 and below
add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if ( !function_exists('wp_list_comments') ) 
		$file = TEMPLATEPATH . '/legacy.comments.php';
	return $file;
}

?>