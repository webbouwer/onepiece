<?php /* Functions WP */


/*
 * Include more functions
 */
require get_template_directory() . '/assets/mobile_detect.php';

require get_template_directory() . '/assets/fonts.php'; 				// customizer fonts
require get_template_directory() . '/assets/colors.php'; 				// customizer colors
require get_template_directory() . '/assets/customizer.php'; 			// customizer functions
require get_template_directory() . '/assets/metaboxes.php'; 			// metabox functions
require get_template_directory() . '/assets/menu.php'; 					// metabox functions
require get_template_directory() . '/assets/slider.php'; 				// metabox functions
require get_template_directory() . '/assets/userlogin.php'; 			// login functions
require get_template_directory() . '/assets/breadcrumbs.php'; 			// breadcrumb functions
require get_template_directory() . '/assets/widgets-onepiece.php'; 		// onepiece widget
require get_template_directory() . '/assets/widgets-sharebox.php'; 		// onepiece sharebox
require get_template_directory() . '/assets/ajax.php'; 					// ajax functions




/*
 * Register global variables (options/customizer)
 */
$wp_global_data = array();
$wp_global_data['customizer'] = json_encode(get_theme_mods());





/*
 * Return of the Links Manager'
 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );



/*
 * Register Theme Support
 */
function basic_setup_theme_global() {
	add_theme_support( 'post-thumbnails' );
	/*
	the_post_thumbnail('thumbnail');       // Thumbnail (default 150px x 150px max)
	the_post_thumbnail('medium');          // Medium resolution (default 300px x 300px max)
	the_post_thumbnail('large');           // Large resolution (default 640px x 640px max)
	the_post_thumbnail('full');            // Original image resolution (unmodified)
	*/
	add_image_size( 'big-thumb', 320, 9999 );
	add_image_size( 'medium', 480, 9999 );
	add_image_size( 'normal', 960, 9999 );
    add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' ); 

	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
}
add_action( 'after_setup_theme', 'basic_setup_theme_global' );

/*
 * Editor style WP THEME STANDARD
 */
function onepiece_editor_styles() {
    add_editor_style( 'style.css' );
    add_editor_style( get_theme_mod('onepiece_identity_stylelayout_stylesheet', 'default.css') );
}
add_action( 'admin_init', 'onepiece_editor_styles' );
  


/*
 *Register menu's
 */
function basic_setup_register_menus() {
	
	register_nav_menus(
		array(
		'minimenu' => __( 'Mini menu' , 'onepiece' ),
		'topmenu' => __( 'Top menu' , 'onepiece' ),
		'mainmenu' => __( 'Main menu' , 'onepiece' ),
		'usermenu' => __( 'User menu' , 'onepiece' ),
		'sidemenu' => __( 'Side menu' , 'onepiece' ),
		'bottommenu' => __( 'Bottom menu' , 'onepiece' )
		)
	);
	
}
add_action( 'init', 'basic_setup_register_menus' );



/* unregister widgets (if really not needed)"*/
 function remove_default_widgets() {
     //unregister_widget('WP_Widget_Pages');
     //unregister_widget('WP_Widget_Calendar');
     //unregister_widget('WP_Widget_Archives');
     //unregister_widget('WP_Widget_Links');
     //unregister_widget('WP_Widget_Meta');
     //unregister_widget('WP_Widget_Search');
     //unregister_widget('WP_Widget_Text');
     //unregister_widget('WP_Widget_Categories');
     //unregister_widget('WP_Widget_Recent_Posts');
     //unregister_widget('WP_Widget_Recent_Comments');
     //unregister_widget('WP_Widget_RSS');
     //unregister_widget('WP_Widget_Tag_Cloud');
     //unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'remove_default_widgets', 11);



/*
 * Register widgets
 */
function basic_setup_widgets_init() {
	if (function_exists('register_sidebar')) {
     
   /* Not using the the default wordpress widget,
        keep the widget slot for management (repositioning options) */
        
		register_sidebar(array(
			'name' => 'Widgets Header',
			'id'   => 'widgets-header',
			'description'   => 'This is a standard wordpress widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));

        // Custom Header Area
        register_sidebar(array(
			'name' => 'Widgets Onepiece Header',
			'id'   => 'widgets-onepiece-header',
			'description'   => 'This is a replacement for the standard wordpress widgetized header area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));

       

		// the top widgets 
		register_sidebar(array(
			'name' => 'Widgets Top',
			'id'   => 'widgets-top',
			'description'   => 'This the widgetized area on top.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
			// the top sidebar widgets 
		register_sidebar(array(
			'name' => 'Widgets Top Sidebar',
			'id'   => 'widgets-top-sidebar',
			'description'   => 'This the widgetized area in the top sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
		
		
		// the default wordpress sidebar
		register_sidebar(array(
			'name' => 'Widgets Sidebar',
			'id'   => 'sidebar',
			'description'   => 'This is the standard wordpress widgetized sidebar area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		// the second sidebar
		register_sidebar(array(
			'name' => 'Widgets Sidebar 2',
			'id'   => 'sidebar2',
			'description'   => 'This is a second widgetized sidebar area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		// the pagesidebar
		register_sidebar(array(
			'name' => 'Widgets Page Sidebar',
			'id'   => 'pagesidebar',
			'description'   => 'Page only widgetized sidebar area on top, bottom or replacing the main sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		// special page widgets area on top of before content
		register_sidebar(array(
			'name' => 'Special Widgets',
			'id'   => 'special-page-widgets',
			'description'   => 'Special page widgetized area on top, bottom or replacing the the before content.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
		
        // the before content widget
		register_sidebar(array(
			'name' => 'Widgets Before Content',
			'id'   => 'widgets-before',
			'description'   => 'This is the before content widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
		// the after content widget
		register_sidebar(array(
			'name' => 'Widgets After Content',
			'id'   => 'widgets-after',
			'description'   => 'This is the after content widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
		
		// the subcontent widgets 
		register_sidebar(array(
			'name' => 'Widgets Subcontent',
			'id'   => 'widgets-subcontent',
			'description'   => 'This the subcontent widgetized.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
	    // the subcontent widget
		register_sidebar(array(
			'name' => 'Widgets Subcontent sidebar',
			'id'   => 'widgets-subcontent-sidebar',
			'description'   => 'This is the sidebar in the subcontent widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));

	    // the bottom top widget
		register_sidebar(array(
			'name' => 'Widgets Bottom Top',
			'id'   => 'widgets-bottom-top',
			'description'   => 'This is the full width bottom-top widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
	    // the bottom widget
		register_sidebar(array(
			'name' => 'Widgets Bottom',
			'id'   => 'widgets-bottom',
			'description'   => 'This is the default bottom widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
		
		// the bottom widget
		register_sidebar(array(
			'name' => 'Widgets bottom sidebar',
			'id'   => 'widgets-bottom-sidebar',
			'description'   => 'This is the bottom sidebar area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
	}
}
add_action( 'widgets_init', 'basic_setup_widgets_init' );
 

/*
 * Javascript with customizer variables
 */
// http://wordpress.stackexchange.com/questions/57386/how-do-i-force-wp-enqueue-scripts-to-load-at-the-end-of-head
function onepiece_global_js() {
    // Register the script first.
    wp_register_script( 'custom_global_js', get_template_directory_uri().'/assets/global.js', 99, '1.0', false);

    // Get the global data list.
    global $wp_global_data;

	// Localize the global data list for the script
	wp_localize_script( 'custom_global_js', 'site_data', $wp_global_data );


    // localize the script with specific data.
    //$color_array = array( 'color1' => get_theme_mod('color1'), 'color2' => '#000099' );
    //wp_localize_script( 'custom_global_js', 'object_name', $color_array );

    // The script can be enqueued now or later.
    wp_enqueue_script( 'custom_global_js');
}
add_action('wp_enqueue_scripts', 'onepiece_global_js');









/*
 * Adjust excerpt num words max
 */
function the_excerpt_length( $words = null, $links = true ) {
    global $_the_excerpt_length_filter;

    if( isset($words) ) { 
        $_the_excerpt_length_filter = $words;
    }   

    add_filter( 'excerpt_length', '_the_excerpt_length_filter' );
    if( $links == false){
		echo preg_replace('/(?i)<a([^>]+)>(.+?)<\/a>/','', get_the_excerpt() );
	}else{
		the_excerpt();
	}

	remove_filter( 'excerpt_length', '_the_excerpt_length_filter' );

    // reset the global
    $_the_excerpt_length_filter = null;
}

function _the_excerpt_length_filter( $default ) { 
    global $_the_excerpt_length_filter;

    if( isset($_the_excerpt_length_filter) ) { 
        return $_the_excerpt_length_filter;
    }   

    return $default;
}
// the_excerpt_length( 25 );





/*
 * Replace post readmore excerpt link
 */
function new_excerpt_more($more) {

	$readmore = get_theme_mod('onepiece_content_panel_posts_readmore', 'none');
	// define link
    global $post;
	$custom_metabox_url = get_post_meta( $post->ID, 'meta-box-custom-url', true);
	$custom_metabox_useurl = get_post_meta( $post->ID, 'meta-box-custom-useurl', true);
	$custom_metabox_urltext = get_post_meta( $post->ID, 'meta-box-custom-urltext', true);
	
	if($readmore != 'none' && $custom_metabox_useurl != 'replaceself' && $custom_metabox_useurl != 'replaceblank'){
	
	if(empty($custom_metabox_urltext)){
		$custom_metabox_urltext = __( 'read more', 'onepiece');
	}
	
	if(!empty($custom_metabox_url) && ($custom_metabox_useurl == 'internal' || $custom_metabox_useurl == 'external')){
		$readmorelink = $custom_metabox_url;
		
	}else{
		$readmorelink =  get_permalink($post->ID);
	}
	$target = "_self";
	if($custom_metabox_useurl == 'external'){
		$target = "_blank"; 
	}
	
	
	if($readmore == 'inline'){
		return ' <a class="readmorelink" href="'.$readmorelink. '" target="'.$target.'">'.$custom_metabox_urltext.'</a>';
	}else{
		return '<br /><a class="readmorelink" style="float:'.$readmore.'" href="'.$readmorelink. '" target="'.$target.'">'.$custom_metabox_urltext.'</a><div class="clr"></div>';
	}
	}
	
}
add_filter('excerpt_more', 'new_excerpt_more');


/*
 * Adjust html output next / prev postlinks
 */
function add_class_next_post_link($html){
	$html = str_replace('<a','<a class="next-post" title="'.__('Next post','onepiece').'"',$html);
	return $html;
}
add_filter('next_post_link','add_class_next_post_link',10,1);
function add_class_previous_post_link($html){
	$html = str_replace('<a','<a class="prev-post" title="'.__('Previous post','onepiece').'"',$html);
	return $html;
}
add_filter('previous_post_link','add_class_previous_post_link',10,1);



/****** Customize Adminbar ******/
/* Not allowed for official themes
function control_display_adminbar() {
	if (!current_user_can('administrator')){ // only for admins
		show_admin_bar(false);
	}
}
add_action( 'after_setup_theme', 'control_display_adminbar' );
*/



/******** Check active widgets **********/
function is_sidebar_active( $sidebar_id ){
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return false;
    else
        return count( $the_sidebars[$sidebar_id] );
}

/*
 * body tag class
 */
function onepiece_body_class( $classes ) {
	$classes[] = 'frontpage-'.get_theme_mod('onepiece_settings_frontpage_type');
	return $classes;
}
add_filter( 'body_class', 'onepiece_body_class' );


/*
 * Set max srcset image width to 1800px
 */
function remove_max_srcset_image_width( $max_width ){
    $max_width = 2100;
    return $max_width;
}
add_filter( 'max_srcset_image_width', 'remove_max_srcset_image_width' );




// Check for multiple images from plugin https://wordpress.org/plugins/dynamic-featured-image/
function post_dynamic_featured_image_gallery($post_id, $format = 'text'){
	if( class_exists('Dynamic_Featured_Image') ) {
       		
		global $dynamic_featured_image;
       	$featured_dynamic_images = $dynamic_featured_image->get_featured_images($post_id);
		if( count($featured_dynamic_images) ){
		
		if($format == 'text'){
		$thumb_gallery = '<ul class="featured_image_nav">';
		foreach($featured_dynamic_images as $img){
			$thumb_gallery .= '<li data-image="'.$img["full"].'"><img src="'.$img["thumb"].'" /></li>';
		}
		$thumb_gallery .= '</ul>';
		return $thumb_gallery;
		}else{
		return $featured_dynamic_images;
		}
		
		}
   	}
}

// https://codex.wordpress.org/AJAX_in_Plugins
//add_action( 'wp_ajax_dfimage_gallery', 'dfimage_gallery' );
add_action('wp_ajax_get_post_gallery_content', 'get_post_gallery_content'); // ajax.php
add_action('wp_ajax_nopriv_get_post_gallery_content', 'get_post_gallery_content');
// ajax multiple images from plugin https://wordpress.org/plugins/dynamic-featured-image/
function get_post_gallery_content(){

		global $wpdb;
		$postdata = get_post($_POST['post_id']);
		
		$response = [];
		$response['title'] = $postdata->post_title;
		
		if( $postdata->post_content != '' ){ 
			$response['content'] = $postdata->post_content;
		}else{
			$response['content'] = $postdata->post_excerpt; //mysql_real_escape_string
		}
		
		$images = [];
		$images[0]['thumb'] = get_the_post_thumbnail_url( $_POST['post_id'], 'thumbnail' );
		$images[0]['full'] = get_the_post_thumbnail_url( $_POST['post_id'], 'full' ); 
		
		if( class_exists('Dynamic_Featured_Image') ) {
			$moreimages = post_dynamic_featured_image_gallery( $_POST['post_id'], 'array' );
			if(is_array($moreimages)){
				// image box with nav
				$c = 1;
				foreach($moreimages as $img){
					$images[$c]['thumb'] = $img['thumb'];
					$images[$c]['full'] = $img['full'];
					$c++;
				}
			}
		}
		$response['images'] = $images;
		
		echo json_encode($response, JSON_PRETTY_PRINT);
		
		wp_die();
}




// check post by slug
add_action('wp_ajax_get_post_id_by_slug', 'get_post_id_by_slug'); // ajax.php
add_action('wp_ajax_nopriv_get_post_id_by_slug', 'get_post_id_by_slug');
function get_post_id_by_slug(){
		global $wpdb;
		$args = array(
		  'name'        => $_POST['post_slug'],
		  'post_type'   => 'post',
		  'post_status' => 'publish',
		  'numberposts' => 1
		);
		$dapost = get_posts($args);
		if ($dapost) {
			$dapost[0]->meta = get_post_meta( $dapost[0]->ID );
			$dapost[0]->category = wp_get_post_categories($dapost[0]->ID);
			$dapost[0]->tags = wp_get_post_terms( $dapost[0]->ID, 'post_tag', array("fields" => "slugs"));
			
			$response = $dapost[0];
			
		} else {
			$response = '';
		}
		echo json_encode($response, JSON_PRETTY_PRINT);
		wp_die();
}



/*
 * Exclude specific categories from the loop
 */
add_action( 'pre_get_posts', 'exclude_specific_cats' );
function exclude_specific_cats( $wp_query ) {   
    if( !is_admin() && is_main_query() && is_home() ){
		$exclude_cats = '-'.str_replace(",",",-", get_theme_mod('onepiece_content_exclude_categories') );
        $wp_query->set( 'cat', $exclude_cats ); // ! '-1' not allowed = buggy in WP Multisitesq
    }
}



/*
 * CATEGORY LIST - for metaboxes / customizer functions
 */
function get_categories_select(){
 	$get_cats = get_categories();
    	$results;
    	$count = count($get_cats);
    	for ($i=0; $i < $count; $i++) {
      		if (isset($get_cats[$i]))
        		$results[$get_cats[$i]->slug] = $get_cats[$i]->name;
      		else
        		$count++;
    	}
  	return $results;
}

// include webicon
function onepiece_load_share_widget_icons(){

wp_enqueue_script('jquery-webicon', '//cdn.rawgit.com/icons8/bower-webicon/v0.10.7/jquery-webicon.min.js');

}
add_action( 'wp_print_scripts', 'onepiece_load_share_widget_icons' );

/*
 * css file listing
 */
function get_theme_cssfilelist(){
$dir =  get_template_directory(); //dirname( __DIR__ );
$arr = [];
$c = 0;
// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
        
    $ext = pathinfo($file, PATHINFO_EXTENSION);
      if( $ext == 'css' && $file != 'style.css'){
        $arr[$file] = $file;
      }
      $arr++;
    }
    closedir($dh);
  }
}
return $arr;
}



/*
 * object_to_array
 */
function object_to_array($data){
    if(is_array($data) || is_object($data))
    {
        $result = array();
 
        foreach($data as $key => $value){
            $result[$key] = $this->object_to_array($value);
        }
 
        return $result;
    }
 
    return $data;
}



/**
 * Keep category select list in hiÎarchy
 * source http://wordpress.stackexchange.com/questions/61922/add-post-screen-keep-category-structure
 */
function onepiece_wp_terms_checklist_args( $args, $post_id ) {

   $args[ 'checked_ontop' ] = false;

   return $args;

}
add_filter( 'wp_terms_checklist_args', 'onepiece_wp_terms_checklist_args', 1, 2 );




/**
 * Date display in tweet('time ago') format
 */
function wp_time_ago( $t ) {
	// https://codex.wordpress.org/Function_Reference/human_time_diff
	//get_the_time( 'U' )
	printf( _x( '%s ago', '%s = human-readable time difference', 'onepiece' ), human_time_diff( $t, current_time( 'timestamp' ) ) ); 
	
}


/***********************
* Remove unneeded code *
***********************/



/* Remove Emoji junk by Christine Cooper
 * Found on http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
 */
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' ); // filter to remove TinyMCE emojis
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

/*
 * control (remove) gravatar
 */
function bp_remove_gravatar ($image, $params, $item_id, $avatar_dir, $css_id, $html_width, $html_height, $avatar_folder_url, $avatar_folder_dir) {
	$default = get_stylesheet_directory_uri() .'/images/avatar.png';
	if( $image && strpos( $image, "gravatar.com" ) ){ 
		return '<img src="' . $default . '" alt="avatar" class="avatar" ' . $html_width . $html_height . ' />';
	} else {
		return $image;
	}
}
add_filter('bp_core_fetch_avatar', 'bp_remove_gravatar', 1, 9 );
function remove_gravatar ($avatar, $id_or_email, $size, $default, $alt) {
	$default = get_stylesheet_directory_uri() .'/images/avatar.png';
	return "<img alt='{$alt}' src='{$default}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
}
add_filter('get_avatar', 'remove_gravatar', 1, 5);

function bp_remove_signup_gravatar ($image) {
	$default = get_stylesheet_directory_uri() .'/images/avatar.png';
	if( $image && strpos( $image, "gravatar.com" ) ){ 
		return '<img src="' . $default . '" alt="avatar" class="avatar" width="60" height="60" />';
	} else {
		return $image;
	}
}
add_filter('bp_get_signup_avatar', 'bp_remove_signup_gravatar', 1, 1 );
?>