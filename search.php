<?php get_header(); ?>

	
<div class="container archive">
		<h2><?php _e('You searched for "<strong><?php the_search_query(); ?></strong>"', 'checkmate'); ?></h2>
		<div>
			<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
		  	<option value=""><?php echo attribute_escape(__('View By Month', 'checkmate')); ?></option> 
		  	<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?></select>
			
			<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
		  	<option value=""><?php echo attribute_escape(__('View By Year', 'checkmate')); ?></option> 
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
		
		<?php cm_left_column() ?>
		
		<div class="blog span-14">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<div class="meta">
					<ul>
						<li class="date">Posted On <?php the_time('M j, Y') ?></li>
						<li class="comment"> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></li>
					</ul>
				</div>

				<div <?php if (function_exists('post_class')) { post_class(); } else { echo 'class="post"'; } ?>>
					<?php the_content(__('Continue Reading', 'checkmate')); ?>
				</div>

				<?php endwhile; else : ?>

					<h2><?php _e('Not Found', 'checkmate'); ?></h2>
					<p><?php _e('Sorry, but there were no posts found.', 'checkmate'); ?></p> 

				<?php endif; ?>
				
				<div class="navigation clearfix">
					<span class="alignleft"><?php next_posts_link('« Previous Entries', '0') ?></span>
					<span class="alignright"><?php previous_posts_link('Next Entries »', '0'); ?></span>
				</div>
		</div>

		<?php cm_sidebar(); ?>
	
</div><?php //closes container ?>

<?php get_footer(); ?>