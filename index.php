<?php get_header(); ?>

<div class="container content">
	
	<?php cm_left_column() ?>
		
	<div class="span-14">
		
		
		<?php	
		$feature = get_option('cm_feature');  // Gets the option from theme options page
			if($feature == 'No') { }
			if(($feature == 'Yes') && !(is_paged()) ) { 
				$classic = get_option('cm_use_classic');
				if ($classic == 'true') {
					cm_classic_feature_post();
				} else { 
					cm_feature_post();
				}
		  	} 
		?>
		
		<div class="blog">
			
			<?php 
			query_posts($query_string . "&order=DESC");
				
			if(have_posts()):
			while(have_posts()) : the_post();
			if( $post->ID == $feature_post ) continue; update_post_caches($posts);
			?>
		
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="meta">
				<ul>
					<li class="date"><?php _e('Posted On', 'checkmate'); ?> <?php the_time(__('M j, Y', 'checkmate')) ?></li>
					<li class="comment"> | <a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comments', 'checkmate'), __('1 Comment', 'checkmate'), __('% Comments', 'checkmate')); ?></a></li>
				</ul>
			</div>
			
			<div <?php if (function_exists('post_class')) { post_class(); } else { echo 'class="post"'; } ?> >
				<?php the_content(__('Continue Reading', 'checkmate')); ?>
			</div>
			
			<?php endwhile; ?>
			
			<div class="navigation clearfix">
				<span class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries', 'checkmate')) ?></span>
				<span class="alignright"><?php posts_nav_link('',__('Newer Entries &raquo;', 'checkmate'),'') ?></span>
			</div>
			
			<?php else : ?>
				
				<h2><?php _e('Not Found', 'checkmate'); ?></h2>
				<p><?php _e('Sorry, but there were no posts found.', 'checkmate'); ?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
				
			<?php endif;?>

		</div>
		
	</div>
	
	<?php cm_sidebar(); ?>
	
</div>

<?php get_footer(); ?>