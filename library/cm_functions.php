<?
/*
This is needed to be able to localize strings, where "the_authors_post_link()" is needed. 
*/
function get_the_author_posts_link($idmode='') {
    global $id, $authordata;
    return '<a href="' . get_author_link(0, $authordata->ID, $authordata->user_nicename) . '" title="' . sprintf(__("Posts by %s"), htmlspecialchars(the_author($idmode, false))) . '">' . the_author($idmode, false) . '</a>';
}

// Inject after Post
function cm_after_post() {
	$after_post_code = get_option('cm_afterpost_code');
	echo stripslashes($after_post_code);
}

// Left Column for 3 Column Layout
function cm_left_column() {
	$layout = get_option('cm_layout');
	$feature = get_option('cm_feature');

	if ( $layout == '3 Column' ){
		if (($feature == 'Yes') && is_home()) { $class = 'sidebar_feature'; } else { $class = 'sidebar'; };
		echo '<div class="' . $class . ' span-5">';
		 	if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar('Sidebar Left') ) : 
			endif;
		echo '</div>';
	}
}

// Right Column
function cm_sidebar() {
	$layout = get_option('cm_layout');
	$feature = get_option('cm_feature');

	if ( $layout == '2 Column' ){
		$feature = get_option('cm_feature'); 
		if ( !(is_home()) ) { echo '<div class="span-10 last">'; }
		echo '<div class=';
			if (($feature == 'Yes') && is_home()) { 
				echo '"sidebar_feature">';
			} else {
				echo '"sidebar">';
			}
		
			get_sidebar();
		echo '</div>';	
		if ( !(is_home()) ) { echo '</div>'; }		
	} 
	elseif ( $layout == '3 Column') {
		if (($feature == 'Yes') && is_home()) { $class = 'sidebar_feature'; } else { $class = 'sidebar'; };
		echo '<div class="' . $class . ' span-5 last">';
			if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar('Sidebar Right') ) : 
			endif;
		echo '</div>';
	}
}

// FEATURE CATEGORIES
 
function cm_feature_post(){
	global $post, $feature_post;
	
	$feature_cats = get_option('cm_featureId');
	$feature_array = explode( ",", $feature_cats );

	query_posts(array('category__in' => $feature_array, 'showposts' => 1));
	
	if(have_posts()):
	while(have_posts()) : the_post();
	
	$feature_post = $post->ID;

	?>
		<div class="feature clearfix">
			
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="meta">
				<ul>
					<li class="date">Posted On <?php the_time('M j, Y') ?></li>
					<li class="comment"> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></li>
				</ul>
			</div>
				<?php //get thumbnail (custom field)  
				$featureimage = get_post_meta($post->ID, 'feature_image', true); ?>
				<?php if($featureimage !== '') { ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<img src="<?php echo $featureimage; ?>" alt="<?php the_title(); ?>" /></a>
				<?php } else { } ?>
				<?php the_content('Continue Reading'); ?>
			
		</div>
	<?php endwhile; endif;
}

// CLASSIC FEATURE CATEGORIES
 
function cm_classic_feature_post(){
	global $post, $feature_post;
	
	$feature_cats = get_option('cm_featureId');
	$feature_array = explode( ",", $feature_cats );

	query_posts(array('category__in' => $feature_array, 'showposts' => 1));
	
	if(have_posts()):
	while(have_posts()) : the_post();
	
	$feature_post = $post->ID;

	?>
		<div class="classic-feature clearfix">
			
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="meta">
				<ul>
					<li class="date">Posted On <?php the_time('M j, Y') ?></li>
					<li class="comment"> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></li>
				</ul>
			</div>
				<?php //get thumbnail (custom field)  
				$featureimage = get_post_meta($post->ID, 'feature_image', true); ?>
				<?php if($featureimage !== '') { ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<img src="<?php echo $featureimage; ?>" alt="<?php the_title(); ?>" /></a>
				<?php } else { } ?>
				<?php the_content('Continue Reading'); ?>
			
		</div>
	<?php endwhile; endif;
}

?>