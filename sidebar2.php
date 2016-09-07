<?php
echo '<div class="sidebarpadding">';
if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') ){
dynamic_sidebar('sidebar2');
} 
echo '</div>';
?>
