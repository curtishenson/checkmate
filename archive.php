<?php get_header(); ?>

	
<div class="container archive">
	
	<?php //Author Header
		if (is_author()) { 
		// gather author information
		if(get_query_var('author_name')) :
		$curauth = get_userdatabylogin(get_query_var('author_name'));
		else:
		$curauth = get_userdata(get_query_var('author'));
		endif; ?>
		
		<div class="author span-24 last">
			<h2>Posts by <?php echo $curauth->display_name; //display name set in user options ?></h2>
		
			<?php 	if (function_exists('get_avatar')) {
		 			echo get_avatar( $curauth->user_email, '80'); } ?>
		
			<p><?php echo $curauth->description; ?></p>
		</div>
	<?php } //Category Header
		elseif (is_category()) { ?>	
		<h2>You are viewing the <strong><em><?php single_cat_title(); ?></em></strong> category</h2>
		
	<?php } //Tag Header
		elseif (is_tag()) { ?>	
		<h2>You are viewing the <strong><em><?php single_tag_title(); ?></em></strong> tag</h2>
		
	<?php } //Archive Header
		else { ?>
		<h2>You are viewing the Archives</h2>
		<?php } ?>
		
		<div>
			<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
		  	<option value=""><?php echo attribute_escape(__('View By Month')); ?></option> 
		  	<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?></select>
			
			<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
		  	<option value=""><?php echo attribute_escape(__('View By Year')); ?></option> 
		  	<?php wp_get_archives('type=yearly&format=option&show_post_count=1'); ?></select>
	
			<form action="<?php bloginfo('url'); ?>/" method="get">
				<?php
				$select = wp_dropdown_categories('show_option_none=View By Category&show_count=1&hierarchical=1&echo=0');
				$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
				echo $select;
				?>
				<noscript><input type="submit" value="View" /></noscript>
			</form>
		</div>
		
		<div class="blog span-14">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="span-3 meta">
					<ul>
						<li><?php the_time('M j, Y') ?></li>
						<li><a href="<?php comments_link(); ?>"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></li>
						<?php //get thumbnail (custom field)  
						$post_thumb = get_post_meta($post->ID, 'post_thumb', true); ?>
						<?php if($post_thumb !== '') { ?>
						<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $post_thumb; ?>" alt="<?php the_title(); ?>" /></a></li>
						<?php } else { } ?>
					</ul>
				</div>

				<div class="post span-11 last">
					<?php the_excerpt(); ?>
				</div>

				<?php endwhile; else : ?>

					<h2>Not Found</h2>
					<p>Sorry, but there were no posts found.</p>
					<?php include (TEMPLATEPATH . "/searchform.php"); ?>

				<?php endif; ?>
				
				<div class="posts_navigation">
					<?php posts_nav_link('-','&laquo; Previous Page','Next Page &raquo;'); ?> 
				</div>
		</div>

		
	<div class="sidebar span-10 last">
		<?php get_sidebar(); ?>
	</div>
	
</div><?php //closes container ?>

<?php get_footer(); ?>