<?php // footer
$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);

$bottombarclass = 'right';
if( get_theme_mod( 'onepiece_elements_bottommenubar_position') ){
    $bottombarclass = get_theme_mod( 'onepiece_elements_bottommenubar_position');
}
echo '<div id="footercontainer" class="menu-'.$bottombarclass.'">';


// slider options
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

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-subcontent') ){
echo '<div id="widgets-subcontent">';
dynamic_sidebar('widgets-subcontent');
echo '<div class="clr"></div></div>';
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


if(  get_theme_mod('onepiece_elements_bottom_copyrighttext') != '' ){
echo '<div id="copyright-textbox">';
echo get_theme_mod('onepiece_elements_bottom_copyrighttext');
echo '<div class="clr"></div></div>';
}

echo '<div class="clr"></div></div>';
echo '</div>';
?>
