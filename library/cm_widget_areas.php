<?php
// SIDEBARS ******************************
if ( function_exists('register_sidebars') )
    register_sidebar(array(
		'name' => 'Index Bottom Left',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Index Bottom Right',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Top',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Left',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Right',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Sidebar Bottom',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name'=>'Tabbed Content',
		'before_widget' => '<div id="%1$s" class="tabbertab %2$s">', // Removes <li>
		'after_widget' => '</div>', // Removes </li>
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));

$footeroption = get_option('cm_footer_widgets');
if ($footeroption == "Enabled") {
	if ( function_exists('register_sidebars') )
	    register_sidebar(array(
			'name' => 'Footer Left',
	       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>',
	    ));
	register_sidebar(array(
		'name' => 'Footer Middle',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
		'name' => 'Footer Right',
       	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	
}
?>