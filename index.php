<?php /* Code made with love in Brackets on Github */
// htmlhead
get_template_part('htmlhead');
// header
get_template_part('header');
/*
 * main login 
 */
$logindisplay = get_theme_mod('onepiece_elements_loginbar_option', 'none');


/*
 * Breadcrumbs
 */
$breadcrumbsdisplay = get_theme_mod( 'onepiece_elements_breadcrumbs_display' , 'top');

// content
echo '<div id="contentcontainer"><div class="outermargin">';

$contentpercentage = 100; 

if( get_theme_mod('onepiece_elements_sidebar2_position2', 'out') == 'out' ){
if (  ( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position', 'none') != 'none' )
|| ( $logindisplay == 'sb2top' || $logindisplay == 'sb2bottom' )  ){

$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width', 28); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2', 'out').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width', 20).'%;">';

get_template_part('sidebar2');

echo '<div class="clr"></div></div>';
}
}



if( ( function_exists('is_sidebar_active') && is_sidebar_active('sidebar') && get_theme_mod('onepiece_elements_sidebar_position', 'left') != 'none' )
|| $logindisplay == 'sbtop' || $logindisplay == 'sbbottom' || has_nav_menu( 'sidemenu' ) ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_mainsidebar_width', 28); 
echo '<div id="mainsidebar" class="'.get_theme_mod('onepiece_elements_sidebar_position', 'left').'side" style="float:'.get_theme_mod('onepiece_elements_sidebar_position', 'left').';width:'.get_theme_mod('onepiece_elements_mainsidebar_width', 28).'%;">';
get_template_part('sidebar');
echo '<div class="clr"></div></div>';
}



if( get_theme_mod('onepiece_elements_sidebar2_position2', 'out') == 'ins' ){
if (  ( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position', 'none') != 'none' )
|| ( $logindisplay == 'sb2top' || $logindisplay == 'sb2bottom' )  ){

$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width', 28); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2', 'out').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width', 20).'%;">';

get_template_part('sidebar2');

echo '<div class="clr"></div></div>';
}
}

/**
 *
 *  Start html main content area 
 *
 */	
$contentfloat = 'left';

// main content area
echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

/* Breadcrumbs */
if($breadcrumbsdisplay == 'top'){
custom_breadcrumbs();
}


/**
 * 
 * Login
 *
 */
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'cbtop'){
display_userpanel();
}


/**
 * 
 * Before
 *
 */
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-before') ){
echo '<div id="widgets-before">';
dynamic_sidebar('widgets-before');
echo '<div class="clr"></div></div>';
} 


// mainmenu placement
$mainmenuplace = get_theme_mod('onepiece_elements_mainmenubar_placement', 'below');
$mainbarclass = get_theme_mod( 'onepiece_elements_mainmenubar_position' , 'none'); 
$mainminisize = get_theme_mod( 'onepiece_elements_mainmenubar_minisize' , 'none').'-minisize';

if($mainmenuplace == 'content' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.' '.$mainminisize.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}





if ( have_posts() ) {

get_template_part('loop');

}else{

echo '<div id="post-undefined"><div class="contentpadding">';
echo '<div class="post-title"><h4>No content available</h4></div>';
echo '</div></div>';

} 




/**
 * 
 * After content
 *
 */

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') ){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 

/**
 * 
 * Login
 *
 */
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'cbbot'){
display_userpanel();
}

echo '</div>';

echo '<div class="clr"></div></div></div>';

// subcontent
get_template_part('subcontent');

// footer
get_template_part('footer');

wp_footer();

echo '</div>';

$loadiconcontent = __('loading', 'onepiece');
$loaderboxicon = get_theme_mod('onepiece_identity_icons_loader', esc_url( get_template_directory_uri() ).'/icons/loader_icon_circle_default.gif');

if($loaderboxicon != ''){
	$loadiconcontent = '<img width="100%" height="auto" src="'.$loaderboxicon.'" alt="loader" />';
}
echo '<div class="loadbox"><span>'.$loadiconcontent.'</span></div>';

echo '</body>';
