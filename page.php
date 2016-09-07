
<?php 
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);


// htmlhead
get_template_part('htmlhead');



/*
// slider options
$sliderdisplay = get_post_meta(get_the_ID(), "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta(get_the_ID(), "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta(get_the_ID(), "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta(get_the_ID(), "pagetheme_slide_displaywidth", true);

$sliderdefaultdisplay = get_theme_mod('onepiece_content_sliderbar_display', 'default' );
$sliderdefaultcat = get_theme_mod('onepiece_content_sliderbar_category', 'uncategorized' );
$sliderdefaultheight = get_theme_mod('onepiece_content_sliderbar_height', '60%' );
$sliderdefaultwidth = get_theme_mod('onepiece_content_sliderbar_width', 'full' );

$pgslider = sliderhtml($slidercat, $mobile);
$dfslider = sliderhtml($sliderdefaultcat, $mobile);
*/

// main content area
$useheaderimage = get_post_meta( get_the_ID() , "meta-page-headerimage", true);
$pagesidebardisplay = get_post_meta(get_the_ID(), "meta-page-pagesidebardisplay", true);
$specialwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-specialwidgetsdisplay", true);
$beforewidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-beforewidgetsdisplay", true);
$afterwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-afterwidgetsdisplay", true);
$secondsidebardisplay = get_post_meta(get_the_ID(), "meta-page-secondsidebardisplay", true);
$childpagedisplay = get_post_meta(get_the_ID(), "meta-box-display-childpages", true);


// header
get_template_part('header');

echo '<div id="contentcontainer"><div class="outermargin">';


/************** PAGE SIDEBARS ******************/
$contentpercentage = 100;

if( get_theme_mod('onepiece_elements_sidebar2_position2') == 'out' && function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position') != 'none' && $secondsidebardisplay != 'hide' ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width'); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position').';width:'.get_theme_mod('onepiece_elements_sidebar2_width').'%;">';
get_template_part('sidebar2');
echo '<div class="clr"></div></div>';
}

if( $pagesidebardisplay != 'none' && function_exists('is_sidebar_active') && get_theme_mod('onepiece_elements_sidebar_position') != 'none' && (is_sidebar_active('sidebar') || is_sidebar_active('pagesidebar') ) ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_mainsidebar_width');

echo '<div id="pagesidebarcontainer" class="'.get_theme_mod('onepiece_elements_sidebar_position', 'left').'side" style="float:'.get_theme_mod('onepiece_elements_sidebar_position').';width:'.get_theme_mod('onepiece_elements_mainsidebar_width').'%;">';

if( ( is_sidebar_active('pagesidebar')  || has_nav_menu( 'pagemenu' ) ) && ($pagesidebardisplay == 'top' || $pagesidebardisplay == 'replace')   ){
echo '<div id="pagesidebar">';
get_template_part('pagebar');
echo '<div class="clr"></div></div>';
}
if( is_sidebar_active('sidebar') && ($pagesidebardisplay != 'replace' || !is_sidebar_active('pagesidebar')) ){ 
echo '<div id="mainsidebar">';
get_template_part('sidebar');
echo '<div class="clr"></div></div>';
}
if( ( is_sidebar_active('pagesidebar') || has_nav_menu( 'pagemenu' ) ) && $pagesidebardisplay == 'below'   ){
echo '<div id="pagesidebar">';
get_template_part('pagebar');
echo '<div class="clr"></div></div>';
}
echo '<div class="clr"></div></div>';
}

if( get_theme_mod('onepiece_elements_sidebar2_position2') == 'ins' && function_exists('is_sidebar_active') && is_sidebar_active('sidebar2') && get_theme_mod('onepiece_elements_sidebar2_position') != 'none' && $secondsidebardisplay != 'hide' ){
$contentpercentage = $contentpercentage - get_theme_mod('onepiece_elements_sidebar2_width'); 
echo '<div id="sidebar2" class="'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').'side '.get_theme_mod('onepiece_elements_sidebar2_position2').'" style="float:'.get_theme_mod('onepiece_elements_sidebar2_position', 'right').';width:'.get_theme_mod('onepiece_elements_sidebar2_width').'%;">';
get_template_part('sidebar2');
echo '<div class="clr"></div></div>';
}

$contentfloat = 'left';


echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

if( function_exists('is_sidebar_active') && is_sidebar_active('special-page-widgets') && ( $specialwidgetsdisplay == 'top' || $specialwidgetsdisplay == 'replace' ) ){
echo '<div id="specialpagewidgets">';
dynamic_sidebar('special-page-widgets');
echo '<div class="clr"></div></div>';
}
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-before') && $specialwidgetsdisplay != 'replace' && $beforewidgetsdisplay != 'hide'){
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
if($mainmenuplace == 'content' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}

/*
// slider topcontent
if( $sliderdisplay == 'topcontent' && $slidercat != 'uncategorized'){
// slider content here
echo '<h2>'.$sliderdisplay.' page</h2>'. $pgslider;
}else if( $sliderdefaultdisplay == "topcontent" && $sliderdefaultcat != 'uncategorized' && $sliderdisplay != 'none' && $sliderdisplay != 'replaceheader' ){
// default slider content here
echo '<h2>'.$sliderdefaultdisplay.' default</h2>'. $dfslider;
}
*/

/* MAIN CONTENT */
if ( have_posts() ) :    
while( have_posts() ) : the_post();
echo '<div id="post-'.get_the_ID().'" ';
post_class();
echo '><div class="contentpadding">';


$page_ID = get_the_ID();
$values = get_post_custom( $page_ID );
$post_obj = $wp_query->get_queried_object();

// cover, title & meta
if ( has_post_thumbnail() && $useheaderimage != 'replace' && $childpagedisplay != 'fade' ) {
    
$title_link = '<a href="'.get_the_permalink().'" target="_self" title="'.get_the_title().'">';
echo '<div class="post-coverimage">'.$title_link;
$pagefeaturedimage =  '';
if($mobile){
the_post_thumbnail('big-thumb');
$pagefeaturedimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'big-thumb' ); 
}else{
the_post_thumbnail('medium');
$pagefeaturedimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' ); 
}
echo '</a></div>'; // default, 'thumb' or 'medium'
}





// editor
if ( is_super_admin() ) {
edit_post_link( __( 'Edit' , 'onepiece' ), '<span class="edit-link">', '</span>' );
}
$mainpageoption = '';
$mainpagecontent = '';



if( $childpagedisplay != 'fade' && $childpagedisplay != 'slddwn' ){ 
    
echo '<div class="post-title"><h1>'. get_the_title().'</h1></div>';

if( get_theme_mod('onepiece_content_panel_page_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_page_authortime') == 'date' ){
echo '<span class="post-date">'.get_the_date().'</span>';
}
if( get_theme_mod('onepiece_content_panel_page_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_page_authortime') == 'author'){
echo '<span class="post-author">'.get_the_author().'</span>';
}

// Page full content
echo '<div class="page-content mainpage">';
echo apply_filters('the_content', get_the_content()).'</div>';

}else{
    
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);
    
    
$mainpageoption .= '<li id="button-'.$post_obj->post_name.'" data-imgurl="'.$thumb_url[0].'"><a href="'.get_permalink($post_obj->ID).'" target="_self">'.$post_obj->post_title.'</a></li>';
$mainpagecontent .= '<li id="'.$post_obj->post_name.'" data-imgurl="'.$thumb_url[0].'" class="childcontent"><div class="subtitle"><h3>'.$post_obj->post_title.'</h3></div><div class="subcontent">'.
            apply_filters('the_content', get_the_content())
            .'</div></li>';

}



if( isset($childpagedisplay) && $childpagedisplay != 'none'){  

    $args = array(
    'post_parent' => $page_ID,
    'post_type'   => 'page', 
    'posts_per_page' => -1,
    'post_status' => 'publish', 
    'order' => 'ASC'
    ); 
    $childpages = get_children( $args );
    if( $childpages ){
        $menu = $mainpageoption;
        $content = $mainpagecontent;
        foreach($childpages as $c => $page){
            $contentimagedata = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ),'full', false );
            $contentimage = $contentimagedata[0];
			
			$pieces = get_extended($page->post_content);
			//print_r($pieces);
			
            $menu .= '<li id="button-'.$page->post_name.'" data-imgurl="'.$contentimage.'"><a href="'.get_permalink($page->ID).'" target="_self">'.$page->post_title.'</a></li>';
            $content .= '<li id="'.$page->post_name.'" data-imgurl="'.$contentimage.'" class="childcontent"><div class="subtitle"><h3>'.$page->post_title.'</h3></div><div class="subcontent">'.
            apply_filters('the_content',$pieces['main'])
            .'</div><div class="childcontent moretextbox">'.apply_filters('the_content',$pieces['extended']).'</div></li>';
        }
        
        echo '<div class="page-content childpages">';
        // subpagemenu
        if( $childpagedisplay == 'menu' || $childpagedisplay == 'fade'){ 
        //echo '<h3>Sub Pages</h3>';
        echo '<ul id="childpagemenu">'.$menu.'</ul><div class="clr"></div>';
        }
        // subpages
        if( $childpagedisplay != 'menu' ){
        echo '<ul id="childpagecontent">'.$content.'</ul>';
        }
        echo '</div>';
        //print_r($page);
    }



} // end childpage content

/*
if( $sliderdisplay == 'bottomcontent' && $slidercat != 'uncategorized'){
// slider content here
echo '<h2>'.$sliderdisplay.'</h2>';
}else if( $sliderdefaultdisplay == "bottomcontent" && $sliderdefaultcat != 'uncategorized' && $sliderdisplay != 'none' && $sliderdisplay != 'replaceheader' ){
// default slider content here
echo '<h2>'.$sliderdefaultdisplay.'</h2>';
}
*/


	// Page comments
    if ( comments_open() || get_comments_number() ) {
    comments_template(); // WP THEME STANDARD: comments_template( $file, $separate_comments );
    }  
    
    /* Page nav */
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
	
	
	
	
echo '<div class="clr"></div></div></div>';

endwhile;	
endif;   

if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') && $afterwidgetsdisplay != 'hide'){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 

echo '</div>';


echo '<div class="clr"></div></div></div>';

// footer
get_template_part('footer');

wp_footer();

if( $childpagedisplay == 'fade' ){
?>
<script type="text/javascript"> 
jQuery(function($) {
	$(document).load(function(){
		function change_header_image(src){
			var m = 'url('+src+')';
			var bg = $('#headerbar').css('background-image');
			$('#headerbar .bglayer').css("background-image", bg );
			$('#headerbar').css("background-image", m );
			$('#headerbar .bglayer').fadeOut('slow' , function(){
				 $(this).css("background-image", 'none' ); 
                                 $('#headerbar .bglayer').fadeIn('fast');
                        });
		}
                function set_header_height(){
		    var h = $(window).height() / 5 * 3 + 'px';
		    $('#headerbar .bglayer').css("height", h );
                }

		$(window).on('resize', function(){
		    set_header_height();
                });

		set_header_height();

		$('ul#childpagecontent li.childcontent').hide();
                $('ul#childpagecontent li.childcontent').eq(0).addClass('active').slideDown();
                var poimg = $('ul#childpagecontent li.active').attr('data-imgurl');
		change_header_image(poimg);
		$('ul#childpagemenu li').on('click', function(){
			$('ul#childpagemenu li').removeClass('active');
			$('ul#childpagecontent li.childcontent').removeClass('active');
                	$(this).addClass('active');
			$('ul#childpagecontent li.childcontent').slideUp();
    			$('ul#childpagecontent li.childcontent').eq(
                          $(this).index()
                        ).addClass('active').slideDown();
                        poimg = $('ul#childpagecontent li.childcontent').eq(
                          $(this).index()
                        ).attr('data-imgurl');
		        change_header_image(poimg);
			return false;
		});
		$('ul#childpagemenu li').hover(
  		    function() {
    			$( this ).addClass('hovered');
  		    }, function() {
    			$( this ).removeClass('hovered');
  		    }
		);
	});
});
</script>
<?php
}


echo '</div></body>';