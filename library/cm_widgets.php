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
			<label>Welcome Title</label>
			<input style="width: 450px;" id="welcome-title-<?php echo $number; ?>" name="welcome-title-<?php echo $number; ?>" type="text" value="<?php echo $title; ?>" />
			<label>Welcome Image URL<small>(optional)</small></label>
			<input style="width: 450px;" id="welcome-image-<?php echo $number; ?>" name="welcome-image-<?php echo $number; ?>" type="text" value="<?php echo $image; ?>" />
			<label>Welcome Text</label>
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
			<p style="line-height: 30px;"><?php _e('How many welcome boxes would you like?'); ?>
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
		$name = sprintf(__('Checkmate Welcome Box %d'), $i);
		$id = "welcome-$i"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, $i <= $number ? 'cm_widget_welcome' : /* unregister */ '', $class, $i);
		wp_register_widget_control($id, $name, $i <= $number ? 'cm_widget_welcome_control' : /* unregister */ '', $dims, $i);
	}
	add_action('sidebar_admin_setup', 'cm_widget_welcome_setup');
	add_action('sidebar_admin_page', 'cm_widget_welcome_page');
}
cm_widget_welcome_register();
//END WELCOME BOX

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
	register_sidebar_widget(__('Checkmate Ads'), 'cm_widget_ads');
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
	register_sidebar_widget(__('Checkmate Ad<small>(from ad.php)</small>'), 'cm_widget_adinclude');
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
		$name = sprintf(__('Checkmate Tabcontent %d'), $i);
		$id = "tabcontent-$i"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, $i <= $number ? 'ch_widget_tabcontent' : /* unregister */ '', $class, $i);
	}
	add_action('sidebar_admin_setup', 'ch_widget_tabcontent_setup');
	add_action('sidebar_admin_page', 'ch_widget_tabcontent_page');
}
	ch_widget_tabcontent_register();
// thats it for the tabbed content boxes

//CATEGORY WIDGET
		function cm_widget_category( $args, $widget_args = 1 ) {
			
			extract( $args, EXTR_SKIP );
			if ( is_numeric($widget_args) )
				$widget_args = array( 'number' => $widget_args );
			$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
			extract( $widget_args, EXTR_SKIP );
			
			$options = get_option('widget_category');
			if ( !isset($options[$number]) )
				return;

			$title = $options[$number]['title'];
			$cat_name = $options[$number]['cat_name'];
			
		?>
		<div class="widget widget_category">
			<?php 	
					$id = get_cat_id($cat_name);
					$q = "showposts=5&cat=" . $id;
					query_posts($q);
			?>
				<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
					
				<ul>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <small><?php the_time('F j, Y'); ?></small></li>
					<?php endwhile; else: ?>
					<li>There are no posts at this time.</li>
					<?php endif; ?>
				</ul>
			
				<p class="more">
					<?php 	$id = get_cat_id($cat_name); ?>
					<a href="<?php echo get_category_link($id);?>" class="more-link">More <?php echo $title; ?></a>
				</p>
		</div>
		<?php
	}
			
		function cm_widget_category_control($widget_args) {
			global $wp_registered_widgets;
			static $updated = false;

			if ( is_numeric($widget_args) )
				$widget_args = array( 'number' => $widget_args );
			$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
			extract( $widget_args, EXTR_SKIP );

			$options = get_option('widget_category');
			if ( !is_array($options) )
				$options = array();

			if ( !$updated && !empty($_POST['sidebar']) ) {
				$sidebar = (string) $_POST['sidebar'];

				$sidebars_widgets = wp_get_sidebars_widgets();
				if ( isset($sidebars_widgets[$sidebar]) )
					$this_sidebar =& $sidebars_widgets[$sidebar];
				else
					$this_sidebar = array();

				foreach ( $this_sidebar as $_widget_id ) {
					if ( 'cm_widget_category' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
						$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
						if ( !in_array( "cat_name-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed.
							unset($options[$widget_number]);
					}
				}

				foreach ( (array) $_POST['widget-category'] as $widget_number => $widget_category ) {
					$title = strip_tags(stripslashes($widget_category['title']));
					$cat_name = strip_tags(stripslashes( $widget_category['cat_name']  ));
					$options[$widget_number] = compact( 'title', 'cat_name' );
				}

				update_option('widget_category', $options);
				$updated = true;
			}

			if ( -1 == $number ) {
				$title = '';
				$cat_name = '';
				$number = '%i%';
			} else {
				$title = attribute_escape($options[$number]['title']);
				$cat_name = format_to_edit($options[$number]['cat_name']);
			}
		?>
				<p>
					<label>Category Widget Title</label>
					<input class="widefat" id="video-title-<?php echo $number; ?>" name="widget-category[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" />
					<label>Category Name</label>
					<input class="widefat" id="video-cat_name-<?php echo $number; ?>" name="widget-category[<?php echo $number; ?>][cat_name]" type="text" value="<?php echo $cat_name; ?>" />
					<input type="hidden" name="widget-category[<?php echo $number; ?>][submit]" value="1" />
				</p>
		<?php
		}
		
		
		function cm_widget_category_register() {
			if ( !$options = get_option('widget_category') )
				$options = array();
			$widget_ops = array('classname' => 'widget_category', 'description' => __('Category Widget'));
			$control_ops = array('width' => 400, 'height' => 350, 'id_base' => 'category');
			$name = __('CheckMate Category');

			$id = false;
			foreach ( array_keys($options) as $o ) {
				// Old widgets can have null values for some reason
				if ( !isset($options[$o]['title']) || !isset($options[$o]['cat_name']) )
					continue;
				$id = "category-$o"; // Never never never translate an id
				wp_register_sidebar_widget($id, $name, 'cm_widget_category', $widget_ops, array( 'number' => $o ));
				wp_register_widget_control($id, $name, 'cm_widget_category_control', $control_ops, array( 'number' => $o ));
			}

			// If there are none, we register the widget's existance with a generic template
			if ( !$id ) {
				wp_register_sidebar_widget( 'video-1', $name, 'cm_widget_category', $widget_ops, array( 'number' => -1 ) );
				wp_register_widget_control( 'video-1', $name, 'cm_widget_category_control', $control_ops, array( 'number' => -1 ) );
			}
		}
	
		cm_widget_category_register();
// END VIDEO WIDGET
?>