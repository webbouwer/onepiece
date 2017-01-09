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

		'default'=>'Use default (main) font',

		'arial'=>'Arial',

		'Courgette'=> 'Courgette',

		'Journal__'=>'Journal',

		'Kelly+Slab'=> 'Kelly Slab',

		'Magra'=> 'Magra',

		'Marck+Script'=> 'Marck Script',

		'MarkerFelt-Thin__'=>'MarkerFelt Thin',

		'MarkerFelt-Wide__'=>'MarkerFelt Wide',

		'Marvel'=> 'Marvel',

		'Michroma'=> 'Michroma',

		'Poiret+One'=> 'Poiret One',

		'Pompiere'=> 'Pompiere',

		'Roboto+Mono'=>'Roboto Mono',

		'Roboto+Slab'=>'Roboto Slab',

		'Rochester'=> 'Rochester',

		'Rock+Salt'=> 'Rock Salt',

		'Rosario'=>'Rosario',

		'verdana'=>'Verdana'

	);

	return $fontselectlist;

}


function generate_font_style($fontkey){


	$fontlist = get_fonts_select();

	// __ in fontkey is self-hosted
	if( strpos($fontkey, '__') !== false ){

		$fontname = str_replace('__', '', $fontkey); // remove __

		// add font css code in head
		$fontcode = '@font-face {
			font-family: '.$fontname.';
			src: url( "'.esc_url( get_template_directory_uri() ) . '/fonts/'.$fontname.'.eot" );
			src: url( "'.esc_url( get_template_directory_uri() ) . '/fonts/'.$fontname.'.eot?#iefix") format("embedded-opentype"),
			url( "'.esc_url( get_template_directory_uri() ) . '/fonts/'.$fontname.'.woff") format("woff"),
			url( "'.esc_url( get_template_directory_uri() ) . '/fonts/'.$fontname.'.ttf") format("truetype"),
		}';

	}
	/*
	else{ // otherwise load google font

		embed_google_font($fontkey);

	}*/

	return $fontcode;
}


/*function embed_google_font($fontkey) {

	//$fontlist = get_fonts_select();
	echo '<link href="https://fonts.googleapis.com/css?family='.$fontkey.'" rel="stylesheet">';

}*/

function generate_font_css($fontkey,$element){

		$fontcode = generate_font_style($fontkey);
		$fontname = str_replace('__', '', $fontkey); // remove __ for selfhosted font names
	    $fontname = str_replace('+', ' ', $fontname); // replace + in most of googlefont names
		$fontcode .= "\n".$element.'{ font-family: "'.$fontname.'", verdana; }';
		return $fontcode;
}




function add_fonts_frontend(){
	// check selected fonts

		$fontcode = '';
		$googlefontlist = '';

		// main
		$fontkey_default = get_theme_mod('onepiece_style_fonts_maintype', 'arial' ); // defaults to arial
		$fontcode .= generate_font_css($fontkey_default,'body');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= $fontkey_default;
		}

		if( get_theme_mod('onepiece_style_fonts_pagetitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_pagetitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.page-title h1, .category-titlebar h1, .gallery-titlebar h1, #childpagecontent .subtitle h3');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}
		if( get_theme_mod('onepiece_style_fonts_posttitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_posttitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.post-title h1');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}
		if( get_theme_mod('onepiece_style_fonts_postlisttitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_postlisttitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.post-title h2, .titlebox h3');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}
		if( get_theme_mod('onepiece_style_fonts_widgettitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_widgettitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.widgetpadding h3');
		}
		if( get_theme_mod('onepiece_style_fonts_widgetitemtitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_widgetitemtitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.widgetpadding ul li h4');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}

		if($googlefontlist !== ''){
		echo '<link href="https://fonts.googleapis.com/css?family='.$googlefontlist.'" rel="stylesheet">';
		}

		/* Aladin|Almendra+SC|Bubblegum+Sans|Cabin+Condensed|Caveat|Croissant+One|Cutive+Mono|Days+One|Droid+Sans+Mono|Happy+Monkey|Italiana|Julius+Sans+One|Lemon|Libre+Franklin|Lilita+One|Modak|Montez|Noto+Sans|Permanent+Marker|Quicksand|Racing+Sans+One|Ropa+Sans|Russo+One|Sanchez|Schoolbell|Vesper+Libre|Work+Sans
		*/
		echo '<style>/* fonts check */ '.$fontcode.'</style>';

}

// ! just added the function call on end htmlhead
//add_action( 'wp_enqueue_scripts', 'add_fonts_frontend' );
//add_action('wp_head', 'add_fonts_frontend', 9999 );





?>
