<?php // footer
$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);



/**
 *
 * Bottom side bar
 *
 */ 
$bottomsidebarplace = get_theme_mod('onepiece_elements_bottom_sidebar_position', 'right');
$bottomsidebarwidth = get_theme_mod( 'onepiece_elements_bottom_sidebar_width' , '30'); 

/*
 * Bottom login
 */
$logindisplay = get_theme_mod('onepiece_elements_loginbar_option', 'none');

 

/**
 *
 * Bottom menu position
 *
 */ 
$bottombarclass = 'right';
if( get_theme_mod( 'onepiece_elements_bottommenubar_position') ){
    $bottombarclass = get_theme_mod( 'onepiece_elements_bottommenubar_position', 'right');
}
echo '<div id="footercontainer" class="menu-'.$bottombarclass.'">';



if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-bottom-top') ){
echo '<div class="outermargin"><div id="widgets-bottom-top">';
dynamic_sidebar('widgets-bottom-top');
echo '<div class="clr"></div></div></div>';
}




/**
 *
 * Bottom Slider
 *
 */ 
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




echo '<div class="outermargin">';





/**
 *
 * set bottom bar floatmargin
 *
 */   
if( ( $bottomsidebarplace != 'none' && function_exists('is_sidebar_active') && is_sidebar_active('widgets-bottom-sidebar') ) 
|| $logindisplay == 'bsbtop' || $logindisplay == 'bsbbot' ){
$bottombarmarginfloatpos = 'left';
if( $bottomsidebarplace == 'left'){
$bottombarmarginfloatpos = 'right';
}
echo '<div id="bottombarmargin" class="'.$bottombarclass.' '.$bottombarmarginfloatpos.'side" style="float:'.$bottombarmarginfloatpos.';width:'.( 100 - $bottomsidebarwidth).'%;">';

}else{

echo '<div id="bottombarmargin" class="'.$bottombarclass.'" style="width:100%">';

}




echo '<div class="logobox small">';
if ( get_theme_mod( 'onepiece_identity_logo_s' ) ){
echo '<a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_theme_mod( 'onepiece_identity_logo_s' ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).' - '.get_bloginfo( 'description' ).'"></a>';
}else{ 
echo '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a></h1>';
}
echo '</div>';





if ( has_nav_menu( 'bottommenu' ) && get_theme_mod( 'onepiece_elements_bottommenubar_position') != 'none' ) {
echo '<div id="footer-navigation" class="main-navigation '.$bottombarclass.'" role="navigation"><nav>';
wp_nav_menu( array( 'theme_location' => 'bottommenu' ) );
echo '<div class="clr"></div></nav></div>';
}

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-bottom') ){
echo '<div id="widgets-bottom">';
dynamic_sidebar('widgets-bottom');
echo '<div class="clr"></div></div>';
} 


echo '</div>'; // close topbar float margin 

/**
 *
 * widgets-bottom-sidebar
 *
 */  
if( ( $bottomsidebarplace != 'none' && function_exists('is_sidebar_active') && is_sidebar_active('widgets-bottom-sidebar') ) ||
$logindisplay == 'bsbtop' || $logindisplay == 'bsbbot'  ){

$count = is_sidebar_active('widgets-bottom-sidebar');
echo '<div id="bottomsidebar" class="colset-'.$count.' '.$bottomsidebarplace.'side" style="float:'.$bottomsidebarplace.';width:'.$bottomsidebarwidth.'%;">';

if( $logindisplay == 'bsbtop'){
display_userpanel();
}

if( is_sidebar_active('widgets-bottom-sidebar') ){
dynamic_sidebar('widgets-bottom-sidebar');
}

if( $logindisplay == 'bsbbot'){
display_userpanel();
}

echo '<div class="clr"></div></div>';
} 


$copyrighttext = get_theme_mod('onepiece_elements_bottom_copyrighttext' , '');
$copyrightpos = get_theme_mod('onepiece_elements_bottom_copyrightposition', 'hide');
if(  $copyrighttext != '' && $copyrightpos != 'hide'){
echo '<div class="clr"></div><div id="copyright-textbox" class="'.$copyrightpos.'">';
echo $copyrighttext;
echo '</div>';
}

echo '<div class="clr"></div></div>';
echo '</div>';
?>
