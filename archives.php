<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div class="container archives">
	
	<h2><?php _e('You are viewing the Archives', 'checkmate'); ?></h2>
	<?php cm_left_column() ?>
		<div class="span-14 content">
			<div class="">
				<h3><?php _e('View By Month', 'checkmate'); ?></h3>
				<ul class="clearfix">
		  			<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			</div>
			
			<div class="">
				<h3><?php _e('View By Year', 'checkmate'); ?></h3>
				<ul class="clearfix">
		  			<?php wp_get_archives('type=yearly&show_post_count=1'); ?>
				</ul>
			</div>
			
			<div class="">
				<h3><?php _e('View By Category', 'checkmate'); ?></h3>
				<ul class="clearfix">
					<?php wp_list_categories('title_li=&show_count=1&hierarchical='); ?>
				</ul>
			</div>
			
			<div class="">
				<h3><?php _e('View By Tag', 'checkmate'); ?></h3>
				<?php wp_tag_cloud('format=list&smallest=7&largest=13'); ?>
			</div>
		</div>		
		
		<?php cm_sidebar(); ?>
	
</div><?php //closes container ?>

<?php get_footer(); ?>