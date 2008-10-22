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
					<li class="date">Posted On <?php the_time('M j, Y') ?></li>
					<li class="comment"> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></li>
				</ul>
			</div>
			
			<div class="post">
				<?php the_content('Continue Reading'); ?>
			</div>
			
			<?php endwhile; ?>
			
			<div class="navigation clearfix">
				<span class="alignleft"><?php posts_nav_link('','','&laquo; Previous Entries') ?></span>
				<span class="alignright"><?php posts_nav_link('','Newer Entries &raquo;','') ?></span>
			</div>
			
			<?php else : ?>
				
				<h2>Not Found</h2>
				<p>Sorry, but there were no posts found.</p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
				
			<?php endif;?>

		</div>
		
	</div>
	
	<?php cm_sidebar(); ?>
	
</div>

<?php get_footer(); ?>