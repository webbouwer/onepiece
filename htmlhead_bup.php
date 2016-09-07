<?php // html head
$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);
echo '<!DOCTYPE HTML><html '; 
language_attributes(); 
echo '><head><meta http-equiv="Content-Type" content="text/html; charset='.get_bloginfo( 'charset' ).'" />';
wp_enqueue_script("jquery");
// basic wp meta 
wp_head(); // http://codex.wordpress.org/Function_Reference/wp_head 
$site_description = get_bloginfo( 'description' );
echo 	'<meta name="description" content="'.$site_description.'">'
	.'<meta name="keywords" content="wordpress theme,theme setup,basic theme,custom theme">'
	.'<link rel="canonical" href="'.home_url(add_query_arg(array(),$wp->request)).'">'
	.'<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'" />'
	.'<link rel="shortcut icon" href="images/favicon.ico" />'
	.'<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/style.css" />'
	.'<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/'.get_theme_mod('onepiece_identity_stylelayout_stylesheet', 'default.css').'" />';




// mobile meta 
/* echo '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>'; */

if($mobile){
echo '<meta name="viewport" content="initial-scale=1.0, width=device-width" />';
}else if ( ! isset( $content_width ) ) {
$content_width = 960;
}

global $post;
$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
if($pageTemplate == 'gallery.php')
{
// custom gallery scripts
}


   


// slider js lib codes
if( ( ( 
get_theme_mod('onepiece_content_sliderbar_display', 'default' ) != 'none' && get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' ) != 'uncategorized') 
|| 
( get_post_meta(get_the_ID(), "pagetheme_slide_displaytype", true) != 'none' && get_post_meta(get_the_ID(), "pagetheme_slide_selectbox", true) != 'uncategorized' ) 
)
&& get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replacemargin' 
&& get_post_meta(get_the_ID(), "meta-page-headerimage", true) != 'replace'   
){
 
if(!is_single() || get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replace' ){
 
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.tools.min.js"></script>';
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.easing.1.2.js"></script>';
// jquery Anything Slider | http://css-tricks.com/examples/AnythingSlider/ | https://github.com/ProLoser/AnythingSlider/wiki/Setup 
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.min.js"></script>';
// Anything Slider optional FX extension
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.fx.min.js"></script>'; 

}
}

// default js codes
echo '<script src="'.get_template_directory_uri().'/assets/global.js" type="text/javascript" language="javascript"></script>';


echo '<style type="text/css">';
echo '#headercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logo_maxwidth',240 ).'px !important; }';
echo '#footercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logosmall_maxwidth',80).'px !important; }';

echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_small_width', 512).'%; max-width:'.get_theme_mod('onepiece_responsive_small_outermargin', 480 ).'px; margin:0 auto; }'; 

// single column small /  medium
echo '@media screen and (max-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '#maincontent,#mainsidebar,#pagesidebarcontainer,#sidebar2{float:none !important;width:100% !important;margin:0px auto;}';
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_small_max', 512 ).'px) {';
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_medium_width', 96 ).'%;max-width:'.get_theme_mod('onepiece_responsive_medium_outermargin', 1024 ).'px; }';
echo '}';
echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_medium_max', 1200 ).'px) {';
echo '.outermargin { max-width:'.get_theme_mod('onepiece_responsive_large_outermargin', 1600 ).'px; }';
echo '}';
echo '</style>';

echo '</head><body '; body_class(); 
echo '><div id="pagecontainer"';
if($mobile){
echo ' class="mobile">';
}else{
echo '>';
}
?>