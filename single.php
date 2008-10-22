<?php get_header(); ?>

<div class="container single">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		
		<?php cm_left_column() ?>
		
		<div class="blog span-14">
			
			<h2><?php the_title(); ?></h2>
			<p class="meta">
				<?php printf(__('Posted on %1$s by %2$s in %3$s','checkmate'), get_the_time(__('M j, Y','checkmate')), get_the_author_posts_link(), get_the_category_list(', ')); ?> | <a href="#comments"><?php comments_number(__('0 Comments','checkmate'), __('1 Comment','checkmate'), __('% Comments','checkmate')); ?></a> <?php edit_post_link((__('Edit Post','checkmate')), '| '); ?>
			</p>
			
			<div class="post">
				<?php the_content(); ?>
			</div>
			
			<?php wp_link_pages('before=<div class="page-links"> Pages: &after=</div>'); ?>
			
			<?php cm_after_post(); ?>

			<div class="comments">
				<?php comments_template(); ?>
			</div>
			
		</div>
	<?php endwhile; endif; ?>
		
	<?php cm_sidebar(); ?>

	
</div>
</div><?php //closes container ?>

<?php get_footer(); ?>