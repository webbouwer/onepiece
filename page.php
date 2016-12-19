<?php 
$mobile = mobile_device_detect(true,true,true,true,true,true,true,false,false);


/**
 *
 * htmlhead
 *
 */	
get_template_part('htmlhead');

/** 
 *
 * content custom variables
 *
 */	
$useheaderimage = get_post_meta( get_the_ID() , "meta-page-headerimage", true);
$pagesidebardisplay = get_post_meta(get_the_ID(), "meta-page-pagesidebardisplay", true);
$specialwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-specialwidgetsdisplay", true);
$beforewidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-beforewidgetsdisplay", true);
$afterwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-afterwidgetsdisplay", true);
$secondsidebardisplay = get_post_meta(get_the_ID(), "meta-page-secondsidebardisplay", true);
$childpagedisplay = get_post_meta(get_the_ID(), "meta-box-display-childpages", true);
$childparentcontent = get_post_meta(get_the_ID(), "meta-box-display-parentcontent", true);
$childalignment = get_post_meta(get_the_ID(), "meta-box-display-alignment", true);
$childcoverimage = get_post_meta(get_the_ID(), "meta-box-display-coverimage", true);

/**
 *
 * header
 *
 */	
get_template_part('header');

/**
 *
 * main container
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

/**
 *
 *  Start html main content area 
 *
 */	
$contentfloat = 'left';

echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

if( function_exists('is_sidebar_active') && is_sidebar_active('special-page-widgets') && ( $specialwidgetsdisplay == 'top' || $specialwidgetsdisplay == 'replace' ) ){
echo '<div id="specialpagewidgets">';
dynamic_sidebar('special-page-widgets');
echo '<div class="clr"></div></div>';
}

/**
 * login 
 */
if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'cbtop'){
display_userpanel();
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

/**
 *
 *  mainmenu placement
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
 *  MAIN CONTENT LOOP
 *
 */	
if ( have_posts() ) :    
while( have_posts() ) : the_post();
echo '<div id="post-'.get_the_ID().'" ';
post_class();
echo '><div class="contentpadding">';

$page_ID = get_the_ID();
$values = get_post_custom( $page_ID );
$post_obj = $wp_query->get_queried_object();

/**
 *
 *  post cover, title & meta
 *
 */	
if ( has_post_thumbnail() && $useheaderimage != 'replace' && $childpagedisplay != 'fade' ) {

if( $childparentcontent != 'none' ){ 
  
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

}

if ( is_super_admin() ) { // admin/editor options
edit_post_link( __( 'Edit' , 'onepiece' ), '<span class="edit-link">', '</span>' );
}



$mainpageoption = '';
$mainpagecontent = '';



/** 
 *
 * CHILDPAGES
 * Page theme childpages display
 *
 */
if( $childpagedisplay != 'fade' && $childpagedisplay != 'slddwn' ){ 

if( $childpagedisplay == 'none' || ($childparentcontent != 'none' && $childpagedisplay !='none') ){

echo '<div class="page-title"><h1>'.get_the_title().'</h1></div>';
if(get_theme_mod('onepiece_content_panel_page_authortime') != 'none'){
echo '<div class="page-subtitle">';
if( get_theme_mod('onepiece_content_panel_page_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_page_authortime') == 'date' ){
echo '<span class="post-date">'.get_the_date().' </span>';
}
if( get_theme_mod('onepiece_content_panel_page_authortime') == 'both' || 
get_theme_mod('onepiece_content_panel_page_authortime') == 'author'){
echo '<span class="post-author">'.get_the_author().'</span>';
}
echo '</div>';
}

/** 
 *
 * normal page content display
 *
 */ 
echo '<div class="page-content mainpage">';
echo apply_filters('the_content', get_the_content());
echo '</div>';
}

}else{

/** 
 *
 * display main content adjusted for box/tab/slides 
 *
 */ 
//$thumb_id = get_post_thumbnail_id();
//$thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);

$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full', false );

if( $childparentcontent != 'none' ){
$contentalign = 'left';
if( isset($childpagedisplay) && $childpagedisplay != 'none' ){
$contentalign = $childalignment;
}


$mainpageoption .= '<li id="button-'.$post_obj->post_name.'" data-imgurl="'.$thumb_url[0].'"><a href="'.get_permalink($post_obj->ID).'" target="_self">'.$post_obj->post_title.'</a></li>';
$mainpagecontent .= '<li id="'.$post_obj->post_name.'" data-imgurl="'.$thumb_url[0].'" class="childcontent align-'.$contentalign.'"><div class="subtitle"><h3>'.$post_obj->post_title.'</h3></div><div class="subcontent">'. apply_filters('the_content', get_the_content()) .'</div></li>';
}

}

/** 
 *
 * prepare childpages box/pop/tab/slide content 
 *
 */ 
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
			
			$pieces = get_extended($page->post_content); //print_r($pieces);
			
            $menu .= '<li id="button-'.$page->post_name.'" data-imgurl="'.$contentimage.'"><a href="'.get_permalink($page->ID).'" title="'.$page->post_title.'" target="_self">'.$page->post_title.'</a></li>';
            $content .= '<li id="'.$page->post_name.'" data-imgurl="'.$contentimage.'" class="childcontent align-'.$childalignment.'">';
			
			
			if( !$childcoverimage || $childcoverimage == 'below' || $childcoverimage == 'none' || $childcoverimage == 'inlineL' || $childcoverimage == 'inlineR'){
			$content .= '<div class="subtitle"><h3><a href="'.get_permalink($page->ID).'" title="'.$page->post_title.'" target="_self">'.$page->post_title.'</a></h3></div>';
			}
			
			if ( $childcoverimage != 'none' && $childcoverimage != 'inlineL' && $childcoverimage != 'inlineR' && $contentimagedata != false && $childpagedisplay != 'fade') {
			$content .= '<div class="post-coverimage '.$childcoverimage.'"><a href="'.get_permalink($page->ID).'" title="'.$page->post_title.'" target="_self">';
			
			if($mobile){
				if($childcoverimage == 'thumb'){
					$content .= get_the_post_thumbnail( $page->ID, 'big-thumb' );
				}else{
					$content .= get_the_post_thumbnail( $page->ID, 'medium' );
				}
			}else{
				if($childcoverimage == 'thumb'){
					$content .= get_the_post_thumbnail( $page->ID, 'medium' );
				}else{
					$content .= get_the_post_thumbnail( $page->ID, 'large' );
				}
			}
			$content .= '</a></div>';
			}

			if($childcoverimage == 'above' || $childcoverimage == 'thumb' ){
			$content .= '<div class="subtitle"><h3><a href="'.get_permalink($page->ID).'" title="'.$page->post_title.'" target="_self">'.$page->post_title.'</a></h3></div>';
			}
			
			
			$content .= '<div class="subcontent">';
			
			$maintext = $pieces['main']; //default without filter
			
			if ( ($childcoverimage == 'inlineL' || $childcoverimage == 'inlineR' ) && $contentimagedata != false && $childpagedisplay != 'fade') {
				
				$imagealign = 'left';
				if( $childcoverimage == 'inlineR'){
				$imagealign = 'right';
				}
				if($childalignment == 'center' ){
				$imagealign = 'center';
				}
			
				// start maintext with image
				if($mobile){
					$maintext = get_the_post_thumbnail( $page->ID, 'big-thumb' , array( 'align' => $imagealign, 'class' => 'align-'.$imagealign ) ) . $maintext;
				}else{
					$maintext = get_the_post_thumbnail( $page->ID, 'medium' , array( 'align' => $imagealign, 'class' => 'align-'.$imagealign ) ) . $maintext;
				}
				
			}
			
			
			$content .= apply_filters('the_content',  $maintext ); // add filter on full content
			
            if($childpagedisplay == 'slddwn' && !empty($pieces['extended']) ){ // inline readmore
			$content .= '<a class="readmore" href="'.get_permalink($page->ID).'" target="_self">'.__('Read more', 'onepiece').'</a>'; 
			}
			$content .= '</div>';
			
			if($childpagedisplay != 'bloc'){
            $content .= '<div class="childcontent moretextbox">'.apply_filters('the_content',$pieces['extended']).'</div>';
			}
            if($childpagedisplay != 'fade' && $childpagedisplay != 'slddwn' && !empty($pieces['extended'])){
            $content .= '<a class="readmore" href="'.get_permalink($page->ID).'" target="_self">'.__('Read more', 'onepiece').'</a>';
            }
			$content .= '</li>';
        }
        
        echo '<div class="page-content childpages '.$childpagedisplay.'">';
        
        if( $childpagedisplay == 'menu' || $childpagedisplay == 'fade'){ 
        echo '<ul id="childpagemenu">'.$menu.'</ul><div class="clr"></div>'; // subpagemenu
        }
        // subpages
        if( $childpagedisplay != 'menu' ){
        echo '<ul id="childpagecontent">'.$content.'</ul>';
        }
        echo '</div>';
        //print_r($page);
    }

} // end childpage content




/**
 * 
 * PAGE RELATED
 *
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


/**
 * 
 * Widgets after
 *
 */
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') && $afterwidgetsdisplay != 'hide'){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 


/**
 * 
 * Login
 *
 */

if( get_theme_mod('onepiece_elements_loginbar_option', 'none') == 'cbbot'){
display_userpanel();
}


echo '</div>';


echo '<div class="clr"></div></div></div>';


/**
 * 
 * Footer
 *
 */

get_template_part('footer');
wp_footer();

echo '</div>';

/** 
 *
 * JS CHILDPAGES
 * Page theme childpages display
 */
 
// move to custom js

if( $childpagedisplay == 'fade' ){
?>
<script type="text/javascript"> 
/**
 * Tab menu
 * Fade header 
 * Slide down text
 */
jQuery(document).ready(function($) {
    
		function change_header_image(src){
			var m = 'url('+src+')'; // new bg image url
			var bg = $('#headerbar').css('background-image'); // current bg image url to move to bglayer
			$('#headerbar .bglayer').css("background-image", bg ); // set current in bglayer, in front of #headerbar
			$('#headerbar').css("background-image", m );  // load new in #headerbar, behind bglayer
			$('#headerbar .bglayer').fadeOut('slow' , function(){ // fadeout bglayer (current)
				$(this).css("background-image", 'none' ); // on end clear bglayer bg image
                $('#headerbar .bglayer').fadeIn('fast'); // reset bglayer opacity/fade
            });
		}
        
        
		$('ul#childpagecontent li.childcontent').hide();
        $('ul#childpagecontent li.childcontent').eq(0).addClass('active').slideDown();
        $('ul#childpagemenu li').eq(0).addClass('active');
        var poimg = $('ul#childpagecontent li.active').attr('data-imgurl');
		change_header_image(poimg);
		$('ul#childpagemenu li').on('click', function(){
		$('ul#childpagemenu li').removeClass('active');
		$('ul#childpagecontent li.childcontent').removeClass('active');
        $(this).addClass('active');
		$('ul#childpagecontent li.childcontent').slideUp();
    	$('ul#childpagecontent li.childcontent').eq( $(this).index() ).addClass('active').slideDown();
        poimg = $('ul#childpagecontent li.childcontent').eq(
        $(this).index()).attr('data-imgurl');
		change_header_image(poimg);
		return false;
		});
		$('ul#childpagemenu li a').hover(
  		    function() {
    			$( this ).addClass('hovered');
  		    }, function() {
    			$( this ).removeClass('hovered');
  		    }
		);
});
</script>
<?php
}

if( $childpagedisplay == 'slddwn' ){
?>
<script type="text/javascript"> 
/**
 * Tab menu
 * Fade header 
 * Slide down text
 */
jQuery(document).ready(function($) {

		$('ul#childpagecontent li.childcontent .moretextbox').hide();
        //$('ul#childpagecontent li.childcontent .moretextbox').eq(0).addClass('active').slideDown();
        //$('ul#childpagemenu li').eq(0).addClass('active');
        
		$('.childcontent').on('click', function(){ 
		if($(this).hasClass('active') ){
			$(this).find('.moretextbox').slideUp();
			$('ul#childpagecontent li.childcontent').removeClass('active');
			$(this).find('.readmore').slideDown('fast');
		}else{
			$('ul#childpagecontent li.childcontent').removeClass('active');
        	$(this).addClass('active');
			$('ul#childpagecontent li.childcontent .moretextbox').slideUp();
			$('ul#childpagecontent li.childcontent .readmore').fadeIn('slow');
    		$(this).find('.moretextbox').slideDown();
			$(this).find('.readmore').slideUp('fast');
        }
		return false;
		});
		
});
</script>
<?php
}
echo '</body>';
?>
