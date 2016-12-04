<?php // AJAX for wordpress
function ajax_filter_posts_scripts() {
  // Enqueue script
  wp_register_script('afp_script', get_template_directory_uri() . '/assets/ajax-filter-posts.js', false, null, false);
  wp_enqueue_script('afp_script');
 
  wp_localize_script( 'afp_script', 'afp_vars', array(
    'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
    'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
  )
  );
}
add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);


// Get posts
function ajax_filter_get_posts() {

    // Verify nonce
    if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
    die('Permission denied');

    $ajxtags = $_POST['ajxtags'];
    $ajxcategories = $_POST['ajxcategories'];
    $ajxloaded = $_POST['ajxloaded'];
    $itemamount = $_POST['itemamount'];

    // WP Query 
    $args = array( 
      'post_type' => array('post'), // 'any'
      'post_status' => 'publish',
      //'cat' => -2, // filter out categories
      'tag' => $ajxtags, 
      'category_name' => $ajxcategories, 
      'post__not_in' => $ajxloaded,
      'orderby' => 'date', //'rand',
      'order' => 'DESC',
      'posts_per_page' => $itemamount
    );

    if( !$ajxcategories ) {
        unset( $args['category_name'] ); 
    }
    if( !$ajxtags ) {
	unset ( $args['tag'] );
    }
    if( !$ajxloaded ) {
	unset ( $args['ajxloaded'] );
    }

    $array = array();
    $query = new WP_Query( $args );


    // order data
    if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();

        global $item;
        $post_data = get_post( get_the_ID() , ARRAY_A); 

    // prepare object data
    $content = apply_filters('the_content', get_the_content());

    //$excerpt_length = 240;
    $excerpt = apply_filters('the_content', get_the_excerpt()); //truncate( $content, $excerpt_length, '', false, true );

    if(get_post_thumbnail_id()){
    $thumb_id = get_post_thumbnail_id();
    $thumbimg = wp_get_attachment_image_src($thumb_id,'thumbnail', true);
    $smallimg = wp_get_attachment_image_src( $thumb_id, 'big-thumb' );
    $mediumimg = wp_get_attachment_image_src( $thumb_id, 'medium' );
    $largeimg = wp_get_attachment_image_src( $thumb_id, 'large' );
    $fullimg = wp_get_attachment_image_src( $thumb_id, 'full' );
    }else{
    $thumb_id = '';
    $thumbimg = '';
    $smallimg = '';
    $mediumimg = '';
    $largeimg = '';
    $fullimg = '';
    }

    $metadata = get_post_meta( get_the_ID() );


    $taglist = wp_get_post_terms( get_the_ID(), 'post_tag', array("fields" => "slugs"));

    /*$custom_field_keys = get_post_custom_keys(); // get_post_custom_values
    $customfields = '';
    foreach ( $custom_field_keys as $key => $value ) {
        // custom fields
        $valuet = trim($value);
        if ( '_' == $valuet{0} ) continue;
        $values = get_post_custom_values( $value ); // $customfields .= $key . " => " . $value . "<br />";
	foreach ( $values as $fieldkey => $fieldvalue ) {
	  $customfields[ $value ] = $fieldvalue; 
        }
    }*/
        //$array[] = $post_data;
        $array[] = array(
         'id' => get_the_ID(),
	     'type' => get_post_type(),
         'date' => get_the_date(),
         'author' => get_the_author(),
         'title' => get_the_title(),
         'category' => get_the_category(),
         'excerpt' => $excerpt,
         'content' => $content,
	 'meta' => $metadata,
	 'tags' => $taglist,
	 'thumbimg' => $thumbimg,
	 'smallimg' => $smallimg,
	 'mediumimg' => $mediumimg,
	 'largeimg' => $largeimg,
	 'fullimg' => $fullimg,
	 'posturl' => get_the_permalink(),
         'slug' => $post_data['post_name'],
         //'customfieldarray' => $customfields,
         //'post_data' => $post_data

	 // the_meta(); // basic custom fields display - http://codex.wordpress.org/Function_Reference/the_meta
	 // or 1 specific field: get_post_meta($post->ID, 'note' , false);
	 // example $key_1_values = get_post_meta( 76, 'key_1' );
	 // the_tags('Tags: ',' '); // tags - http://codex.wordpress.org/Function_Reference/the_tags
	 // the_post_thumbnail();
       ); 
    endwhile;
    endif;
    wp_reset_query();
    ob_clean();
    echo json_encode($array); // response in json
    exit();

}
add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');






/**
 *
 * http://wordpress.stackexchange.com/questions/27856/is-there-a-way-to-send-html-formatted-emails-with-wordpress-wp-mail-function
 * http://wordpress.stackexchange.com/questions/18845/wp-mail-script-with-jquery-post
 
// if you want only logged in users to access this function use this hook
add_action('wp_ajax_mail_before_submit', 'mycustomtheme_send_mail_before_submit');

// if you want none logged in users to access this function use this hook
add_action('wp_ajax_nopriv_mail_before_submit', 'mycustomtheme_send_mail_before_submit');

// if you want both logged in and anonymous users to get the emails, use both hooks above

function mycustomtheme_send_mail_before_submit(){
    check_ajax_referer('my_email_ajax_nonce');
    if ( isset($_POST['action']) && $_POST['action'] == "mail_before_submit" ){

    //send email  wp_mail( $to, $subject, $message, $headers, $attachments ); ex:
        wp_mail($_POST['toemail'],'this is the email subject line','email message body');
        echo 'email sent';
        die();
    }
    echo 'error';
    die();
}
 */

?>