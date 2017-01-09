<?php
/*
 * Fonts for Onepiece theme
 */


/*

Devhowto:


https://www.google.com/webfonts
http://www.wpexplorer.com/google-fonts-wordpress/


function myprefix_enqueue_google_fonts() {
	wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto' );
}
add_action( 'wp_enqueue_scripts', 'myprefix_enqueue_google_fonts' );


body { font-family: "Roboto"; } (main font)
.page-tile h1 (page title)
.post-tile h1 (single post)
.post-tile h2 (post in list)
.widgetpadding h3 (widget titlebar)
/*
 * Main font
 */


/*
 * Page / default h1 title (type/size)
 */

/*
 * List/Category post title h2 (type/size)
 */

/*
 * Post title h1 (type/size)
 */

/*
 * Widget title h3 (type/size)
 */

/*
 * Widget list item title h4 (type/size)
 */



function get_fonts_select(){

	// available font selection
	$fontselectlist = array(

		'arial'=>'Arial',

		'helvetica__'=>'Helvetica',

		'verdana'=>'Verdana'

	);

	return $fontselectlist;

}

function add_fonts_style(){
	// check selected fonts
	// __ in key string is selfhosted font

	// include font stylesheets/libs

	// output style css
}






?>
