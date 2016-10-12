<?php 

// htmlhead
get_template_part('htmlhead');

// header
get_template_part('header');

// content
echo '<div id="contentcontainer"><div class="outermargin">';

$contentpercentage = 100;


if( get_theme_mod('onepiece_elements_sidebar2_position2', 'out') == 'out'
&& function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position', 'none') != 'none' ){

$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width'); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2', 'out').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width', 20).'%;">';
get_template_part('sidebar2');
echo '<div class="clr"></div></div>';

}


if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar') && get_theme_mod('onepiece_elements_sidebar_position', 'left') != 'none' ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_mainsidebar_width', 28); 
echo '<div id="mainsidebar" class="'.get_theme_mod('onepiece_elements_sidebar_position', 'left').'side" style="float:'.get_theme_mod('onepiece_elements_sidebar_position', 'left').';width:'.get_theme_mod('onepiece_elements_mainsidebar_width', 28).'%;">';
get_template_part('sidebar');
echo '<div class="clr"></div></div>';
}

if( get_theme_mod('onepiece_elements_sidebar2_position2','out') == 'ins'
&& function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position', 'right') != 'none' ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width', 28); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2', 'ins').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width', 20).'%;">';
get_template_part('sidebar2');
echo '<div class="clr"></div></div>';
}

$contentfloat = 'left';

// main content area
echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

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

get_template_part('loop');

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') ){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 

echo '</div>';

echo '<div class="clr"></div></div></div>';

// footer
get_template_part('footer');

wp_footer();

echo '</div></body>';
