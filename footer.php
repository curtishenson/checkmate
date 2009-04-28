<div class="container footer">
<?php 
	$footwidgets = get_option('cm_footer_widgets');
	if ($footwidgets == "Enabled") { ?>
		
		<div class="span-8">
			<?php if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Footer Left') ) : 
			endif; ?>
		</div>

		<div class="span-8">
			<?php if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar('Footer Middle') ) : 
			endif; ?>
		</div>

		<div class="span-8 last">
			<?php if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar('Footer Right') ) : 
			endif; ?>
		</div>
		
<?php	} ?>
	
	<div class="span-24">
		<span xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dc:title" rel="dc:type"><a href="http://curtishenson.com/checkmate" title="Checkmate - A Refined WordPress Theme">CheckMate</a></span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://curtishenson.com/" property="cc:attributionName" rel="cc:attributionURL">Curtis Henson</a> is licensed under <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons</a>.
	</div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
<?php $classic = get_option('cm_use_classic');
 		if ( $classic == "Yes") { ?>
			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.curvycorners.packed.js"></script>
			<script type="text/javascript">
				roundedCorners();
			</script>
<?php } ?> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cm_javascript.js"></script>
<script type="text/javascript">
	searchInput(<?php _e("Type and hit enter to search", 'checkmate'); ?>);
	emailInput(<?php _e("Enter your email and hit enter", 'checkmate'); ?>);
</script>

<?php 	$footer_code = get_option('cm_footer_code'); 
		echo stripslashes($footer_code); 
?>

<?php wp_footer(); ?>

</body>
</html>
