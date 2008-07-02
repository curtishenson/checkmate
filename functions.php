<?php
//WELCOME BOX
function cm_widget_welcome($args, $number = 1) {
	extract($args);
	$options = get_option('widget_welcome');
	$title = $options[$number]['title'];
	$image = $options[$number]['image'];
	$text = apply_filters( 'widget_welcome', $options[$number]['text'] );
?>
		<?php if (is_home()) {?>
		<?php echo $before_widget; ?>
			<?php if ( !empty( $title ) ) { echo "<h2>" . $title . "</h2>"; } ?>
			<p><?php if ( !empty( $image ) ) { echo '<img src="' . $image . '" //>'; } ?>
			<?php echo $text; ?></p>
		<?php echo $after_widget; ?>
		<?php } ?>
<?php
}

function cm_widget_welcome_control($number) {
	$options = $newoptions = get_option('widget_welcome');
	if ( !is_array($options) )
		$options = $newoptions = array();
	if ( $_POST["welcome-submit-$number"] ) {
		$newoptions[$number]['title'] = strip_tags(stripslashes($_POST["welcome-title-$number"]));
		$newoptions[$number]['image'] = strip_tags($_POST["welcome-image-$number"]);
		$newoptions[$number]['text'] = stripslashes($_POST["welcome-text-$number"]);
		if ( !current_user_can('unfiltered_html') )
			$newoptions[$number]['text'] = stripslashes(wp_filter_post_kses($newoptions[$number]['text']));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_welcome', $options);
	}
	$title = attribute_escape($options[$number]['title']);
	$image = attribute_escape($options[$number]['image']);
	$text = format_to_edit($options[$number]['text']);
?>
			<input style="width: 450px;" id="welcome-title-<?php echo $number; ?>" name="welcome-title-<?php echo $number; ?>" type="text" value="<?php echo $title; ?>" />
			<input style="width: 450px;" id="welcome-image-<?php echo $number; ?>" name="welcome-image-<?php echo $number; ?>" type="text" value="<?php echo $image; ?>" />
			<textarea style="width: 450px; height: 280px;" id="welcome-text-<?php echo $number; ?>" name="welcome-text-<?php echo $number; ?>"><?php echo $text; ?></textarea>
			<input type="hidden" id="welcome-submit-<?php echo "$number"; ?>" name="welcome-submit-<?php echo "$number"; ?>" value="1" />
<?php
}

function cm_widget_welcome_setup() {
	$options = $newoptions = get_option('widget_welcome');
	if ( isset($_POST['welcome-number-submit']) ) {
		$number = (int) $_POST['welcome-number'];
		if ( $number > 9 ) $number = 9;
		if ( $number < 1 ) $number = 1;
		$newoptions['number'] = $number;
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_welcome', $options);
		wp_widget_text_register($options['number']);
	}
}

function cm_widget_welcome_page() {
	$options = $newoptions = get_option('widget_welcome');
?>
	<div class="wrap">
		<form method="POST">
			<h2><?php _e('Welcome Box Widgets'); ?></h2>
			<p style="line-height: 30px;"><?php _e('How many text welcome boxes would you like?'); ?>
			<select id="text-number" name="text-number" value="<?php echo $options['number']; ?>">
<?php for ( $i = 1; $i < 10; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>
			</select>
			<span class="submit"><input type="submit" name="welcome-number-submit" id="welcome-number-submit" value="<?php echo attribute_escape(__('Save')); ?>" /></span></p>
		</form>
	</div>
<?php
}

function cm_widget_welcome_register() {
	$options = get_option('widget_welcome');
	$number = $options['number'];
	if ( $number < 1 ) $number = 1;
	if ( $number > 9 ) $number = 9;
	$dims = array('width' => 460, 'height' => 350);
	$class = array('classname' => 'widget_welcome clearfix');
	for ($i = 1; $i <= 9; $i++) {
		$name = sprintf(__('Welcome Box %d'), $i);
		$id = "welcome-$i"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, $i <= $number ? 'cm_widget_welcome' : /* unregister */ '', $class, $i);
		wp_register_widget_control($id, $name, $i <= $number ? 'cm_widget_welcome_control' : /* unregister */ '', $dims, $i);
	}
	add_action('sidebar_admin_setup', 'cm_widget_welcome_setup');
	add_action('sidebar_admin_page', 'cm_widget_welcome_page');
}
cm_widget_welcome_register();
//END WELCOME BOX


//News List Widget- displays stories from a news category
function widget_news_list() {
?>
<div class="widget widget_news_list">
	<h3>News</h3>
	<?php query_posts('category_name=news&showposts=8'); // gets 8 posts from the news category ?>
		<ul>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <small><?php the_time('F j, Y'); ?></small></li>
	<?php endwhile; else: ?>
		<li>There is no news at this time</li>
	<?php endif; ?>
		</ul>
</div>
<?php
}
if ( function_exists('register_sidebar_widget') )
	register_sidebar_widget(__('News List'), 'widget_news_list');
// END NEWS WIDGET


//Ads Widget 125x125 by 3
function cm_widget_ads() {
?>
<?php
	$ads = get_option('cm_show_ads');  // Gets the option from theme options page
		if($ads == 'No') { }
		if($ads == 'Yes') { 
			$ad1_image = get_option('cm_ad_image_one');
			$ad1_url = get_option('cm_ad_url_one'); 
			$ad2_image = get_option('cm_ad_image_two');
			$ad2_url = get_option('cm_ad_url_two');
			$ad3_image = get_option('cm_ad_image_three');
			$ad3_url = get_option('cm_ad_url_three');
			?>
		
			<div class="ads clearfix">
				<a href="<?php echo $ad1_url; ?>"><img src="<?php echo $ad1_image; ?>" /></a>
				<a href="<?php echo $ad2_url; ?>"><img src="<?php echo $ad2_image; ?>" /></a>
				<a href="<?php echo $ad3_url; ?>"><img src="<?php echo $ad3_image; ?>" /></a>
			</div>
		<?php } ?>
<?php
}
if ( function_exists('register_sidebar_widget') )
	register_sidebar_widget(__('Ads'), 'cm_widget_ads');
// END ADS WIDGET

//Ads widget, displays whatever is in ads.php file
function cm_widget_adinclude() {
	$ads = get_option('cm_show_ads');  // Gets the option from theme options page
		if($ads == 'Yes') { ?>
			<div class="widget">
				<?php include (TEMPLATEPATH . "/ads.php"); ?>
			</div> <?php
		}
}
if ( function_exists('register_sidebar_widget') )
	register_sidebar_widget(__('Ad(from ad.php)'), 'cm_widget_adinclude');
// END ADS WIDGET

//tabbed content widget - controls what is in the tabbed box and how many tabbed boxes there are
function ch_widget_tabcontent($args, $number = 1) {
	extract($args);
	$options = get_option('widget_tabcontent');
	
	include(TEMPLATEPATH . '/tabcontent.php');
	
}

function ch_widget_tabcontent_setup() {
	$options = $newoptions = get_option('widget_tabcontent');
	if ( isset($_POST['tabcontent-number-submit']) ) {
		$number = (int) $_POST['tabcontent-number'];
		if ( $number > 9 ) $number = 9;
		if ( $number < 1 ) $number = 1;
		$newoptions['number'] = $number;
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_tabcontent', $options);
		ch_widget_tabcontent_register($options['number']);
	}
}

function ch_widget_tabcontent_page() {
	$options = $newoptions = get_option('widget_tabcontent');
?>
	<div class="wrap">
		<form method="POST">
			<h2><?php _e('Tabcontent Widgets'); ?></h2>
			<p style="line-height: 30px;"><?php _e('How many tab box widgets would you like?'); ?>
			<select id="tabcontent-number" name="tabcontent-number" value="<?php echo $options['number']; ?>">
<?php for ( $i = 1; $i < 10; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>
			</select>
			<span class="submit"><input type="submit" name="tabcontent-number-submit" id="tabcontent-number-submit" value="<?php echo attribute_escape(__('Save')); ?>" /></span></p>
		</form>
	</div>
<?php
}

function ch_widget_tabcontent_register() {
	$options = get_option('widget_tabcontent');
	$number = $options['number'];
	if ( $number < 1 ) $number = 1;
	if ( $number > 9 ) $number = 9;
	$dims = array('width' => 460, 'height' => 350);
	$class = array('classname' => 'widget_tabcontent');
	for ($i = 1; $i <= 9; $i++) {
		$name = sprintf(__('Tabcontent %d'), $i);
		$id = "tabcontent-$i"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, $i <= $number ? 'ch_widget_tabcontent' : /* unregister */ '', $class, $i);
	}
	add_action('sidebar_admin_setup', 'ch_widget_tabcontent_setup');
	add_action('sidebar_admin_page', 'ch_widget_tabcontent_page');
}
	ch_widget_tabcontent_register();
// thats it for the tabbed content boxes

// SIDEBARS ******************************
if ( function_exists('register_sidebars') )
    register_sidebar(array(
		'name' => 'Index Bottom Left',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Index Bottom Right',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Top',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Left',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Right',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Bottom',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name'=>'Tabbed Content',
		'before_widget' => '<div id="%1$s" class="tabbertab %2$s">', // Removes <li>
		'after_widget' => '</div>', // Removes </li>
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));

$footeroption = get_option('cm_footer_widgets');
if ($footeroption == "Enabled") {
	if ( function_exists('register_sidebars') )
	    register_sidebar(array(
			'name' => 'Footer Left',
	       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>',
	    ));
	register_sidebar(array(
		'name' => 'Footer Middle',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Footer Right',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	
}


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