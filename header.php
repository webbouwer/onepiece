<?php 
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);


// main menu markup
$mainmenuplace = get_theme_mod('onepiece_elements_mainmenubar_placement', 'below');
$mainbarclass = get_theme_mod( 'onepiece_elements_mainmenubar_position' , 'none'); 


// header image or slider
if ( is_page() || is_single() ){
global $wp_query;
$postid = $wp_query->post->ID;
$useheaderimage = get_post_meta($postid, "meta-page-headerimage", true);
$usepostfeaturedimage = get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default');
$childpagedisplay = get_post_meta($postid, "meta-box-display-childpages", true);
$thumbelarge = wp_get_attachment_url(get_post_thumbnail_id($postid));
wp_reset_query();
}

// default slider options
$sliderdefaultdisplay = get_theme_mod('onepiece_content_sliderbar_display', 'default' );
$sliderdefaultcat = get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' );
$sliderdefaultheight = get_theme_mod('onepiece_content_sliderbar_height', '60' );
$sliderdefaultwidth = get_theme_mod('onepiece_content_sliderbar_width', 'full' );

// page slider options
$sliderdisplay = get_post_meta(get_the_ID(), "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta(get_the_ID(), "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta(get_the_ID(), "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta(get_the_ID(), "pagetheme_slide_displaywidth", true);

/*
// get html for default slider and page slider if available
if( $sliderdefaultdisplay == 'replaceheader' && $sliderdefaultcat != 'uncategorized' ){
    $headerstyle = 'style="height:'.$sliderdefaultheight.'%;min-height:'.$sliderdefaultheight.'%;"';
}
if( $sliderdisplay == 'replaceheader' && $slidercat != 'uncategorized' && $sliderheight != 'variable' ){
    $headerstyle = 'style="height:'.$sliderheight.'%;min-height:'.$sliderheight.'%;"';
}
*/
echo '<div id="headercontainer"><div id="topbar"><div class="outermargin">';

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-top') ){
$count = is_sidebar_active('widgets-top');
echo '<div id="widgets-top" class="colset-'.$count.'">';
dynamic_sidebar('widgets-top');
echo '<div class="clr"></div></div>';
} 


$topbarclass = 'right';
if( get_theme_mod( 'onepiece_elements_topmenubar_position', 'right') ){
    $topbarclass = get_theme_mod( 'onepiece_elements_topmenubar_position', 'right');
}
echo '<div id="topmenubar" class="'.$topbarclass.'">';

echo '<div class="logobox medium">';
if ( get_theme_mod( 'onepiece_identity_logo_m' ) ){
echo '<a href="'.esc_url( home_url( '/' ) ).'" class="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_theme_mod( 'onepiece_identity_logo_m' ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).' - '.get_bloginfo( 'description' ).'"></a>';
}else{ 
echo '<hgroup><h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a></h1>';
echo '<h2 class="site-description">'.get_bloginfo( 'description' ).'</h2></hgroup>';
}
echo '</div>';


if ( has_nav_menu( 'topmenu' ) && get_theme_mod( 'onepiece_elements_topmenubar_position', 'right') != 'none' ) {
echo '<div id="topbar-navigation" class="main-navigation" role="navigation"><nav>';
if ( has_nav_menu( 'topmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'topmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}
echo '<div class="clr"></div></div>';





if($mainmenuplace == 'topbar' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
echo wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
echo wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}

echo '</div>'; // end topbar

if($mainmenuplace == 'above' && $mainbarclass != 'none'){
echo '<div class="outermargin"><div id="site-navigation" class="main-navigation '.$mainbarclass.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div></div>';
}



// Slider or (featured) headerimage
if( $sliderdisplay == 'replaceheader' && $slidercat != 'uncategorized' && ( $useheaderimage != 'replace' ||  $childpagedisplay != 'fade') ){
// slider content here 
if( $sliderwidth == 'full' ){
echo '</div>';
}
// page slider
echo '<div id="sliderbox-head">'. sliderhtml($slidercat, $mobile, 'header-page') .'</div>';
if( $sliderwidth == 'full' ){
echo '<div class="outermargin">';
}

}else if(  $childpagedisplay == 'fade' || ( ($usepostfeaturedimage == 'replace' ||  $usepostfeaturedimage == 'replacemargin') && is_single() ) && has_post_thumbnail() ){
if( $usepostfeaturedimage == 'replace' ){
echo '</div>';
}
$thumbelarge = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));// the_post_thumbnail('big-thumb');
if($childpagedisplay == 'fade'){
echo '<div id="headerbar" style="background-image: url('.esc_url( $thumbelarge ).');"><div class="bglayer" style="width:100%; height: 100%; display: block; background-image: none;"></div></div>';
}else{
echo '<img src="'.esc_url( $thumbelarge ).'" class="header-image" alt="'.get_bloginfo( 'description' ).'" />';
}

if( $usepostfeaturedimage == 'replace' ){
echo '<div class="outermargin">';
}

   
}else if( $sliderdefaultdisplay == "replaceheader" && ( $useheaderimage != 'replace' && $childpagedisplay != 'fade' && $sliderdisplay != 'none')){
/*&& $sliderdefaultcat != 'uncategorized' && $sliderdisplay != 'none' && $sliderdisplay != 'belowheader' && ( !is_page() && $useheaderimage != 'replace')){*/

// default slider content here
if( $sliderdefaultwidth == 'full' ){
echo '</div>';
}
// default slider
echo '<div id="sliderbox-head">'. sliderhtml($sliderdefaultcat, $mobile, 'header-default'). '<div class="clr"></div></div>';
if( $sliderdefaultwidth == 'full' ){
echo '<div class="outermargin">';
}

}else{ // headerimage
$header_image = get_header_image(); 
if ( (is_page() && ( $useheaderimage == 'replace' || $childpagedisplay == 'fade' ) ) || (is_single() && $usepostfeaturedimage == 'replace') ){
$header_image = $thumbelarge;
}

if (( !empty( $header_image ) && $useheaderimage != 'hide'  ) || $childpagedisplay == 'fade' ) :
if( get_theme_mod( 'onepiece_elements_headerimage_width' , 'full') == 'full' ){
echo '</div>';
}
echo '<img src="'.esc_url( $header_image ).'" class="header-image" alt="'.get_bloginfo( 'description' ).'" />';
if( get_theme_mod( 'onepiece_elements_headerimage_width' , 'full') == 'full' ){
echo '<div class="clr"></div><div class="outermargin">';
}
endif; 
} // end headerimage



if( $sliderdisplay == 'belowheader' && $slidercat != 'uncategorized'){
// slider content here
if( $sliderwidth == 'full' ){
echo '</div>';
}
echo '<h2>'.$sliderdisplay.' pageslider </h2>';
echo '<div id="sliderbox-head">'. sliderhtml($slidercat, $mobile, 'header-page'). '<div class="clr"></div></div>';
if( $sliderwidth == 'full' ){
echo '<div class="outermargin">';
}
}elseif( $sliderdefaultdisplay == "belowheader" && $sliderdefaultcat != 'uncategorized' && $sliderdisplay != 'none' && $sliderdisplay != 'replaceheader' ){

// default slider content here
if( $sliderdefaultwidth == 'full' ){
echo '</div>';
}
echo '<div id="sliderbox-head">'. sliderhtml($sliderdefaultcat, $mobile, 'header-default') .'<div class="clr"></div></div>';
if( $sliderdefaultwidth == 'full' ){
echo '<div class="outermargin">';
}
}



if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-onepiece-header') ){
$count = is_sidebar_active('widgets-onepiece-header');
echo '<div id="widgets-header" class="colset-'.$count.'">';
dynamic_sidebar('widgets-onepiece-header');
echo '<div class="clr"></div></div>';
}


if($mainmenuplace == 'below' && $mainbarclass != 'none' ){
if( $sliderdisplay != 'replaceheader' && $sliderdefaultdisplay != 'replaceheader' && empty( $header_image )){
echo '<div class="outermargin">';
}
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
echo wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
echo wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
if( $sliderdisplay != 'replaceheader' && $sliderdefaultdisplay != 'replaceheader' && empty( $header_image )){
echo '</div>';
}
}


echo '<div class="clr"></div></div></div>';
?>