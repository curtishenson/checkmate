<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>
	
<div class="container single">
	
	<?php cm_left_column() ?>
		
		<div class="page span-14">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<h2><?php the_title(); ?></h2>

				<div <?php if (function_exists('post_class')) { post_class(); } else { echo 'class="post"'; } ?>>
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="page-links"> Pages: &after=</div>'); ?>
				</div>

				<?php endwhile; else : ?>

					<h2>Not Found</h2>
					<p>Sorry, but there were no posts found.</p>
					<?php include (TEMPLATEPATH . "/searchform.php"); ?>

				<?php endif; ?>
		</div>

	<?php cm_sidebar(); ?>
	
</div><?php //closes container ?>

<?php get_footer(); ?>