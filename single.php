<?php get_header(); ?>

<div class="container single">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		
		<div class="blog span-14">
			
			<h2><?php the_title(); ?></h2>
			<p class="meta">
				Posted on <?php the_time('M j, Y'); ?> by <?php the_author_posts_link(); ?> in <?php the_category(', '); ?> | <a href="#comments"><?php comments_number('0','1','%'); ?> Comments</a> <?php edit_post_link('Edit Post', '| '); ?>
			</p>
			
			<div class="post append-1 last">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages('before=<div class="page-links"> Pages: &after=</div>'); ?>


			<div class="comments">
				<?php comments_template(); ?>
			</div>
			
		</div><!-- closes blog -->
	<?php endwhile; endif; ?>
		
	<div class="sidebar span-10 last">
		<?php get_sidebar(); ?>
	</div>
	
</div><?php //closes container ?>

<?php get_footer(); ?>