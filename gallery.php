<?php 
/**
 * Template Name: Gallery
 * List posts to a grid with Isotope
 */
 
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);

// htmlhead
get_template_part('htmlhead');
get_template_part('header');

// get header variables
$useheaderimage = get_post_meta( get_the_ID() , "meta-page-headerimage", true);
$pagesidebardisplay = get_post_meta(get_the_ID(), "meta-page-pagesidebardisplay", true);
$specialwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-specialwidgetsdisplay", true);
$secondsidebardisplay = get_post_meta(get_the_ID(), "meta-page-secondsidebardisplay", true);


// $values variables page template
// .. use for slider functions 
$values = get_post_custom( $post->ID );

// $values get variables gallery template settings
$selected = isset( $values['theme_gallery_category_selectbox'] ) ? $values['theme_gallery_category_selectbox'][0] : '';
$gallerydefault = isset( $values['onepiece_content_gallery_category'] ) ? $values['onepiece_content_gallery_category'][0] : '';
$pagetitle = isset( $values['theme_gallery_pagetitle_selectbox'] ) ? $values['theme_gallery_pagetitle_selectbox'][0] : '';
$filters = isset( $values['theme_gallery_filters_selectbox'] ) ? $values['theme_gallery_filters_selectbox'][0] : '';
$maxinrow = isset( $values['theme_gallery_items_maxinrow'] ) ? $values['theme_gallery_items_maxinrow'][0] : '5';
$clickaction = isset( $values['theme_gallery_items_clickaction'] ) ? $values['theme_gallery_items_clickaction'][0] : 'poppost';

// $topcat default gallery category
if($selected){
$topcat = $selected;
}elseif( $gallerydefault && $gallerydefault != '' ){
$topcat = $gallerydefault;
}else{
$topcat = 'uncategorized';
}

// build filtermenu     
// $filters from $values 
if($filters != 'none'){ // prepare filter menu and create category tag index
// prepare category query
$args = array( 
    'child_of'                 => get_category_by_slug($topcat)->term_id,
    'orderby'                  => 'name',
    'order'                    => 'ASC', 
    'public'                   => true,
); 
$categories = get_categories( $args );
$cat_tags = ''; // string to hold tag menu for each category
$tag_idx = ''; // string csv tag names
$filtermenubox = '<ul id="topgridmenu" class="categorymenu ">';
$filtermenubox .= '<li><a class="category" href="#" data-filter="*">All</a></li>';

// wp categories - http://wordpress.stackexchange.com/questions/212923/how-to-list-all-categories-and-tags-in-a-page 
foreach ( $categories as $category ) {
    
if( $category->slug != $topcat ){
    
    // category option
    $filtermenubox .= '<li><a class="category" href="#" data-filter="' . $category->slug . '">' . $category->name . '</a>'; 
    
    // tag option submenu
    if( $filters == 'all'){ // get tags from category post .. get_category_link( $category )
	query_posts('category_name='.$category->slug);
  
	if (have_posts()) : while (have_posts()) : the_post();
	  	$posttags = get_the_tags();
	  		if ($posttags):
				foreach($posttags as $tag) {
					if (!in_array($tag->term_id , $tag_IDs)):
		   				$tag_IDs[] = $tag->term_id; 
		   				$tag_names[$tag->term_id] = $tag->name;
		 			endif;
				}
	  		endif;
	endwhile; endif;
	wp_reset_query();
	
	$cat_tags = '<ul class="tagmenu '.$category->slug.'">';
	foreach($tag_IDs as $tag_ID){
    	$cat_tags .= '<li><a href="'.get_tag_link($tag_ID).'">'.$tag_names[$tag_ID].'</a></li>';
	}
	$cat_tags .= "</ul>";
	 
    }
	
	$filtermenubox .= '</li>';
}
}
$filtermenubox .= '</ul>';
$filtermenubox .= $cat_tags;
}






// start content
echo '<div id="contentcontainer"><div class="outermargin">';

// set sidebars
$contentpercentage = 100;
if( get_theme_mod('onepiece_elements_sidebar2_position2') == 'out' && get_theme_mod('onepiece_elements_sidebar2_position') != 'none' && $secondsidebardisplay != 'hide'){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width'); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position').';width:'.get_theme_mod('onepiece_elements_sidebar2_width').'%;">';
get_template_part('sidebar2');
echo '<div class="clr"></div></div>';
}
if( $pagesidebardisplay != 'none' && function_exists('is_sidebar_active') && get_theme_mod('onepiece_elements_sidebar_position') != 'none' && (is_sidebar_active('sidebar') || is_sidebar_active('pagesidebar') ) ){
    $contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_mainsidebar_width');
    echo '<div id="pagesidebarcontainer" class="'.get_theme_mod('onepiece_elements_sidebar_position', 'right').'side" style="float:'.get_theme_mod('onepiece_elements_sidebar_position','right').';width:'.get_theme_mod('onepiece_elements_mainsidebar_width').'%;">';
    if( ( is_sidebar_active('pagesidebar')  || has_nav_menu( 'pagemenu' ) ) && ($pagesidebardisplay == 'top' || $pagesidebardisplay == 'replace') ){
    echo '<div id="pagesidebar">';
    get_template_part('pagebar');
    echo '<div class="clr"></div></div>';
    }
    if( is_sidebar_active('sidebar') && ($pagesidebardisplay != 'replace' || !is_sidebar_active('pagesidebar')) ){ 
    echo '<div id="mainsidebar">';
    get_template_part('sidebar');
    echo '<div class="clr"></div></div>';
    }
    if( ( is_sidebar_active('pagesidebar') || has_nav_menu( 'pagemenu' ) ) && $pagesidebardisplay == 'below' ){
    echo '<div id="pagesidebar">';
    get_template_part('pagebar');
    echo '<div class="clr"></div></div>';
    }
    echo '<div class="clr"></div></div>';
}
if( get_theme_mod('onepiece_elements_sidebar2_position2') == 'ins' && get_theme_mod('onepiece_elements_sidebar2_position') != 'none' && $secondsidebardisplay != 'hide'){
    $contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width'); 
    echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position').';width:'.get_theme_mod('onepiece_elements_sidebar2_width').'%;">';
    echo '<div class="sidebarpadding">';
    get_template_part('sidebar2');
    echo '<div class="clr"></div></div></div>';
}

$contentfloat = 'left';

// start maincontent
echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

// before widgets
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

// mainmenu placement
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

// cover image
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

// main content title and text
if ( $pagetitle != 'none') {
echo '<div class="gallery-titlebar"><h1>'.get_the_title().'</h1>';
if ( $pagetitle == 'text') : 
echo '<p>'.get_the_content().'</p>'; 
endif; 
echo '</div>';
}

// output filtermenu
// $filtermenubox string with html list
if($filters != 'none'){
    // display filter menu
    echo $filtermenubox;
}

// start isotope item container
echo '<div id="itemcontainer" class="category-contentbar">';
// Gallery content
echo '</div>';

// after widgets
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') ){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 
echo '</div>';
echo '<div class="clr"></div></div></div>';

// htmlfooter
get_template_part('footer');
wp_footer();

// get tag index from php for isotope filters

if($tag_idx){ 
?>

<script>
jQuery(function ($) { 
$(document).ready(function() {
<?php echo 'var $tagindex = Array('.rtrim($tag_idx,',').');'; ?>
});

});
</script>
<?php
}
echo '</div></body>';
?>