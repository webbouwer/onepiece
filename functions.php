<?php /* Functions WP */


/*
 * Include more functions
 */
require get_template_directory() . '/assets/mobile_detect.php';
require get_template_directory() . '/assets/fonts.php'; // customizer fonts
require get_template_directory() . '/assets/colors.php'; // customizer colors
require get_template_directory() . '/assets/customizer.php'; // customizer functions
require get_template_directory() . '/assets/metaboxes.php'; // metabox functions
require get_template_directory() . '/assets/menu.php'; // metabox functions
require get_template_directory() . '/assets/slider.php'; // metabox functions
require get_template_directory() . '/assets/userlogin.php'; // login functions
require get_template_directory() . '/assets/widgets-global.php'; // widget functions
require get_template_directory() . '/assets/widgets-onepiece.php'; // onepiece widget functions
require get_template_directory() . '/assets/ajax.php'; // ajax functions



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
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="sidebarpadding">',
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
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="sidebarpadding">',
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

    // Now we can localize the script with our data.
    //$color_array = array( 'color1' => get_theme_mod('color1'), 'color2' => '#000099' );
    //wp_localize_script( 'custom_global_js', 'object_name', $color_array );

    // The script can be enqueued now or later.
    wp_enqueue_script( 'custom_global_js');
}
add_action('wp_enqueue_scripts', 'onepiece_global_js');




/*
 * Adjust excerpt num words max
 */
function the_excerpt_length( $words = null ) { 
    global $_the_excerpt_length_filter;

    if( isset($words) ) { 
        $_the_excerpt_length_filter = $words;
    }   

    add_filter( 'excerpt_length', '_the_excerpt_length_filter' );
    the_excerpt();
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
 * Set max srcset image width to 1800px
 */
function remove_max_srcset_image_width( $max_width ){
    $max_width = 2100;
    return $max_width;
}
add_filter( 'max_srcset_image_width', 'remove_max_srcset_image_width' );


/*
 * body tag class
 */
function onepiece_body_class( $classes ) {
	$classes[] = 'frontpage-'.get_theme_mod('onepiece_settings_frontpage_type');
	return $classes;
}
add_filter( 'body_class', 'onepiece_body_class' );




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
function tweetTime( $t ) {
	/**** Begin Time Loop ****/
	// Set time zone
	date_default_timezone_set('America/New_York');
	// Get Current Server Time
	$server_time = $_SERVER['REQUEST_TIME'];
	// Convert Twitter Time to UNIX
	$new_tweet_time = strtotime($t);
	// Set Up Output for the Timestamp if over 24 hours
	$this_tweet_day =  date('D. M j, Y', strtotime($t));
	// Subtract Twitter time from current server time
	$time = $server_time - $new_tweet_time;
	// less than an hour, output 'minutes' messaging
	if( $time < 3599) {
		$time = round($time / 60) . ' minutes ago';
			}
	// less than a day but over an hour, output 'hours' messaging
	else if ($time >= 3600 && $time <= 86400) {
		$time = round($time / 3600) . ' hours ago';
		}
	// over a day, output the $tweet_day formatting
	else if ( $time > 86400)  {
		$time = $this_tweet_day;
		}
	// return final time from tweetTime()
	return $time;
	/**** End Time Loop ****/
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
