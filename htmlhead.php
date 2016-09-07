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

$useheaderimage = get_post_meta($post->ID, "meta-page-headerimage", true);
$usepostfeaturedimage = get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default');

// slider js lib codes
if( get_post_meta($post->ID, "pagetheme_slide_displaytype", true) != 'none' && ( ( 
get_theme_mod('onepiece_content_sliderbar_display', 'default' ) != 'none' && get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' ) != 'uncategorized') 
|| 
( get_post_meta($post->ID, "pagetheme_slide_displaytype", true) != 'none' && get_post_meta($post->ID, "pagetheme_slide_selectbox", true) != 'uncategorized' ) 
)
&& ( get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replacemargin' || get_post_meta($post->ID, "onepiece_content_sliderbar_display", true) == 'topfooter')
&& ( get_post_meta($post->ID, "meta-page-headerimage", true) != 'replace' || get_post_meta($post->ID, "pagetheme_slide_displaytype", true) == 'topfooter' )  
){
if( !is_single() || get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replace' ){
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.tools.min.js"></script>';
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.easing.1.2.js"></script>';
// jquery Anything Slider | http://css-tricks.com/examples/AnythingSlider/ | https://github.com/ProLoser/AnythingSlider/wiki/Setup 
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.min.js"></script>';
// Anything Slider optional FX extension
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.fx.min.js"></script>'; 

// default slider options
$sliderdefaultdisplay = get_theme_mod('onepiece_content_sliderbar_display', 'default' );
$sliderdefaultcat = get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' );
$sliderdefaultheight = get_theme_mod('onepiece_content_sliderbar_height', '60' );
$sliderdefaultwidth = get_theme_mod('onepiece_content_sliderbar_width', 'full' );

// page slider options
$sliderdisplay = get_post_meta($post->ID, "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta($post->ID, "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta($post->ID, "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta($post->ID, "pagetheme_slide_displaywidth", true);

// get html for default slider and page slider if available
if( ( $sliderdefaultdisplay == 'replaceheader' || $sliderdefaultdisplay == 'belowheader') && $sliderdefaultcat != 'uncategorized' ){
    //$headerstyle = 'style="height:'.$sliderdefaultheight.'%;min-height:'.$sliderdefaultheight.'%;"';
	$displaytype = $sliderdefaultheight;
}
if( ( $sliderdisplay == 'replaceheader' || $sliderdisplay == 'belowheader') && $slidercat != 'uncategorized' && $sliderheight != 'variable' ){
    //$headerstyle = 'style="height:'.$sliderheight.'%;min-height:'.$sliderheight.'%;"';
	$displaytype = $sliderheight;
}
if( $sliderdisplay == 'topfooter' ){
    $footerheight = $sliderheight;
}elseif($sliderdefaultdisplay == 'topfooter'){
    $footerheight = $sliderdefaultheight;
}

// START output slider codes ?>

<script type="text/javascript" language="javascript">
jQuery(function($) {

$(window).resize(function() {
<?php if( $displaytype != 'variable' && $useheaderimage != 'hide' ){ 
echo  '$("#sliderbox-head").css("min-height", ( $(window).height() / 100) * '.$displaytype.' );';
}
if( $sliderdisplay == 'topfooter' || $sliderdefaultdisplay == 'topfooter' ){
echo  '$("#sliderbox-footer").css("min-height", ( $(window).height() / 100) * '.$footerheight.' );';
}
?>
});

jQuery(document).ready(function($) {
$(window).trigger('resize'); // adjust slider on resize
$('.sliderarea').anythingSlider({
			
    theme		: 'fullscreen', 
    expand		: true, 
    mode                : 'fade',
    resizeContents      : true,
    delay               : 5000, 
    resumeDelay         : 5000,
    animationTime       : 400,       
    easing              : "swing",
    buildArrows         : true,
    buildNavigation     : false, 
    navigationSize      : 5,
    buildStartStop      : false,
    hashTags            : true,
    autoPlay            : true,
    startPanel          : 1,
    startStopped        : false,
    forwardText         : ">", 
    backText            : "<",

    stopAtEnd           : false,     
    playRtl             : false,    
    startText           : "Start",   
    stopText            : "Stop",   
    //delayBeforeAnimate : 500,	
    onSlideComplete : function(slider){ // update the hash AFTER the slide is in view (so we can animate)
	window.location.hash = '#' + slider.$currentPage[0].id;
	$('#current').html(window.location.hash); // get current
    },
    onInitialized: function(e, slider) {
        //setupSwipe(slider);
    }
/*	
    navigationFormatter : function(i, panel){
	return ['Webdesign', 'Interactief', 'Ontwerp', 'Ontwikkeling'][i - 1];
    },
*/

}); // end anythingSlider
}); // end ready
}); // end jQuery $		
</script>			
<style type="text/css">

<?php if( ( $displaytype == '50' && $mobile ) || $displaytype == '66' || $displaytype == '75' || $displaytype == '80' || $displaytype == '100' ){ ?>
div#topbar
{
position:absolute;
z-index:99;
width:100%;
top:0px;
left:0px;
z-index:59;
}

<?php } ?>


div#sliderbox-head,
div#sliderbox-footer
{
position:relative;
width: 100%; 
<?php 
/* 
if( $mobile ){ 
echo 'max-height:780px;'; 
}
if( $displaytype == 'variable'){
echo 'height: auto;'; 
}else{ 
echo 'height: 100%'; 
} 
*/ ?>
}
.sliderarea {
width: 100%; 
min-height: 100%; 
list-style: none;
overflow-y: auto;
overflow-x: hidden;
}

.sliderarea li.panel 
{
position:relative;
width:100%;
min-height:100%;
background-position:center;
background-size:cover;
background-origin: border-box;
background-repeat: no-repeat;
padding-top:0px;
margin-bottom:0px;
}

div.anythingSlider {
	display: block;
	margin: 0 auto;
	overflow: visible !important; 
	position: relative;
	padding: 0 0 0 0;
}
div.anythingSlider .anythingWindow {
	overflow: hidden;
	position: relative;
	width: 100%;
	min-height: 100%;
}


/* see style.css */
div.anythingSlider span.arrow
{
position:absolute;
top:48%;
padding:10px;
background-color:#ffffff;
z-index:89;
}
div.anythingSlider span.back
{
left:5px;
}
div.anythingSlider span.forward
{
right:5px;
}
div.slidebox
{
}
.anythingBase {
	background: transparent;
	list-style: none;
	position: absolute;
	overflow: visible !important;
	top: 0;
	left: 0;
	margin: 0;
	padding: 0;
} 
.anythingBase .panel {
	background: transparent;
	display: block;
	overflow: hidden;
	float: left;
	padding: 0;
	margin: 0;
}
.anythingBase .panel.vertical {
	float: none;
}
.anythingSlider .fade .activePage { z-index: 1; }
.anythingSlider .fade .panel { z-index: 0; }


@media screen and (min-width: 780px ){

}

</style>

<?php 
}
} // END output slider codes

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