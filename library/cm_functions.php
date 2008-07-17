<?
/*
This is needed to be able to localize strings, where "the_authors_post_link()" is needed. 
*/
function get_the_author_posts_link($idmode='') {
    global $id, $authordata;
    return '<a href="' . get_author_link(0, $authordata->ID, $authordata->user_nicename) . '" title="' . sprintf(__("Posts by %s"), htmlspecialchars(the_author($idmode, false))) . '">' . the_author($idmode, false) . '</a>';
}

//FEATURE CATEGORIES
 
function cm_feature_post(){
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
		<div class="feature clearfix">
			
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="meta">
				Posted on <?php the_time('M j, Y'); ?> by <?php the_author_posts_link(); ?></a>
			</p>
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