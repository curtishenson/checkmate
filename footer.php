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
	<p>Designed by <a href="http://curtishenson.com/checkmate-a-free-wordpress-theme/">Curtis Henson</a> &copy; 2008</p>
	</div>
</div>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.3.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.curvycorners.packed.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.color.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabber-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cm_javascript.js"></script>

<?php wp_footer(); ?>

</body>
</html>
