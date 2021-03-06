<?php 
/**
 * Template Name: Gallery
 * List posts to a grid with Isotope
 */
 
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);

/**
 *
 * get header variables
 *
 */
$useheaderimage = get_post_meta( get_the_ID() , "meta-page-headerimage", true);
$pagesidebardisplay = get_post_meta(get_the_ID(), "meta-page-pagesidebardisplay", true);
$specialwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-specialwidgetsdisplay", true);
$secondsidebardisplay = get_post_meta(get_the_ID(), "meta-page-secondsidebardisplay", true);

/**
 *
 * $values variables page template
 * .. use for slider functions 
 */	
$values = get_post_custom( $post->ID );


/**
 *
 * $values get variables gallery template settings
 *
 */	
$selected = isset( $values['theme_gallery_category_selectbox'] ) ? $values['theme_gallery_category_selectbox'][0] : '';
$gallerydefault = isset( $values['onepiece_content_gallery_category'] ) ? $values['onepiece_content_gallery_category'][0] : '';
$pagetitle = isset( $values['theme_gallery_pagetitle_selectbox'] ) ? $values['theme_gallery_pagetitle_selectbox'][0] : '';
$filters = isset( $values['theme_gallery_filters_selectbox'] ) ? $values['theme_gallery_filters_selectbox'][0] : '';
$maxinrow = isset( $values['theme_gallery_items_maxinrow'] ) ? $values['theme_gallery_items_maxinrow'][0] : '5';
$clickaction = isset( $values['theme_gallery_items_clickaction'] ) ? $values['theme_gallery_items_clickaction'][0] : 'poppost';

/**
 *
 * $topcat default gallery category
 *
 */	
if($selected){
$topcat = $selected;
}elseif( $gallerydefault && $gallerydefault != '' ){
$topcat = $gallerydefault;
}else{
$topcat = 'uncategorized';
}





/**
 *
 * FILTER MENU
 * prepare filter menu and create category tag index
 * http://wordpress.stackexchange.com/questions/212923/how-to-list-all-categories-and-tags-in-a-page
 */	
if($filters != 'none'){ // show filters
$args = array( 
    'child_of'                 => get_category_by_slug($topcat)->term_id,
    'orderby'                  => 'name',
    'order'                    => 'ASC', 
    'public'                   => true,
); 
$categories = get_categories( $args );
$cat_tags = ''; // tags by category
$tag_idx = ''; // all tags csv string for javascript array
$idxtags = '';
$alltags = array(); // all tags csv string for javascript array
$filtermenubox = ''; // output taglists ordered by category filter 


$filtermenubox .= '<ul id="topgridmenu" class="categorymenu">';// start filtermenu html
$filtermenubox .= '<li><a class="category selected" href="#" data-filter="*">All</a></li>';

foreach ( $categories as $category ) {
if( $category->slug != $topcat ){
$filtermenubox .= '<li><a class="category cat-' . $category->slug . '" href="#" data-filter="' . $category->slug . '">' . $category->name . '</a>'; 

    if( $filters == 'all'){
	
	
	$posttags = '';
	$postids = get_objects_in_term( $category->term_id, 'category' );
      if( !is_wp_error( $postids ) && !empty( $postids ) ){
        //get the tags for the posts...
        $tags = wp_get_object_terms( (array)$postids, 'post_tag' );
        if( !is_wp_error( $tags ) && !empty( $tags ) ){
          //make a link for each tag...
          foreach( $tags as $tag ){
            //simple paragraph containing linked tag name...
            $posttags .='<li><a class="tag-'.$tag->name.'" href="'.get_site_url().'/tag/'.$tag->name.'/" rel="tag">'.$tag->name.'</a></li>';
			if( !in_array( $tag->name, $alltags) ){
				$alltags[] = $tag->name; 
				$idxtags .= '"'.$tag->name.'", '; 
			}
          }
        }
      }
	
    $cat_tags .='<ul class="tagmenu '.$category->slug.'">'.$posttags.'</ul>';
    $tag_idx .= $idxtags;
   
	
    }
	$filtermenubox .= '</li>';
}
}
$filtermenubox .= '</ul>';


/**
 * 
 * prepare tags 
 *
 */
$alltagmenuoptions = '';
foreach( $alltags as $id => $tag){
$alltagmenuoptions .= '<li><a class="tag-'.$tag.'" href="'.get_site_url().'/tag/'.$tag.'/" rel="tag">'.$tag.'</a></li>';
}
$filtermenubox .= '<ul class="tagmenu overview active">'.$alltagmenuoptions.'</ul>'; // fille up with all tags from other menu's, js script at bottom.
$filtermenubox .= $cat_tags;
}

/*
 * Breadcrumbs
 */
$breadcrumbsdisplay = get_theme_mod( 'onepiece_elements_breadcrumbs_display' , 'top');
$breadcrumbspageshow = get_theme_mod( 'onepiece_elements_breadcrumbs_onpages' , 'all');




/**
 *
 * htmlhead
 *
 */	
get_template_part('htmlhead');

get_template_part('header');






/**
 * 
 * start content
 *
 */
echo '<div id="contentcontainer"><div class="outermargin">';
 
 
/*
 * main login 
 */
$logindisplay = get_theme_mod('onepiece_elements_loginbar_option', 'none');


/**
 *
 *  PAGE SIDEBARS 
 *
 */
$contentpercentage = 100; 

if( get_theme_mod('onepiece_elements_sidebar2_position2', 'out') == 'out' && $secondsidebardisplay != 'hide'){ 
if (  ( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position', 'none') != 'none' )
|| ( $logindisplay == 'sb2top' || $logindisplay == 'sb2bottom' )  ){

$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width', 28); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2', 'out').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width', 20).'%;">';

get_template_part('sidebar2');

echo '<div class="clr"></div></div>';
}
}



if( ( (function_exists('is_sidebar_active') && is_sidebar_active('sidebar') && get_theme_mod('onepiece_elements_sidebar_position', 'left') != 'none' )
|| $logindisplay == 'sbtop' || $logindisplay == 'sbbottom' || has_nav_menu( 'sidemenu' ) ) && $pagesidebardisplay != 'none' ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_mainsidebar_width', 28); 
echo '<div id="mainsidebar" class="'.get_theme_mod('onepiece_elements_sidebar_position', 'left').'side" style="float:'.get_theme_mod('onepiece_elements_sidebar_position', 'left').';width:'.get_theme_mod('onepiece_elements_mainsidebar_width', 28).'%;">';
get_template_part('sidebar');
echo '<div class="clr"></div></div>';
}



if( get_theme_mod('onepiece_elements_sidebar2_position2', 'out') == 'ins' && $secondsidebardisplay != 'hide'){
if (  ( function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position', 'none') != 'none' )
|| ( $logindisplay == 'sb2top' || $logindisplay == 'sb2bottom' )  ){

$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width', 28); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2', 'out').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width', 20).'%;">';

get_template_part('sidebar2');

echo '<div class="clr"></div></div>';
}
} 
 
 
$contentfloat = 'left';




/**
 * 
 * start maincontent
 *
 */
echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

/* Breadcrumbs */
if($breadcrumbsdisplay == 'top' && $breadcrumbspageshow == 'all'){
custom_breadcrumbs();
}


/**
 * login 
 */
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'cbtop'){
display_userpanel();
}

/**
 * 
 * before widgets
 *
 */
if( function_exists('is_sidebar_active') && is_sidebar_active('special-page-widgets') && ( $specialwidgetsdisplay == 'top' || $specialwidgetsdisplay == 'replace' ) ){
echo '<div id="specialpagewidgets">';
dynamic_sidebar('special-page-widgets');
echo '<div class="clr"></div></div>';
}
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-before') && $specialwidgetsdisplay != 'replace'){
echo '<div id="widgets-before">';
dynamic_sidebar('widgets-before');
echo '<div class="clr"></div></div>';
}
if( function_exists('is_sidebar_active') && is_sidebar_active('special-page-widgets') && $specialwidgetsdisplay == 'below'){
echo '<div id="specialpagewidgets">';
dynamic_sidebar('special-page-widgets');
echo '<div class="clr"></div></div>';
}



/* Breadcrumbs */
if($breadcrumbsdisplay == 'befor' && $breadcrumbspageshow == 'all'){
custom_breadcrumbs();
}



/**
 * 
 * mainmenu placement
 *
 */
$mainmenuplace = get_theme_mod('onepiece_elements_mainmenubar_placement', 'below');
$mainbarclass = get_theme_mod( 'onepiece_elements_mainmenubar_position' , 'none'); 
$mainminisize = get_theme_mod( 'onepiece_elements_mainmenubar_minisize' , 'none').'-minisize';

if($mainmenuplace == 'content' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.' '.$mainminisize.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}

/**
 * 
 * cover image
 *
 */
$title_link = '<a href="'.get_the_permalink().'" target="_self" title="'.get_the_title().'">';
$useheaderimage = get_post_meta( get_the_ID() , "meta-page-headerimage", true);
if ( has_post_thumbnail() && $useheaderimage != 'replace'  ) {
echo '<div class="post-coverimage">'.$title_link;
if($mobile){
the_post_thumbnail('big-thumb');
}else{
the_post_thumbnail('medium');
}
echo '</a></div>'; // default, 'thumb' or 'medium'
}

/**
 * 
 * main content title and text
 *
 */
if ( $pagetitle != 'none') {
echo '<div class="gallery-titlebar"><h1>'.get_the_title().'</h1>';
if ( $pagetitle == 'text') : 
    // Post full content
    echo '<div class="post-content">'.apply_filters('the_content', get_the_content()).'</div>';
endif; 
echo '</div>';
}

/**
 * 
 * output filtermenu
 * $filtermenubox string with html list
 *
 */
if($filters != 'none'){
    // display filter menu
    echo $filtermenubox;
}


/**
 * 
 * start isotope item container (see code in htmlhead.php :)
 *
 */
echo '<div id="itemcontainer" class="category-contentbar"></div>'; // Gallery content container


/**
 * 
 * Login
 *
 */

if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'cbbot'){
display_userpanel();
}



/**
 * 
 * after widgets
 *
 */
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') ){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 
echo '</div>';
echo '<div class="clr"></div></div></div>';


// subcontent
get_template_part('subcontent');



/**
 * 
 * htmlfooter
 *
 */
get_template_part('footer');
wp_footer();


echo '</div>';

$loadiconcontent = __('loading', 'onepiece');
$loaderboxicon = get_theme_mod('onepiece_identity_icons_loader', esc_url( get_template_directory_uri() ).'/icons/loader_icon_circle_default.gif');

if($loaderboxicon != ''){
	$loadiconcontent = '<img width="100%" height="auto" src="'.$loaderboxicon.'" alt="loader" />';
}
echo '<div class="loadbox"><span>'.$loadiconcontent.'</span></div>';

echo '</body>';
?>
