<?php
// THEME OPTIONS *************************
$themename = "Checkmate";
$shortname = "cm";
$theme_current_version = "2.0.2";
$theme_url = "http://curtishenson.com/checkmate-20-a-free-premium-wordpress-theme/";

//Logo Auto Detect
$logo_path = TEMPLATEPATH . '/images/logo/';
$logos = array();	

if ( is_dir($logo_path) ) {
	if ($logo_dir = opendir($logo_path) ) { 
		while ( ($logo_file = readdir($logo_dir)) !== false ) {
			if(stristr($logo_file, ".png") !== false) {
				$logos[] = $logo_file;
			}
		}	
	}
}

$logos_tmp = asort($logos);
$logos_tmp = array_unshift($logos, "Select a logo:");


// Background Image Detect
$bg_path = TEMPLATEPATH . '/images/bg_images/';
$bgs = array();	

if ( is_dir($bg_path) ) {
	if ($bg_dir = opendir($bg_path) ) { 
		while ( ($bg_file = readdir($bg_dir)) !== false ) {
			$bgs[] = $bg_file;
		}	
	}
}

$bgs_tmp = asort($bgs);
$bgs_tmp = array_unshift($bgs, "Select a background:");


// Stylesheet Auto Detect
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();	

if ( is_dir($alt_stylesheet_path) ) {
	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
			if(stristr($alt_stylesheet_file, ".css") !== false) {
				$alt_stylesheets[] = $alt_stylesheet_file;
			}
		}	
	}
}	

$alt_stylesheets_tmp = asort($alt_stylesheets);
$alt_stylesheets_tmp = array_unshift($alt_stylesheets, "Select a stylesheet:");

$options = array (
	
	array(	"name" => "Style Options",
			"type" => "subhead"),
			
	array(  "name" => "Layout",
	        "id" => $shortname."_layout",
			"desc" => "Choose between the more traditional 2 column layout, or a 3 column layout with content centered.",
	        "std" => "2 Column",
	        "type" => "select",
			"options" => array("2 Column", "3 Column")),
			
	//COLOR THEME
			
	array(	"name" => "Alternate Theme Stylesheet",
			"desc" => "Place additional theme stylesheets in the <code>styles/</code> subdirectory to have them automatically detected.",
		    "id" => $shortname."_alt_stylesheet",
		    "std" => "Select a stylesheet:",
		    "type" => "select",
		    "options" => $alt_stylesheets),
		
	array(	"name" => "Use Custom Logo",
			"desc" => "Check this box if you wish to use a logo from the list below.",
			"id" => $shortname."_use_custom_logo",
			"std" => "false",
			"type" => "checkbox"),
		
	array(	"name" => "Logo",
			"desc" => "Upload PNG files to <code>images/logo/</code> to have them automatically detected.",
		    "id" => $shortname."_logo",
		    "std" => "Select a logo:",
		    "type" => "select",
		    "options" => $logos),
		
 	array(	"name" => "Header Background Image",
 			"desc" => "Upload image files to <code>images/bg_images/</code> to have them automatically detected.",
 		    "id" => $shortname."_bg_url",
 		    "std" => "Select a background:",
 		    "type" => "select",
 		    "options" => $bgs),

	array(	"name" => "Header Background Position",
			"desc" => "Select centered or repeated background.",
		    "id" => $shortname."_bg_position",
		    "std" => "Repeated:",
		    "type" => "select",
		    "options" => array("Centered", "Repeated") ),
		
	array(	"name" => "Use Classic Look",
			"desc" => "Check this box if you wish to use the rounded corner feature story and welcome widget from Checkmate 1.0.",
			"id" => $shortname."_use_classic",
			"std" => "false",
			"type" => "checkbox"),

	//FEATURE STORY			
    array(   "name" => "Display Feature Story",
            "id" => $shortname."_feature",
            "std" => "Yes",
            "type" => "select",
			"options" => array("Yes", "No")),
			
	array(	"name" => "Feature Category ID",
			"desc" => "Can be multiple categories. Uses a comma separated lists of page ID numbers. e.g. 2,7,12",
			"id" => $shortname."_featureId",
			"std" => 1,
			"type" => "text"),
			
	//MENU				
	array ( "name" => "Pages to display in menu",
			"desc" => "Defaults to all pages. Uses a comma separated lists of page ID numbers. e.g. 1,2,5,6",
			"id" => $shortname."_menu_pages",
			"std" => "",
			"type" => "text"),
	//FOOTER WIDGETS		
	array ( "name" => "Widgetize Footer",
			"id" => $shortname."_footer_widgets",
			"std" => "",
			"type" => "select",
			"options" => array("Enabled", "Disabled")),
			
  	array(	"name" => "Category and Page Ids",
  			"type" => "cats_ids"),
			
	//FEEDBURNER	
	array(	"name" => "Feedburner Options",
			"type" => "subhead"),
					
	array ( "name" => "Feedburner Feed Address",
			"id" => $shortname."_feedburner_address",
			"std" => "",
			"type" => "text",
			"style" => "width: 500px",
			"row_style" => "background-color: #ffd7ad;" ),
	array ( "name" => "Feedburner Comments Feed Address",
			"id" => $shortname."_feedburner_comments",
			"std" => "",
			"type" => "text",
			"style" => "width: 500px",
			"row_style" => "background-color: #ffd7ad;"),
	array ( "name" => "Feedburner ID Number"		,
			"desc" => "Your Feedburner ID is used for email subscriptions.",
			"id" => $shortname."_feedburner_id",
			"std" => "",
			"type" => "text",
			"style" => "width: 200px;",
			"row_style" => "background-color: #ffd7ad;"),
	
	//CODE INSERTS		
   	array(	"name" => "Insert Your Own Code Code",
   			"type" => "subhead"),

  	array ( "name" => "Header Code",
  			"desc" => "If you have code you want to inject into the head of your website, put it here.",
  			"id" => $shortname."_header_code",
  			"std" => "",
  			"type" => "textarea",
  			"options" => array(	"rows" => "10",
								"cols" => "95")),

 	 array ( "name" => "Footer Code",
 	 		"desc" => "If you have code you want to inject into the footer, put it here.",
 	 		"id" => $shortname."_footer_code",
 	 		"std" => "",
 	 		"type" => "textarea",
 	 		"options" => array(	"rows" => "10",
								"cols" => "95")),
								
	array ( "name" => "After Post Code",
			"desc" => "If you have code you want to inject after posts on single post pages, put it here.",
			"id" => $shortname."_afterpost_code",
			"std" => "",
			"type" => "textarea",
			"options" => array(	"rows" => "10",
								"cols" => "95")),

//AD OPTIONS ********

	array(	"name" => "Ad Options",
			"type" => "subhead"),

	array(	"name" => "Show Ads",
			"id" => $shortname."_show_ads",
			"std" => "",
			"type" => "select",
			"desc" => "Turn all ads below on or off.",
			"options" => array("Yes", "No")),
			
	array(   "name" => "Ad One Image URL",
            "id" => $shortname."_ad_image_one",
            "std" => "",
			"style" => "width: 500px",
			"desc" => "Address to Ad Image.",
            "type" => "text"),
    array(   "name" => "Ad One URL",
            "id" => $shortname."_ad_url_one",
			"style" => "width: 500px",
			"desc" => "Ad link",
            "type" => "text",
            "std" => ""),

	array(   "name" => "Ad Two Image URL",
            "id" => $shortname."_ad_image_two",
			"style" => "width: 500px",
			"desc" => "Address to Ad Image.",
            "std" => "",
            "type" => "text"),
    array(   "name" => "Ad Two URL",
            "id" => $shortname."_ad_url_two",
			"style" => "width: 500px",
			"desc" => "Ad link",
            "type" => "text",
            "std" => ""),

	array(   "name" => "Ad Three Image URL",
            "id" => $shortname."_ad_image_three",
			"style" => "width: 500px",
			"desc" => "Address to Ad Image.",
            "std" => "",
            "type" => "text"),
    array(   "name" => "Ad Three URL",
            "id" => $shortname."_ad_url_three",
			"style" => "width: 500px",
			"desc" => "Ad link",
            "type" => "text",
            "std" => "")
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=cm_theme_options.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=cm_theme_options.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "Checkmate Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2 class="updatehook"><?php echo $themename; ?> Options</h2>

<table class="widefat" style="margin: 20px 0;">
	<thead style="background: #ccc; color: #333;">
		<tr>
			<th scope="col" style="width: 50%; font-size: 1.1em;">About Checkmate</th>
			<th scope="col" style="font-size: 1.1em;">Feed the Developer</th>
		</tr>
	</thead>
	<tbody>
		<tr style="background: #dfdfdf;">
			<td>
			This theme is designed and developed by <a href="http://curtishenson.com">Curtis Henson</a> of <a href="http://gruntdesign.com">Grunt</a>.<br /><br />
			Please go to the <a href="http://curtishenson.tenderapp.com/">Checkmate Support Page</a> for support or to report bugs.</strong>
			</td>
			<td>
			If you enjoy this theme, consider donating an amount of your choice with PayPal.<br />
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="812595">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			
			</td>
		</tr>
	</tbody>
</table>

<form method="post">

<?php foreach ($options as $value) { 
	
	switch ( $value['type'] ) {
		case 'subhead':
		?>
			</table>
			
			<table class="widefat">
			
			<thead>
				<tr>
					<th scope="col" style="width:20%" class="column-title"><?php echo $value['name']; ?></th>
					<th scope="col"></th>
				</tr>
			</thead>
			
		<?php
		break;

		case 'text':
		?>
		<tr valign="top" style="<?php echo $value['row_style']; ?>"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
		        <input style="<?php echo $value['style']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
			    <?php echo $value['desc']; ?>
		    </td>
		</tr>
		<?php
		break;
		
		case 'select':
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
	            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                <?php foreach ($value['options'] as $option) { ?>
	                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
				<?php echo $value['desc']; ?>
	        </td>
	    </tr>
		<?php
		break;
		
		case 'textarea':
		$ta_options = $value['options'];
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
			    <?php echo $value['desc']; ?>
				<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php 
				if( get_settings($value['id']) != "") {
						echo stripslashes(get_settings($value['id']));
					}else{
						echo $value['std'];
				}?></textarea>
	        </td>
	    </tr>
		<?php
		break;

		case "radio":
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
	            <?php foreach ($value['options'] as $key=>$option) { 
				$radio_setting = get_settings($value['id']);
				if($radio_setting != ''){
		    		if ($key == get_settings($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
	            <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
	            <?php } ?>
	        </td>
	    </tr>
		<?php
		break;
		
		case "checkbox":
		?>
			<tr valign="top"> 
		        <th scope="row"><?php echo $value['name']; ?>:</th>
		        <td>
		           <?php
						if(get_settings($value['id'])){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
					?>
		            <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />

			    <?php echo $value['desc']; ?>
		        </td>
		    </tr>
			<?php
		break;
		
		case "cats_ids":
		?>
			<tr valign="top"> 
		        <th scope="row"><?php echo $value['name']; ?>:</th>
		        <td>
				<p style="float:left; width:40%;">	<?php
				$cats = get_categories('orderby=ID&hide_empty=0');
				echo '<strong>Category IDs and Names</strong><br />'; 
					foreach($cats as $category) { 
					    echo $category->cat_ID . ' = ' . $category->cat_name . '<br />'; 
					} 
					?>
				</p>
				<p style="float:left; width:40%">	<?php
				$pages = get_pages('orderby=ID&hide_empty=0');
				//print_r($pages);
				echo '<strong>Page IDs and Names</strong><br />'; 
					foreach($pages as $page) { 
					    echo $page->ID . ' = ' . $page->post_name . '<br />'; 
					} 
					?>
				</p>
		        </td>
		    </tr>
			<?php
		break;

		default:

		break;
	}
}
?>

</table>

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

function mytheme_wp_head() { ?>
<link href="<?php bloginfo('template_directory'); ?>/style.php" rel="stylesheet" type="text/css" />
<?php }

/* Whoa this hammers my server
function mytheme_admin_head(){ 
	global $theme_current_version;
	global $theme_url;
	global $themename;
	?>
	<script type="text/javascript">  
	 jQuery(document).ready(function() {  
	     jQuery.get('http://curtishenson.com/checkmateversion.txt', function(newversion){  
			if (<?php echo $theme_current_version; ?> < newversion ) {
	         	jQuery('#wpbody-content .wrap h2').after('<div id="message" class="updated fade"><p><strong>Theme Update available. Click <a href="<?php echo $theme_url;?>">here</a> for details.</strong></p></div>');
				jQuery('#rightnow .youare').after('<p class="themehas"><?php echo $themename; ?> has an <a href="<?php echo $theme_url; ?>">available update</a>.</p>');
			}  
	     });  
	 });  
	 </script>
<?php }
add_action('admin_head','mytheme_admin_head'); 
*/
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_menu', 'mytheme_add_admin');

?>