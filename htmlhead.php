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
$maxinrow = isset( $values['theme_gallery_items_maxinrow'] ) ? $values['theme_gallery_items_maxinrow'][0] : '5';
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

}




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
echo '<meta name="description" content="'.$site_description.'">'
	.'<meta name="keywords" content="wordpress theme,theme setup,basic theme,custom theme">'
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
//if($mobile){
	echo '<meta name="viewport" content="initial-scale=1.0, width=device-width" />';
//}else 
//if ( ! isset( $content_width ) ) {
//	$content_width = 960;
//}



// Frontend user login  
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/userlogin.js"></script>'; 


 
// default style sizes
$stylelayout_fontsize = get_theme_mod('onepiece_identity_stylelayout_fontsize', 5);
$stylelayout_spacing = get_theme_mod('onepiece_identity_stylelayout_spacing', 5);
$stylelayout_speed = 100 * get_theme_mod('onepiece_identity_stylelayout_speed', 5);



// topbar
$topbarbehavior = get_theme_mod('onepiece_elements_topmenubar_behavior', 'rela');
$topbarbgfixed = get_theme_mod('onepiece_elements_topmenubar_bgfixed', 'keep');
$topbaropacity = get_theme_mod('onepiece_elements_topmenubar_opacity', 20);
// + colors 



// mainmenubar
$mainmenubarplace = get_theme_mod('onepiece_elements_mainmenubar_placement', 'below');
$mainmenubarbehavior = get_theme_mod('onepiece_elements_mainmenubar_behavior', 'stat');
//$mainmenubarminisize = get_theme_mod('onepiece_elements_mainmenubar_minisize', 'stat');


 
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
&& ( get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default') != 'replacemargin' || get_post_meta($post->ID, "onepiece_content_sliderbar_display", true) == 'topfooter')
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
Header Height Resize
*/
var rtime;
var timeout = false;
var delta = 200;
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
		
		var rMinHeight = $('#topbar .outermargin').outerHeight(true);
		var rSetHeight = ($(window).height() / 100) * <?php echo $displaytype; ?>;
		//var rToHeight = (  rMinHeight > rSetHeight ? rMinHeight : rSetHeight );
				
		$("#sliderbox-head,#headerbar").css("min-height", rMinHeight );
		$("#sliderbox-head,#headerbar").css("height", rSetHeight );		
        //if (window.console) console.log('check!');
    }   
}

jQuery(document).ready(function($) {

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
    forwardText         : ">", 
    backText            : "<",
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
|| $displaytype == '80' || $displaytype == '100' ) && $childpagedisplay != 'fade' && $topbarbehavior != 'rela'){ 
$toppos = 'absolute'; 
}else{
if( $topbarbehavior != 'rela'){ 
$toppos = 'absolute'; 
}else{ 
$toppos = 'relative';
}
}
?>
div#topbar
{
position:<?php echo $toppos; ?>;
width:100%;
z-index:69;
}
div#topbar.minified
{
position:<?php if( $topbarbehavior == 'fixe' || $topbarbehavior == 'mini' ){ echo 'fixed'; }else{ echo 'absolute';} ?>;
top:0px;
left:0px;
}

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
padding:10px;
background-color:#ffffff;
z-index:80;
}
div.anythingSlider span.back
{
left:5px;
}
div.anythingSlider span.forward
{
right:5px;
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



/*
 *
 * POPUP STYLING 
 *
 */
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
position:fixed;
top:0px;
left:0px;
height:100%;
width:100%;
z-index:99;
background-color:<?php echo $c; ?>;
opacity:<?php echo $o; ?>;
}
#mainpopupbox
{
position:fixed;
top:10%;
left:<?php echo $l; ?>%;
width:<?php echo $w; ?>%;
height:80%;
z-index:101;
background-color:#ffffff;
overflow:auto; 
}
#mainpopupbox .popupcontent
{
position:relative;
width:auto;
padding:4% 5%;
}



</style>

<?php 
}

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

echo '#headerbar { min-height:'.get_theme_mod('onepiece_elements_headerimage_height','280').'px; }'; 

echo '#footercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logosmall_maxwidth',80).'px !important; }';

echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_small_width', 512).'%; max-width:'.get_theme_mod('onepiece_responsive_small_outermargin', 480 ).'px; margin:0 auto; }'; 

// single column small /  medium
echo '@media screen and (max-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '#maincontent,#mainsidebar,#pagesidebarcontainer,#sidebar2{float:none !important;width:100% !important;margin:0px auto;}';
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
        z-index:-1,
        width:'100%', 
        height:'100%'
      }) 
   );
   <?php 
   } 
	?>
   
   
});

 

/**
 * TOPBAR FIXED / MINIFY ONSCROLL
 */ 
$(window).on("mousewheel scroll", function() {

<?php
if( $topbarbehavior == 'mini' || $topbarbehavior == 'fixe' ){
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
	
 	<?php if($topbarbehavior == 'mini'){ ?>
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
 * onscroll for fixed topbar:
 */
if( $mainmenubarbehavior == 'stic' && ( $topbarbehavior == 'fixe' || $topbarbehavior == 'mini') ){ 
// #site-navigation or #topbar-navigation 
?>

/**
 * MAIN MENU FIXED IN TOPBAR ONSCROLL
 */ 
<?php 
$stickymenu_triggerheight = '$("#topbar").height()';
if($mainmenubarplace == 'topbar'){
$stickymenu_triggerheight = '0';
}
?>
 
var offset = $('#site-navigation').offset();
if( (offset.top - $(window).scrollTop()) < <?php echo $stickymenu_triggerheight; ?> && !$("#site-navigation nav").hasClass('sticky')){

	/**
	 * POSITION MAIN MENU IN TOPBAR 
	 */
 	$("#site-navigation nav").addClass('sticky');
	if( $('#minibar-navigation').length > 0 ){
	$('#minibar-navigation').next().after($("#site-navigation nav"));
	}else if( $('#topbar-navigation').length > 0 ){
	$('#topbar-navigation').after($("#site-navigation nav"));
	}else{
	$('#topmenubar .outermargin .logobox').after($("#site-navigation nav"));
	
	//$('#site-navigation .outermargin nav').prependTo( $('#topmenubar .outermargin') );
	}
	
	
}else if( (offset.top - $(window).scrollTop()) >= <?php echo $stickymenu_triggerheight; ?> && $("#topmenubar nav").hasClass('sticky')){
	
	
	$("#topmenubar nav.sticky")
	.removeClass('sticky')
	.appendTo("#site-navigation");
	
} // end  onscroll for fixed topbar



<?php
} // end topbarbehavior sticky 
?>

});



});
</script>


<?php
/**
 * PAGE TEMPLATE GALLERY JS
 * gallery.php
 */ 
if($pageTemplate == 'gallery.php'){

// include Isotope & Imagesloaded javascript libs
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



	var keyhash = window.location.hash.substr(1);
	if(keyhash){
	
		
		if( $(document).find('a.cat-'+keyhash).length > 0  ){
		
		$catList = keyhash;
		$tagList = '';
			
		}
		if( $(document).find('a.tag-'+keyhash).length > 0 ){
		
		$catList = '';
        $tagList = keyhash;
			
		}
		
	}

	
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
                  $itemsloaded.push(obj.id); // add loaded items id
		  $itemList[obj.id] = obj;
                  elems += itemmarkup(obj); // item html markup
              });

              $newItems = $( elems );
              $container.append( $newItems ).isotope( 'appended', $newItems );
          }
        }).done(function( data ) {
            $container.imagesLoaded( function(){
                $items = $('.item');
                $container.isotope( 'updateSortData', $items).isotope( 'layout' );
                $noloading = 0;
                //$('#contentloadbox').remove();
            });

        }); 

    }

    
    function itemmarkup(obj){

    var tags = '';
    var taglist = obj['tags'].toString();
    var tags_arr = taglist.split(/\s*,\s*/);
    for(i=0;i<tags_arr.length;i++){
        tags += tags_arr[i]+' ';
      }

    var cat = '';
    if(obj['category'].length > 0 ){
      for(i=0;i<obj['category'].length;i++){
        cat += obj['category'][i]['slug']+' ';
      }
    }
    var markup = '<div id="post-'+obj.id+'" data-category="'+cat+'" class="item '+cat+' '+tags+'"><div class="innerpadding">';

    markup += '<div class="titlebox"><h3>';

	var readmoreurl = obj.posturl;
	var customurl = obj.meta['meta-box-custom-url'];
	var useurl = obj.meta['meta-box-custom-useurl'];
	
	var posturl = '<a href="'+readmoreurl+'" title="'+obj.title+'" target="_self">';
	if( customurl != '' && typeof customurl !== 'undefined' && useurl == 'replaceself' ){
		var posturl = '<a href="'+customurl+'" title="'+obj.title+'" target="_self">';
	}
	if( customurl != '' && typeof customurl !== 'undefined' && useurl == 'replaceblank' ){
		var posturl = '<a href="'+customurl+'" title="'+obj.title+'" target="_blank">';
	}
	
    markup += posturl+''+obj.title+'</a></h3>';

    <?php // check for customizer posts display settings
    if( get_theme_mod('onepiece_content_panel_postlist_authortime') ){
    echo "var authortime = '".get_theme_mod('onepiece_content_panel_postlist_authortime')."'; // from php";
    ?>
    
    if( authortime == 'both' || authortime ==  'date' ){
        markup += '<span class="datebox">'+obj.date+'</span>';
    }
    if( authortime == 'both'  ){
        markup += '<span class="authorbox">'+obj.author+'</span>';
    }
    <?php } ?>


    
    markup += '</div>';


	var smallscreen = false;
 	<?php // check for customizer posts display settings
    if( $mobile ){
    echo "smallscreen = true;";
	}
    ?>


 	if( smallscreen === false && obj.largeimg ){ 
	markup += '<div class="coverbox"><img class="coverimage" src="'+obj.largeimg[0]+'" alt="'+obj.title+'" /></div>';
	}else if( obj.mediumimg ){ 
    markup += '<div class="coverbox"><img class="coverimage" src="'+obj.mediumimg[0]+'" alt="'+obj.title+'" /></div>';
    }
	
    // META DATA .. JSON.stringify(obj.meta)
	
	/*
	 * LABEL
	 */
	if( obj.meta['meta-box-product-label'] != '' && obj.meta['meta-box-product-label'] != 'none' && typeof obj.meta['meta-box-product-label'] !== 'undefined'){
	
	markup += '<div class="labelbox">';
	
	markup += '<span class="productlabel">'+obj.meta['meta-box-product-label']+'</span>';
	
	markup += '</div>';
	
	}
	
	
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
	
    
	markup += '<div class="fullinfobox hidden">';
	markup += '<div class="textbox">'+obj.content+'</div>';
	
	
	/*
	 * SIZE
	 */
	
	if( obj.meta['meta-box-product-size'] != '' && obj.meta['meta-box-product-size'] != 'none' && typeof obj.meta['meta-box-product-size'] !== 'undefined'){
	
	markup += '<div class="sizebox">';
	
	markup += '<span class="size">'+obj.meta['meta-box-product-size']+'</span>';
	
	markup += '</div>';
	
	}
	
	/*
	 * PRICE
	 */
	if( obj.meta['meta-box-product-price'] != '' &&  typeof obj.meta['meta-box-product-price'] !== 'undefined' ){
	markup += '<div class="pricebox">';
	
	if( obj.meta['meta-box-product-discount'] != '' && typeof obj.meta['meta-box-product-discount'] !== 'undefined' && !isNaN(obj.meta['meta-box-product-discount']) && !isNaN(obj.meta['meta-box-product-price']) ){
	
		markup += '<span class="discount"><?php echo __('Discount', 'onepiece'); ?> '+ obj.meta['meta-box-product-discount']+'% </span>';
	
		var price = '<span class="price"> &#8364; '+ (obj.meta['meta-box-product-price'] / 100) * (100 - obj.meta['meta-box-product-discount']) +'</span>';
		
	}else if( !isNaN(obj.meta['meta-box-product-price']) ){
	
		var price = '<span class="price"> &#8364; '+ obj.meta['meta-box-product-price'] +'</span>';
		
	}else{
	
		var price = '<span class="price"> '+ obj.meta['meta-box-product-price'] +'</span>'; // text
	}
	
	
	markup += price;
	
	markup += '</div>';
	}
	
	/*
	 * PACKAGE
	 */
	
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
	
	markup += '<div class="packagebox">';
	markup += '<span class="packagesize">'+packsize+' '+obj.meta['meta-box-product-dms']+'</span>';
	markup += '</div>';
	}
	
	markup += itemreadmore;	
	
	//markup += JSON.stringify(obj.meta);
	markup += '</div>';
	
    markup += '</div></div>';
	return markup;
	
    /* 'id,'type','date','title','category','excerpt','content','meta','tags', 'imageurl','posturl','slug','customfieldarray','post_data' */
	/* meta-box-product-size,meta-box-product-dmx,meta-box-product-dmy,meta-box-product-dmz,meta-box-product-dms,_thumbnail_id,meta-box-custom-url,meta-box-product-label */
    }
   


    // Grid items
	function loadpopup( popcontent ){
		$('.popupcloak').fadeIn(300);
		$('#mainpopupbox .popupcontent').html( popcontent )
		$('#mainpopupbox').fadeIn(300);
    }
	
	
	
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
		
		$(this).addClass('active');
		$(this).find('.fullinfobox').removeClass('hidden');
		
		$currCat = $(this).attr('data-category');
		var $this = $(this);

		$container.prepend($this).isotope('reloadItems').isotope({ sortBy: 'byCategory' }); // or 'original-order'
	
	
	 if( $('#topgridmenu').length > 0 ){
		$('html, body').animate({ scrollTop: $('#topgridmenu').offset().top - $('#topbar .outermargin').outerHeight(true) }, 400); // Scroll to top (bottom of header)
	}else{
		$('html, body').animate({ scrollTop: $('#itemcontainer').offset().top - $('#topbar .outermargin').outerHeight(true) }, 400); // Scroll to top (bottom of header)
	}
		
		
		<?php }
		if( $clickaction == 'poppost' ){ 
		?>
		var title = $(this).find('.titlebox').wrap('<p/>').parent().html();
		var image = $(this).find('.coverbox').wrap('<p/>').parent().html();
		var text =  $(this).find('.fullinfobox').html(); 
		var content =  title + image + text;
		$(this).find('.titlebox').unwrap();
		$(this).find('.coverbox').unwrap();
		loadpopup( content );
	
		<?php } ?>

		return false;
	}); 
	
	

    // Filter menu's
    $('ul.tagmenu').hide();
	
    $('ul.tagmenu.active').slideDown();

    $('ul.categorymenu li a.category').click(function(m){

    m.preventDefault();

	$('.item').removeClass('active');
	$('.item .fullinfobox').addClass('hidden');
	
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
	
  	    var keyword = '.'+$(this).text();
        $catList = $(this).attr('data-filter');
        $tags = $(this).text();
		$tagList = $tags; 
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
$globalfontsize = 0.6 + $stylelayout_fontsize / 6;
}
// buttons
$vertical_padding_line = ($stylelayout_spacing / 5) * 4;
$horizontal_padding_line = ($stylelayout_spacing / 6 ) * 3 ;

// headers / boxes
$vertical_padding_box = $stylelayout_spacing * 2;

echo '<style>';
echo 'body{ font-size:'.$globalfontsize.'em !important; }';
echo 'ul li a { display:inline-block;padding:'.$vertical_padding_line.'px '.$horizontal_padding_line.'px; }';
echo '.post-title, h1, .readmore, p, #copyright-textbox { display:inline-block;padding:'.$vertical_padding_line.'px 0px; }';
if( $mainmenubarplace == 'above' ){ 
echo '#headercontainer #site-navigation{ position: relative; z-index:999;}';
}
echo '</style>';

echo '</head><body '; body_class(); 
echo '><div id="pagecontainer"';
if($mobile){
echo ' class="mobile">';
}else{
echo '>';
}
?>
