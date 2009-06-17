<?php

/***************************
Widgets for WordPress 2.8+
***************************/

/**************************************************
RSS Widget Displays a styled box for RSS feeds
**************************************************/
class CM_RSS_Widget extends WP_Widget {
	function CM_RSS_Widget(){
		$widget_ops = array('classname' => 'cm_rss_widget', 'description' => __('Styled RSS box for Checkmate'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('cm_rss_widget', __('Checkmate RSS Widget'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$image = $instance['image'];
		$text = apply_filters( 'widget_text', $instance['text'] );
		
	   		echo $before_widget;
			if ( !empty( $title ) ) { echo "<h3>" . $title . "</h3>"; }
			 if ( !empty( $image ) ) { echo '<img src="' . $image . '" alt="RSS" />'; }
				if ( !empty($text) ) { ?>
					<p><?php echo $text; ?></p> 
				<?php } ?>
						<ul>
							<?php $rss_url = get_option('cm_feedburner_address'); 
								if ($rss_url != "") {
									echo '<li><a href="' . $rss_url . '"> Articles RSS</a></li>';
								} 
								else { ?>
							<li><a href="<?php bloginfo('rss2_url'); ?> ">Articles RSS</a></li>
							<?php } ?>
							<?php $comments_url = get_option('cm_feedburner_comments'); 
								if ($comments_url != "") {
									echo '<li><a href="' . $comments_url . '"> Comments RSS</a></li>';
								} 
								else { ?>
							<li><a href="<?php bloginfo_rss('comments_rss2_url') ?>">Comments RSS</a></li>
							<?php } ?>
						</ul>

						<?php $fbId = get_option('cm_feedburner_id'); //Your feedburner ID 
						if ( !empty($fbId) ) {?>
							<form method="post" action="http://www.feedburner.com/fb/a/emailverify" target="popupwindow"
							onsubmit="window.open('http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php echo $fbId; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
								<fieldset>
									<label for="input_subscribe">By Email</label>
									<input value="" name="email" id="input_subscribe" type="text" />
									<input type="hidden" id="submit" name="url" value="http://feeds.feedburner.com/~e?ffid=<?php echo $fbId; ?>"  />
									<input type="hidden" name="loc" value="en_US"/>
								</fieldset>
							</form>	
						<?php } ?>

			<?php echo $after_widget;
	}
	
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_filter_post_kses( $new_instance['text'] );
		$instance['filter'] = isset($new_instance['filter']);
		$instance['image'] = $new_instance['image'];
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$image = $instance['image'];
		$text = $instance['text'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('RSS Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('RSS Icon URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('ttextitle'); ?>"><?php _e('Optional Text:'); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<?php
	}
}

register_widget('CM_RSS_Widget');

/**************************************************
CM text Box Widget Displays a styled box on every page 
**************************************************/
class CM_Widget_Box extends WP_Widget {
	function CM_Widget_Box(){
		$widget_ops = array('classname' => 'widget_welcome', 'description' => __('Stylized box in the sidebar. Displays on every page.'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('cm_text_box', __('Checkmate Text Box'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$image = $instance['image'];
		$text = apply_filters( 'widget_text', $instance['text'] );
	   		echo '<div class="widget widget_welcome clearfix">';
	   			if ( !empty( $title) ){ echo '<h2>' . $title . '</h2>'; } 
				if ( !empty( $image ) ) { echo '<img src="' . $image . '" //>'; }
	   			echo $instance['filter'] ? wpautop($text) : $text; 
	   		echo '</div>';
	}
	
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_filter_post_kses( $new_instance['text'] );
		$instance['filter'] = isset($new_instance['filter']);
		$instance['image'] = $new_instance['image'];
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$image = $instance['image'];
		$text = format_to_edit($instance['text']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></p>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked($instance['filter']); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
		<?php
	}
}

register_widget('CM_Widget_Box');

/**************************************************
Welcome Widget Displays a styled box on every page 
**************************************************/
class CM_Widget_Welcome extends WP_Widget {
	function CM_Widget_Welcome(){
		$widget_ops = array('classname' => 'widget_welcome', 'description' => __('Stylized box in the sidebar. Only shown on the homepage!'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('cm_welcome_box', __('Checkmate Welcome Box'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$image = $instance['image'];
		$text = apply_filters( 'widget_text', $instance['text'] );
	   		echo '<div class="widget widget_welcome clearfix">';
	   			if ( !empty( $title) ){ echo '<h2>' . $title . '</h2>'; } 
				if ( !empty( $image ) ) { echo '<img src="' . $image . '" //>'; }
	   			echo $instance['filter'] ? wpautop($text) : $text; 
	   		echo '</div>';
	}
	
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_filter_post_kses( $new_instance['text'] );
		$instance['filter'] = isset($new_instance['filter']);
		$instance['image'] = $new_instance['image'];
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$image = $instance['image'];
		$text = format_to_edit($instance['text']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></p>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked($instance['filter']); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
		<?php
	}
}

register_widget('CM_Widget_Welcome');

/**************************************************
Ads widget 3 - 125x125  
**************************************************/
class CM_Ads_Widget extends WP_Widget {
	function CM_Ads_Widget(){
		$widget_ops = array('classname' => 'widget_ads', 'description' => __('Ads placement. Ads are controlled on the theme options page.'));
		$control_ops = array('height' => 350);
		$this->WP_Widget('widget_ads', __('Checkmate Ads'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
	
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
			<?php } 
	}
	
}

register_widget('CM_Ads_Widget');

/**************************************************
Ads widget 3 - 125x125  
**************************************************/
class CM_Ads_Alt_Widget extends WP_Widget {
	function CM_Ads_Alt_Widget(){
		$widget_ops = array('classname' => 'widget_ads_alt', 'description' => __('Ads placement. <small>(from ads.php)</small>.'));
		$control_ops = array('height' => 350);
		$this->WP_Widget('widget_ads_alt', __('Checkmate Ads(from ads.php)'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		$ads = get_option('cm_show_ads');  // Gets the option from theme options page
			if($ads == 'Yes') { ?>
				<div class="widget">
					<?php include (TEMPLATEPATH . "/ads.php"); ?>
				</div> <?php
			}
	}
	
}

register_widget('CM_Ads_Alt_Widget');

/**************************************************
TabContent holds a widget area for other widgets
**************************************************/
class CM_TabContent_Widget extends WP_Widget {
	function CM_TabContent_Widget(){
		$widget_ops = array('classname' => 'widget_tabcontent', 'description' => __('Creates a Tabbed Widget Area. Displays widgets from Tabbed Content widget area.'));
		$control_ops = array('height' => 350);
		$this->WP_Widget('widget_tabcontent', __('Checkmate Tabbed Box'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		$options = get_option('widget_tabcontent');

		include(TEMPLATEPATH . '/tabcontent.php');
	}
	
}

register_widget('CM_TabContent_Widget');


/**********************************************************
CM Category widget displays titles from a specific category
**********************************************************/
class CM_Widget_Category extends WP_Widget {
	function CM_Widget_Category(){
		$widget_ops = array('classname' => 'cm_widget_category', 'description' => __('Displays a list of posts from the chosen category'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('cm_widget_category', __('Checkmate Category List'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$cat_id = $instance['cat_id'];
		
	   	?><div class="widget widget_category">
			<?php 	
				$q = "showposts=5&cat=" . $cat_id;
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
					<a href="<?php if (!empty($id)) { echo get_category_link($id); } ?>" class="more-link">More <?php echo $title; ?></a>
				</p>
		</div><?php
	}
	
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat_id'] = $new_instance['cat_id'];

		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		$cat_id = $instance['cat_id'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('cat_id'); ?>"><?php _e('Category Name:'); ?></label>
			<?php wp_dropdown_categories(array('hide_empty' => 0, 'name' => $this->get_field_name('cat_id'), 'orderby' => 'name', 'selected' => $cat_id, 'hierarchical' => true, 'class' => 'widefat', 'show_count' => true)); ?>
		</p>
		<?php
	}
}

register_widget('CM_Widget_Category');
