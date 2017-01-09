<?php
/*
 * Fonts for Onepiece theme
 */

/*
Devhowto:
https://www.google.com/webfonts
http://www.wpexplorer.com/google-fonts-wordpress/
*/



function get_fonts_select(){

	// available font selection
	$fontselectlist = array(



		'default'=>'Use default (main) font',

		'Aladin'=>'Aladin',

		'Almendra+SC'=>'Almendra SC',

		'Andada'=>'Andada',

		'arial'=>'Arial',

		'Bubblegum+Sans'=>'Bubblegum Sans',

		'Chelsea+Market'=>'Chelsea Market',

		'ChunkFive__'=> 'ChunkFive',

		'Courgette'=> 'Courgette',

		'Croissant+One'=>'Croissant One',

		'decade__'=>'Decade',

		'Droid+Sans+Mono'=>'Droid Sans Mono',

		'Gochi+Hand'=>'Gochi Hand',

		'GoodDog__'=>'Good Dog',

		'Italiana'=>'Italiana',

		'Journal__'=>'Journal',

		'Julius+Sans+One'=>'Julius Sans One',

		'Kelly+Slab'=> 'Kelly Slab',

		'Lemon'=>'Lemon',

		'Libre+Franklin'=>'Libre Franklin',

		'Lilita+One'=>'Lilita One',

		'Magra'=> 'Magra',

		'Marck+Script'=> 'Marck Script',

		'MarkerFelt-Thin__'=>'MarkerFelt Thin',

		'MarkerFelt-Wide__'=>'MarkerFelt Wide',

		'Marvel'=> 'Marvel',

		'Permanent+Marker'=>'Permanent+Marker',

		'playbill'=>'Playbill',

		'Poiret+One'=> 'Poiret One',

		'Pompiere'=> 'Pompiere',

		'Quicksand'=>'Quicksand',

		'Racing+Sans+One'=>'Racing Sans One',

		'Roboto+Mono'=>'Roboto Mono',

		'Roboto+Slab'=>'Roboto Slab',

		'Rochester'=> 'Rochester',

		'Rock+Salt'=> 'Rock Salt',

		'Ropa+Sans'=>'Ropa Sans',

		'Rubik+Mono+One'=>'Rubik Mono One',

		'Rubik+One'=>'Rubik One',

		'Russo+One'=>'Russo One',

		'rockwell__'=>'Rockwell',

		'Rockwell_Extra_Bold__'=>'Rockwell Extra Bold',

		'Rosario'=>'Rosario',

		'Sanchez'=>'Sanchez',

		'Schoolbell'=>'Schoolbell',

		'verdana'=>'Verdana',

		'Vesper+Libre'=>'Vesper Libre',

		'Work+Sans'=>'Work Sans',
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

		// page / default / gallery / subtitles
		if( get_theme_mod('onepiece_style_fonts_pagetitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_pagetitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.page-title h1, .category-titlebar h1, .gallery-titlebar h1, #childpagecontent .subtitle h3');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}

	    // list titles posts
		if( get_theme_mod('onepiece_style_fonts_postlisttitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_postlisttitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.post-title h2, .titlebox h3');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}
		// single post titles
		if( get_theme_mod('onepiece_style_fonts_posttitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_posttitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.post-title h1');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
		}

		// Widget title
		if( get_theme_mod('onepiece_style_fonts_widgettitle' ) != 'default' ){
		$fontkey = get_theme_mod('onepiece_style_fonts_widgettitle', $fontkey_default );
		$fontcode .= generate_font_css($fontkey,'.widgetpadding h3,.sidebarpadding h3');
		if( strpos($fontkey, '__') !== true ){
		$googlefontlist .= '|'.$fontkey;
		}
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


		echo '<style>'.$fontcode.'</style>';

}

// ! just added the function call on end htmlhead
//add_action( 'wp_enqueue_scripts', 'add_fonts_frontend' );
//add_action('wp_head', 'add_fonts_frontend', 9999 );





?>
