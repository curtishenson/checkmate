<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_settings( $value['id'] ); }
    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php load_theme_textdomain('checkmate'); ?>

	<title><?php 
		if (is_home()) { echo bloginfo('name'); } 
		elseif (is_404()) { echo bloginfo('name'). '» 404'; } 
		elseif (is_search()) { echo bloginfo('name') . __(' » Search Results', 'checkmate'); } 
		else { echo wp_title('') . ' - ' . get_bloginfo('name'); } 
	?></title>
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<?php 	if ( isset($cm_alt_stylesheet) && !($cm_alt_stylesheet == 'Select a stylesheet:') ) {
				echo '<link rel="stylesheet" href="' . get_bloginfo('template_directory') . '/styles/' . $cm_alt_stylesheet . '" type="text/css" media="screen" />';
			}
	?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />  
	
	<?php $rss_url = get_option('cm_feedburner_address'); 
		if ($rss_url != "") { ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php echo $rss_url; ?>" />
		<?php } else { ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<?php } ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 1.0 Feed" href="<?php bloginfo('rdf_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 0.92 Feed" href="<?php bloginfo('rss_url'); ?>" />	
	
	<?php $comments_url = get_option('cm_feedburner_comments'); 
		if ($comments_url != "") {
			echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo('name') . ' Comments RSS 2.0 Feed" href="' . $comments_url . '" />';
		} 
		else { ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Comments RSS 2.0 Feed" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<?php } ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		  
	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen, projection" />
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css" media="screen, projection" />
	<![endif]-->
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php $header_code = get_option('cm_header_code'); 
			echo stripslashes($header_code); 
	?>
	
	<?php wp_head(); ?>
</head>

<body>
	<div class="header">
		<div class="container">
			<div class="logo span-17">
				<?php 	if ( $cm_use_custom_logo == 'true' ) { 
							echo "<a href=\"" . get_bloginfo('home') . "\">";
							 	echo "<img src=\"" . get_template_directory_uri() . "/images/logo/" . $cm_logo ."\" alt=\"" . get_bloginfo('name') . "\" />";
							echo "</a>";
						} else { ?>
							<h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></h1>
							<em><?php bloginfo('description'); ?></em>
				<?php }	 ?>
			</div>
			<div class="span-7 last">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				
					<p class="rss">
						<a href="#"><?php _e('Subscription Options', 'checkmate'); ?></a>
					</p>
					<div class="rssoptions">
						<ul>
							<?php $rss_url = get_option('cm_feedburner_address'); 
								if ($rss_url != "") {
									echo __('<li><a href="' . $rss_url . '"> Articles RSS</a></li>', 'checkmate');
								} 
								else { ?>
							<li><a href="<?php bloginfo('rss2_url'); ?> "><?php _e('Articles RSS', 'checkmate'); ?></a></li>
							<?php } ?>
							<?php $comments_url = get_option('cm_feedburner_comments'); 
								if ($comments_url != "") {
									echo __('<li><a href="' . $comments_url . '"> Comments RSS</a></li>', 'checkmate');
								} 
								else { ?>
							<li><a href="<?php bloginfo_rss('comments_rss2_url') ?>"><?php _e('Comments RSS', 'checkmate'); ?></a></li>
							<?php } ?>
						</ul>

						<?php $fbId = get_option('cm_feedburner_id'); //Your feedburner ID 
							if ( !empty($cm_feedburner_id) ) { ?>
								<form id="subscribe" method="post" action="http://www.feedburner.com/fb/a/emailverify" target="popupwindow"
								onsubmit="window.open('http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php echo $fbId; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
									<fieldset>
										<label for="input_subscribe"><?php _e('By Email', 'checkmate'); ?></label>
										<input value="" name="email" id="input_subscribe" type="text" />
										<input type="hidden" id="submit" name="url" value="http://feeds.feedburner.com/~e?ffid=<?php echo $fbId; ?>"  />
										<input type="hidden" name="loc" value="en_US"/>
									</fieldset>
								</form>	
						<?php } ?>
					</div>

			</div>
		</div>
	</div>
	
	<div id="subheader" class="clearfix">
		
			<div class="menu">
				<ul>
					<?php 
					$menupages = get_option('cm_menu_pages');
					wp_list_pages('title_li=&depth=2&sort_column=menu_order&include=' . $menupages); ?>
				</ul>
			</div>

	</div><?php // close subheader ?>	
	