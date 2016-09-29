<?php /* Functions WP */

// Include Code Assets
require get_template_directory() . '/assets/mobile_detect.php';
require get_template_directory() . '/assets/customizer.php'; // customizer functions
require get_template_directory() . '/assets/metaboxes.php'; // metabox functions
require get_template_directory() . '/assets/widgets-global.php'; // widget functions
require get_template_directory() . '/assets/widgets-onepiece.php'; // onepiece widget functions
require get_template_directory() . '/assets/colors.php'; // customizer colors
require get_template_directory() . '/assets/ajax.php'; // ajax functions


/****** Register Theme Support ******/
function basic_setup_theme_global() {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'big-thumb', 320, 9999 );
    add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
}
add_action( 'after_setup_theme', 'basic_setup_theme_global' );


/****** Editor style WP THEME STANDARD ******/
function onepiece_editor_styles() {
    add_editor_style( 'style.css' );
    add_editor_style( get_theme_mod('onepiece_identity_stylelayout_stylesheet', 'default.css') );
}
add_action( 'admin_init', 'onepiece_editor_styles' );
  

/****** Register menu's ******/
function basic_setup_register_menus() {
	register_nav_menus(
		array(
		'topmenu' => __( 'Top menu' , 'onepiece' ),
		'mainmenu' => __( 'Main menu' , 'onepiece' ),
		'sidemenu' => __( 'Side menu' , 'onepiece' ),
		'bottommenu' => __( 'Bottom menu' , 'onepiece' )
		)
	);
}
add_action( 'init', 'basic_setup_register_menus' );


/****** Register widgets *******/
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
			'description'   => 'This is a top frontpage widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetpadding">',
			'after_widget'  => '<div class="clr"></div></div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
	}
}
add_action( 'widgets_init', 'basic_setup_widgets_init' );


/****** Javascript with customizer variables *****/
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


/********* body tag class **********/
function onepiece_body_class( $classes ) {
	$classes[] = 'frontpage-'.get_theme_mod('onepiece_settings_frontpage_type');
	return $classes;
}
add_filter( 'body_class', 'onepiece_body_class' );

/** Exclude specific categories from the loop */
add_action( 'pre_get_posts', 'exclude_specific_cats' );
function exclude_specific_cats( $wp_query ) {   
    if( !is_admin() && is_main_query() && is_home() ) {
        $wp_query->set( 'cat', '-1,-3' );
    }
}

/********* CATEGORY LIST **********/
function get_categories_select() {
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

/********* SLIDER CATEGORY ITEM HTML **********/
function sliderhtml($category, $mobile, $id = null){ 
    $cat = get_category_by_slug( $category );
    $sliderhtml = '';
    if( $cat->term_id ){
	    query_posts('category_name='.$cat->cat_name);
        $sliderhtml .= '<ul id="slider-'.$id.'" class="sliderarea">';
        if (have_posts()) : while (have_posts()) : the_post();

	    $sliderhtml .= '<li class="panel"';
	if ( get_post_thumbnail_id( get_the_ID() ) ) {
	$aid = get_post_thumbnail_id( get_the_ID() );
    	$large_image_url = wp_get_attachment_image_src( $aid, 'full' );
    	$small_image_url = wp_get_attachment_image_src( $aid, 'big-thumb' );
	if($mobile){ 
	$sliderhtml .= ' style="background-image:url('.$small_image_url[0].');"';
	}else{
	$sliderhtml .= ' style="background-image:url('.$large_image_url[0].');"';
	}
	}
	$sliderhtml .= '>';
    $sliderhtml .= '<div class="slidebox"><div class="outermargin">';
	$sliderhtml .= '<h3>'.get_the_title().'</h3>';
	$sliderhtml .= '<div>'.get_the_excerpt().'</div>';
	$sliderhtml .= '</div></div></li>'; 
    
    endwhile; endif; 
	wp_reset_query();
	
	$sliderhtml .= '</ul>';
	return $sliderhtml;
    }    
}



/******** css file listing ********/
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

// Remove Emoji junk by Christine Cooper
// Found on http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

?>
