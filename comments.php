<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since Foundation 0.2
*/
// post comments

echo '<div id="commentscontainer">';
comment_form(); // WP THEME STANDARD
wp_list_comments(); // WP THEME STANDARD: wp_list_comments( $args );

if ( is_singular() ) wp_enqueue_script( "comment-reply" ); // WP THEME STANDARD

next_comments_link();
previous_comments_link();

echo '</div>';
?>
