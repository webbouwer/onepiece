<?php
/**
 * Template Name: Slider
 * List posts in a slider with the Anything Slider
 */
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);
echo '<!DOCTYPE HTML>'; 
echo '<html '; 
language_attributes(); 
echo '><head>';

get_template_part('htmlhead');

// page specific options/variables
global $post;
$values = get_post_custom( $post->ID );
$selected = isset( $values['pagetheme_cat1_selectbox'] ) ? $values['pagetheme_cat1_selectbox'][0] : '';
if($selected){
$topcat = $selected;
}else{
$topcat =  get_theme_mod( 'fndtn_theme2_cat1' );
}

// header / slider size
$displaytype = isset( $values['pagetheme_display_selectbox'] ) ? $values['pagetheme_display_selectbox'][0] : '';
$displaytype2 = isset( $values['pagetheme_display_selectbox2'] ) ? $values['pagetheme_display_selectbox2'][0] : '';

// jquery Anything Slider | http://css-tricks.com/examples/AnythingSlider/ | https://github.com/ProLoser/AnythingSlider/wiki/Setup 
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.min.js"></script>';
// Anything Slider optional FX extension
echo '<script type="text/javascript" language="javascript" src="'.esc_url( get_template_directory_uri() ).'/assets/jquery.anythingslider.fx.min.js"></script>'; 


?>
<script type="text/javascript" language="javascript">
jQuery(document).ready(function($) {

$('#slider').anythingSlider({
			
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
        setupSwipe(slider);
    }
/*	
    navigationFormatter : function(i, panel){
	return ['Webdesign', 'Interactief', 'Ontwerp', 'Ontwikkeling'][i - 1];
    },
*/

});
<?php /* if( $displaytype == '75' || $displaytype == '80' || $displaytype == '100' ){ ?>
$('#slidedownbutton').click(function(){
	$('html, body').animate({ scrollTop: $("#maincontainer").offset().top }, 500);
});
<?php }  */ ?>

   		
});


	

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
				scrollTop: $("#maincontainer").offset().top 
			},{
        			duration: 800,
        			complete: function () {
                		
        			}
      			});
                }

                if ( newy > y ) {

			 $('html, body').animate({
				scrollTop: $("#topcontainer").offset().top 
			},{
        			duration: 400,
        			complete: function () {
        			}
      			});

                }
          
                t = 0;
                y = 0;

            }
        });
};
			
</script>			
<style type="text/css">

<?php if( $displaytype == '75' || $displaytype == '80' || $displaytype == '100' ){ ?>
div#topcontainer

{
position:absolute;
z-index:99;
width:100%;
top:0px;
left:0px;
}
div#slidedownbutton
{
position:absolute;
z-index:99;
width:100%;
bottom:0px;
left:0px;
text-align:center;
}
div#slidedownbutton span
{
display:inline-block;
padding:15px;
color:#ffffff;
}
<?php } ?>

div#sliderbox
{
position:relative;
width: 100%; 
min-height:280px;
<?php if( $mobile ){ 
echo 'max-height:780px;'; 
}
if( $displaytype == 'variable'){
echo 'height: auto;'; 
}else{ 
echo 'height: '.$displaytype.'%'; 
} ?>
}



#slider {
width: 100%; 
min-height: 100%; 
list-style: none;
overflow-y: auto;
overflow-x: hidden;
}

#slider li.panel 
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
}
div.anythingSlider span.back
{
}
div.anythingSlider span.forward
{
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
echo '</head><body ';
body_class(); 
echo '>';

get_template_part('header');


if( get_theme_mod( 'fndtn_view_scale_headermargin' ) == 'no' || $displaytype2 == 'margin'){	
    if( $displaytype2 == 'margin'){
    	$outermargin = ' class="outermargin"';
    }
}
echo '<div id="sliderbox"'.$outermargin.'>';

// set slider container
$cat1 = get_category_by_slug( $topcat ); 
if( $cat1->term_id ){
	query_posts('category_name='.$cat1->cat_name);
        echo '<ul id="slider">';
        if (have_posts()) : while (have_posts()) : the_post();

	echo '<li class="panel"';
	if ( get_post_thumbnail_id( get_the_ID() ) ) {
	$aid = get_post_thumbnail_id( get_the_ID() );
    	$large_image_url = wp_get_attachment_image_src( $aid, 'full' );
    	$small_image_url = wp_get_attachment_image_src( $aid, 'big-thumb' );
	if($mobile){ 
	echo ' style="background-image:url('.$small_image_url[0].');"';
	}else{
	echo ' style="background-image:url('.$large_image_url[0].');"';
	}
	}
	echo '>';
        echo '<div class="slidebox"><div class="outermargin">';
	echo '<h3>'.get_the_title().'</h3>';
	echo '<div>'.get_the_excerpt().'</div>';
	echo '</div></div></li>';

        endwhile; endif; 
	wp_reset_query();
	echo '</ul>';
}
/* if( $displaytype == '75' || $displaytype == '80' || $displaytype == '100' ){
echo '<div id="slidedownbutton"><span>Scroll down</span></div>';
} */
echo '<div class="clr"></div></div>';


echo '<div id="maincontainer"><div class="outermargin"><div id="contentbox">';

// get page
if ( have_posts() ) : 
while( have_posts() ) : the_post();
?>
<div id="page-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
<?php
if ( has_post_thumbnail() ) {
the_post_thumbnail('medium');
}
echo '<h1><a href="'.get_the_permalink().'">'.get_the_title().'</a></h1>';
echo get_the_date();
echo get_the_author();
if ( is_super_admin() ) {
edit_post_link( __( 'Edit' , 'fndtn' ), '<span class="edit-link">', '</span>' );
}
echo apply_filters('the_content', get_the_content());

// sharebox
if ( get_theme_mod( 'fndtn_elements_frontendshare_options' ) && ( get_theme_mod( 'fndtn_elements_frontendshare_options' ) == 'post' ||
get_theme_mod( 'fndtn_elements_frontendshare_options' ) == 'all' ) ){
// post thumb url
if ( has_post_thumbnail() ) {
$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
$imageurl = $attachment_image['0'];
}else{
$imageurl = ''; // default image
}
display_sharebox(get_the_permalink(),get_the_title(),'shared article @ '.$_SERVER['SERVER_NAME'] , $imageurl );
}

$defaults = array(
		'before'           => '<div>' . __( 'Pages:'  , 'fndtn' ),
		'after'            => '</div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page'  , 'fndtn' ),
		'previouspagelink' => __( 'Previous page'  , 'fndtn' ),
		'pagelink'         => '%',
		'echo'             => 1
);
wp_link_pages( $defaults );

echo'</div>';

// page comments
if ( comments_open() || get_comments_number() ) {
comments_template(); // WP THEME STANDARD: comments_template( $file, $separate_comments );
}
endwhile;
endif; 

echo '</div>';

if ( (has_nav_menu( 'sidemenu' ) || ( function_exists('dynamic_sidebar') && is_sidebar_active('sidebar') )) && get_theme_mod( 'fndtn_theme2_sidebar' ) == 'show' ){ 
echo '<div id="sidebarbox">';
if ( has_nav_menu( 'sidemenu' ) ) { 
echo '<div class="sidemenubar">';
wp_nav_menu( array( 'theme_location' => 'sidemenu' ) ); 
echo '<div class="clr"></div></div>';
}
if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar') ){
dynamic_sidebar('sidebar');
} 
echo '</div>';
}
echo '<div class="clr"></div>';

echo'</div>';

echo'</div>'; 

get_template_part('footer');

wp_footer();

echo '</body></html>';