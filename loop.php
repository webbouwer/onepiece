<?php
// important to include the mobile detect function again!
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);

// amount of top posts (first group in pages)
$firstcount = get_theme_mod('onepiece_content_panel_postlist_firstcount', 3);
$excerptlength = get_theme_mod('onepiece_content_panel_postlist_excerptlength', 25);
$imagewidth = get_theme_mod('onepiece_content_panel_list_imgwidth', 37);

$breadcrumbsdisplay = get_theme_mod( 'onepiece_elements_breadcrumbs_display' , 'top');

if($breadcrumbsdisplay == 'befor'){
custom_breadcrumbs();
}


function nextprevbuttondisplay(){

		$prevcustombut = get_theme_mod('onepiece_content_panel_posts_previcon', 'Next >');
		$nextcustombut = get_theme_mod('onepiece_content_panel_posts_nexticon', '< Previous');
		$nextprevtitle = get_theme_mod('onepiece_content_panel_posts_nextprevtitle', 'none');

		if($nextprevtitle == 'above' ){

			previous_post_link('%link', '<div class="above"><h5>%title</h5>'.__($prevcustombut, 'onepiece' ).'</div>', TRUE);
			next_post_link('%link', '<div class="above"><h5>%title</h5>'.__($nextcustombut, 'onepiece' ).'</div>', TRUE);

		}elseif($nextprevtitle == 'below' ){

			previous_post_link('%link', '<div class="below">'.__($prevcustombut, 'onepiece' ).'<h5>%title</h5>'.'</div>', TRUE);
			next_post_link('%link', '<div class="below">'.__($nextcustombut, 'onepiece' ).'<h5>%title</h5>'.'</div>', TRUE);

		}elseif($nextprevtitle == 'beside'){

    		previous_post_link('%link', '<div class="beside">'.__($prevcustombut, 'onepiece' ).'%title'.'</div>', TRUE);
    		next_post_link('%link', '<div class="beside">'.'%title'.__($nextcustombut, 'onepiece' ).'</div>', TRUE);

		}else{

    		previous_post_link('%link', __($prevcustombut, 'onepiece' ), TRUE);
    		next_post_link('%link', __($nextcustombut, 'onepiece' ), TRUE);

		}
		echo '<div class="clr"></div>';

}


if ( is_category() && get_theme_mod( 'onepiece_content_panel_list_titledisplay' ) != 'none') {
echo '<div class="category-titlebar"><h1>'.single_cat_title( '', false ).'</h1>';
if ( category_description() && get_theme_mod( 'onepiece_content_panel_category_titledisplay' ) == 'text') : 
echo '<p>'.category_description().'</p>'; 
endif; 
echo '</div>';
echo '<div class="category-contentbar">';
}elseif( is_search() ){
echo '<div class="search-contentbar">';
}else{
echo '<div class="posts-contentbar">';
}

// get post(s)
if ( have_posts() ) :  
$counter = 0;
while( have_posts() ) : the_post();

echo '<div id="post-'.get_the_ID().'" ';

$classproductlabel = get_post_meta( get_the_ID() , 'meta-box-product-label', true);

if( $counter < $firstcount && !$paged  ){
post_class('first-group-post label-'.$classproductlabel);
}else{

post_class('follow-post label-'.$classproductlabel);
}

$textalign = get_theme_mod('onepiece_content_panel_posts_textalign', 'left');   
$postimagelist = get_theme_mod('onepiece_content_panel_postlist_inlineimage', 'left'); // needed in the loop again to redefine next..

if ( !is_single() && !is_page() ) { 
	$textalign = get_theme_mod('onepiece_content_panel_postlist_textalign', 'left'); 
	if($postimagelist == 'zigzag'){

		$postimagelist = 'right';
		if ($counter % 2 == 0) {
			$postimagelist = 'left';
		}
	}
}

echo '><div class="contentpadding align-'.$textalign.' imgalign-'.$postimagelist.'">';


// include product options
include('assets/product.php');



// define title link
$custom_metabox_url = get_post_meta( get_the_ID() , 'meta-box-custom-url', true);
$custom_metabox_useurl = get_post_meta( get_the_ID() , 'meta-box-custom-useurl', true);
$custom_metabox_urltext = get_post_meta( get_the_ID() , 'meta-box-custom-urltext', true);


$title_link = '<a href="'.get_the_permalink().'" target="_self" title="'.get_the_title().'">';
if( $custom_metabox_url != '' && $custom_metabox_useurl == 'replaceblank'){
$title_link = '<a href="'.$custom_metabox_url.'" target="_blank" title="'.get_the_title().'">';
}elseif( $custom_metabox_url != '' && $custom_metabox_useurl == 'replaceself'){
$title_link = '<a href="'.$custom_metabox_url.'" target="_self" title="'.get_the_title().'">';
}

// editor
if ( is_super_admin() ) {
edit_post_link( __( '<webicon icon="fa:edit"/>' , 'onepiece' ), '<span class="edit-link">', '</span>' );
}

// Titles on top in lists/loops
if ( !is_single() && !is_page() ) {

	echo '<div class="post-title"><h2>'. $title_link . get_the_title().'</a></h2></div>';

if( get_theme_mod('onepiece_content_panel_postlist_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_postlist_authortime') == 'date' ){

echo '<div class="post-subtitle">';

if( get_theme_mod('onepiece_content_panel_postlist_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_postlist_authortime') == 'date' ){

	
	$postlisteddateformat = get_theme_mod('onepiece_content_panel_postlist_dateformat', '2');
	
	
	if($postlisteddateformat == '1'){
	echo '<span class="post-date time-ago">';
	echo wp_time_ago(get_the_time( 'U' ));
	echo '</span>';
	}
	
	if($postlisteddateformat == '2'){
	echo '<span class="post-date">';
	echo get_the_date();
	echo '</span>';
	} 
	
	if($postlisteddateformat == '3'){
	echo '<span class="post-date date-time">';
	echo get_the_date().' - '.get_the_time();
	echo '</span>';
	}
	
}

if( get_theme_mod('onepiece_content_panel_postlist_authortime') == 'both' ){
echo ' <span class="post-author">'.get_the_author().'</span> ';
}
echo '</div>';

}

}





// featured (cover) image
$postimagesingle = get_theme_mod('onepiece_content_panel_posts_featuredimage', 'default');  

if( is_single() && ($postimagesingle == 'replace' || $postimagesingle == 'replacemargin'  
|| $postimagesingle == 'left' || $postimagesingle == 'right') ){
    // no image here..
}else{

if ( has_post_thumbnail()  ) {



	if( post_dynamic_featured_image_gallery(get_the_ID()) != '' && is_single() ){
		echo '<div class="featured_gallery_box '.$postimagesingle.'">'; 
	}

	echo '<div class="post-coverimage" data-image="'.get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ).'">'.$title_link;
		
		if($mobile){
			if( $counter < $firstcount && !$paged ){ // (first page)
				the_post_thumbnail('medium');
			}else{
				the_post_thumbnail('big-thumb');
			}
		}else{
			if( $counter < $firstcount && !$paged ){
				the_post_thumbnail('large');
			}else{
				the_post_thumbnail('normal');
			}
		}
		
	echo '</a></div>'; // default, 'thumb' or 'medium'

	if( post_dynamic_featured_image_gallery(get_the_ID()) != '' && is_single() ){
		echo  post_dynamic_featured_image_gallery($post_id, 'text').'</div>'; 
	}

}else{

	echo '<div class="clr"></div>';

}

} // end featured image 



/*
 * Post Content
*/

// post product label
echo $productlabel;


// Title below image for single/page items
if ( is_single() || is_page() ) { 
echo '<div class="post-title"><h1>'. $title_link . get_the_title().'</a></h1></div>';


if(get_theme_mod('onepiece_content_panel_postlist_authortime') != 'none'){
echo '<div class="post-subtitle">';
if( get_theme_mod('onepiece_content_panel_postlist_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_postlist_authortime') == 'date' || 
get_theme_mod('onepiece_content_panel_postlist_authortime') == 'single' || 
get_theme_mod('onepiece_content_panel_postlist_authortime') == 'datesingle'){
	
	
	$postdateformat = get_theme_mod('onepiece_content_panel_posts_dateformat', '2');
	
	
	if($postdateformat == '1'){
	echo '<span class="post-date time-ago">';
	echo wp_time_ago(get_the_time( 'U' ));
	echo '</span>';
	}
	
	if($postdateformat == '2'){
	echo '<span class="post-date">';
	echo get_the_date();
	echo '</span>';
	} 
	
	if($postdateformat == '3'){
	echo '<span class="post-date date-time">';
	echo get_the_date().' - '.get_the_time();
	echo '</span>';
	}	
	
}
if( get_theme_mod('onepiece_content_panel_postlist_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_postlist_authortime') == 'single'){
echo '<span class="post-author">'.get_the_author().'</span>';
}
echo '</div>';
}

}



// display options
$tagdisplay = get_theme_mod('onepiece_content_panel_posts_tagdisplay', 'belowcontent');
$catdisplay = get_theme_mod('onepiece_content_panel_posts_catdisplay', 'belowcontent');
$nextprevdisplay = get_theme_mod('onepiece_content_panel_posts_nextprevdisplay', 'belowcontent');


	


// content
if ( !is_single() && !is_page() ) { 

	// product box
	echo $productbox;

    // Post intro content
    echo '<div class="post-excerpt">';
	the_excerpt_length( $excerptlength );

	
	// package box
	echo $packagebox;
	
	// order box
	echo $orderbox;

	echo '<div class="clr"></div></div>'; //apply_filters('the_excerpt', get_the_excerpt())
}else{

	if( $tagdisplay == 'belowtitle' ){
    	// post tags
		echo '<div class="post-tags">';
    	the_tags('',', '); // the_tags(', ');  //
		echo '</div>'; 
	}
	
	
	if( $catdisplay == 'belowtitle' ){
    	// post categories
		echo '<div class="post-cats">';
    	the_category(', ');
		echo '</div>'; 
	}

	// prepare content
	$maintext = get_the_content();

	if( $postimagesingle == 'left' || $postimagesingle == 'right' ){

	if($mobile){
		$pthumb = '<div class="post-coverimage" data-image="'.get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ).'">'.get_the_post_thumbnail( get_the_ID(), 'big-thumb' , array( 'class' => 'align-'.$postimagesingle ) ).'</div>';
	}else{
		$pthumb = '<div class="post-coverimage" data-image="'.get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ).'">'.get_the_post_thumbnail( get_the_ID(), 'medium' , array( 'align' => $postimagesingle, 'class' => 'align-'.$postimagesingle ) ).'</div>';
	}
	
	if( post_dynamic_featured_image_gallery( get_the_ID() ) != ''){
		$maintext = '<div class="featured_gallery_box '.$postimagesingle.'">'. $pthumb . post_dynamic_featured_image_gallery( get_the_ID() ) . '</div>' . $maintext; 
	}else{
		$maintext = $pthumb . $maintext; 
	}
	
	}
	
    // Post full content
    echo '<div class="post-content">'.apply_filters('the_content', $maintext.$productbox.$packagebox.$orderbox ).'<div class="clr"></div></div>';


	// define custom link (internal / external)
	if( $custom_metabox_url != '' && ($custom_metabox_useurl == 'external' || $custom_metabox_useurl == 'internal') ){
	$custom_link = '<a href="'.get_the_permalink().'" target="_self" title="'.get_the_title().'">';
	if( $custom_metabox_url != '' && $custom_metabox_useurl == 'external'){
	$custom_link = '<a href="'.$custom_metabox_url.'" target="_blank" title="'.get_the_title().'">';
	}elseif( $custom_metabox_url != '' && $custom_metabox_useurl == 'internal'){
	$custom_link = '<a href="'.$custom_metabox_url.'" target="_self" title="'.get_the_title().'">';
	}

	echo $custom_link.$custom_metabox_urltext.'</a>';


	}



	if( $tagdisplay == 'belowcontent' ){
    	// post tags
    	// post tags
		echo '<div class="post-tags">';
    	the_tags('Tagged with: ',' '); // the_tags(', ');  //
		echo '</div>';
	}

	if( is_single() && $nextprevdisplay == 'belowcontent' ){
    	// prev / next posts
    	nextprevbuttondisplay();
	}

	if( $catdisplay == 'belowcontent' ){
    	// post categories
		echo '<div class="post-cats">';
    	the_category(', ');
		echo '</div>'; 
	}

	// post comments
    if ( comments_open() || get_comments_number() ) {
    	comments_template(); // WP THEME STANDARD: comments_template( $file, $separate_comments );
    }
	
	if( is_page() ){
	
	$defaults = array(
		'before'           => '<div>' . __( 'Pages:'  , 'onepiece' ),
		'after'            => '</div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page'  , 'onepiece' ),
		'previouspagelink' => __( 'Previous page'  , 'onepiece' ),
		'pagelink'         => '%',
		'echo'             => 1
	);
	wp_link_pages( $defaults );
	
	}
	
}

echo '<div class="clr"></div></div></div>';

$counter++;

endwhile;

echo '</div>';


if( is_single() && ($nextprevdisplay == 'contentside' || $nextprevdisplay == 'abovefooter' )){ 
    	// prev / next posts fixed positioned
    	nextprevbuttondisplay();
}



if ( !is_single() && !is_page() ) {
    	// prev / next posts - https://codex.wordpress.org/Function_Reference/posts_nav_link
    	echo '<div class="pagenavigation">';
        echo '<div class="alignleft">'.previous_posts_link( '&laquo; Previous Entries' ).'</div>';
        echo '<div class="alignright">'.next_posts_link( 'Next Entries &raquo;', '' ).'</div>';
        echo '</div>';
}

endif; 


?>