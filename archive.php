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
			<h2><?php _e('Posts by ', 'checkmate'); ?><?php echo $curauth->display_name; //display name set in user options ?></h2>
		
			<?php 	if (function_exists('get_avatar')) {
		 			echo get_avatar( $curauth->user_email, '80'); } ?>
		
			<p><?php echo $curauth->description; ?></p>
		</div>
	<?php } //Category Header
		elseif (is_category()) { ?>	
		<h2><?php _e('You are viewing the', 'checkmate'); ?> <strong><em><?php single_cat_title(); ?></em></strong> <?php _e('category', 'checkmate'); ?></h2>
		
	<?php } //Tag Header
		elseif (is_tag()) { ?>	
		<h2><?php _e('You are viewing the', 'checkmate'); ?> <strong><em><?php single_tag_title(); ?></em></strong> <?php _e('tag', 'checkmate'); ?></h2>
		
	<?php } //Archive Header
		else { ?>
		<h2><?php _e('You are viewing the Archives', 'checkmate'); ?></h2>
		<?php } ?>
		
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
						<li class="date"><?php _e('Posted On', 'checkmate'); ?> <?php the_time(__('M j, Y', 'checkmate')) ?></li>
						<li class="comment"> | <a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comments', 'checkmate'),__('1 Comment', 'checkmate'),__('% Comments', 'checkmate')); ?></a></li>
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
					<span class="alignleft"><?php posts_nav_link('','', __('&laquo; Previous Entries', 'checkmate')) ?></span>
					<span class="alignright"><?php posts_nav_link('',__('Newer Entries &raquo;', 'checkmate'),'') ?></span>
				</div>
		</div>
		
	<?php cm_sidebar(); ?>
	
</div><?php //closes container ?>

<?php get_footer(); ?>