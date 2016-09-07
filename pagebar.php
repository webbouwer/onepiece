<?php
echo '<div class="sidebarpadding">';
if ( has_nav_menu( 'pagemenu' ) ) {
echo '<div id="pagebar-navigation" class="main-navigation" role="navigation"><nav>';
wp_nav_menu( array( 'theme_location' => 'pagemenu' ) );
echo '<div class="clr"></div></nav></div>';
}
if( function_exists('is_sidebar_active') && is_sidebar_active('pagesidebar') ){
$count = is_sidebar_active('pagesidebar');
echo '<div id="pagebar-widgets" class="colset-'.$count.'">';
dynamic_sidebar('pagesidebar');
echo '<div class="clr"></div></div>';
} 
echo '</div>';
?>
