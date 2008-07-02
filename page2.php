<?php
/*
Template Name: Page No Sidebar
*/
?>

<?php get_header(); ?>
	
<div class="container single">
		
		<div class="page span-24">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<h2><?php the_title(); ?></h2>

				<div class="post span-24 last">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="page-links"> Pages: &after=</div>'); ?>
				</div>

				<?php endwhile; else : ?>

					<h2>Not Found</h2>
					<p>Sorry, but there were no posts found.</p>
					<?php include (TEMPLATEPATH . "/searchform.php"); ?>

				<?php endif; ?>
		</div>
	
</div><?php //closes container ?>

<?php get_footer(); ?>