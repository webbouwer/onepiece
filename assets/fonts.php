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

		'HelveticaNeue__'=>'Helvetica Neue',

		'Italiana'=>'Italiana',

		'journal__'=>'Journal',

		'Julius+Sans+One'=>'Julius Sans One',

		'Kelly+Slab'=> 'Kelly Slab',

		'Lato'=>'Lato',
		
		'Lemon'=>'Lemon',

		'Libre+Franklin'=>'Libre Franklin',

		'Lilita+One'=>'Lilita One',

		'Magra'=> 'Magra',

		'Marck+Script'=> 'Marck Script',

		'MarkerFelt-Thin__'=>'MarkerFelt Thin',

		'MarkerFelt-Wide__'=>'MarkerFelt Wide',

		'Martel'=> 'Martel',
		
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
		$fontcode .= "\n";
		$fontcode .= $element.'{ font-family: "'.$fontname.'", verdana; }';
		return $fontcode;
}




function add_fonts_frontend(){
	// check selected fonts

		$fontcode = '';
		$googlefontlist = '';







		// main
		$fontkey_default = get_theme_mod('onepiece_style_fonts_maintype', 'arial' ); // defaults to arial

		if( strpos($fontkey_default, '__')  ){
			// default is local font
			$fontcode .= generate_font_css($fontkey_default,'body');
		}else if($fontkey_default != 'arial'){
			// default is google font
		    $googlefontlist .= $fontkey_default;
			$fontcode .= 'body{ font-family: "'.str_replace('+', ' ', $fontkey_default).'", arial, verdana; }';
		}


		// page / default / gallery / subtitles
		$fontkey_page = get_theme_mod('onepiece_style_fonts_pagetitle', $fontkey_default ); // defaults to arial
		if($fontkey_page != 'default'){
			$css_element = '.page-title h1, .category-titlebar h1, .gallery-titlebar h1, #childpagecontent .subtitle h3';
		if( strpos($fontkey_page, '__')  ){
			// default is local font
			$fontcode .= generate_font_css($fontkey_page,$css_element);
		}else if($fontkey_page != 'arial'){
			// default is google font
		    $googlefontlist .= '|'.$fontkey_page;
			$fontcode .= "\n";
			$fontcode .= $css_element.'{ font-family: "'.str_replace('+', ' ', $fontkey_page).'", arial, verdana; }';
		}
		}


		// list titles posts
		$fontkey_postlist = get_theme_mod('onepiece_style_fonts_postlisttitle', $fontkey_default ); // defaults to arial
		if($fontkey_postlist != 'default'){
			$css_element = '.post-title h2, .titlebox h3';
		if( strpos($fontkey_postlist, '__')  ){
			// default is local font
			$fontcode .= generate_font_css($fontkey_postlist,$css_element);
		}else if($fontkey_postlist != 'arial'){
			// default is google font
		    $googlefontlist .= '|'.$fontkey_postlist;
			$fontcode .= "\n";
			$fontcode .= $css_element.'{ font-family: "'.str_replace('+', ' ', $fontkey_postlist).'", arial, verdana; }';
		}
		}


		// single post titles
		$fontkey_postsingle = get_theme_mod('onepiece_style_fonts_posttitle', $fontkey_default ); // defaults to arial
		if($fontkey_postsingle != 'default'){
			$css_element = '.post-title h1';
		if( strpos($fontkey_postsingle, '__')  ){
			// default is local font
			$fontcode .= generate_font_css($fontkey_postsingle,$css_element);
		}else if($fontkey_postsingle != 'arial'){
			// default is google font
		    $googlefontlist .= '|'.$fontkey_postsingle;
			$fontcode .= "\n";
			$fontcode .= $css_element.'{ font-family: "'.str_replace('+', ' ', $fontkey_postsingle).'", arial, verdana; }';
		}
		}





		// Widget title
		$fontkey_widgettitle = get_theme_mod('onepiece_style_fonts_widgettitle', $fontkey_default ); // defaults to arial
		if($fontkey_widgettitle != 'default'){
			$css_element = '.widgetpadding h3,.sidebarpadding h3';
		if( strpos($fontkey_widgettitle, '__')  ){
			// default is local font
			$fontcode .= generate_font_css($fontkey_widgettitle,$css_element);
		}else if($fontkey_widgettitle != 'arial'){
			// default is google font
		    $googlefontlist .= '|'.$fontkey_widgettitle;
			$fontcode .= "\n";
			$fontcode .= $css_element.'{ font-family: "'.str_replace('+', ' ', $fontkey_widgettitle).'", arial, verdana; }';
		}
		}


		// Widget title
		$fontkey_widgetitemtitle = get_theme_mod('onepiece_style_fonts_widgetitemtitle', $fontkey_default ); // defaults to arial
		if($fontkey_widgetitemtitle != 'default'){
			$css_element = '.widgetpadding ul li h4';
		if( strpos($fontkey_widgetitemtitle, '__')  ){
			// default is local font
			$fontcode .= generate_font_css($fontkey_widgetitemtitle,$css_element);
		}else if($fontkey_widgetitemtitle != 'arial'){
			// default is google font
		    $googlefontlist .= '|'.$fontkey_widgetitemtitle;
			$fontcode .= "\n";
			$fontcode .= $css_element.'{ font-family: "'.str_replace('+', ' ', $fontkey_widgetitemtitle).'", arial, verdana; }';
		}
		}



		if( !empty($googlefontlist) ) echo '<link href="https://fonts.googleapis.com/css?family='.$googlefontlist.'" rel="stylesheet">';


		if( !empty( $fontcode) ) echo '<style>'.$fontcode.'</style>';

}

// ! just added the function call on end htmlhead
//add_action( 'wp_enqueue_scripts', 'add_fonts_frontend' );
//add_action('wp_head', 'add_fonts_frontend', 9999 );





?>
