<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	

	<title><?php 
	if (is_home()) { echo bloginfo('name'); } elseif (is_404()) { echo bloginfo('name'). '» 404'; } elseif 
	(is_search()) { echo bloginfo('name'). ' » Search Results'; } else { echo wp_title(''); } 
	?></title>
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print">  
	
	<?php $rss_url = get_option('cm_feedburner_address'); 
		if ($rss_url != "") { ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php echo $rss_url; ?>" />
		<?php } else { ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<?php } ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 1.0 Feed" href="<?php bloginfo('rdf_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 0.92 Feed" href="<?php bloginfo('rss_url'); ?>" />	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Comments RSS 2.0 Feed" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		  
	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen, projection">
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css" media="screen, projection">
	<![endif]-->
	
	<?php wp_head(); ?>
</head>

<body>
	<div class="header">
		<div class="container">
			<div class="logo span-17">
				<h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></h1>
					<em><?php bloginfo('description'); ?></em>
			</div>
			<div class="span-7 last">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				
					<p class="rss">
						<a href="#">Subscription Options</a>
					</p>
					<div class="rssoptions">
						<ul>
							<?php $rss_url = get_option('cm_feedburner_address'); 
								if ($rss_url != "") {
									echo '<li><a href="' . $rss_url . '"> Articles RSS</a></li>';
								} 
								else { ?>
							<li><a href="<?php bloginfo('rss2_url'); ?> ">Articles RSS</a></li>
							<?php } ?>
							<?php $comments_url = get_option('cm_feedburner_comments'); 
								if ($comments_url != "") {
									echo '<li><a href="' . $comments_url . '"> Comments RSS</a></li>';
								} 
								else { ?>
							<li><a href="<?php bloginfo_rss('comments_rss2_url') ?>">Comments RSS</a></li>
							<?php } ?>
						</ul>

						<?php $fbId = get_option('cm_feedburner_id'); //Your feedburner ID ?>
						<form id="subscribe" method="post" action="http://www.feedburner.com/fb/a/emailverify" target="popupwindow"
						onsubmit="window.open('http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php echo $fbId; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
							<fieldset>
								<label for="input_subscribe">By Email</label>
								<input value="" name="email" id="input_subscribe" type="text" />
								<input type="hidden" id="submit" name="url" value="http://feeds.feedburner.com/~e?ffid=<?php echo $fbId; ?>"  />
								<input type="hidden" name="loc" value="en_US"/>
							</fieldset>
						</form>	
					</div>

			</div>
		</div>
	</div>
	
	<div id="subheader" class="clearfix">
		
			<div class="menu">
				<ul>
					<?php 
					$menupages = get_option('cm_menu_pages');
					wp_list_pages('title_li=&sort_column=menu_order&include=' . $menupages); ?>
				</ul>
			</div>

	</div><?php // close subheader ?>	
	