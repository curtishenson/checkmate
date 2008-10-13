<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

	
<div class="container archives">
	
	<h2>You are viewing the Archives</h2>
	<?php cm_left_column() ?>
		<div class="span-14 content">
			<div class="">
				<h3>View By Month</h3>
				<ul class="clearfix">
		  			<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			</div>
			
			<div class="">
				<h3>View By Year</h3>
				<ul class="clearfix">
		  			<?php wp_get_archives('type=yearly&show_post_count=1'); ?>
				</ul>
			</div>
			
			<div class="">
				<h3>View By Cateogory</h3>
				<ul class="clearfix">
					<?php wp_list_categories('title_li=&show_count=1&hierarchical='); ?>
				</ul>
			</div>
			
			<div class="">
				<h3>View By Tag</h3>
				<?php wp_tag_cloud('format=list&smallest=7&largest=13'); ?>
			</div>
		</div>		
		
		<?php cm_sidebar(); ?>
	
</div><?php //closes container ?>

<?php get_footer(); ?>