<?php
//  The following php sets up color themes
require_once( dirname(__FILE__) . '../../../../wp-config.php');
require_once( dirname(__FILE__) . '/functions.php');
header("Content-type: text/css");

$color_theme = get_option('cm_color_theme');

// Global CSS Styles
$header_bg_url = 'images/bg_pattern.gif';
echo '.header { background-image: url(' . $header_bg_url . ');}';

// Red Color Theme
if($color_theme == 'Red') { ?>

h1, h2, h3, h4, h5, h6 {font-weight:normal; color:#790000; font-family: Georgia, serif;}

a { color: #790000; }
a:hover { color: #777;}
a:visited { color:#777;}

/******  HEADER *****/
.header { background-color: #790000; color:#bbb; }

/****** MENU *******/
.menu ul li a:hover, .menu ul li:hover sub { color: #790000; }
.menu ul li.current_page_item a, .menu ul li.current_page_item sub{ color: #790000; }

/**** FEATURED ****/
.feature { background-color: #790000; color: #ddd; }

/**** BLOG ****/
.blog h2 a {  color: #790000;}

/**** WIDGETS ****/
.widget h3 { border-top: 2px solid #9d4144; border-bottom: 1px solid #be6a6c; color: #9d4144; }
/* Welcome Box Widget */
.widget_welcome { background-color: #fbe5e5;  }

<? } //End Red Color Theme 

// Blue Color Theme
if($color_theme == 'Blue') { ?>

h1, h2, h3, h4, h5, h6 {font-weight:normal; color:#214656; font-family: Georgia, serif;}

a { color: #214656; }
a:hover { color: #777;}
a:visited { color:#777;}

/******  HEADER *****/
.header { background-color: #214656; color:#bbb;}

/****** MENU *******/
.menu ul li a:hover, .menu ul li:hover sub { color: #214656; }
.menu ul li.current_page_item a, .menu ul li.current_page_item sub{ color: #214656; }

/**** FEATURED ****/
.feature {background-color: #214656; color: #ddd; }

/**** BLOG ****/
.blog h2 a { color: #214656;}

/**** WIDGETS ****/
.widget h3 { border-top: 2px solid #78ACCF; border-bottom: 1px solid #CEDDEB; color: #78ACCF; }
/* Welcome Box Widget */
.widget_welcome { background-color: #CEDDEB; }

/**** COMMENTS ****/
#comments li.odd { background-color: #E5ECF3;}
#comments li.even { background-color: #EDF4F9; }

<? } //End Blue Color Theme 

// Green Color Theme
if($color_theme == 'Green') { ?>

h1, h2, h3, h4, h5, h6 {font-weight:normal; color:#3B4736; font-family: Georgia, serif;}

a { color: #3B4736; }
a:hover { color: #777;}
a:visited { color:#777;}

/******  HEADER *****/
.header { background-color: #3B4736; color:#bbb;}

/****** MENU *******/
.menu ul li a:hover, .menu ul li:hover sub { color: #3B4736; }
.menu ul li.current_page_item a, .menu ul li.current_page_item sub{ color: #3B4736; }

/**** FEATURED ****/
.feature {background-color: #3B4736; color: #ddd; }

/**** BLOG ****/
.blog h2 a { color: #3B4736;}

/**** WIDGETS ****/
.widget h3 { border-top: 2px solid #91CB78; border-bottom: 1px solid #C9DFBE; color: #82AF6E; }
/* Welcome Box Widget */
.widget_welcome { background-color: #E2EDDB; }

/**** COMMENTS ****/
#comments li.odd { background-color: #E9F4E4;}
#comments li.even { background-color: #EFF5EC; }

<? } //End Green Color Theme 

// Purple Color Theme
if($color_theme == 'Purple') { ?>

h1, h2, h3, h4, h5, h6 {font-weight:normal; color:#3B3858; font-family: Georgia, serif;}

a { color: #3B3858; }
a:hover { color: #777;}
a:visited { color:#777;}

/******  HEADER *****/
.header { background-color: #3B3858; color:#bbb;}

/****** MENU *******/
.menu ul li a:hover, .menu ul li:hover sub { color: #3B3858; }
.menu ul li.current_page_item a, .menu ul li.current_page_item sub{ color: #3B3858; }

/**** FEATURED ****/
.feature {background-color: #3B3858; color: #ddd; }

/**** BLOG ****/
.blog h2 a { color: #3B3858;}

/**** WIDGETS ****/
.widget h3 { border-top: 2px solid #9FA6D4; border-bottom: 1px solid #CACDE8; color: #858FC7; }
/* Welcome Box Widget */
.widget_welcome { background-color: #DAD9EA; }

/**** COMMENTS ****/
#comments li.odd { background-color: #DADCEF;}
#comments li.even { background-color: #EBEBF6; }

<? } //End Purple Color Theme 

// Brown Color Theme
if($color_theme == 'Brown') { ?>

h1, h2, h3, h4, h5, h6 {font-weight:normal; color:#362D28; font-family: Georgia, serif;}

a { color: #362D28; }
a:hover { color: #777;}
a:visited { color:#777;}

/******  HEADER *****/
.header { background-color: #362D28; color:#bbb;}

/****** MENU *******/
.menu ul li a:hover, .menu ul li:hover sub { color: #362D28; }
.menu ul li.current_page_item a, .menu ul li.current_page_item sub{ color: #362D28; }

/**** FEATURED ****/
.feature {background-color: #362D28; color: #ddd; }

/**** BLOG ****/
.blog h2 a { color: #362D28;}

/**** WIDGETS ****/
.widget h3 { border-top: 2px solid #AD8368; border-bottom: 1px solid #C9AD99; color: #AD8368; }
/* Welcome Box Widget */
.widget_welcome { background-color: #E7DDD4; }

/**** COMMENTS ****/
#comments li.odd { background-color: #f5f5f5;}
#comments li.even { background-color: #E8E1DD; }

<? } //End Brown Color Theme 

// Grey/Red Color Theme
if($color_theme == 'Grey/Red') { ?>

	h1, h2, h3, h4, h5, h6 {font-weight:normal; color:#790000; font-family: Georgia, serif;}

	a { color: #790000; }
	a:hover { color: #777;}
	a:visited { color:#777;}

	/****** MENU *******/
	.menu ul li a:hover, .menu ul li:hover sub { color: #790000; }
	.menu ul li.current_page_item a, .menu ul li.current_page_item sub{ color: #790000; }

	/**** FEATURED ****/
	.feature { background-color: #790000; color: #ddd; }

	/**** BLOG ****/
	.blog h2 a {  color: #790000;}

<? } //End Grey/Red Color Theme ?>