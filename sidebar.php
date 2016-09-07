<?php
echo '<div class="sidebarpadding">';
if ( has_nav_menu( 'sidemenu' ) ) {
echo '<div id="sidebar-navigation" class="main-navigation" role="navigation"><nav>';
wp_nav_menu( array( 'theme_location' => 'sidemenu' ) );
echo '<div class="clr"></div></nav></div>';
}

if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar') ){
$count = is_sidebar_active('sidebar');
echo '<div id="sidebar-widgets" class="colset-'.$count.'">';
dynamic_sidebar('sidebar');
echo '<div class="clr"></div></div>';
} 
echo '</div>';
?>
