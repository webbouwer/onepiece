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
    
// $values variables page template
// .. use for slider functions 
$values = get_post_custom( $post->ID );

// $values get variables gallery template settings
$selected = isset( $values['theme_gallery_category_selectbox'] ) ? $values['theme_gallery_category_selectbox'][0] : '';
$gallerydefault = isset( $values['onepiece_content_gallery_category'] ) ? $values['onepiece_content_gallery_category'][0] : '';
$pagetitle = isset( $values['theme_gallery_pagetitle_selectbox'] ) ? $values['theme_gallery_pagetitle_selectbox'][0] : '';
$filters = isset( $values['theme_gallery_filters_selectbox'] ) ? $values['theme_gallery_filters_selectbox'][0] : '';
$maxinrow = isset( $values['theme_gallery_items_maxinrow'] ) ? $values['theme_gallery_items_maxinrow'][0] : '5';
$clickaction = isset( $values['theme_gallery_items_clickaction'] ) ? $values['theme_gallery_items_clickaction'][0] : 'poppost';

// $topcat default gallery category
if($selected){
$topcat = $selected;
}elseif( $gallerydefault && $gallerydefault != '' ){
$topcat = $gallerydefault;
}else{
$topcat = 'uncategorized';
}

// build filtermenu     
// $filters from $values 
if($filters != 'none'){ // prepare filter menu and create category tag index
// prepare category query
$args = array( 
    'child_of'                 => get_category_by_slug($topcat)->term_id,
    'orderby'                  => 'name',
    'order'                    => 'ASC', 
    'public'                   => true,
); 
$categories = get_categories( $args );
$cat_tags = ''; // string to hold tag menu for each category
$tag_idx = ''; // string csv tag names
$filtermenubox = '<ul id="topgridmenu" class="categorymenu">';
$filtermenubox .= '<li><a class="category" href="#" data-filter="*">All</a></li>';

// wp categories - http://wordpress.stackexchange.com/questions/212923/how-to-list-all-categories-and-tags-in-a-page 
foreach ( $categories as $category ) {
    
if( $category->slug != $topcat ){
    
    // category option
    $filtermenubox .= '<li><a class="category" href="#" data-filter="' . $category->slug . '">' . $category->name . '</a>'; 
    
    // tag option submenu
    if( $filters == 'all'){ // get tags from category post .. get_category_link( $category )
	query_posts('category_name='.$category->slug);
    $posttags = ''; // string to hold tags for each post
    $idxtags =''; // string to hold new part of list cvs tag names
    if (have_posts()) : while (have_posts()) : the_post();
        if( get_the_tag_list() ){
            $posttags .= get_the_tag_list('<li>','</li><li>','</li>');
            $listtags = get_the_tags();
            foreach($listtags as $tag) { //$idxtags .= get_the_tag_list('"','","','",');
                $idxtags .= '"'.$tag->name.'",'; 
            }
        }
    endwhile; endif; 
    $cat_tags .='<ul class="tagmenu '.$category->slug.'">'.$posttags.'</ul>';
    $tag_idx .= $idxtags; // add string cvs tag names
    wp_reset_query(); 
    }
	$filtermenubox .= '</li>';
}
}
$filtermenubox .= '</ul>';
$filtermenubox .= $cat_tags;
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

// mobile meta 
/* echo '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>'; */
if($mobile){
echo '<meta name="viewport" content="initial-scale=1.0, width=device-width" />';
}else if ( ! isset( $content_width ) ) {
$content_width = 960;
}


 
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
$mainmenubarbehavior = get_theme_mod('onepiece_elements_mainmenubar_behavior', 'stat');


 
// get header replacement variables for page/post feautured images
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



// get html for default slider and page slider if available
if( ( $sliderdefaultdisplay == 'replaceheader' || $sliderdefaultdisplay == 'belowheader' ) && $sliderdefaultcat != 'uncategorized' ){
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

// output html slider codes 
?>
<script type="text/javascript" language="javascript">
jQuery(function($) {
$(window).resize(function() {
<?php 
// start php to js
if( $displaytype != 'variable' && $childpagedisplay != 'fade' && ( $sliderdefaultdisplay == 'replaceheader' || $useheaderimage == 'replace' || $sliderdisplay == 'replaceheader' ) ){ 
echo  '$("#sliderbox-head").css("min-height", ( $(window).height() / 100) * '.$displaytype.' );';
}
if( $sliderdisplay == 'topfooter' || $sliderdefaultdisplay == 'topfooter' ){
echo  '$("#sliderbox-footer").css("min-height", ( $(window).height() / 100) * '.$footerheight.' );';
}
// end php to js 
?>
});

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
    enableKeyboard      : true,
    toggleArrows        : true,
    //delayBeforeAnimate : 500,	
    onSlideComplete : function(slider){ // update the hash AFTER the slide is in view (so we can animate)
	window.location.hash = '#' + slider.$currentPage[0].id;
	$('#current').html(window.location.hash); // get current
    },
    onInitialized: function(e, slider) {
        setupSwipe(slider);
    }
    /*	add a menu
    navigationFormatter : function(i, panel){
	return ['Webdesign', 'Interactief', 'Ontwerp', 'Ontwikkeling'][i - 1];
    },
    */

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

    slider.$window
        .bind(st, function(e) {
            // prevent image drag (Firefox)
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
				scrollTop: $("#contentcontainer").offset().top 
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
<?php // default font size, spacing and speed 
$size = ( $stylelayout_fontsize * 0.2 );
?>
body
{
font-size:<?php echo $size; ?>em;
}



<?php /* TOPBAR BEHAVIOR */

if( ( $displaytype == '50' && $mobile ) || ($displaytype == '66' || $displaytype == '75' 
|| $displaytype == '80' || $displaytype == '100' ) && $childpagedisplay != 'fade'){ 

$toppos = 'absolute'; 

}else{

if( $topbarbehavior == 'abso'){ 
$toppos = 'absolute'; 
}else{ 
$toppos = 'relative';
}

}

if( $mobile && $topbarbehavior == 'mini' ){ 
$toppos = 'relative';
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
}

<?php
/* 
if( $topbarbehavior != 'rela' ){ 
?>
div#topbar
{
position:<?php if( $topbarbehavior == 'fixe' || $topbarbehavior == 'mini' ){ echo 'fixed'; }else{ echo 'absolute';} ?>;
width:100%;
top:0px;
left:0px;
z-index:79;
}


<?php 
}

if( ( $displaytype == '50' && !$mobile ) || $displaytype == '33' || $displaytype == '25' || $displaytype == '20'){
}
*/

/*
// detect topbar overlay 
if( ( $displaytype == '50' && $mobile ) || ($displaytype == '66' || $displaytype == '75' 
|| $displaytype == '80' || $displaytype == '100' ) && $childpagedisplay != 'fade'){ 

if( $topbarbehavior != 'rela' ){
?>
div#topbar
{
position:<?php if( $topbarbehavior == 'fixe' || $topbarbehavior == 'mini' ){ echo 'fixed'; }else{ echo 'fixed';} ?>;
z-index:99;
width:100%;
top:0px;
left:0px;
z-index:79;
}
<?php 
} // end relative positioning 

} // end absolute positioning 
*/
?>

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
position:fixed;
top:0px;
left:0px;
height:100%;
width:100%;
z-index:80;
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
z-index:81;
background-color:#ffffff;
overflow:auto; 
}
#mainpopupbox .popupcontent
{
position:relative;
width:auto;
padding:4% 5%;
}


/* SLIDER STYLES */
div#sliderbox-head,
div#sliderbox-footer
{
position:relative;
width: 100%; 
<?php 
/* available mobile detect
if( $mobile ){ 
echo 'max-height:780px;'; 
}
if( $displaytype == 'variable'){
echo 'height: auto;'; 
}else{ 
echo 'height: 100%'; 
} 
*/ 
?>
}

/* Slider default styles
.. should move to style.css */
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
z-index:59;
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
position:relative;
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
}
</style>
<?php 
}

/**
 * HTML HEAD THEME DEFAULT CSS/JS
 * assets/global.js, assets/customizer.php
 */ 
// default js codes
echo '<script src="'.get_template_directory_uri().'/assets/global.js" type="text/javascript" language="javascript"></script>';


/**
 * CSS GLOBAL SETTINGS
 * htmlhead.php, assets/customizer.php, assets/global.js, 
 */

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
   <?php } ?>
});

$(window).on("mousewheel scroll", function() {

<?php
if( $topbarbehavior == 'mini' ){
?>
if( $(window).scrollTop() > 1 && !$("#topbar").hasClass('minified')){
	 <?php if($topbarbgfixed != 'keep'){ ?>
	 $("#topbar .minifiedtopbarbg").remove();
	 <?php } ?>
     $("#topbar").addClass('minified').append( $("<div>")
      .attr('class', 'minifiedtopbarbg')
      .css({
        /*backgroundColor:'#ffffff',  customize variable */
        position: 'absolute',
        top:0,
        left:0,
        opacity:<?php if($topbarbgfixed != 'keep'){ echo ( 100 - $topbaropacity) / 100; }else{ echo 0; } ?>,
        zIndex:-1,
        width:'100%', 
        height:'100%'
      }) 
    );

   $("#topbar .minifiedtopbarbg").animate({
       opacity:<?php echo ( 100 - $topbaropacity) / 100; ?>,
   }, <?php echo $stylelayout_speed; ?>);
   $(".logobox a img").stop().animate({
				width:'<?php echo get_theme_mod('onepiece_identity_panel_logosmall_maxwidth',80).'px'; ?>',
   }, <?php echo $stylelayout_speed; ?>);
   
   if(slider){
   slider.stop();
   }
   
}else if( $(window).scrollTop() <= 1 && $("#topbar").hasClass('minified') ){
   
   <?php if($topbarbgfixed != 'keep'){ ?>
   $("#topbar .minifiedtopbarbg").animate({
       opacity:0,
   }, <?php echo $stylelayout_speed; ?>, function(){
      this.remove();
   });
   <?php } ?>
   
   $(".logobox a img").stop().animate({
				width:'<?php echo get_theme_mod('onepiece_identity_panel_logo_maxwidth').'px'; ?>',
   }, <?php echo $stylelayout_speed; ?>);
   
   $("#topbar").removeClass('minified');
   
   if(slider){
   slider.start();
   }
} // end minify logobox


<?php  
}
if($mainmenubarbehavior == 'stic' && ($topbarbehavior == 'fixe' || $topbarbehavior == 'mini') ){ 
// #site-navigation
// or #topbar-navigation 
?>
var offset = $('#site-navigation').offset();
if( (offset.top - $(window).scrollTop()) < $("#topbar").height() && !$("#site-navigation .outermargin nav").hasClass('sticky')){
	// move mainmenu to topbar menu
	$("#site-navigation .outermargin nav").addClass('sticky');
	if( $('#topbar-navigation').length > 0 ){
	$('#topbar-navigation').after($("#site-navigation .outermargin nav"));
	}else{
	$('#topmenubar .outermargin .logobox').after($("#site-navigation .outermargin nav"));
	//$('#site-navigation .outermargin nav').prependTo( $('#topmenubar .outermargin') );
	}
}else if( (offset.top - $(window).scrollTop()) >= $("#topbar").height() && $("#topmenubar .outermargin nav").hasClass('sticky')){
	// move mainmenu back in place
	$("#topmenubar .outermargin nav.sticky")
	.removeClass('sticky')
	.appendTo("#site-navigation .outermargin");
}
<?php 
}
?>


});

});
</script>


<?php


/**
 * PAGE TEMPLATE GALLERY
 * gallery.php
 */ 
if($pageTemplate == 'gallery.php'){

// include Isotope & Imagesloaded javascript libs
echo '<script src="'.get_template_directory_uri().'/assets/isotope.js" type="text/javascript" language="javascript"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/isotope-packery.js" type="text/javascript" language="javascript"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/imagesloaded.js" type="text/javascript" language="javascript"></script>';

// generate css styles
echo '<style type="text/css">';
echo '#headercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logo_maxwidth').'px !important; }'; // not sure if needed
echo '#footercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logosmall_maxwidth').'px !important; }'; // not sure if needed

echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_small_width', 98).'%; max-width:'.get_theme_mod('onepiece_responsive_small_outermargin').'px; margin:0 auto; }'; 
echo '#itemcontainer .item{ width:50%; }';
echo '#itemcontainer .item.active{ width:100%; }';

// single column (sidebars on top/bottom) small 
echo '@media screen and (max-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '#maincontent,#mainsidebar,#pagesidebarcontainer,#sidebar2{float:none !important;width:100% !important;margin:0px auto;}'; 
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_medium_width', 95).'%;max-width:'.get_theme_mod('onepiece_responsive_medium_outermargin').'px; }'; 
// set medium width

echo '#itemcontainer .item{width:'.(100 / 3).'%;}'; 
echo '#itemcontainer .item.active{ width:'.((100 / 3)*2).'%; }';
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_medium_max', 1280).'px) {';
echo '.outermargin { max-width:'.get_theme_mod('onepiece_responsive_large_outermargin').'px; }'; 
// set large width 
$aw = 2;
if( $maxinrow > 3){
$aw = 3;
}
echo '#itemcontainer .item{width:'.(100 / $maxinrow).'%;}'; 
echo '#itemcontainer .item.active{ width:'.((100 / $maxinrow)*$aw).'%; }';
echo '}';
echo '</style>';

// generate Anything slider js
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
    
    <?php // get tag index from php
    if($tag_idx){ 
    echo 'var $tagindex = Array('.rtrim($tag_idx,',').');';
    } ?>
    
    var phsh = window.location.hash.substr(1);    
    if(phsh.length){    
        $catList = phsh;
        // check tags
        if( $.inArray( phsh, $tagindex ) != -1 ){
            $catList = '<?php echo $topcat; ?>';
            $tagList = phsh;
        }   
    }
    
    <?php // php to javascript
    if($tag_idx != ''){ 
    echo 'var $tagindex = Array('.rtrim($tag_idx,',').');';
    }else{
    echo 'var $tagindex = [];';
    }
    ?>

    var phsh = window.location.hash.substr(1);
    if(phsh != '' && $tagindex){  
        // check tags by hash
        if( $.inArray( phsh, $tagindex ) != -1 ){
            $catList = '<?php echo $topcat; ?>';
            $tagList = phsh;
        }else{
        $catList = phsh;
        $tagList = '';
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

    var posturl = '<a href="'+obj.posturl+'" title="'+obj.title+'" target="_self">';

    if( obj.meta['meta-box-custom-url'] && obj.meta['meta-box-custom-useurl'] == 'replaceblank'){
    posturl = '<a href="'+obj.meta['meta-box-custom-url']+'" title="'+obj.title+'" target="_blank">';
    }
    if( obj.meta['meta-box-custom-url'] && obj.meta['meta-box-custom-useurl'] == 'replaceself'){
    posturl = '<a href="'+obj.meta['meta-box-custom-url']+'" title="'+obj.title+'" target="_self">';
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

    if( obj.smallimg ){ 
    markup += '<div class="coverbox"><img class="coverimage" src="'+obj.smallimg[0]+'" alt="'+obj.title+'" /></div>';
    }
  
    // META DATA .. JSON.stringify(obj.meta)
    if( obj.meta['meta-box-custom-url'] && (obj.meta['meta-box-custom-useurl'] == 'external' || obj.meta['meta-box-custom-useurl'] == 'internal') ){
    	var urltext = obj.meta['meta-box-custom-url'];
	if( obj.meta['meta-box-custom-urltext'] ){
		urltext = obj.meta['meta-box-custom-urltext']; 
	}
	if( obj.meta['meta-box-custom-useurl'] == 'external' ){
		markup += '<a class="urlbutton" href="'+obj.meta['meta-box-custom-url']+'" target="_blank">';
	}else{
		markup += '<a class="urlbutton" href="'+obj.meta['meta-box-custom-url']+'" target="_self">';
	}
    	markup += urltext+'</a>';
    }
    
    markup += '<div class="textbox">'+obj.excerpt+'</div>';

	if(obj.meta['meta-box-custom-url']){
    		markup += '<div class="fullinfobox hidden">'+obj.meta['meta-box-custom-url']+'</div>';
	}

    markup += '</div></div>';
    return markup;

    /* 'id,'type','date','title','category','excerpt','content','meta','tags', 'imageurl','posturl','slug','customfieldarray','post_data' */
    }
   


    	// Grid items
	$container.on('click', '.item', function(){

<?php if( $clickaction == 'sizeup' ){ ?>

		$('.item').removeClass('active');
		$(this).addClass('active');
		$currCat = $(this).attr('data-category');
		var $this = $(this);

		$container.prepend($this).isotope('reloadItems').isotope({ sortBy: 'byCategory' }); // or 'original-order'
	
		$('html, body').animate({scrollTop: $('#maincontent').offset().top }, 400); // Scroll to top (bottom of header)

<?php } ?>

		return false;
	}); 


    // Filter menu's
    $('ul.tagmenu').hide();

    $('ul.categorymenu li a.category').click(function(m){

    m.preventDefault();

	$('.item').removeClass('active');
    $('ul.tagmenu.active').slideUp().removeClass('active');
    $('ul.categorymenu li a').removeClass('selected');
    $(this).addClass('selected');

    if( $(this).attr('data-filter') == '*'){
        var keyword = '*';
        $catList = '<?php echo $topcat; ?>';//[];
    }else{ 
        var keyword = '.'+$(this).attr('data-filter');
        // multiple filters: $catList += ','+$(this).attr('data-filter');
        $catList = $(this).attr('data-filter');
        var submenu = 'ul.tagmenu.'+$(this).attr('data-filter');
	    $(submenu).slideDown().addClass('active');
        }
        $tagList = '';
        
        loaditems();
        $container.isotope({ filter: keyword }).isotope('layout');
        window.location.hash = $catList;
        return false;

    });
  
    $('ul.tagmenu li a,div.tagcloud a').click(function(m){
  	    var keyword = '.'+$(this).text();
        $catList = $(this).attr('data-filter');
        $tags = $(this).text();
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
}


/**
 * HTML HEAD THEME CORE 
 * head end, body start
 * index.php, page.php, gallery.php
 */ 
 
// fontsize 
$globalfontsize = 0.4 + $stylelayout_fontsize / 10;
 
// buttons
$vertical_padding_line = ($stylelayout_spacing / 2) * 3;
$horizontal_padding_line = ($stylelayout_spacing / 3 ) * 2 ;

// headers / boxes
$vertical_padding_box = $stylelayout_spacing * 2;


echo '<style>';
echo 'body{ font-size:'.$globalfontsize.'em !important; }';
echo 'ul.menu li a { display:inline-block;padding:'.$vertical_padding_line.'px '.$horizontal_padding_line.'px; }';
echo 'h1,.readmore,p { display:inline-block;padding:'.$vertical_padding_line.'px 0px; }';
echo '</style>';
echo '</head><body '; body_class(); 
echo '><div id="pagecontainer"';
if($mobile){
echo ' class="mobile">';
}else{
echo '>';
}
?>
