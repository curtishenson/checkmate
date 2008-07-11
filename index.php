<?php get_header(); ?>
<div class="container content">
		
	<div class="span-14">
		<?php	
		$feature = get_option('cm_feature');  // Gets the option from theme options page
			if($feature == 'No') { }
			if($feature == 'Yes') { 
				
			cm_feature_post();
		 	$feature_post = $post->ID;
		  	} 
		?>
		
		<div class="blog">
			
			<?php			
			if(have_posts()):
			while(have_posts()) : the_post();
			if( $post->ID == $feature_post ) continue; update_post_caches($posts);
			?>
		
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="span-3 meta">
				<ul>
					<li><?php the_time('M j, Y') ?></li>
					<li><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> Comments</a></li>
					<?php //get thumbnail (custom field)  
					$post_thumb = get_post_meta($post->ID, 'post_thumb', true); ?>
					<?php if($post_thumb !== '') { ?>
						
					<?php // If you wish to not use the TimThumb Script you can use the following line instead
				/*	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $post_thumb; ?>" alt="<?php the_title(); ?>" /></a></li> */ ?>
				
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $post_thumb; ?>&w=110&zc=1" alt="" /></a></li>
					
					
					<?php } else { } ?>
				</ul>
			</div>
			
			<div class="post span-11 last">
				<?php the_content('Continue...'); ?>
			</div>
			
			<?php endwhile; ?>
			<?php  else : ?>
				
				<h2>Not Found</h2>
				<p>Sorry, but there were no posts found.</p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
				
			<?php endif;?>

		</div><!-- closes blog -->
		
		<div class="span-7">
			<?php if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar('Index Bottom Left') ) : 
			endif; ?>
		</div>
		
		<div class="span-7 last">
			<?php if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar('Index Bottom Right') ) : 
			endif; ?>
		</div>
		
	</div><!-- close left side -->
	
	<?php
		$feature = get_option('cm_feature');  // Gets the option from theme options page
			if($feature == 'Yes') { ?>
				<div class="sidebar_feature">
					<?php get_sidebar(); ?>
				</div>
	<?php	 }
			else {
	?>
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
	<?php } ?>
	
</div>

<?php get_footer(); ?>