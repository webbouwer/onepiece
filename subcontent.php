<?php // subcontent
$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);



/**
 *
 * Bottom side bar
 *
 */
$subcontentsidebarplace = get_theme_mod('onepiece_elements_subcontent_sidebar_position', 'right');
$subcontentsidebarwidth = get_theme_mod( 'onepiece_elements_subcontent_sidebar_width' , '30');

/*
 * Subcontent login
 */
$subcontentlogindisplay = get_theme_mod('onepiece_elements_loginbar_option', 'none');


/**
 *
 * Bottom menu position
 *
 */
$subcontentbarclass = 'right';
if( get_theme_mod( 'onepiece_elements_subcontent_sidebar_position') ){
    $subcontentbarclass = get_theme_mod( 'onepiece_elements_subcontent_sidebar_position', 'right');
}


echo '<div id="subcontainer" class="menu-'.$subcontentbarclass.'">';

/**
 *
 * Subcontent Slider
 *

$sliderdefaultdisplay = get_theme_mod('onepiece_content_sliderbar_display', 'none' );
$sliderdefaultcat = get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' );
$sliderdefaultheight = get_theme_mod('onepiece_content_sliderbar_height', '60' );
$sliderdefaultwidth = get_theme_mod('onepiece_content_sliderbar_width', 'full' );

$sliderdisplay = get_post_meta(get_the_ID(), "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta(get_the_ID(), "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta(get_the_ID(), "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta(get_the_ID(), "pagetheme_slide_displaywidth", true);

if( $sliderdisplay && $sliderdisplay == 'topfooter' && $slidercat != 'uncategorized' ){

// slider content here
if( $sliderwidth != 'full' ){
echo '<div class="outermargin">';
}
echo '<div id="sliderbox-footer">'. sliderhtml($slidercat, $mobile, 'footer-page'). '<div class="clr"></div></div>';
if( $sliderwidth != 'full' ){
echo '</div>';
}

}elseif( $sliderdefaultdisplay == "topfooter" && $sliderdefaultcat != 'uncategorized' && $sliderdisplay != 'none' ){
// default slider content here
if( $sliderdefaultwidth != 'full' ){
echo '<div class="outermargin">';
}
echo '<div id="sliderbox-footer">'. sliderhtml($sliderdefaultcat, $mobile, 'footer-default'). '<div class="clr"></div></div>';
if( $sliderdefaultwidth != 'full' ){
echo '</div>';
}
}


*/

echo '<div class="outermargin">';



/**
 *
 * set bottom bar floatmargin
 *
 */
if( ( $subcontentsidebarplace != 'none' && function_exists('is_sidebar_active') && is_sidebar_active('widgets-subcontent-sidebar') )
|| $subcontentlogindisplay == 'sbctop' || $subcontentlogindisplay == 'sbcbot' ){
$subbarmarginfloatpos = 'left';
if( $subcontentsidebarplace == 'left'){
$subbarmarginfloatpos = 'right';
}
echo '<div id="subcontentbarmargin" class="'.$subcontentbarclass.' '.$subbarmarginfloatpos.'side" style="float:'.$subbarmarginfloatpos.';width:'.( 100 - $subcontentsidebarwidth).'%;">';

}else{

echo '<div id="subcontentbarmargin" class="'.$subcontentbarclass.'" style="width:100%">';

}

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-subcontent') ){
echo '<div id="widgets-subcontent">';
dynamic_sidebar('widgets-subcontent');
echo '<div class="clr"></div></div>';
}

echo '</div>';




/**
 *
 * widgets-bottom-sidebar
 *
 */
if( ( $subcontentsidebarplace != 'none' && function_exists('is_sidebar_active') && is_sidebar_active('widgets-subcontent-sidebar') ) ||
$logindisplay == 'sbctop' || $logindisplay == 'sbcbot'  ){

$count = is_sidebar_active('widgets-subcontent-sidebar');
echo '<div id="subcontentsidebar" class="colset-'.$count.' '.$subcontentsidebarplace.'side" style="float:'.$subcontentsidebarplace.';width:'.$subcontentsidebarwidth.'%;">';

if( $logindisplay == 'sbctop'){
display_userpanel();
}

if( is_sidebar_active('widgets-subcontent-sidebar') ){
dynamic_sidebar('widgets-subcontent-sidebar');
}

if( $logindisplay == 'sbcbot'){
display_userpanel();
}

echo '<div class="clr"></div></div>';
}


echo '<div class="clr"></div></div></div>';



?>
