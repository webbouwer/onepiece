<?php

$loginbar_display = get_theme_mod('onepiece_elements_loginbar_option', 'none');

if($loginbar_display == 'sb2top'){
display_userpanel();
}
 
echo '<div class="sidebarpadding">';

if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') ){
dynamic_sidebar('sidebar2');
} 

echo '</div>';

if($loginbar_display == 'sb2bottom'){
display_userpanel();
}
 
?>
