<?php
// THEME OPTIONS *************************
$themename = "Checkmate";
$shortname = "cm";
$options = array (
	//COLOR THEME
	array(    "name" => "Color Theme",
            "id" => $shortname."_color_theme",
            "std" => "Grey",
            "type" => "select",
			"options" => array("Grey", "Red", "Blue", "Green", "Purple", "Brown", "Grey/Red")),
	//HEADER IMAGE
    array(    "name" => "Show Header Image",
            "id" => $shortname."_header",
            "std" => "",
            "type" => "select",
			"options" => array("Yes", "No")),
		array(	"name" => "Header Image URL",
				"id" => $shortname."_header_url",
				"std" => "",
				"type" => "text"),
	//FEATURE STORY			
    array(   "name" => "Display Feature Story",
            "id" => $shortname."_feature",
            "std" => "Yes",
            "type" => "select",
			"options" => array("Yes", "No")),
		array(	"name" => "Feature Category ID*",
				"id" => $shortname."_featureId",
				"std" => 1,
				"type" => "text"),
	//FEEDBURNER			
	array ( "name" => "Feedburner Feed Address",
			"id" => $shortname."_feedburner_address",
			"std" => "",
			"type" => "text"),
	array ( "name" => "Feedburner Comments Feed Address",
			"id" => $shortname."_feedburner_comments",
			"std" => "",
			"type" => "text"),
	array ( "name" => "Feedburner ID Number**",
			"id" => $shortname."_feedburner_id",
			"std" => "",
			"type" => "text"),
	//MENU				
	array ( "name" => "Pages to display in menu***",
			"id" => $shortname."_menu_pages",
			"std" => "",
			"type" => "text"),
	//FOOTER WIDGETS		
	array ( "name" => "Widgetize Footer",
			"id" => $shortname."_footer_widgets",
			"std" => "",
			"type" => "select",
			"options" => array("Enabled", "Disabled"))
			
);

//AD OPTIONS ********
$ads_options = array (
	array(	"name" => "Show Ads",
			"id" => $shortname."_show_ads",
			"std" => "",
			"type" => "select",
			"options" => array("Yes", "No")),
			
	array(   "name" => "Ad One Image URL",
            "id" => $shortname."_ad_image_one",
            "std" => "",
            "type" => "text"),
    array(   "name" => "Ad One URL",
            "id" => $shortname."_ad_url_one",
            "type" => "text",
            "std" => ""),

	array(   "name" => "Ad Two Image URL",
            "id" => $shortname."_ad_image_two",
            "std" => "",
            "type" => "text"),
    array(   "name" => "Ad Two URL",
            "id" => $shortname."_ad_url_two",
            "type" => "text",
            "std" => ""),

	array(   "name" => "Ad Three Image URL",
            "id" => $shortname."_ad_image_three",
            "std" => "",
            "type" => "text"),
    array(   "name" => "Ad Three URL",
            "id" => $shortname."_ad_url_three",
            "type" => "text",
            "std" => "")
);

function mytheme_add_admin() {

    global $themename, $shortname, $options, $ads_options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
					foreach ($ads_options as $value) {
	                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
					foreach ($ads_options as $value) {
	                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }
				foreach ($ads_options as $value) {
	                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "Checkmate Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options, $ads_options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">

<table class="optiontable">

<?php foreach ($options as $value) { 
    
if ($value['type'] == "text") { ?>
        
<tr valign="top"> 
    <th scope="row" style="text-align:right"><?php echo $value['name']; ?>:</th>
    <td>
        <input style="width:500px" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
    </td>
</tr>

<?php } elseif ($value['type'] == "select") { ?>

    <tr valign="top"> 
        <th scope="row" style="text-align:right"><?php echo $value['name']; ?>:</th>
        <td>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>

<?php 
} 
}
?>

</table>
<p><small>* Can be multiple categories.  Uses a comma separated lists of page ID numbers.  e.g. 2,7,12<br />
	** Your Feedburner ID is used for email subscriptions.<br />
	*** Defaults to all pages. Uses a comma separated lists of page ID numbers.  e.g. 1,2,5,6</small></p>

<p>	<?php
$cats = get_categories('orderby=ID&hide_empty=0');
echo 'Category IDs and Names<br />'; 
	foreach($cats as $category) { 
	    echo $category->cat_ID . ' = ' . $category->cat_name . '<br />'; 
	} 
	?>
</p>
<p>	<?php
$pages = get_pages('orderby=ID&hide_empty=0');
//print_r($pages);
echo 'Page IDs and Names<br />'; 
	foreach($pages as $page) { 
	    echo $page->ID . ' = ' . $page->post_name . '<br />'; 
	} 
	?>
</p>

<h2>Ad Options</h2>
<table class="optiontable">
<p>Location of ads are controlled by widgets.  The 'Ads' widget controls the three ads below. The 'Ad(from ads.php)' widget controls whatever custom code you put into ads.php. They can be turned on or off independent of the widgets on this page.</p>

<?php foreach ($ads_options as $value) { 
    
if ($value['type'] == "text") { ?>
        
<tr valign="top"> 
    <th scope="row" style="text-align:right"><?php echo $value['name']; ?>:</th>
    <td>
        <input style="width:700px" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
    </td>
</tr>

<?php } elseif ($value['type'] == "select") { ?>

    <tr valign="top"> 
        <th scope="row" style="text-align:right"><?php echo $value['name']; ?>:</th>
        <td>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>

<?php 
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

add_action('wp_head', 'mytheme_wp_head');
add_action('admin_menu', 'mytheme_add_admin');
?>