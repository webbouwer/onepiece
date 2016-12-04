<?php // http://www.sitepoint.com/adding-custom-meta-boxes-to-wordpress/
require get_template_directory() . '/assets/page_metaboxes.php'; 
require get_template_directory() . '/assets/post_metaboxes.php'; 
require get_template_directory() . '/assets/gallery_metaboxes.php'; 


/**
 * Keep category select list in hiëarchy
 * source http://wordpress.stackexchange.com/questions/61922/add-post-screen-keep-category-structure
 */
add_filter( 'wp_terms_checklist_args', 'my_website_wp_terms_checklist_args', 1, 2 );
function my_website_wp_terms_checklist_args( $args, $post_id ) {

   $args[ 'checked_ontop' ] = false;

   return $args;

}
?>