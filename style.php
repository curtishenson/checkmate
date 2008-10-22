<?php
//  The following php sets up color themes
require_once( dirname(__FILE__) . '../../../../wp-config.php');
require_once( dirname(__FILE__) . '/functions.php');
header("Content-type: text/css");

// Global CSS Styles
$cm_bg_url = get_option('cm_bg_url');
$cm_bg_pos = get_option('cm_bg_position');

if ( $cm_bg_url != 'Select a background:' ) {
	
	echo '.header { background-image: url(images/bg_images/' . $cm_bg_url . ');';
		if ( $cm_bg_pos == 'Centered' ) {
			echo 'background-position: center center; background-repeat: no-repeat;';
		} else {
			echo 'background-repeat: repeat;';
		}
	echo '}';
	
}
 ?>