<?
/*
This is needed to be able to localize strings, where "the_authors_post_link()" is needed. 
*/
function get_the_author_posts_link($idmode='') {
    global $id, $authordata;
    return '<a href="' . get_author_link(0, $authordata->ID, $authordata->user_nicename) . '" title="' . sprintf(__("Posts by %s"), htmlspecialchars(the_author($idmode, false))) . '">' . the_author($idmode, false) . '</a>';
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

// CLASSIC FEATURE CATEGORIES
 
function cm_feature_post(){
	global $post;
	
	$feature_cats = get_option('cm_featureId');
	
	query_posts(array('category__in' => array($feature_cats)));
	
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
	global $wpdb, $post;
	
	$feature_cats = get_option('cm_featureId');
			
	$querystr =	"SELECT * FROM $wpdb->posts
		LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
		LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		WHERE $wpdb->term_taxonomy.term_id IN ($feature_cats)
		AND $wpdb->term_taxonomy.taxonomy = 'category'
		AND $wpdb->posts.post_status = 'publish'
		AND $wpdb->posts.post_type = 'post'
		ORDER BY $wpdb->posts.post_date DESC
		LIMIT 1";
	
	$featurepost = $wpdb->get_results($querystr);
	foreach ($featurepost as $post):
	setup_postdata($post);
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
	<?php endforeach;
}

?>