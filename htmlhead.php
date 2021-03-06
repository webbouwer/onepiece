<?php // html head
/**
 * MAIN HTML DOCUMENT HEADER
 * HTML HEAD CODE AND BODY OPEN TAG ..</head><body>
 * htmlhead.php 
 * Document php prerun & global htmlhead setup
 * incl. in all pages (pagetemplate specific)
 */


/**
 * MOBILE DETECT (PHP)
 * 
 * $mobile true/false from function mobile_device_detect() from http://detectmobilebrowsers.mobi 
 * @require functions.php (include /assets/mobile_detect.php)
 */
 
$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);

// $post object document 
global $post;

// $pageTemplate 'TEMPLATE_FILENAME' (gallery.php,page.php,index.php)
$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

// default SEO
$seodesc = get_theme_mod('onepiece_identity_panel_seo_description', 'Check out this cool website!');
$seokeywords = get_theme_mod('onepiece_identity_panel_seo_keywords', 'cool, website, webdesign');
$seotrackcode = get_theme_mod('onepiece_identity_panel_seo_trackcode', '');

/**
 * PAGE TEMPLATE GALLERY
 * gallery.php
 */ 
if($pageTemplate == 'gallery.php'){ 
    

/** 
 * $values variables page template
 */ 
 
$values = get_post_custom( $post->ID );

// gallery template settings
$selected = isset( $values['theme_gallery_category_selectbox'] ) ? $values['theme_gallery_category_selectbox'][0] : '';
$gallerydefault = isset( $values['onepiece_content_gallery_category'] ) ? $values['onepiece_content_gallery_category'][0] : '';
$pagetitle = isset( $values['theme_gallery_pagetitle_selectbox'] ) ? $values['theme_gallery_pagetitle_selectbox'][0] : '';
$filters = isset( $values['theme_gallery_filters_selectbox'] ) ? $values['theme_gallery_filters_selectbox'][0] : '';
$itemminh = isset( $values['theme_gallery_items_minheight'] ) ? esc_attr( $values['theme_gallery_items_minheight'][0] ) : 160;
$itembigh = $itemminh  * 2;
if($mobile){
$itemminh = $itemminh / 1.5;
$itembigh = $itemminh * 1.8;
}

$maxinrow = isset( $values['theme_gallery_items_maxinrow'] ) ? $values['theme_gallery_items_maxinrow'][0] : 5;
$clickaction = isset( $values['theme_gallery_items_clickaction'] ) ? $values['theme_gallery_items_clickaction'][0] : 'poppost';
$itemview = isset( $values['theme_gallery_items_itemview'] ) ? $values['theme_gallery_items_itemview'][0] : 'right';

// $topcat default gallery category
if($selected){
$topcat = $selected;
}elseif( $gallerydefault && $gallerydefault != '' ){
$topcat = $gallerydefault;
}else{
$topcat = 'uncategorized';
}


} // end gallery page template

/**
 * HTML HEAD THEME CORE
 * index.php, page.php, gallery.php
 */ 
// html doc head start
echo '<!DOCTYPE HTML><html '; 
language_attributes(); // wp language
echo '><head>'; 
echo '<meta http-equiv="Content-Type" content="text/html; charset='.get_bloginfo( 'charset' ).'" />';

wp_enqueue_script("jquery");    // default wp jquery
wp_head();                      // http://codex.wordpress.org/Function_Reference/wp_head 

// generate header meta info
$site_description = get_bloginfo( 'description' );

if( is_category() ){
	$cat = get_query_var('cat');
	$metacat= strip_tags(category_description($cat));
	$site_description =  $metacat;
}else
	if( !empty($seodesc)){
		$site_description = $seodesc;
}

$site_keywords = 'cool, website, amazing, webdesign';
if( !empty($seokeywords)){
$site_keywords = $seokeywords;
}

echo '<meta name="description" content="'.$site_description.'">'
	.'<meta name="keywords" content="'.$site_keywords.'">'
	.'<link rel="canonical" href="'.home_url(add_query_arg(array(),$wp->request)).'">'
	.'<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'" />'
	.'<link rel="shortcut icon" href="images/favicon.ico" />'
	.'<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/style.css" />'
	.'<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/'.get_theme_mod('onepiece_identity_stylelayout_stylesheet', 'default.css').'" />';

/**
 * share meta info 
 * ! should get featured image (header)
 * linkedin - https://www.linkedin.com/help/linkedin/answer/46687
 */
echo '<meta property="og:title" content="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>'
	.'<meta property="og:image" content="'.get_theme_mod( 'onepiece_identity_featured_image' ).'"/>'
	.'<meta property="og:description" content="'.get_theme_mod( 'onepiece_identity_panel_sharing_description' ).' '.get_bloginfo( 'description' ).'"/>'
	.'<meta property="og:url" content="'.esc_url( home_url( '/' ) ).'" />';

// mobile meta 
/* echo '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>'; */
if($mobile){
	echo '<meta name="viewport" content="initial-scale=1.0, width=device-width" />';
	if ( ! isset( $content_width ) ) {
	$content_width = get_theme_mod('onepiece_responsive_small_outermargin', 512 );
	}
}else if ( ! isset( $content_width ) ) {
	$content_width = get_theme_mod('onepiece_responsive_medium_outermargin', 1024 );
}


// Frontend user login  
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') != 'none' || is_active_widget( false, false, 'onepiece_login_widget', true ) ){
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/userlogin.js"></script>'; 
}

// default style sizes
$stylelayout_fontsize = get_theme_mod('onepiece_identity_stylelayout_fontsize', 5);
$stylelayout_spacing = get_theme_mod('onepiece_identity_stylelayout_spacing', 5);
$stylelayout_speed = 100 * get_theme_mod('onepiece_identity_stylelayout_speed', 5);

// icons
$loaderboxicon = get_theme_mod('onepiece_identity_icons_loader', esc_url( get_template_directory_uri() ).'/icons/loader_icon_circle_default.gif');

// topbar
$topbarbehavior = get_theme_mod('onepiece_elements_topmenubar_behavior', 'rela');
$topbarbgfixed = get_theme_mod('onepiece_elements_topmenubar_bgfixed', 'keep');
$topbaropacity = get_theme_mod('onepiece_elements_topmenubar_opacity', 20);
// + colors 

// mainmenubar
$mainmenubarplace = get_theme_mod('onepiece_elements_mainmenubar_placement', 'below');
$mainmenubarbehavior = get_theme_mod('onepiece_elements_mainmenubar_behavior', 'stat');
$mainmenubarminisize = get_theme_mod('onepiece_elements_mainmenubar_minisize', 'always');
 
// header replacement variables for page/post feautured images
$useheaderimage = get_post_meta($post->ID, "meta-page-headerimage", true);
$usepostfeaturedimage = get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default');

$thumbelarge = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

// get childpage options
$childpagedisplay = get_post_meta($post->ID, "meta-box-display-childpages", true);

// get main popup options
$popupdefaultdisplay = get_theme_mod('onepiece_content_mainpopup_display', 'medium' );
$popupoverlaycolor = get_theme_mod('onepiece_content_mainpopup_overlaycolor', '#ffffff' );
$popupoverlayopacity = get_theme_mod('onepiece_content_mainpopup_overlayopacity', 20 );


/**
 * PAGE HEADER IMAGE / REPLACE / SLIDER 
 * :jquery anythingslider 
 */ 

// detect variables for available sliders
// add slider code if not hidden by page settings
// 1 default slider is set with category available
// 2 page slider is set with category available
// 3 sliders are not replaced by page/post featured images when positioned in the header
// 4 not showing a single post with feautured image replacement
if(
 (get_post_meta($post->ID, "pagetheme_slide_displaytype", true) != 'none' && ( ( 
get_theme_mod('onepiece_content_sliderbar_display', 'default' ) != 'none' 
&& get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' ) != 'uncategorized') // 1
|| ( get_post_meta($post->ID, "pagetheme_slide_displaytype", true) != 'none' && get_post_meta($post->ID, "pagetheme_slide_selectbox", true) != 'uncategorized' ) 
) // 2
&& ( get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replacemargin' || get_post_meta($post->ID, "onepiece_content_sliderbar_display", true) == 'topfooter') // 3
&& ( get_post_meta($post->ID, "meta-page-headerimage", true) != 'replace' || get_post_meta($post->ID, "pagetheme_slide_displaytype", true) == 'topfooter' )  
&& (!is_single() || get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replace')  )
|| get_theme_mod('onepiece_content_sliderbar_display', 'default' ) != 'hide'

){ // 4

// include jquery and anythingslider javascript libs
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.tools.min.js"></script>';
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.easing.1.2.js"></script>';
// jquery Anything Slider | http://css-tricks.com/examples/AnythingSlider/ | https://github.com/ProLoser/AnythingSlider/wiki/Setup 
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.min.js"></script>';
// Anything Slider optional FX extension
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.fx.min.js"></script>'; 

// get default slider options
$sliderdefaultdisplay = get_theme_mod('onepiece_content_sliderbar_display', 'default' );
$sliderdefaultcat = get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' );
$sliderdefaultheight = get_theme_mod('onepiece_content_sliderbar_height', '60' );
$sliderdefaultwidth = get_theme_mod('onepiece_content_sliderbar_width', 'full' );

// get page slider options
$sliderdisplay = get_post_meta($post->ID, "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta($post->ID, "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta($post->ID, "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta($post->ID, "pagetheme_slide_displaywidth", true);

$displaytype = $sliderdefaultheight;

// get html for default slider and page slider if available
if( ( $sliderdefaultdisplay == 'replaceheader' || $sliderdefaultdisplay == 'belowheader' ) && $sliderdefaultcat != 'uncategorized'  && $sliderdisplay != 'none'){
    //$headerstyle = 'style="height:'.$sliderdefaultheight.'%;min-height:'.$sliderdefaultheight.'%;"';
	$displaytype = $sliderdefaultheight;
}
if( $sliderheight && ( $sliderdisplay == 'replaceheader' || $sliderdisplay == 'belowheader') && $slidercat != 'uncategorized' && $sliderheight != 'variable'  && $sliderdisplay != 'none'){
    //$headerstyle = 'style="height:'.$sliderheight.'%;min-height:'.$sliderheight.'%;"';
	$displaytype = $sliderheight;
}


if( $sliderdisplay == 'topfooter' ){
    $footerheight = $sliderheight;
}elseif($sliderdefaultdisplay == 'topfooter'){
    $footerheight = $sliderdefaultheight;
}

// output html slider codes 
?>
<script type="text/javascript" language="javascript">
jQuery(function($) {


/*
Loaderbox icon image
*/
//$('.loadbox span').html('<img width="100%" height="auto" src="<?php echo $loaderboxicon;?>" alt="loader" />');

jQuery(document).ready(function($) {
/*
Header Height Resize
*/
var rtime;
var timeout = false;
var delta = 20;
$(window).resize(function() {

	rtime = new Date();
    if (timeout === false) {
        timeout = true;
        setTimeout( resizeend , delta);
    }

});


function resizeend() {
	if(new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
    }else{
        timeout = false;
		sizeHeaderElements();
    }
}


function sizeHeaderElements(){

		var rMinHeight = $('#topbar .outermargin').outerHeight();
		var rSetHeight = ($(window).height() / 100) * <?php echo $displaytype; ?>;
		//var rToHeight = (  rMinHeight > rSetHeight ? rMinHeight : rSetHeight );
		$("#sliderbox-head").css("min-height", rMinHeight );

		// check if slider active > slide min-height
		if( $('#sliderbox-head .anythingSlider').length > 0 ){
			$("#sliderbox-head").css("min-height", rSetHeight );
		}

		$('#headerbar .bglayer').css( 'height' , $('#headerbar').height() );	// reset topbar bglayer height

		<?php
		/*
		 * Place header overlay elmenent
		 */
		$headeroverlaydisplay = get_theme_mod('onepiece_elements_headerimage_overlay', 'none');
		if($headeroverlaydisplay != 'none'){
		?>

		if(!$('.header-overlay').length){
			//alert('check overlay!');
			var ol = '<div class="header-overlay"></div>';
			if($('#headerbar').length){
				$('#headerbar').append(ol);
			}else if($('#sliderbox-head').length){
			    $('#sliderbox-head').append(ol);
			}

		}

		<?php
		}
		?>

}

/* AnythingSlider */
$(window).trigger('resize'); // adjust slider on resize

// see https://github.com/CSS-Tricks/AnythingSlider/wiki/Setup
$('.sliderarea').anythingSlider({
    theme		        : 'fullscreen', 
    expand		        : true, 
    mode                : 'fade',
    resizeContents      : true,
    delay               : <?php echo $stylelayout_speed*10; ?>, 
    resumeDelay         : <?php echo $stylelayout_speed*4; ?>,
    animationTime       : <?php echo $stylelayout_speed*2; ?>,       
    easing              : "swing",
    buildArrows         : true,
    buildNavigation     : false, 
    navigationSize      : 5,
    buildStartStop      : false,
    hashTags            : false,
    autoPlay            : true,
	autoPlayLocked      : false, 
    startPanel          : 1,
    startStopped        : false,
    forwardText         : '<webicon icon="fa:chevron-right"/>', // >
    backText            : '<webicon icon="fa:chevron-left"/>', // <
    stopAtEnd           : false,     
    playRtl             : false,    
    startText           : "Start",   
    stopText            : "Stop",  
    enableKeyboard      : true,
    toggleArrows        : true,
    //delayBeforeAnimate : 500,	
    onSlideComplete : function(slider){ // update the hash AFTER the slide is in view (so we can animate)
	//window.location.hash = '#' + slider.$currentPage[0].id;
	//$('#current').html(window.location.hash); // get current
    },
    onInitialized: function(e, slider) {
        setupSwipe(slider); // on overlay element
    }
    /*	add a menu
    navigationFormatter : function(i, panel){
	return ['Webdesign', 'Interactief', 'Ontwerp', 'Ontwikkeling'][i - 1];
    },
    */
}).anythingSliderFx({
				// base FX definitions
				// '.selector' : [ 'effect(s)', 'size', 'time', 'easing' ]
				// 'size', 'time' and 'easing' are optional parameters, but must be kept in order if added
				//'.contentbox h3'       : [ 'bottom fade', '200px', '600', 'easeOutExpo' ],
	
				// https://github.com/CSS-Tricks/AnythingSlider-Fx-Builder
				//'.contentbox h3'       : [ 'fade'  ],
				'.contentbox h3,.contentbox div.excerpt'       : [ 'listLR', 'auto', '1000', 'easeOutExpo' ]
				
}); // end anythingSlider
}); // end ready
}); // end jQuery $	

var setupSwipe = function(slider) {

    var time = 1000,
        // allow movement if < 1000 ms (1 sec)
        range = 50,
        // swipe movement of 50 pixels triggers the slider
        x = 0,
        y = 0,
        t = 0,
        touch = "ontouchend" in document,
        st = (touch) ? 'touchstart' : 'mousedown',
        mv = (touch) ? 'touchmove' : 'mousemove',
        en = (touch) ? 'touchend' : 'mouseup';

		/*
		 * Add swipe events to another layer ( in the background of clickable content elements )
		 */
		$('<div class="swipe-overlay"></div>').appendTo(slider.$window).bind(st, function(e) {
            // prevent image drag (Firefox)//
			e.preventDefault();
            t = (new Date()).getTime();
            x = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX;
            y = e.originalEvent.touches ? e.originalEvent.touches[0].pageY : e.pageY;
        })
        .bind(en, function(e) {
            t = 0;
            x = 0;
            y = 0;
        })
        .bind(mv, function(e) {
            e.preventDefault();
            var newx = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX,
                r = (x === 0) ? 0 : Math.abs(newx - x),
                // allow if movement < 1 sec
                ct = (new Date()).getTime();
            
	    	var newy = e.originalEvent.touches ? e.originalEvent.touches[0].pageY : e.pageY,
                v = (y === 0) ? 0 : Math.abs(newy - y),
                // allow if movement < 1 sec
                dt = (new Date()).getTime();
		
            if (t !== 0 && ct - t < time && r > range) {
                if (newx < x) {
                    slider.goForward();
                }
                if (newx > x) {
                    slider.goBack();
                }
          
                t = 0;
                x = 0;
            }
	    var yscrolling = 0;

	    if (t !== 0 && dt - t < time && v > range && yscrolling == 0) {
                if ( newy < y ) {
                    //alert('scroll down'); 
				$('html, body').animate({
					scrollTop: $("#contentcontainer").offset().top - $("#topbar").outerHeight(true)
				},{
        			duration: <?php echo $stylelayout_speed*4; ?>,
        			complete: function () { 
                		
        			}
      			});
                }

                if ( newy > y ) {
					$('html, body').animate({
					scrollTop: $("#topbar").offset().top 
				},{
        			duration: <?php echo $stylelayout_speed/2; ?>,
        			complete: function () {
        			}
      			});

                }
                t = 0;
                y = 0;
            }
  });
  
}; // END TOUCH SCROLL SLIDER



</script>			
<style type="text/css">
<?php /* TOPBAR BEHAVIOR */
if( ( $displaytype == '50' && $mobile ) || ($displaytype == '66' || $displaytype == '75' 
|| $displaytype == '80' || $displaytype == '100' ) && $childpagedisplay != 'fade' && $topbarbehavior != 'rela' && $topbarbehavior != 'relf'){

$toppos = 'absolute'; 

}else{

if( $topbarbehavior != 'rela' && $topbarbehavior != 'relf'){
$toppos = 'absolute'; 
}else{ 
$toppos = 'relative';
}
}
?>

/*
 * SLIDER STYLING 
 */
div#sliderbox-head,
div#sliderbox-footer
{
position:relative;
width: 100%; 
height: 100%;
<?php if( $mobile ){ /* available mobile detect */ 
echo 'max-height:680px;'; 
} ?>
}
#headerbar
{
<?php  if( $mobile ){ /* available mobile detect */ 
echo 'max-height:680px;'; 
} ?>
}

/* Slider decoration layers */
#sliderbox-head .topelement,
#sliderbox-head .bottomelement {
position: absolute;
z-index: 40;
}
#sliderbox-head .topelement {
width: 100%;
height: 50%;
top: 0;
right: 0;
}
#sliderbox-head .bottomelement {
width: 100%;
height: 50%;
bottom: 0;
left: 0;
}

/* Slider swipe overlay */
.swipe-overlay {
position: absolute;
width: 100%;
height: 100%;
top: 0;
left: 0;
z-index: 50;
}

/* Slider default styles */
.sliderarea {
position:relative;
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
    position:relative;
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
div.anythingSlider span.arrow
{
position:absolute;
top:48%;
padding:0px;
z-index:80;
}
div.anythingSlider span.back
{
margin-left:1%;
}
div.anythingSlider span.forward
{
margin-right:1%;
}

div.anythingSlider span.back webicon,
div.anythingSlider span.forward	webicon
{
width:24px !important;
}

div.anythingSlider div.slidebox,
div.anythingSlider div.slidebox div.outermargin
{
position:relative;
height:100%;
}
.outermargin div.slidebox div.outermargin
{
width:100%; /* if inside another outermargin */
}

div.anythingSlider div.slidebox .contentbox
{
position:absolute;
bottom:8%;
left:0%;
width:90%;
z-index: 65;
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



/* add medium/large screen styling */
@media screen and (min-width: 780px ){
div.anythingSlider div.slidebox .contentbox
{
position:absolute;
bottom:4%;
left:0%;
width:40%;
}
}

</style>

<?php
}else{
	$toppos = 'relative';
} // end if header area slider/image
?>

<style type="text/css">

/* final header styling	*/
div#topbar
{
position:<?php echo $toppos; ?>;
width:100%;
z-index:69;
}
div#topbar.minified
{
position:<?php if( $topbarbehavior == 'fixe' || $topbarbehavior == 'mini' || $topbarbehavior == 'relf' ){ echo 'fixed'; }else{ echo 'absolute';} ?>;
top:0px;
left:0px;
}

/* POPUP STYLING */
<?php // popup variable display
if($mobile){
$w = 96;
$l = 2;
}else{
$w = 80;
$l = 10;
if( $popupdefaultdisplay == 'large'){
$w = 100;
$l = 0;
}elseif( $popupdefaultdisplay == 'small'){
$w = 60;
$l = 20;
}
$c = $popupoverlaycolor;
$o = ( 100 - $popupoverlayopacity) / 100;
}
?>

.popupcloak
{
background-color:<?php echo $c; ?>;
opacity:<?php echo $o; ?>;
}
#mainpopupbox .popupcontent
{
width:<?php echo $w; ?>%;
}

</style>

<?php

/**
 * HTML HEAD THEME DEFAULT CSS/JS
 * assets/global.js, assets/customizer.php
 
 * default js codes
 */
 
/* echo '<script src="'.get_template_directory_uri().'/assets/global.js" type="text/javascript" language="javascript"></script>'; */
/**
 * CSS GLOBAL SETTINGS
 * htmlhead.php, assets/customizer.php, assets/global.js, 
 */

echo '<style type="text/css">';
echo '#headercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logo_maxwidth',240 ).'px !important; }';

echo '#headerbar { min-height:'.get_theme_mod('onepiece_elements_headerimage_height',280).'px; }'; 

echo '#footercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logosmall_maxwidth',80).'px !important; }';
 
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_small_width', 512).'%; max-width:'.get_theme_mod('onepiece_responsive_small_outermargin', 480 ).'px; margin:0 auto; }'; 

// single column small /  medium
echo '@media screen and (max-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '#maincontent,#mainsidebar,#pagesidebarcontainer,#sidebar2,#subcontentbarmargin,#subcontentsidebar{float:none !important;width:100% !important;margin:0px auto;}';
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_small_max', 512 ).'px) {';
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_medium_width', 96 ).'%;max-width:'.get_theme_mod('onepiece_responsive_medium_outermargin', 1024 ).'px; }';
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_small_max', 512 ).'px) and (max-width: '.(get_theme_mod('onepiece_responsive_medium_max', 1200 )-1).'px) {';
echo '#headercontainer .logobox { width:60% !important; }';
echo '}';


echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_medium_max', 1200 ).'px) {';
echo '.outermargin { max-width:'.get_theme_mod('onepiece_responsive_large_outermargin', 1600 ).'px; }';
echo '}';
echo '</style>';

/**
 * JS TOPBAR MINIFIED BEHAVIOR
 * htmlhead.php, assets/customizer.php, assets/global.js, 
 */ 
// add js code for minified behavior

?>
<script type="text/javascript" language="javascript">
jQuery(function ($) { 

$(document).ready(function() {   

	<?php if($topbarbgfixed == 'keep'){ ?>
	/**
	 * TOPBAR ADD BG
	 */	
	$("#topbar").append( $("<div>")
      .attr('class', 'minifiedtopbarbg')
      .css({
        /*backgroundColor:'#ffffff',  customize variable */
        position: 'absolute',
        top:0,
        left:0,
        opacity:<?php echo ( 100 - $topbaropacity) / 100; ?>,
        zIndex:-1,
        width:'100%', 
        height:'100%'
      }) 
   );
   <?php 
   } 
	?>
  
/* 
 * Mainmenu sticky / minisize
 */
var menubox;

<?php

/* 
 * Mainmenu minisize
 */	
if( $mainmenubarminisize != 'none' ){
echo 'var mainmenuminisize = "'.$mainmenubarminisize.'";';
?>

var menubox = $('#site-navigation nav').prepend('<div class="navcontrol"><div class="menu-button"><?php echo __('Menu', 'onepiece'); ?></div></div>');
var menubutton = $('#site-navigation nav .menu-button').hide();
var menupanel = $('#site-navigation nav div ul.menu');

function setminisizemenu(){

	if( !menubox.hasClass('minisize') ){
	menubox.addClass('minisize')
	menubutton.show();
	menupanel.hide();
    }
}
function resetminisizemenu(){

	if( menubox.hasClass('minisize') ){
	menubutton.html('<?php echo __('Menu', 'onepiece'); ?>').hide();
	menubox.removeClass('minisize');
	menupanel.show(); // default text / image
	
	}

}

menubox.on( 'click' ,'.menu-button', function(){
	$(this).html('<?php echo __('Menu', 'onepiece'); ?>'); // default text / image
	menupanel.slideToggle();
	menubutton.toggleClass('open');
	if(menubutton.hasClass('open')){
	menubutton.html('<?php echo __('Close', 'onepiece'); ?>'); // when open show close text /image
	}
});

// always menu minisize
if( mainmenuminisize == 'always' ){
	setminisizemenu();
}

<?php
if( $mainmenubarminisize == 'respon' || $mainmenubarminisize == 'respon2'){

if( $mainmenubarminisize == 'respon'){
echo  'var width_responsive_menu = '.get_theme_mod('onepiece_responsive_small_max', 512).';';
}
if( $mainmenubarminisize == 'respon2'){
echo  'var width_responsive_menu = '.get_theme_mod('onepiece_responsive_medium_max', 960).';';
}
?>

/* on resize */
	var resizeM;
	$(window).resize(function() {
    		clearTimeout(resizeM);
    		resizeM = setTimeout(doneResizing, 20);
	});
	
	function doneResizing(){
		if( $(window).width() < width_responsive_menu){
			setminisizemenu();
		}else{
			resetminisizemenu();
		}

	}
	
	doneResizing(); // ondoc ready trigger
<?php
}

}
?>


/**
 * TOPBAR FIXED / STICKY / MINIFY ONSCROLL
 */ 
$(window).on("mousewheel scroll", function() {

// sticky
<?php
if( $topbarbehavior == 'mini' || $topbarbehavior == 'fixe' || $topbarbehavior == 'relf' ){
?>
if( $(window).scrollTop() > 0 && !$("#topbar").hasClass('minified')){

	/**
	 * FIX TOPBAR & ADD BG
	 */
	 $("#topbar .minifiedtopbarbg").remove();
     $("#topbar").addClass('minified').append( $("<div>")
      .attr('class', 'minifiedtopbarbg')
      .css({
        /*backgroundColor:'#ffffff',  customize variable */
        position: 'absolute',
        top:0,
        left:0,
        opacity:<?php echo ( 100 - $topbaropacity) / 100; ?>,
        zIndex:-1,
        width:'100%', 
        height:'100%'
      }) 
    );

 	<?php if($topbarbehavior == 'mini' || $topbarbehavior == 'relf'){ ?>
	/**
	 * MINIFY TOPBAR & BG
	 */
   $("#topbar .minifiedtopbarbg").animate({
       opacity:<?php echo ( 100 - $topbaropacity) / 100; ?>,
   }, <?php echo $stylelayout_speed; ?>);
   $(".logobox a img").stop().animate({
				width:'<?php echo get_theme_mod('onepiece_identity_panel_logo_minwidth',80).'px'; ?>',
   }, <?php echo $stylelayout_speed; ?>);

  <?php } ?>

}else if( $(window).scrollTop() <= 0 && $("#topbar").hasClass('minified') ){

   <?php if($topbarbgfixed != 'keep'){ ?>
	/**
	 * RELEASE FIXED / MINIFIED TOPBAR & BG
	 */ 
   if( $("#topbar .minifiedtopbarbg") && $("#topbar .minifiedtopbarbg") != 'undefined'){
   $("#topbar .minifiedtopbarbg").animate({
       opacity:0,
   }, <?php echo $stylelayout_speed; ?>, function(){
      this.remove();
   });
   }
   <?php } ?>
   
   $(".logobox a img").stop().animate({
				width:'<?php echo get_theme_mod('onepiece_identity_panel_logo_maxwidth').'px'; ?>',
   }, <?php echo $stylelayout_speed; ?>);

   $("#topbar").removeClass('minified');

} // end minify logobox



<?php  
} // end minify logobox or fixed topbar

/** 
 * onscroll for fixed / minisize topbar:
 */
if( $mainmenubarbehavior == 'stic' && ( $topbarbehavior == 'fixe' || $topbarbehavior == 'mini' || $topbarbehavior == 'relf') ){
// #site-navigation or #topbar-navigation 
?>

/**
 * MAIN MENU FIXED IN TOPBAR ONSCROLL
 */ 
//$stickymenu_triggerheight = '$("#topbar").height()';

var stickymenutriggerheight = $("#topbar").height();
var offset = $('#site-navigation').offset();

if(  menubox && ( offset.top - $(window).scrollTop() ) < stickymenutriggerheight && !menubox.hasClass('sticky') ){
	
	/**
	 * POSITION MAIN MENU IN TOPBAR 
	 */
	menubox.addClass('sticky');
	if( $('#minibar-navigation').length > 0 ){
	$('#minibar-navigation').next().after(menubox);
	}else if( $('#topbar-navigation').length > 0 ){
	$('#topbar-navigation').after(menubox);
	}else{
	$('#topmenubar .outermargin .logobox').after(menubox);
	//$('#site-navigation .outermargin nav').prependTo( $('#topmenubar .outermargin') );
	}
	
  	if( mainmenuminisize == 'sticky' ){
    setminisizemenu();
	}
	
	if( mainmenuminisize == 'respon' || mainmenuminisize == 'respon2' ){
		if( menubutton.hasClass('open') ){
			menupanel.slideToggle();
			menubutton.toggleClass('open');
			menubutton.html('<?php echo __('Menu', 'onepiece'); ?>'); // when open show close text /image
		}
	}
		
	
}else if( (offset.top - $(window).scrollTop()) >= stickymenutriggerheight && menubox.hasClass('sticky')){
	
	
	if( mainmenuminisize == 'sticky' ){
   	resetminisizemenu();
	}

	<?php
	if($mainmenubarplace == 'content'){
	?>
	menubox.removeClass('sticky').appendTo("#site-navigation");
	<?php
	}else{ ?>
	menubox.removeClass('sticky').appendTo("#site-navigation .outermargin");
	<?php } ?>
	
	if( mainmenuminisize == 'respon' || mainmenuminisize == 'respon2' ){
		if( menubutton.hasClass('open') ){
			menupanel.slideToggle();
			menubutton.toggleClass('open');
			menubutton.html('<?php echo __('Menu', 'onepiece'); ?>'); // when open show close text /image
		}
	}
	
} // end  onscroll for fixed topbar

<?php
} // end topbarbehavior sticky / minisize
?>

}); /// endon scroll


<?php
/*
if($mainmenubarplace == 'below'){
?>
    //alert('!check!');
	if( ($('#sliderbox-head').length == 0 && $('#headerbar').length == 0)&& $('#site-navigation') ){
		//alert('!check!');
		// insert header placeholder
		//$('#maincontainer').css('margin-top', $("#headercontainer").height() );
		$("#headercontainer").append($('<div id="sliderbox-head" style="min-height:'+$("#topmenubar").height()+'px;"></div>'));
		$("#headercontainer").append($('#site-navigation'));
		//$('#topbarmenu').append($('#site-navigation'));
		// $('#headercontainer').prepend( $("#topbar") ); works only for maincontent
	}
<?php
}*/
?>
    //$(window).trigger('scroll');
	
});// end ready doc
});
</script>

<?php
/**
 * PAGE TEMPLATE GALLERY JS
 * gallery.php
 */ 
if($pageTemplate == 'gallery.php'){

// include Isotope & Imagesloaded javascript libs
echo '<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/isotope.js" type="text/javascript" language="javascript"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/isotope-packery.js" type="text/javascript" language="javascript"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/imagesloaded.js" type="text/javascript" language="javascript"></script>';

}

/**
 * GLOBAL CSS 
 */ 
echo '<style type="text/css">';

// single column (sidebars on top/bottom) small 
echo '@media screen and (max-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_small_width', 98).'%; max-width:'.get_theme_mod('onepiece_responsive_small_outermargin').'px; margin:0 auto; }'; 
echo '#maincontent,#mainsidebar,#pagesidebarcontainer,#sidebar2{float:none !important;width:100% !important;margin:0px auto;}'; 
echo '}';

/**
 * PAGE TEMPLATE GALLERY
 * gallery.php
 */ 
if($pageTemplate == 'gallery.php'){

echo '#itemcontainer .item{ width:50%; }';
echo '#itemcontainer .item.active{ width:100%; }';

// medium screen
echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_medium_width', 95).'%;max-width:'.get_theme_mod('onepiece_responsive_medium_outermargin').'px; }'; 
// set medium width
$cr = 2;
$qr = 2;
if( $maxinrow > 3){
$cr = 3;
}
if( $maxinrow > 4){
$cr = 4;
$qr = $maxinrow-2;
}
if( $maxinrow > 5){
$cr = 5;
$qr = $maxinrow-3;
}
echo '#itemcontainer .item{width:'.(100 / $cr).'%;}'; 
echo '#itemcontainer .item.active{ width:'.((100 / $cr)*$qr).'%; }';

echo '.item .coverbox{ min-height:'.$itemminh.'px !important;}';
echo '.item.active .coverbox{ min-height:'.$itembigh.'px !important;}';

/**
 * Set Item view Columns
 * ! make custom sizes?
 */
if( $itemview == 'right'){
echo '#itemcontainer .item.active .coverbox{ width:60%; float:left; }';
echo '#itemcontainer .item.active .titlebox, #itemcontainer .item.active .fullinfobox{ width:40%; float:right;}';
}
if( $itemview == 'left'){
echo '#itemcontainer .item.active .coverbox{ width:60%; float:right; }';
echo '#itemcontainer .item.active .titlebox, #itemcontainer .item.active .fullinfobox{ width:40%; float:left;}';
}
echo '}'; // end medium screen

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_medium_max', 1280).'px) {';
echo '.outermargin { max-width:'.get_theme_mod('onepiece_responsive_large_outermargin').'px; }'; 

$aw = 2; // set large width item
if( $maxinrow > 3){
$aw = 3;
}
echo '#itemcontainer .item{width:'.(100 / $maxinrow).'%;}'; 
echo '#itemcontainer .item.active{ width:'.((100 / $maxinrow)*$aw).'%; }';
echo '}'; // end large screen
} //end gallery css 

echo '</style>';

/**
 * PAGE TEMPLATE GALLERY ISOTOPE
 * gallery.php
 */ 
if($pageTemplate == 'gallery.php'){
// generate isotope js
?>
<script>
jQuery(function ($) { 

$(document).ready(function() {

    var $container = $("#itemcontainer");
    var $tagList = '';
    var $catList = '<?php echo $topcat; ?>';
    var $currCat = '';
    var $itemsloaded = [];
    var $itemamount = <?php echo isset( $maxinrow ) ? ( $maxinrow * 3 ) : 8; ?>;
    var $itemList = [];
    var $noloading = 0;
	
	var $checkpopup = 0;
	
	var keyhash = window.location.hash.substr(1);
	if(keyhash){
		
		if( $(document).find('a.cat-'+keyhash).length > 0  ){
		$catList = keyhash;
		$tagList = '';
		
		}else if( $(document).find('a.tag-'+keyhash).length > 0 ){
		
		$catList = '';
        $tagList = keyhash;
		
		}else{ 
			$checkpopup = 1;
			$startslug = keyhash;
			//check_popuppost_by_slug(keyhash);
		}
		
	}
	
	
	function check_popuppost_by_slug(slug){
				// check for post id
				
				if( $('div[data-slug="'+slug+'"]').length > 0 && $checkpopup == 1){
					$checkpopup = 0;
					//alert(slug);
					var elid = $( 'div[data-slug="'+slug+'"]' );
					elid.trigger( "click" );
				}
				/*data = {
					action: 'get_post_id_by_slug', // function to execute
					afp_nonce: afp_vars.afp_nonce, // wp_nonce
					post_slug:  slug
				};  
				
				$.post( afp_vars.afp_ajax_url, data, function(response) {
					if( response.length > 0 && response != ''){ 
					
						var postdata = $.parseJSON(response);
						
						alert(postdata.ID +' - '+postdata.category+' - '+postdata.tags);
						
					}
				}).done(function( data ) {
				
				});*/
			
	}
	
	
	
	var $newload = 0;
	
    // init isotope :: http://isotope.metafizzy.co/layout-modes/masonry.html
    $container.isotope({ 
       	itemSelector: '.item',	  
   		layoutMode: 'packery',	  
        packery: {
                //columnWidth: $container.width()/2, // min blocks on row is 2 
         	gutter: 0
       	 },
		getSortData: {
		byCategory: function (elem) { // sort randomly
        	return $(elem).data('category') === $currCat ? 0 : 1;
      	}},
       	animationEngine: 'best-available'
    });
    
    /* load posts to container */
    loaditems();
   
	/* on resize */
	var resizeId;
	$(window).resize(function() {
    		clearTimeout(resizeId);
    		resizeId = setTimeout(doneResizing, 20);
	});
	function doneResizing(){
		setColumnWidth(); 
	}
	function setColumnWidth(){
	    
	    var small = <?php echo get_theme_mod('onepiece_responsive_small_max', 512); ?>;
	    var medium = <?php echo get_theme_mod('onepiece_responsive_medium_max', 1280); ?>;
	    var maxinrow = <?php echo isset( $maxinrow ) ? $maxinrow: 3; ?>;
	    var w = $container.width() / 2;
	    if( $(window).width() > small ){
	        w = $container.width() / 3;
	    }
	    if( $(window).width() > medium ){
	        w = $container.width() / maxinrow;
	    }
	  	//$('#itemcontainer .item:last').width(); // present css 
    	$container.isotope({ masonry: { columnWidth: w } }).isotope('layout'); // define in isotope
	}
	setColumnWidth();

    
    $(window).scroll(function(s){
    s.preventDefault(); 
    if($(window).scrollTop() == $(document).height() - $(window).height() && $noloading == 0){ 
        loaditems();
    }
    });
	
	
	
	
    
    function loaditems(){
        data = {
          action: 'filter_posts', // function to execute
          afp_nonce: afp_vars.afp_nonce, // wp_nonce
          ajxtags:  $tagList, // selected options
          ajxcategories:  $catList, // selected options
          ajxloaded:  $itemsloaded, // available items
          itemamount:  $itemamount, // available items
        };  

	$.post( afp_vars.afp_ajax_url, data, function(response) {
          if( response.length > 0 ){  
	  		  var elems = '';
              $.each( $.parseJSON(response), function(idx, obj) {
			  	  if( obj ){
                  $itemsloaded.push(obj.id); // add loaded items id
		  		  $itemList[obj.id] = obj;
                  elems += itemmarkup(obj); // item html markup
				  }
              });

              $newItems = $( elems );
              $container.append( $newItems ).isotope( 'appended', $newItems );
			  
			// prevend doubled items
			var seen = {};
				$('.item').each(function() {
					var txt = $(this).text();
					if (seen[txt])
						$(this).remove();
					else
						seen[txt] = true;
				});
			  
          }
        }).done(function( data ) {
		
	  		  
            $container.imagesLoaded( function(){
                $items = $('.item');
				
				if( $newload == 0 ){
				$newload = 1;
                $container.isotope('shuffle').isotope( 'layout' );
				}else{
                $container.isotope( 'updateSortData', $items).isotope( 'layout' );
				}
				
                $noloading = 0;
				
				if( $checkpopup == 1){
					check_popuppost_by_slug($startslug);
				}
                //$('#contentloadbox').remove();
            });


        }); 

    }


	

	/*
	 * Label
	 */ 
	function display_postlabel(obj){

		var output = '';
		var product_labelicons = <?php echo json_encode($GLOBALS['product_label_webicons']); ?>;
	
		if( obj.meta['meta-box-product-label'] != '' && obj.meta['meta-box-product-label'] != 'none' && typeof obj.meta['meta-box-product-label'] !== 'undefined'){
		
			var labelcontent = obj.meta['meta-box-product-label'];
			if( product_labelicons != '' &&  typeof product_labelicons !== 'undefined'){
				labelcontent = product_labelicons[labelcontent];
			}
		
			output += '<div class="labelbox">';
			output += '<span class="productlabel">'+labelcontent+'</span>';
			output += '</div>';
		
		}
		return output;
	}
	
	
	/*
	 * PRICE
	 */ 
	function display_postprice(obj){
	
		var output = '';
		
		/* CURRENCY MAP */
		var currency_map = <?php echo json_encode($GLOBALS['currency_symbols']); ?>;
	
		var used_currency =  obj.meta['meta-box-product-currency'];
		
		if( obj.meta['meta-box-product-currency'] != '' &&  typeof obj.meta['meta-box-product-currency'] !== 'undefined' && typeof currency_map !== 'undefined'){
		used_currency = currency_map[ obj.meta['meta-box-product-currency'] ];
		}
		
		if( obj.meta['meta-box-product-price'] != '' &&  typeof obj.meta['meta-box-product-price'] !== 'undefined' ){
		output += '<div class="pricebox">';
		
		if( obj.meta['meta-box-product-discount'] != '' && typeof obj.meta['meta-box-product-discount'] !== 'undefined' && !isNaN(obj.meta['meta-box-product-discount']) && !isNaN(obj.meta['meta-box-product-price']) ){
		
			output += '<span class="discount"><?php echo __('Discount', 'onepiece'); ?> '+ obj.meta['meta-box-product-discount']+'% </span>';
		
			var price = '<span class="price"> '+ used_currency +' '+ (obj.meta['meta-box-product-price'] / 100) * (100 - obj.meta['meta-box-product-discount']) +'</span>';
			
		}else if( !isNaN(obj.meta['meta-box-product-price']) ){
		
			var price = '<span class="price"> '+ obj.meta['meta-box-product-currency'] +' '+ obj.meta['meta-box-product-price'] +'</span>';
			
		}else{
		
			var price = '<span class="price"> '+ obj.meta['meta-box-product-price'] +'</span>'; // text
		}
		
		output += price;
		output += '</div>';
		
		}
		
		return output;
	
	}
	
	
	
	
	/*SIZE MAP */
	function display_postsize(obj){
		
		var output = '';
		var size_map = <?php echo json_encode($GLOBALS['size_select']); ?>;
			
		/* SIZE */
		if( obj.meta['meta-box-product-size'] != '' && obj.meta['meta-box-product-size'] != 'none' && typeof obj.meta['meta-box-product-size'] !== 'undefined'){
		 
		output += '<div class="sizebox">';
		output += '<span class="size">'+size_map[ obj.meta['meta-box-product-size'] ]+'</span>';
		output += '</div>';
		
		}
		return output;
	}
	
	
	/* PACKAGE */
	function display_postpackagesize(obj){
	
		var output = '';
		
		if( obj.meta['meta-box-product-dms'] != 'none' && obj.meta['meta-box-product-dms'] != '' && typeof obj.meta['meta-box-product-dms'] !== 'undefined' ){
		
		var packsize = '';
		if( obj.meta['meta-box-product-dmx'] != '' && typeof obj.meta['meta-box-product-dmx'] !== 'undefined' && !isNaN(obj.meta['meta-box-product-dmx'])){
		packsize += obj.meta['meta-box-product-dmx']+' ';
		}
		if( obj.meta['meta-box-product-dmy'] != '' && typeof obj.meta['meta-box-product-dmy'] !== 'undefined' && !isNaN(obj.meta['meta-box-product-dmy'])){
		packsize += 'x '+obj.meta['meta-box-product-dmy']+' ';
		}
		if( obj.meta['meta-box-product-dmz'] != '' && typeof obj.meta['meta-box-product-dmz'] !== 'undefined' && !isNaN(obj.meta['meta-box-product-dmz'])){
		packsize += 'x '+obj.meta['meta-box-product-dmz'];
		}
		
		}
		if(packsize != '' && typeof packsize !== 'undefined'){
		
		output += '<div class="packagebox">';
		output += '<span class="packagesize">'+packsize+' '+obj.meta['meta-box-product-dms']+'</span>';
		output += '</div>';
		}
		
		if( obj.meta['meta-box-product-wms'] != 'none' && obj.meta['meta-box-product-wmn'] != '' && typeof obj.meta['meta-box-product-wmn'] !== 'undefined'
		&& !isNaN(obj.meta['meta-box-product-wmn']) && typeof obj.meta['meta-box-product-wms'] !== 'undefined' ){
		output += '<div class="packagebox">';
		output += '<span class="packageweight">'+obj.meta['meta-box-product-wmn']+' '+obj.meta['meta-box-product-wms']+'</span>';
		output += '</div>';
		}
		
		return output;
	
	}
	
	
	
	/*
	 * ORDER BY MAIL
	 */
	function display_orderbymail(obj){
	 
	 	var output = '';
		if( obj.meta['meta-box-product-price'] != '' &&  typeof obj.meta['meta-box-product-price'] !== 'undefined' 
		&& obj.meta['meta-box-product-orderbymail'] != 'none' &&  typeof obj.meta['meta-box-product-orderbymail'] !== 'undefined' ){
		
		var orderbymailmarkup = '<?php echo antispambot( get_theme_mod('onepiece_content_panel_product_orderemailaddress', get_option('admin_email') ) ); ?>';
		orderbymailmarkup += '?subject=Order request <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>-'+obj.title;
		orderbymailmarkup += '&body=<?php echo __('Hi,%0AIs this product still available? I would like to buy it. ', 'onepiece'); ?>';
		orderbymailmarkup += '%0A%0A'+obj.title;
		if( obj.posturl ){ 
		//markup += '<div class="coverbox"><img class="coverimage" src="'+obj.mediumimg[0]+'" alt="'+obj.title+'" /></div>';
		orderbymailmarkup += '%0A'+obj.posturl;
		// https://gist.github.com/CatTail/4174511 
		}
		orderbymailmarkup += '%0A'+obj.content.replace(/<\/?[^>]+(>|$)/g, "");
		
		
		output += '<div class="orderbox"><ul>';
		output += '<li><span><a class="orderbyemailbutton" href="mailto:'+orderbymailmarkup+'" target="_self"><?php echo __('Order by Email', 'onepiece'); ?></a></span></li>';
		output += '</ul></div>';
		
		}
		return output; 
	}// end function
	
	
	
	function display_customreadmore(obj){
	
		var customurl = obj.meta['meta-box-custom-url'];
		var useurl = obj.meta['meta-box-custom-useurl'];
		
		var itemreadmore = '';
		var urltext = '<?php echo __('Read more', 'onepiece'); ?>';
	
		if( customurl != '' && typeof customurl !== 'undefined' && ( useurl == 'internal' || useurl == 'external' ) ){
	
		if( customurl != '' && useurl == 'internal' ){
			var itemreadmore = '<a class="urlbutton" href="'+customurl+'" title="'+obj.title+'" target="_self">';
		}
		if( customurl != '' && useurl == 'external' ){
			var itemreadmore = '<a class="urlbutton" href="'+customurl+'" title="'+obj.title+'" target="_blank">';
		}
		if( obj.meta['meta-box-custom-urltext'] ){
			urltext = obj.meta['meta-box-custom-urltext'];  
		}
		
		itemreadmore += urltext+'</a>'; 
		
		}
		return itemreadmore;
	
	}
	
	
	
	function display_posttime(obj){
	
		var output = '';
		<?php // check for customizer posts display settings
		if( get_theme_mod('onepiece_content_panel_postlist_authortime') ){
		echo "var authortime = '".get_theme_mod('onepiece_content_panel_postlist_authortime')."'; // from php";
		?>
		
		if( authortime == 'both' || authortime ==  'date' ){
			output += '<span class="datebox">'+obj.date+'</span>';
		}
		if( authortime == 'both'  ){
			output += ' by <span class="authorbox">'+obj.author+'</span>';
		}
		<?php } ?>
		
		return output;
		
	}
	
	
	
	

    
    function itemmarkup(obj){
	
	// get item categories
    var cat = '';
    if(obj['category'].length > 0 ){
      for(i=0;i<obj['category'].length;i++){
        cat += obj['category'][i]['slug']+' ';
      }
    }
	// get item tags
    var tags = '';
    var taglist = obj['tags'].toString();
    var tags_arr = taglist.split(/\s*,\s*/);
    for(i=0;i<tags_arr.length;i++){
        tags += tags_arr[i]+' ';
    }
	// add custom field product label to item tags
	if( obj.meta['meta-box-product-label'] != '' && obj.meta['meta-box-product-label'] != 'none' && typeof obj.meta['meta-box-product-label'] !== 'undefined'){
		tags += obj.meta['meta-box-product-label']; //'label-'+obj.meta['meta-box-product-label'];
	}


	/*
	 * Item (custom) url/clickaction
 	 */
	var readmoreurl = obj.posturl;
    var itemdatalink = readmoreurl;
	var objslug =  obj.slug;
	var customurl = obj.meta['meta-box-custom-url'];
	var useurl = obj.meta['meta-box-custom-useurl'];

	var posturl = '<a href="'+readmoreurl+'" title="'+obj.title+'" target="_self">';

	if( customurl != '' && typeof customurl !== 'undefined' && useurl == 'replaceself' ){
		var posturl = '<a href="'+customurl+'" title="'+obj.title+'" target="_self">';
	}
	if( customurl != '' && typeof customurl !== 'undefined' && useurl == 'replaceblank' ){
		var posturl = '<a href="'+customurl+'" title="'+obj.title+'" target="_blank">';
	}
	if( customurl != '' && typeof customurl !== 'undefined'){
		itemdatalink = customurl;
	}
	
	
    var markup = '<div id="post-'+obj.id+'" data-id="'+obj.id+'" data-category="'+cat+'" data-slug="'+objslug+'" data-link="'+itemdatalink+'" data-linktarget="'+useurl+'" data-related="'+tags+'" class="item '+cat + tags+'"><div class="innerpadding">';
	
	var smallscreen = false;
 	<?php // check for customizer posts display settings
    if( $mobile ){
    echo "smallscreen = true;";
	}
    ?>

 	if( smallscreen === false && obj.largeimg ){ 
	
	//markup += '<div class="coverbox"><img class="coverimage" src="'+obj.largeimg[0]+'" alt="'+obj.title+'" /></div>';
	markup += '<div class="coverbox" style="background-image:url('+obj.largeimg[0]+');min-height:<?php echo $itemminh; ?>px;"></div>'; 
	}else if( obj.mediumimg ){ 
    //markup += '<div class="coverbox"><img class="coverimage" src="'+obj.mediumimg[0]+'" alt="'+obj.title+'" /></div>';
	markup += '<div class="coverbox" style="background-image:url('+obj.mediumimg[0]+');min-height:<?php echo $itemminh; ?>px;"></div>';
    }
	
    // META DATA .. JSON.stringify(obj.meta)
	
	/*
	 * LABEL
	 */
	markup += display_postlabel(obj);
	
	/*
	 * Titlebox
	 */
    markup += '<div class="titlebox"><h3>';
	
	<?php if( isset($clickaction) && $clickaction != 'none' ){ ?>

    markup += posturl+''+obj.title+'</a></h3>';

	<?php }else{ ?>

    markup += obj.title+'</h3>';

	<?php } ?>

    markup += display_posttime(obj);

    markup += '</div>';


	
	
	
	
	markup += '<div class="fullinfobox hidden">';
	
	markup += display_postprice(obj);
	
	markup += display_postsize(obj);
	
	/* Description / text */
	markup += '<div class="textbox">'+obj.excerpt;
	
	markup += display_customreadmore(obj);
	
	markup += '</div>'; 
	
	markup += display_postpackagesize(obj);

	markup += display_orderbymail(obj);
	
	/* Wishlist.. // https://pippinsplugins.com/storing-session-data-in-wordpress-without-_session/ */
	
	markup += '</div>';
	
    markup += '<div class="clr"></div></div></div>';
	
	return markup;
	
    }
   
    // Grid items
	function loadpopup( popcontent ){
		$('.popupcloak').fadeIn(300);
		$('#mainpopupbox .popupcontent').html( popcontent )
		$('#mainpopupbox').fadeIn(300);
    }
	
	<?php if( $clickaction != 'none' ){ ?>

		$container.on('mouseover', '.item', function(m){
			if( !$(this).hasClass('active') )
				$(this).css('cursor','pointer');
		});

		$container.on('mouseleave', '.item', function(m){
			$(this).css('cursor','default');
		});

	<?php } ?>

	
	$container.on('click', '.item', function(e){

		if($(e.target).is('a')){
            e.preventDefault();
			
			window.open( $(e.target).attr('href'), $(e.target).attr('target') );
			
			//window.location = $(e.target).attr('href');
            return false;
        }

		<?php if( $clickaction == 'sizeup' ){ ?>

		$('.item').removeClass('active');

		$('.item .fullinfobox').addClass('hidden');
		
		<?php if( $mobile ){ ?>
		$('.item').find('.coverbox').css('min-height', '<?php echo $itemminh; ?>px' ); // set min-height other items
		$(this).find('.coverbox').css('min-height', '<?php echo $itembigh; ?>px' );// height this item
		<?php } ?>
		
		$(this).addClass('active');
		$(this).find('.fullinfobox').removeClass('hidden');
		$currCat = $(this).attr('data-category');
		var $this = $(this);

		$container.prepend($this).isotope('reloadItems').isotope({ sortBy: 'byCategory' }); // or 'original-order'
		//$container.isotope('reloadItems').isotope('layout');
		/*
		var ceiling = $('#topbar .outermargin').outerHeight(true);
	 	if( $('#topgridmenu').length > 0 ){
		ceiling = ceiling + $('#topgridmenu').outerHeight(true); // filter menu height
		}
		$('html, body').animate({ scrollTop: $('#contentcontainer').offset().top - ceiling }, 400); // Scroll to top (bottom of header)
		*/
		
		$container.isotope('once', 'layoutComplete',
        function (isoInstance, laidOutItems) {
  			console.log( laidOutItems.length );
			$('html, body').animate({ scrollTop: $('#itemcontainer').offset().top -  ( $(window).height() / 4 )  }, 400);
		});
	
		<?php }else if( $clickaction == 'poppost' ){ ?>

		var title = $(this).find('.titlebox').wrap('<p/>').parent().html();
		var image = $(this).find('.coverbox').wrap('<p/>').parent().html();
		var text =  $(this).find('.fullinfobox').html(); 
		var content =  title + image + text;
		$(this).find('.titlebox').unwrap();
		$(this).find('.coverbox').unwrap();
		loadpopup( content );
	
		<?php }else if( $clickaction == 'link' ){ ?>

		var dataUrl = $(this).attr('data-link');
		var dataTarget = "_blank";
		if( $(this).attr('data-linktarget') == 'replaceself'){
			dataTarget = "_self";
		}
		e.preventDefault();
		window.open( dataUrl, dataTarget );

		<?php }else if( $clickaction == 'popcat' ){ ?>

		/*
		 * Single view popup with related links
		 */
		popup_gallerypost( $(this).attr('data-id'), $(this).attr('data-category'), $(this).attr('data-related'), $(this).attr('data-slug') );
		 
		function popup_gallerypost(pid, catstr, tagstr, postslug){
		
		/* id related.. 
		var pid = ; 
    	var catstr = ;
    	var tagstr = ;*/
		
		window.location.hash = '#' + postslug;
		
    	var filter = catstr+' '+tagstr;
    	var obj = $itemList[pid];
    	//var datastring = ' '+JSON.stringify( obj );

		var cats = '';
		if( catstr != '' ){
			var catlist = catstr.split(' ');
			var realcats = [];
			for(i=0;i < catlist.length; i++){
				if(catlist[i] != ' ' && catlist[i] != ''){
					realcats.push(catlist[i]['cat_name']);
				}
			}
		}

		if( obj['category'].length > 0 ){
			for(i=0;i < obj['category'].length; i++){
			cats += ' <a href="#'+obj['category'][i]['slug']+'" data-filter="'+obj['category'][i]['category_nicename']+'" class="category-link">'+obj['category'][i]['cat_name']+'</a>';
		    }
			cats = '<div class="relcats"><span>categories:</span>'+cats+'</div>';
		}

		var tags = '';
		if( tagstr != '' ){
			var taglist = tagstr.split(' ');
			var realtags = [];
			for(i=0;i < taglist.length; i++){
				if(taglist[i] != ' ' && taglist[i] != ''){
					realtags.push(taglist[i]);
				}
			}
		}

		if( realtags.length > 0 ){
			for(i=0;i < realtags.length; i++){

                tags += ' <a href="#'+realtags[i]+'" data-filter="'+realtags[i]+'" class="tag-link">'+realtags[i]+'</a>';

		    }
			tags = '<div class="reltags"><span>tagged:</span>'+tags+'</div>';
		}

	    var related = '<div class="postrelated">'+cats+tags+'</div>';
		
		
		
		// markup
		var content = '<div class="popupcoverbox"></div><div class="popupcontentbox"><div class="titlebox"></div><div class="textcontent"></div></div>';
		
		//loadpopup( content );
		$('.popupcloak').fadeIn(300);
		
		$('#mainpopupbox .popupcontent').html( content );
		
		$('body').css('overflow', 'hidden');
		
		$('.popupcoverbox,.popupcontentbox').hide();
		
		$('#mainpopupbox').prepend( $('.popupclosebutton') );
		
		$('body > .loadbox').fadeIn(300);
		
			
		$('#mainpopupbox').fadeIn( 300 );
		
		// get post content and image(s) 
		getImgGallery(pid);
		
		
		var timebox = display_posttime(obj);
		$('.popupcontentbox .titlebox').append( timebox );
		
		var labelbox = display_postlabel(obj);
		$('.popupcoverbox').prepend( labelbox );
		
		var readmore = display_customreadmore(obj)
		$('.popupcontentbox').append( readmore );
		
		var sizebox = display_postsize(obj);
		$('.popupcontentbox').append( sizebox ); 
		
		var pricebox = display_postprice(obj);
		$('.popupcontentbox').append( pricebox );
		
		var packagesizebox = display_postpackagesize(obj);
		$('.popupcontentbox').append( packagesizebox );
		
		var orderbymailbox = display_orderbymail(obj);
		$('.popupcontentbox').append( orderbymailbox );
		
		$('.popupcontentbox').append( related );
		
		// get related items 
		loadRelatedItems(realtags,realcats,obj); // placed inside popupcontent > postrelated element
		
		}
		

		function loadRelatedItems(tags,cats,el){
			/*if( $noloading == 0 ){
					loadItems(filter,$itemsLoaded); // make sure the items are available
				}*/
			var relitems = '';
			data = {
				  action: 'filter_posts', // function to execute
				  afp_nonce: afp_vars.afp_nonce, // wp_nonce
				  //maxposts: 8, // selected options
				  //itemfilter:  filter, // selected options
				itemamount: 15,
					ajxtags:  tags,
				    ajxcategories: cats,
				  //itemsLoaded:  Array(), // loaded items reset
					ajxloaded:  Array(), // loaded items reset
				};


					  var relatedList = [];
					  var relnews = '';
					  var relwork = '';
					  var reltitles = '';

				$.post( afp_vars.afp_ajax_url, data, function(response) {
				  if( response.length > 0 ){ //alert(response);
					  $.each( $.parseJSON(response), function(idx, obj) {

						  if(obj != 'false' && obj.slug != el.slug )
						  //alert(obj);
						  reltitles += ' <li><a href="#'+ obj.slug +'" class="related-item-link" data-id="'+ obj.id +'"><img src="'+obj.thumbimg[0]+'" height="auto" width="48px" />'+ obj.title +'</a></li>';

					  });
				  }
				}).done(function( loadeditems ) {
					 $('.popupcontentbox .postrelated .relatedmenu').remove();
					  if( reltitles != '' )
					  $('.popupcontentbox .postrelated').append( '<div class="relatedmenu">Related:<ul class="links">'+reltitles+'</ul><div class="clr"></div></div>');
				
				});
				return true;
				
		}
		
		
		
		function getImgGallery(postID){
		// get dynamic featured images 
		var data = {
			action: 'get_post_gallery_content',
			afp_nonce: afp_vars.afp_nonce, // wp_nonce
			post_id: postID,
			dataType: 'json',
			cache: false 
		}; 

		$.post( afp_vars.afp_ajax_url, data, function( response ) {
			
			if( response.length > 0   ){ 
			
				var postdata = JSON.parse(response);
				
				var titletext = '<h3>'+ postdata.title +'</h3>';
				var textcontent = '<div>'+ postdata.content +'</div>';
				
				
				var imgdisplay = '';
				if( postdata.images.length > 1 ){
					imgdisplay = '<div class="imageholder"><img class="gallerycover" src="'+postdata.images[0]['full']+'" /></div><ul class="gallerynav">';
					//imgdisplay += '<li class="active option" data-image="'+postdata.images[0]['full']+'"><img src="'+postdata.images[0]['thumb']+'" /></li>';
					$.each( postdata.images, function(nr, img){
						imgdisplay += '<li class="option" data-image="'+img['full']+'"><img class="thumb" src="'+img['thumb']+'" /></li>';
					});
					imgdisplay += '</ul>';
				}else{
					imgdisplay = '<div class="imageholder"><img class="singlecover" src="'+postdata.images[0]['full']+'" /></div>';
				}
				
				$('#mainpopupbox .popupcoverbox').append( imgdisplay ).fadeIn('300', function(){
					$('#mainpopupbox .popupcoverbox ul.gallerynav li:first').addClass('active');
					$('#mainpopupbox .popupcontentbox .titlebox').prepend(titletext);
					$('#mainpopupbox .popupcontentbox .textcontent').html( textcontent );
					$('#mainpopupbox .popupcontentbox').fadeIn('300', function(){
							$('body > .loadbox').fadeOut(200);
						});
				});
				
			}
			
		});
		
		}

		<?php }?>

		return false;

	}); 
	
	
	<? if( $clickaction == 'popcat' ){ ?>
	
	$('.closegallerypopup').on('click', function(g){

			g.preventDefault();
			
			$('#mainpopupbox .popupcontentbox').fadeOut('200');
			$('#mainpopupbox .popupccoverbox').fadeOut('200', function(){
			
			
				$('.popupcloak').fadeOut(500);
				
				$('#mainpopupbox').fadeOut(500, function(){
	
					$('#mainpopupbox,.popupcloak').remove();
	
					$('body').append('<div class="popupcloak"></div><div id="mainpopupbox"><div class="popupcontent outermargin"></div>');
					$('#mainpopupbox').hide();
					$('.popupcloak').hide();
					$('div.childpages.pop .moretextbox').hide();
					
					
					
	
				});
			});
			
		});



		$('#mainpopupbox .popupcontent').on('click', 'ul.gallerynav li.option', function(im){
		
			im.preventDefault();

			if( !$(this).hasClass('active') ){
			
				$('ul.gallerynav li.option').removeClass('active');
				$(this).addClass('active');
				$('#mainpopupbox .popupcoverbox .imageholder').addClass('prev');
				$('#mainpopupbox .popupcoverbox').prepend( '<div class="imageholder"><img class="gallerycover" src="'+$(this).attr('data-image')+'" /></div>' );
				$('#mainpopupbox .popupcoverbox .prev').fadeOut('100', function(){
					$('#mainpopupbox .popupcoverbox .prev').remove();
				});
			}
				
  			return false;

		});
	
		
	
		$('#mainpopupbox .popupcontent').on('click', 'a.related-item-link', function(r){
		
			r.preventDefault();

			loaditems();
			$container.isotope('layout');
				
			var elid = $( '#post-'+$(this).attr('data-id')+'.item' );
			elid.trigger( "click" );
				
  			return false;

		});

		$('#mainpopupbox .popupcontent').on('click', 'a.tag-link,a.category-link', function(c){

		c.preventDefault();

		$('.item').removeClass('active');
		$('.item .fullinfobox').addClass('hidden');


		<?php if( $mobile ){ ?>
		$('.item').find('.coverbox').css('min-height', '<?php echo $itemminh; ?>px' );
		<?php } ?>

  	    var keyword = '.'+$(this).text();
        $catList = $(this).attr('data-filter');
        $tags = $(this).text();
		$tagList = $tags;
		if($(this).hasClass('tag-link') ){
			$('ul.tagmenu li a').removeClass('selected');
			$('a.tag-'+$catList).addClass('selected');
		}
		if($(this).hasClass('category-link') ){
			$tagList = '*';
			$catList = $(this).attr('data-filter');
			keyword = '.'+$catList;

			$('ul.tagmenu.active').slideUp( 'fast', function(){
				$('ul.categorymenu li a').removeClass('selected');
    			$('ul.categorymenu li a.cat-'+$catList).addClass('selected');
				$('ul.tagmenu.'+$catList).slideDown().addClass('active');
			} ).removeClass('active');

		}

		$('.popupcloak').fadeOut(300);
		$('#mainpopupbox').fadeOut(300, function(){
			$('#mainpopupbox .popupcontent').html('');
		});

	    loaditems();
     	$container.isotope({ filter: keyword }).isotope('layout');


		var iid = '#' + $tags;
		window.location.hash = iid;
	    return false;
    });

	
	<?php } ?>
	
	
	/* Link post-list-widget items to gallery click action */
	<?php if(get_theme_mod('onepiece_content_gallery_linkpostlistwidget') == 'yes'){ ?>


		$('body').on('click', 'ul li a.rel-item', function(e){

			e.preventDefault();
				var elid = $( '#post-'+$(this).attr('data-id')+'.item' );
				if( elid.length > 0 ){
					loaditems();
					$container.isotope('layout');
					elid.trigger( "click" );
				}else{
					window.location = $(this).attr('href');
					//alert('item not loaded');
					//trigger category first, then load popup
				}
  			return false;

		});

	<? 	} ?>



	
	/*
	 * Gallery tagmenu
	 */

    // Filter menu's
	
    $('ul.tagmenu').hide();
	
    $('ul.tagmenu.active').slideDown();

    $('ul.categorymenu li a.category').click(function(m){

    m.preventDefault();

	$('.item').removeClass('active');
	
	$('.item .fullinfobox').addClass('hidden');
	
		
		<?php if( $mobile ){ ?>
		$('.item').find('.coverbox').css('min-height', '<?php echo $itemminh; ?>px' );
		<?php } ?>
	
    $('ul.tagmenu.active').slideUp().removeClass('active');
    $('ul.categorymenu li a').removeClass('selected');
	
	
    $(this).addClass('selected');

    	if( $(this).attr('data-filter') == '*'){
		
        var keyword = '*';
		$tagList = '';
        $catList = '<?php echo $topcat; ?>';//[];
		
		var submenu = 'ul.tagmenu.overview';
		
    	}else{ 
		
        var keyword = '.'+$(this).attr('data-filter');
		
        // multiple filters: $catList += ','+$(this).attr('data-filter');
        $tagList = '';
        $catList = $(this).attr('data-filter');
        var submenu = 'ul.tagmenu.'+$(this).attr('data-filter');
		
        }
		
		$(submenu).slideDown().addClass('active');
		
        loaditems();
        $container.isotope({ filter: keyword }).isotope('layout');
        
        window.location.hash = $catList;
        return false;

    });
  
  
    $('ul.tagmenu li,div.tagcloud').on('click', 'a', function(m){
	
		$('.item').removeClass('active');
		$('.item .fullinfobox').addClass('hidden');
		
		
		<?php if( $mobile ){ ?>
		$('.item').find('.coverbox').css('min-height', '<?php echo $itemminh; ?>px' );
		<?php } ?>
	
  	    var keyword = '.'+$(this).text();
        $catList = $(this).attr('data-filter');
        $tags = $(this).text();
		$tagList = $tags; 


		$('ul.tagmenu li a').removeClass('selected');
		$(this).addClass('selected');

	    loaditems();
		
		$container.isotope({ filter: keyword }).isotope('layout'); 
		
     	var iid = '#' + $tags;
		window.location.hash = iid;
	    return false;
    });
	

 
});


$(window).load(function() {
	 

});

});

</script>
<?php   
} // end gallery template JS


/**
 * HTML HEAD THEME CORE 
 * head end, body start
 * index.php, page.php, gallery.php
 */ 
 
// fontsize 
$globalfontsize = 0.6 + $stylelayout_fontsize / 10;
if($mobile){
$globalfontsize = 0.6 + $stylelayout_fontsize / 8;
}
// buttons
$vertical_padding_line = ($stylelayout_spacing / 5) * 4;
$horizontal_padding_line = ($stylelayout_spacing / 6 ) * 3 ;

// headers / boxes
$vertical_padding_box = $stylelayout_spacing * 2;

echo '<style>';
echo 'body{ font-size:'.$globalfontsize.'em !important; }';
echo '#site-navigation .menu-button, .contentpadding, .sidebarpadding ul.menu li a, .categorymenu li a, .tagmenu li a { display:inline-block;padding:'.$vertical_padding_line.'px '.$horizontal_padding_line.'px; }';
echo '.readmore, #copyright-textbox { display:inline-block;padding:'.$vertical_padding_line.'px 0px; }';
echo '#maincontent .post .contentpadding { display:block; padding:'.(3*$vertical_padding_line).'px 0px; }';
echo '#maincontent .post, .post-title, h1, p, .widgetpadding h3, .widgetpadding h4 { display:block; padding:'.$vertical_padding_line.'px 0px; }';


if( $mainmenubarplace == 'above' ){ 
echo '#headercontainer #site-navigation{ position: relative; z-index:999;}';
}




/* POST and LIST image sizes/positioning */
// img width in percentage
// img margin is 2% of full width multiplied by half of the (customizer) global spacing

$imgpostwidth = get_theme_mod('onepiece_content_panel_posts_imgwidth',37);
/* image is inline with content text
$imgpostmargin = 2 * ( $stylelayout_spacing / 2 );
$txtpostwidth = 100 - ( $imgpostwidth + $imgpostmargin );
*/
echo '.post-content p img.align-right.wp-post-image,
.post-content p img.align-left.wp-post-image,
.post-content .featured_gallery_box.left, 
.post-content .featured_gallery_box.right,
.post-content .align-left .post-coverimage,
.post-content .align-right .post-coverimage
{
width:'.$imgpostwidth.'% !important;
}';



$imglistwidth = get_theme_mod('onepiece_content_panel_list_imgwidth',37);
$imglistmargin = 2 * ( $stylelayout_spacing / 2 );
$txtlistwidth = 100 - ( $imglistwidth + $imglistmargin );

echo '#maincontent .follow-post .post-coverimage{ width:'.$imglistwidth.'%; };';
echo '#maincontent .follow-post .imgalign-left .post-coverimage,
#maincontent .follow-post .imgalign-right .post-coverimage { margin-right:'.$imglistmargin.'%; }';

echo '#maincontent .follow-post.has-post-thumbnail .imgalign-right .post-title,
#maincontent .follow-post.has-post-thumbnail .imgalign-right .post-subtitle,
#maincontent .follow-post.has-post-thumbnail .imgalign-right .post-content,
#maincontent .follow-post.has-post-thumbnail .imgalign-right .pricebox,
#maincontent .follow-post.has-post-thumbnail .imgalign-right .sizebox,
#maincontent .follow-post.has-post-thumbnail .imgalign-left .post-title,
#maincontent .follow-post.has-post-thumbnail .imgalign-left .post-subtitle,
#maincontent .follow-post.has-post-thumbnail .imgalign-left .post-content,
#maincontent .follow-post.has-post-thumbnail .imgalign-left .pricebox,
#maincontent .follow-post.has-post-thumbnail .imgalign-left .sizebox
{
width:'.$txtlistwidth.'%;
}';


echo '</style>';

// font (overwrites)
add_fonts_frontend();

echo '</head><body '; body_class(); 
echo '>';
echo $seotrackcode;
echo '<div id="pagecontainer"';
if($mobile){
echo ' class="mobile">';
}else{
echo '>';
}
?>
