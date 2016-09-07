<?php 
/**
 * Template Name: Gallery
 * List posts to a grid with Isotope
 */

$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);
// get page template variables
global $post;
$values = get_post_custom( $post->ID );
$selected = isset( $values['theme_gallery_category_selectbox'] ) ? $values['theme_gallery_category_selectbox'][0] : '';
if($selected){
$topcat = $selected;
}else{
$topcat = 'uncategorized';
}
$pagetitle = isset( $values['theme_gallery_pagetitle_selectbox'] ) ? $values['theme_gallery_pagetitle_selectbox'][0] : '';
$filters = isset( $values['theme_gallery_filters_selectbox'] ) ? $values['theme_gallery_filters_selectbox'][0] : '';
$maxinrow = isset( $values['theme_gallery_items_maxinrow'] ) ? $values['theme_gallery_items_maxinrow'][0] : '5';
$clickaction = isset( $values['theme_gallery_items_clickaction'] ) ? $values['theme_gallery_items_clickaction'][0] : 'poppost';

/************** FILTER MENU ******************/
// prepare filter menu and create category tag index

if($filters != 'none'){
// categories // http://wordpress.stackexchange.com/questions/212923/how-to-list-all-categories-and-tags-in-a-page
$args = array( 
    'child_of'                 => get_category_by_slug($topcat)->term_id,
    'orderby'                  => 'name',
    'order'                    => 'ASC', 
    'public'                   => true,
); 
$categories = get_categories( $args );
$cat_tags = '';
$tag_idx = '';
$filtermenubox = '';

$filtermenubox .= '<ul id="topgridmenu" class="categorymenu">';
$filtermenubox .= '<li><a class="category" href="#" data-filter="*">All</a></li>';
foreach ( $categories as $category ) {
if( $category->slug != $topcat ){
$filtermenubox .= '<li><a class="category" href="#" data-filter="' . $category->slug . '">' . $category->name . '</a>'; 
// get_category_link( $category )
    if( $filters == 'all'){
	query_posts('category_name='.$category->slug);
    $posttags = '';
    $idxtags ='';
    if (have_posts()) : while (have_posts()) : the_post();
        if( get_the_tag_list() ){
            $posttags .= get_the_tag_list('<li>','</li><li>','</li>');
            //$idxtags .= get_the_tag_list('"','","','",');
            $listtags = get_the_tags();
            foreach($listtags as $tag) {
                $idxtags .= '"'.$tag->name.'",'; 
            }
        }
    endwhile; endif; 
    $cat_tags .='<ul class="tagmenu '.$category->slug.'">'.$posttags.'</ul>';
    $tag_idx .= $idxtags;
    wp_reset_query(); 
    }
	$filtermenubox .= '</li>';
}
}
$filtermenubox .= '</ul>';
$filtermenubox .= $cat_tags;
}




// slider options
$sliderdisplay = get_post_meta(get_the_ID(), "pagetheme_slide_displaytype", true);
$slidercat = get_post_meta(get_the_ID(), "pagetheme_slide_selectbox", true);
$sliderheight = get_post_meta(get_the_ID(), "pagetheme_slide_displayheight", true);
$sliderwidth = get_post_meta(get_the_ID(), "pagetheme_slide_displaywidth", true);



echo '<!DOCTYPE HTML><html '; 
language_attributes(); 
echo '><head><meta http-equiv="Content-Type" content="text/html; charset='.get_bloginfo( 'charset' ).'" />';
wp_enqueue_script("jquery");
// basic wp meta 
wp_head(); // http://codex.wordpress.org/Function_Reference/wp_head 
$site_description = get_bloginfo( 'description' );
echo 	'<meta name="description" content="'.$site_description.'">'
	.'<meta name="keywords" content="wordpress theme,theme setup,basic theme,custom theme">'
	.'<link rel="canonical" href="'.home_url(add_query_arg(array(),$wp->request)).'">'
	.'<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'" />'
	.'<link rel="shortcut icon" href="images/favicon.ico" />'
	.'<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/style.css" />'
	.'<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/'.get_theme_mod('onepiece_identity_stylelayout_stylesheet', 'default.css').'" />';


// mobile meta 
if($mobile){
echo '<meta name="viewport" content="width=device-width; initial-scale=1.0;" />';
}
if ( ! isset( $content_width ) ) {
$content_width = 960;
}

// include js code
echo '<script src="'.get_template_directory_uri().'/assets/isotope.js" type="text/javascript" language="javascript"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/isotope-packery.js" type="text/javascript" language="javascript"></script>';
echo '<script src="'.get_template_directory_uri().'/assets/imagesloaded.js" type="text/javascript" language="javascript"></script>';

echo '<script src="'.get_template_directory_uri().'/assets/global.js" type="text/javascript" language="javascript"></script>';

echo '<style type="text/css">';
echo '#headercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logo_maxwidth').'px !important; }';
echo '#footercontainer .logobox { max-width:'.get_theme_mod('onepiece_identity_panel_logosmall_maxwidth').'px !important; }';

echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_small_width', 98).'%; max-width:'.get_theme_mod('onepiece_responsive_small_outermargin').'px; margin:0 auto; }'; 
echo '#itemcontainer .item{ width:50%; }';
echo '#itemcontainer .item.active{ width:100%; }';

// single column (sidebars on top/bottom) small 
echo '@media screen and (max-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '#maincontent,#mainsidebar,#pagesidebarcontainer,#sidebar2{float:none !important;width:100% !important;margin:0px auto;}'; 
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_small_max', 512).'px) {';
echo '.outermargin { width:'.get_theme_mod('onepiece_responsive_medium_width', 95).'%;max-width:'.get_theme_mod('onepiece_responsive_medium_outermargin').'px; }'; 
// set medium width

echo '#itemcontainer .item{width:'.(100 / 3).'%;}'; 
echo '#itemcontainer .item.active{ width:'.((100 / 3)*2).'%; }';
echo '}';

echo '@media screen and (min-width: '.get_theme_mod('onepiece_responsive_medium_max', 1280).'px) {';
echo '.outermargin { max-width:'.get_theme_mod('onepiece_responsive_large_outermargin').'px; }'; 
// set large width 
$aw = 2;
if( $maxinrow > 3){
$aw = 3;
}
echo '#itemcontainer .item{width:'.(100 / $maxinrow).'%;}'; 
echo '#itemcontainer .item.active{ width:'.((100 / $maxinrow)*$aw).'%; }';
echo '}';
echo '</style>';
?>
<script>
jQuery(function ($) { 

$(document).ready(function() {

    var $container = $("#itemcontainer");
    var $tagList = '';
    var $catList = '<?php echo $topcat; ?>';
    var $currCat = '';
    var $itemsloaded = [];
    var $itemamount = <?php echo isset( $maxinrow ) ? ( $maxinrow * 3 ) : 8; ?>;
    var $itemList = [];
    var $noloading = 0;
    
    
    <?php if($tag_idx){ 
    echo 'var $tagindex = Array('.rtrim($tag_idx,',').');';
    } ?>
    var phsh = window.location.hash.substr(1);    
    if(phsh.length){    
        $catList = phsh;
        // check tags
        if( $.inArray( phsh, $tagindex ) != -1 ){
            $catList = '<?php echo $topcat; ?>';
            $tagList = phsh;
        }   
    }
    
    
    <?php 
    if($tag_idx != ''){ 
    echo 'var $tagindex = Array('.rtrim($tag_idx,',').');';
    }else{
    echo 'var $tagindex = [];';
    }
    
    ?>

    var phsh = window.location.hash.substr(1);
    if(phsh != '' && $tagindex){  
        
        //alert(window.location.hash.substr(1));
        // check tags
        if( $.inArray( phsh, $tagindex ) != -1 ){
            $catList = '<?php echo $topcat; ?>';
            $tagList = phsh;
        }else{
        $catList = phsh;
        $tagList = '';
        }
    }
    
    
    
    
    
    // init isotope :: http://isotope.metafizzy.co/layout-modes/masonry.html
    $container.isotope({ 
       	itemSelector: '.item',	  
   		layoutMode: 'packery',	  
        packery: {
                //columnWidth: $container.width()/2, // min blocks on row is 2 
         	gutter: 0
       	 },
		getSortData: {
		byCategory: function (elem) { // sort randomly
        	return $(elem).data('category') === $currCat ? 0 : 1;
      	}},
       	animationEngine: 'best-available'
    });
    
    
    /* load posts to container */
    loaditems();
    
    
    

	/* on resize */
	var resizeId;
	$(window).resize(function() {
    		clearTimeout(resizeId);
    		resizeId = setTimeout(doneResizing, 20);
	});
	function doneResizing(){
		setColumnWidth(); 
	}
	function setColumnWidth(){
	    
	    var small = <?php echo get_theme_mod('onepiece_responsive_small_max', 512); ?>;
	    var medium = <?php echo get_theme_mod('onepiece_responsive_medium_max', 1280); ?>;
	    var maxinrow = <?php echo isset( $maxinrow ) ? $maxinrow: 3; ?>;
	    var w = $container.width() / 2;
	    if( $(window).width() > small ){
	        w = $container.width() / 3;
	    }
	    if( $(window).width() > medium ){
	        w = $container.width() / maxinrow;
	    }
	  	//$('#itemcontainer .item:last').width(); // present css 
    	$container.isotope({ masonry: { columnWidth: w } }).isotope('layout'); // define in isotope
	}
	setColumnWidth();

    
    $(window).scroll(function(s){
    s.preventDefault(); 
    if($(window).scrollTop() == $(document).height() - $(window).height() && $noloading == 0){ 
        loaditems();
    }
    });
    

    function loaditems(){
        data = {
          action: 'filter_posts', // function to execute
          afp_nonce: afp_vars.afp_nonce, // wp_nonce
          ajxtags:  $tagList, // selected options
          ajxcategories:  $catList, // selected options
          ajxloaded:  $itemsloaded, // available items
          itemamount:  $itemamount, // available items
        };  

	$.post( afp_vars.afp_ajax_url, data, function(response) {
          if( response.length > 0 ){  
	  var elems = '';
              $.each( $.parseJSON(response), function(idx, obj) {
                  $itemsloaded.push(obj.id); // add loaded items id
		  $itemList[obj.id] = obj;
                  elems += itemmarkup(obj); // item html markup
              });

              $newItems = $( elems );
              $container.append( $newItems ).isotope( 'appended', $newItems );
          }
        }).done(function( data ) {
            $container.imagesLoaded( function(){
                $items = $('.item');
                $container.isotope( 'updateSortData', $items).isotope( 'layout' );
                $noloading = 0;
                //$('#contentloadbox').remove();
            });

        }); 

    }

    
    function itemmarkup(obj){

    var tags = '';
    var taglist = obj['tags'].toString();
    var tags_arr = taglist.split(/\s*,\s*/);
    for(i=0;i<tags_arr.length;i++){
        tags += tags_arr[i]+' ';
      }

    var cat = '';
    if(obj['category'].length > 0 ){
      for(i=0;i<obj['category'].length;i++){
        cat += obj['category'][i]['slug']+' ';
      }
    }
    var markup = '<div id="post-'+obj.id+'" data-category="'+cat+'" class="item '+cat+' '+tags+'"><div class="innerpadding">';

    markup += '<div class="titlebox"><h3>';

    var posturl = '<a href="'+obj.posturl+'" title="'+obj.title+'" target="_self">';

    if( obj.meta['meta-box-custom-url'] && obj.meta['meta-box-custom-useurl'] == 'replaceblank'){
    posturl = '<a href="'+obj.meta['meta-box-custom-url']+'" title="'+obj.title+'" target="_blank">';
    }
    if( obj.meta['meta-box-custom-url'] && obj.meta['meta-box-custom-useurl'] == 'replaceself'){
    posturl = '<a href="'+obj.meta['meta-box-custom-url']+'" title="'+obj.title+'" target="_self">';
    }

    markup += posturl+''+obj.title+'</a></h3>';

    <?php // check for customizer posts display settings
    if( get_theme_mod('onepiece_content_panel_postlist_authortime') ){
    echo "var authortime = '".get_theme_mod('onepiece_content_panel_postlist_authortime')."'; // from php";
    ?>
    
    if( authortime == 'both' || authortime ==  'date' ){
        markup += '<span class="datebox">'+obj.date+'</span>';
    }
    if( authortime == 'both'  ){
        markup += '<span class="authorbox">'+obj.author+'</span>';
    }
    <?php } ?>


    
    markup += '</div>';

    if( obj.smallimg ){ 
    markup += '<div class="coverbox"><img class="coverimage" src="'+obj.smallimg[0]+'" alt="'+obj.title+'" /></div>';
    }
  
    // META DATA .. JSON.stringify(obj.meta)
    if( obj.meta['meta-box-custom-url'] && (obj.meta['meta-box-custom-useurl'] == 'external' || obj.meta['meta-box-custom-useurl'] == 'internal') ){
    	var urltext = obj.meta['meta-box-custom-url'];
	if( obj.meta['meta-box-custom-urltext'] ){
		urltext = obj.meta['meta-box-custom-urltext']; 
	}
	if( obj.meta['meta-box-custom-useurl'] == 'external' ){
		markup += '<a class="urlbutton" href="'+obj.meta['meta-box-custom-url']+'" target="_blank">';
	}else{
		markup += '<a class="urlbutton" href="'+obj.meta['meta-box-custom-url']+'" target="_self">';
	}
    	markup += urltext+'</a>';
    }
    
    markup += '<div class="textbox">'+obj.excerpt+'</div>';

	if(obj.meta['meta-box-custom-url']){
    		markup += '<div class="fullinfobox hidden">'+obj.meta['meta-box-custom-url']+'</div>';
	}

    markup += '</div></div>';
    return markup;

    /* 'id,'type','date','title','category','excerpt','content','meta','tags', 'imageurl','posturl','slug','customfieldarray','post_data' */
    }
   


    	// Grid items
	$container.on('click', '.item', function(){

<?php if( $clickaction == 'sizeup' ){ ?>

		$('.item').removeClass('active');
		$(this).addClass('active');
		$currCat = $(this).attr('data-category');
		var $this = $(this);

		$container.prepend($this).isotope('reloadItems').isotope({ sortBy: 'byCategory' }); // or 'original-order'
	
		$('html, body').animate({scrollTop: $('#maincontent').offset().top }, 400); // Scroll to top (bottom of header)

<?php } ?>

		return false;
	}); 


    // Filter menu's
    $('ul.tagmenu').hide();

    $('ul.categorymenu li a.category').click(function(m){

    m.preventDefault();

	$('.item').removeClass('active');
    $('ul.tagmenu.active').slideUp().removeClass('active');
    $('ul.categorymenu li a').removeClass('selected');
    $(this).addClass('selected');

    if( $(this).attr('data-filter') == '*'){
        var keyword = '*';
        $catList = '<?php echo $topcat; ?>';//[];
    }else{ 
        var keyword = '.'+$(this).attr('data-filter');
        // multiple filters: $catList += ','+$(this).attr('data-filter');
        $catList = $(this).attr('data-filter');
        var submenu = 'ul.tagmenu.'+$(this).attr('data-filter');
	    $(submenu).slideDown().addClass('active');
        }
        $tagList = '';
        
        loaditems();
        $container.isotope({ filter: keyword }).isotope('layout');
        window.location.hash = $catList;
        return false;

    });
  
    $('ul.tagmenu li a,div.tagcloud a').click(function(m){
  	    var keyword = '.'+$(this).text();
        $catList = $(this).attr('data-filter');
        $tags = $(this).text();
	    loaditems();
     	$container.isotope({ filter: keyword }).isotope('layout'); 
     	var iid = '#' + $tags;
		window.location.hash = iid;
	    return false;
    });

 
});


$(window).load(function() { 

});

});

</script>

<?php
echo '</head>';



echo '<body '; 
body_class(); 
echo '><div id="pagecontainer"';
if($mobile){
echo ' class="mobile">';
}else{
echo '>';
}

/************** PAGE HEADER ******************/
get_template_part('header');

/************** PAGE CONTENT ******************/
$useheaderimage = get_post_meta( get_the_ID() , "meta-page-headerimage", true);
$pagesidebardisplay = get_post_meta(get_the_ID(), "meta-page-pagesidebardisplay", true);
$specialwidgetsdisplay = get_post_meta(get_the_ID(), "meta-page-specialwidgetsdisplay", true);
$secondsidebardisplay = get_post_meta(get_the_ID(), "meta-page-secondsidebardisplay", true);

echo '<div id="contentcontainer"><div class="outermargin">';

/************** PAGE SIDEBARS ******************/
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

/************** MAIN CONTENT AREA ******************/
echo '<div id="maincontent" style="float:'.$contentfloat.';width:'.$contentpercentage.'%;">';

/************** BEFORE CONTENT WIDGETS ******************/
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
if($mainmenuplace == 'content' && $mainbarclass != 'none'){
echo '<div id="site-navigation" class="main-navigation '.$mainbarclass.'" role="navigation"><nav>';
if ( has_nav_menu( 'mainmenu' ) ) {
wp_nav_menu( array( 'theme_location' => 'mainmenu' ) );
}else{
wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
} 
echo '<div class="clr"></div></nav></div>';
}



/************* PAGE FEATURED IMAGE *************/
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

/************** PAGE TITLE ******************/
if ( $pagetitle != 'none') {
echo '<div class="gallery-titlebar"><h1>'.get_the_title().'</h1>';
if ( $pagetitle == 'text') : 
echo '<p>'.get_the_content().'</p>'; 
endif; 
echo '</div>';
}

/************** FILTER MENU ******************/
if($filters != 'none'){
    // display filter menu
    echo $filtermenubox;
}

/************** CONTENT ITEMCONTAINER ******************/
echo '<div id="itemcontainer" class="category-contentbar">';
// Gallery content
echo '</div>';

/************** AFTER CONTENT WIDGETS ******************/
if( function_exists('is_sidebar_active') && is_sidebar_active('widgets-after') ){
echo '<div id="widgets-after">';
dynamic_sidebar('widgets-after');
echo '<div class="clr"></div></div>';
} 

echo '</div>';
echo '<div class="clr"></div></div></div>';

/************** PAGE FOOTER ******************/
get_template_part('footer');
wp_footer();

echo '</div></body>';