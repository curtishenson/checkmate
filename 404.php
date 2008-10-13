<?php get_header(); ?>

<div class="container archive">
	
	<?php cm_left_column() ?>
	
	<div class="span-14">
		<h2>404 Error! Sorry but we couldn't find what you are looking for.  Please try the search form or the archives.</h2>
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
		
	<?php cm_sidebar(); ?>
	
</div><?php //closes container ?>

<?php get_footer(); ?>