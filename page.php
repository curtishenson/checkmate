<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>
	
<div class="container single">
		
		<div class="page span-14">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<h2><?php the_title(); ?></h2>

				<div class="post span-14 last">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="page-links"> Pages: &after=</div>'); ?>
				</div>

				<?php endwhile; else : ?>

					<h2>Not Found</h2>
					<p>Sorry, but there were no posts found.</p>
					<?php include (TEMPLATEPATH . "/searchform.php"); ?>

				<?php endif; ?>
		</div>

		
	<div class="sidebar span-10 last">
		<?php get_sidebar(); ?>
	</div>
	
</div><?php //closes container ?>

<?php get_footer(); ?>