<?php

$loginbar_display = get_theme_mod('onepiece_elements_loginbar_option', 'none');

echo '<div class="sidebarpadding">';

if($loginbar_display == 'sb2top'){
display_userpanel();
}
 

if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') ){
dynamic_sidebar('sidebar2');
} 

if($loginbar_display == 'sb2bottom'){
display_userpanel();
}
 

echo '</div>';
?>
