<?php // to use this 404 ERROR page add : ErrorDocument 404 /index.php?error=404 : to the .htaccess file
$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);
echo '<!DOCTYPE HTML>'; 
echo '<html '; 
language_attributes(); 
echo '><head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset='.get_bloginfo( 'charset' ).'" />';

wp_head(); // http://codex.wordpress.org/Function_Reference/wp_head 

$site_description = get_bloginfo( 'description' );
echo 	'<meta name="description" content="'.$site_description.'">'
	.'<meta name="keywords" content="wordpress theme,theme setup,basic theme,custom theme">'
	.'<link rel="canonical" href="'.home_url(add_query_arg(array(),$wp->request)).'">'
	.'<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'" />'
	.'<link rel="shortcut icon" href="images/favicon.ico" />'
	.'<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_url').'" />';

if($mobile){
echo 	'<meta name="viewport" content="initial-scale=1.0, width=device-width" />';
}else{
echo 	'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">'
	.'<!--[if lt IE 9]><script src="'.esc_url( get_template_directory_uri() ).'/assets/html5.js"></script>'
	.'<script src="'.esc_url( get_template_directory_uri() ).'/assets/cssmediaqueries.js"></script>'
	.'<![endif]-->';
}

if ( ! isset( $content_width ) ) $content_width = 900;

wp_enqueue_script("jquery");

echo '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tools/1.2.7/jquery.tools.min.js"></script>';

// Frontend user login 
if( get_option( 'users_can_register' ) ){ 
?>
<script type="text/javascript"> 
jQuery(function($) {
		$(document).ready(function(){

		$('ul.tabcontainer li').hide();
                //$("ul.tabcontainer li").eq(0).slideDown();

		$('ul.tabmenu li,div.resetlogin').on('click', function(){
			$('ul.tabmenu li,div.resetlogin ').removeClass('active');
                	$(this).addClass('active');
			$('li.tab').slideUp();
			if($(this).hasClass('resetlogin')){
    			$("ul.tabcontainer li").eq($(3).index()).slideDown();
			}else{
    			$("ul.tabcontainer li").eq($(this).index()).slideDown();
			}
			return false;
		});
		});
	});
</script>
<?php } 

echo '</head><body';
body_class(); 
echo '>';

if ( has_nav_menu( 'topmenu' ) ) { 
echo '<div class="topmenubar">';
wp_nav_menu( array( 'theme_location' => 'topmenu' ) ); 
echo '<div class="clr"></div></div>';
}

if ( get_option( 'users_can_register' ) ){
display_userpanel();
}

echo '<div class="logobox medium">';
if ( get_theme_mod( 'fndtn_identity_logo_m' ) ){
echo '<a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_theme_mod( 'fndtn_identity_logo_m' ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"></a>';
}else{ 
echo '<hgroup><h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a></h1>';
echo '<h2 class="site-description">'.get_bloginfo( 'description' ).'</h2></hgroup>';
}
echo '</div>';


echo '<div class="mainmenubox">';
if ( has_nav_menu( 'mainmenu' ) ) { 
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) ); 
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); 
} 
echo '<div class="clr"></div></div>'; // end mainmenubox


$header_image = get_header_image();
if( (function_exists('is_sidebar_active') && is_sidebar_active('widgets-header')) || ! empty( $header_image ) ){
echo '<div id="headercontainer" class="site-header" role="head"><header>';
if ( ! empty( $header_image ) ) :
echo '<img src="'.esc_url( $header_image ).'" class="header-image" alt="'.bloginfo( 'description' ).'" />';
endif; 
if (function_exists('dynamic_sidebar') && dynamic_sidebar('widgets-header')) :
endif; 
echo '</header></div>';
}


echo'<div id="contentbox">';
echo 'Whhoooppss, the requested page is not available.';
echo'</div>';

if ( has_nav_menu( 'sidemenu' ) || ( function_exists('dynamic_sidebar') && is_sidebar_active('sidebar') ) ){ 
echo '<div id="sidebarbox">';
if ( has_nav_menu( 'sidemenu' ) ) { 
echo '<div class="sidemenubar">';
wp_nav_menu( array( 'theme_location' => 'sidemenu' ) ); 
echo '<div class="clr"></div></div>';
}
if( function_exists('is_sidebar_active') && is_sidebar_active('sidebar') ){
dynamic_sidebar('sidebar');
} 
echo '</div>';
}

echo '<div class="clr"></div>';


echo '<div class="logobox small">';
if ( get_theme_mod( 'fndtn_identity_logo_s' ) ){
echo '<a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_theme_mod( 'fndtn_identity_logo_s' ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"></a>';
}else{ 
echo '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" id="site-logo" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a></h1>';
}
echo '</div>';


if ( has_nav_menu( 'bottommenu' ) ) { 
echo '<div class="bottommenubar">';
wp_nav_menu( array( 'theme_location' => 'bottommenu' ) ); 
echo '<div class="clr"></div></div>';
}

wp_footer();

echo '</body></html>';