<?php 
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);

/**
 *
 * main menu markup
 *
 */
 $mainmenuplace = get_theme_mod('onepiece_elements_mainmenubar_placement', 'below');
$mainbarclass = get_theme_mod( 'onepiece_elements_mainmenubar_position' , 'none'); 
$mainminisize = get_theme_mod( 'onepiece_elements_mainmenubar_minisize' , 'none').'-minisize';


/**
 *
 * top side bar
 *
 */ 
$topsidebarplace = get_theme_mod('onepiece_elements_topsidebar_position', 'none');
$topsidebarwidth = get_theme_mod( 'onepiece_elements_topsidebar_width' , '30'); 


/**
 *
 * header image or slider
 *
 */ 
global $wp_query;
$postid = $wp_query->post->ID;
$useheaderimage = get_post_meta($postid, "meta-page-headerimage", true);
$usepostfeaturedimage = get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default');
$childpagedisplay = get_post_meta($postid, "meta-box-display-childpages", true);
$thumbelarge = wp_get_attachment_url(get_post_thumbnail_id($postid));
wp_reset_query();


/**
 *
 * default slider options
 *
 */  
$sliderdefaultdisplay = get_theme_mod('onepiece_content_sliderbar_display', 'default' );
$sliderdefaultcat = get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' );
$sliderdefaultheight = get_theme_mod('onepiece_content_sliderbar_height', '60' );
$sliderdefaultwidth = get_theme_mod('onepiece_content_sliderbar_width', 'full' );


/**
 *
 * page slider options
 *
 */  
$sliderdisplay = get_post_meta(get_the_ID(), "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta(get_the_ID(), "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta(get_the_ID(), "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta(get_the_ID(), "pagetheme_slide_displaywidth", true);


/**
 *
 * headercontent container
 *
 */  
echo '<div id="headercontainer">'; 

echo '<div id="topbar">';


/**
 *
 * widgets top
 *
 */   
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-top') ){
$count = is_sidebar_active('widgets-top');
echo '<div id="widgets-top" class="colset-'.$count.'">';
echo '<div class="outermargin">';
dynamic_sidebar('widgets-top');
echo '<div class="clr"></div></div></div>';
} 


/**
 * login 
 */
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'pgtop'){
display_userpanel();
}




/**
 *
 * topbar menu position
 *
 */  
$topbarclass = 'right';
if( get_theme_mod( 'onepiece_elements_topmenubar_position') ){
    $topbarclass = get_theme_mod( 'onepiece_elements_topmenubar_position', 'right');
}


echo '<div id="topmenubar"><div class="outermargin">';

/**
 *
 * set topbar floatmargin
 *
 */   
if( $topsidebarplace != 'none' && function_exists('is_sidebar_active') && is_sidebar_active('widgets-top-sidebar') ){
$topbarmarginfloatpos = 'left';

if( $topsidebarplace == 'left'){
$topbarmarginfloatpos = 'right';
}
echo '<div id="topbarmargin" class="'.$topbarclass.' '.$topbarmarginfloatpos.'side" style="float:'.$topbarmarginfloatpos.';width:'.( 100 - $topsidebarwidth).'%;">';

}else{

echo '<div id="topbarmargin" class="'.$topbarclass.'" style="width:100%">';

}

/**
 *
 * logobox menu
 *
 */   
echo '<div class="logobox medium">';
if ( get_theme_mod( 'onepiece_identity_logo_m' ) ){
echo '<a href="'.esc_url( home_url( '/' ) ).'" class="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_theme_mod( 'onepiece_identity_logo_m' ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).' - '.get_bloginfo( 'description' ).'"></a>';
}else{ 
echo '<hgroup><h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a></h1>';
echo '<h2 class="site-description">'.get_bloginfo( 'description' ).'</h2></hgroup>';
}
echo '</div>';


/**
 *
 * mini menu 
 *
 */  
if ( has_nav_menu( 'minimenu' ) ) {
echo '<div id="minibar-navigation" class="mini-navigation" role="navigation"><nav>';
echo wp_nav_menu( array( 'theme_location' => 'minimenu' ) );
echo '<div class="clr"></div></nav></div><div style="clear:'.$topbarclass.';"></div>';
}

/**
 * login 
 */
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'tbtop'){
display_userpanel();
}


/**
 *
 * topmenu
 *
 */  
if ( has_nav_menu( 'topmenu' ) && get_theme_mod( 'onepiece_elements_topmenubar_position', 'right') != 'none' ) {
echo '<div id="topbar-navigation" class="main-navigation" role="navigation"><nav>';
if ( has_nav_menu( 'topmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'topmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}



/**
 *
 * mainmenu in topbar
 *
 */  

if($mainmenuplace == 'topbar' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.' '.$mainminisize.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
echo wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
echo wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}

echo '</div>'; // close topbar float margin 


/**
 *
 * widgets-top-sidebar
 *
 */  
 
$logindisplay = get_theme_mod('onepiece_elements_loginbar_option', 'none');
 
if( ($topsidebarplace != 'none' && function_exists('is_sidebar_active') && is_sidebar_active('widgets-top-sidebar') ) || 
$logindisplay == 'tstop' || $logindisplay == 'tsbot' ){

$count = is_sidebar_active('widgets-top-sidebar');
echo '<div id="topsidebar" class="colset-'.$count.' '.$topsidebarplace.'side" style="float:'.$topsidebarplace.';width:'.$topsidebarwidth.'%;">';

if( $logindisplay == 'tstop'){
display_userpanel();
}

if( is_sidebar_active('widgets-top-sidebar') ){
dynamic_sidebar('widgets-top-sidebar');
}

if( $logindisplay == 'tsbot'){
display_userpanel();
}


echo '<div class="clr"></div></div>';
} 




echo '<div class="clr"></div></div></div>'; // end topmenubar


echo '</div>'; // end topbar



/**
 *
 * mainmenu above header
 *
 */  
if($mainmenuplace == 'above' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.' '.$mainminisize.'" role="navigation"><div class="outermargin"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div></div>';
}


/**
 *
 * Slider or (featured) headerimage
 *
 */  
if( $sliderdisplay == 'replaceheader' && $slidercat != 'uncategorized' && ( $useheaderimage != 'replace' ||  $childpagedisplay != 'fade') ){

if( $sliderwidth != 'full' ){
echo '<div class="outermargin">';
}

// page slider
echo '<div id="sliderbox-head">'. sliderhtml($slidercat, $mobile, 'header-page') .'</div>';
if( $sliderwidth != 'full' ){
echo '</div>';
}

}else if(  $childpagedisplay == 'fade' || ( ($usepostfeaturedimage == 'replace' ||  $usepostfeaturedimage == 'replacemargin') && is_single() ) && has_post_thumbnail() ){

if( $usepostfeaturedimage == 'replacemargin' ){
echo '<div class="outermargin">';
}

$thumbelarge = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() , 'large' ) );// 

if($childpagedisplay == 'fade'){
echo '<div id="headerbar" style="background-image: url('.esc_url( $thumbelarge ).');"><div class="bglayer" style="width:100%; height: 100%; display: block; background-image: none;"></div></div>';
}else{
echo '<div id="headerbar" style="background-image: url('.esc_url( $thumbelarge ).');"><div class="bglayer" style="width:100%; height: 100%; display: block; background-image: none;"></div></div>';
}

if( $usepostfeaturedimage == 'replacemargin' ){
echo '</div>';
}

}else if( $sliderdefaultdisplay == "replaceheader" && ( $useheaderimage != 'replace' && $childpagedisplay != 'fade' && $sliderdisplay != 'none')){



/**
 *
 * default slider content here
 *
 */  

if( $sliderdefaultwidth != 'full' ){
echo '<div class="outermargin">';
}
// default slider
echo '<div id="sliderbox-head">'. sliderhtml($sliderdefaultcat, $mobile, 'header-default'). '<div class="clr"></div></div>';
if( $sliderdefaultwidth != 'full' ){
echo '</div>';
}

}else{ 


/**
 *
 * headerimage
 *
 */  
$header_image = get_header_image(); 

if ( (is_page() && $thumbelarge != '' && ( $useheaderimage == 'replace' || $childpagedisplay == 'fade' ) ) || (is_single() && $usepostfeaturedimage == 'replace' && $thumbelarge != '' ) ){
$header_image = $thumbelarge;
}

if (( !empty( $header_image ) && $useheaderimage != 'hide'  ) || $childpagedisplay == 'fade' ) :

if( get_theme_mod( 'onepiece_elements_headerimage_width' , 'full') != 'full' ){
echo '<div class="outermargin">';
}

echo '<div id="headerbar" style="background-image: url('.esc_url( $header_image ).');"><div class="bglayer" style="width:100%; height: 100%; display: block; background-image: none;"></div></div>';

//echo '<img src="'.esc_url( $header_image ).'" class="header-image" alt="'.get_bloginfo( 'description' ).'" />';
if( get_theme_mod( 'onepiece_elements_headerimage_width' , 'full') != 'full' ){
echo '<div class="clr"></div></div>';
}
endif; 
} // end headerimage



if( $sliderdisplay == 'belowheader' && $slidercat != 'uncategorized'){



/**
 *
 * default slider options
 *
 */  
if( $sliderwidth != 'full' ){
echo '<div class="outermargin">';
}
echo '<div id="sliderbox-head">'. sliderhtml($slidercat, $mobile, 'header-page'). '<div class="clr"></div></div>';
if( $sliderwidth != 'full' ){
echo '</div>';
}
}elseif( $sliderdefaultdisplay == "belowheader" && $sliderdefaultcat != 'uncategorized' && $sliderdisplay != 'none' && $sliderdisplay != 'replaceheader' ){


/**
 *
 * default slider options
 *
 */  
if( $sliderdefaultwidth != 'full' ){
echo '<div class="outermargin">';
}
echo '<div id="sliderbox-head">'. sliderhtml($sliderdefaultcat, $mobile, 'header-default') .'<div class="clr"></div></div>';
if( $sliderdefaultwidth != 'full' ){
echo '</div>';
}
}
 


/**
 *
 * widgets header
 *
 */ 
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-onepiece-header') ){
$count = is_sidebar_active('widgets-onepiece-header');
echo '<div id="widgets-header" class="colset-'.$count.'">';
dynamic_sidebar('widgets-onepiece-header');
echo '<div class="clr"></div></div>';
}


/**
 *
 * mainmenu below header
 *
 */ 
if($mainmenuplace == 'below' && $mainbarclass != 'none' ){

echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.'  '.$mainminisize.'" role="navigation"><div class="outermargin"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
echo wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}elseif( 

	!has_nav_menu( 'minimenu' ) && 
	!has_nav_menu( 'topmenu' ) && 
	!has_nav_menu( 'mainmenu' ) && 
	!has_nav_menu( 'usermenu' ) &&
	!has_nav_menu( 'sidemenu' ) &&
	!has_nav_menu( 'bottommenu' )
	){
	echo wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu '.$mainminisize ) );
} 
echo '<div class="clr"></div></nav></div></div>';

}


echo '<div class="clr"></div></div>';
?>
