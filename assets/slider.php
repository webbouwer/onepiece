<?php
/**
 * 
 * SLIDER CATEGORY ITEM HTML
 *
 */
function sliderhtml($category, $mobile, $id = null){ 
    $cat = get_category_by_slug( $category );
    $sliderhtml = '';
    if( $cat->term_id ){
	    query_posts('category_name='.$category);
        $sliderhtml .= '<div class="topelement"></div>';
		$sliderhtml .= '<ul id="slider-'.$id.'" class="sliderarea">';
        if (have_posts()) : while (have_posts()) : the_post();

	    $sliderhtml .= '<li class="panel"';
	if ( get_post_thumbnail_id( get_the_ID() ) ) {
	$aid = get_post_thumbnail_id( get_the_ID() );
    	$large_image_url = wp_get_attachment_image_src( $aid, 'full' );
    	$small_image_url = wp_get_attachment_image_src( $aid, 'large' );
	if($mobile){ 
	$sliderhtml .= ' style="background-image:url('.$small_image_url[0].');"';
	}else{
	$sliderhtml .= ' style="background-image:url('.$large_image_url[0].');"';
	}
	}
	$sliderhtml .= '>';
	
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
	
	
    $sliderhtml .= '<div class="slidebox"><div class="outermargin">';
	$sliderhtml .= '<div class="contentbox"><h3>'.$title_link.''.get_the_title().'</a></h3>';
	$sliderhtml .= '<div class="excerpt">'.get_the_excerpt().'</div></div>';
	$sliderhtml .= '</div></div></li>'; 
    
    endwhile; endif; 
	wp_reset_query();
	
	$sliderhtml .= '</ul>';
    $sliderhtml .= '<div class="bottomelement"></div>';
	return $sliderhtml;
    }    
}

?>
