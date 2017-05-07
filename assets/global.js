/* Global */
/** JS code with custom variables
 *  
 * localize this script  
 * http://stackoverflow.com/questions/23763442/wordpress-custom-theme-mixing-php-and-javascript
 *
 */
jQuery(function ($) { 
$(document).ready(function() {    
						   
/*
 * Available js variables (localized)
 * functions.php - $$wp_global_data array
 * functions.php - onepiece_global_js function
 * !! get api / user variables out of public var
 */
 
var $wp_custom_vars = JSON.parse(site_data['customizer']);
	// example: alert($wp_custom_vars['onepiece_elements_topsidebar_responsive']);

	/**
	 * RESPONSIVE ORDER
	 * #topbarmargin, #topsidebar, #contentcontainer .outermargin, #sidebar, #sidebar2, #pagesidebarcontainer (index.php, page.php, gallery.php)
	 */
	if( $("#topsidebar").length > 0 ){ // check top sidebar first
		var topstyleside = $("#topsidebar").attr('style');
		var topstylemain = $("#topbarmargin").attr('style');
	}
	if( $("#bottomsidebar").length > 0 ){ // check top sidebar first
		var bottomstyleside = $("#bottomsidebar").attr('style');
		var bottomstylemain = $("#bottombarmargin").attr('style');
	}
 



	function ResponsiveReorder(){

		var small = 512 ; // defaults
		var medium = 1024; // defaults
		var small = $wp_custom_vars['onepiece_responsive_small_outermargin'];
		var medium = $wp_custom_vars['onepiece_responsive_medium_outermargin'];

		var toprepos = $wp_custom_vars['onepiece_elements_topsidebar_responsive'];
		var mainsidebarrepos = $wp_custom_vars['onepiece_elements_mainsidebar_responsive'];
		var sidebar2repos = $wp_custom_vars['onepiece_elements_sidebar2_responsive'];


		var mainsidebarwidth = $wp_custom_vars['onepiece_elements_mainsidebar_width'];
		var sidebar2width = $wp_custom_vars['onepiece_elements_sidebar2_width'];

		/*
		 * Large / Medium Screens
		 */
	    if( $(window).width() > small ){
			
			if( $("#topsidebar").length > 0 ){ // check top sidebar first
				$("#topsidebar").show();
				$("#topsidebar").attr('style', topstyleside).prependTo("#topmenubar .outermargin");
				$("#topbarmargin").attr('style', topstylemain);
			}
			if( $("#bottomsidebar").length > 0 ){ // check top sidebar first
				$("#bottomsidebar").attr('style', bottomstyleside); //.appendTo("#footercontainer .outermargin");
				$("#bottombarmargin").attr('style', bottomstylemain);
			}
			
	        // prepend
	        if($("#pagesidebarcontainer").length){
	            $("#pagesidebarcontainer").prependTo("#contentcontainer .outermargin");
				$("#pagesidebarcontainer").show();
	        }else if($("#mainsidebar").length){
	        	$("#mainsidebar").prependTo("#contentcontainer .outermargin");
	        	$("#mainsidebar").show();
			}

			// new content width
			var cw = 100;
			if($("#sidebar2").length){
			cw = cw - sidebar2width;
			}
			if($("#mainsidebar").length || $("#pagesidebarcontainer").length){
			cw = cw - mainsidebarwidth;
			}
			$('#maincontent').css('width', cw+'%' );

	    }


		if( $(window).width() > medium && $("#sidebar2").length ){
		    // prepend
	        $("#sidebar2").prependTo("#contentcontainer .outermargin");

			// new content width
			var cw = 100;
			cw = cw - sidebar2width;

			if($("#mainsidebar").length || $("#pagesidebarcontainer").length){
			cw = cw - mainsidebarwidth;
			}
			$('#maincontent').css('width', cw+'%' );

		}

		/*
		 * Medium screens
		 */
		if( $("#sidebar2").length && $(window).width() <= medium && $(window).width() > small ){

		    // append
	        if( $("#mainsidebar").length || $("#pagesidebarcontainer").length ){

				if(sidebar2repos == 'after'){
					$("#sidebar2").appendTo("#contentcontainer .outermargin");
				}
				if(sidebar2repos == 'before'){
					$("#sidebar2").prependTo("#contentcontainer .outermargin");
				}
				if(sidebar2repos == 'hide'){
					$("#sidebar2").hide();
				}

				// new content width
				$('#maincontent').css('width', ( 100 - mainsidebarwidth )+'%' );
				
	        }

		}

		/*
		 * Small Screens
		 */

	    if( $(window).width() <= small ){
			
			if( $("#bottomsidebar").length > 0 ){ // check top sidebar first
				$("#bottomsidebar").attr('style', 'width:100%;'); //.appendTo("#footercontainer .outermargin");
				$("#bottombarmargin").attr('style', 'width:100%;');
			}
			
	        // append    
	        if( $("#sidebar2").hasClass('ins') ){

				if(sidebar2repos == 'after'){
					$("#sidebar2").appendTo("#contentcontainer .outermargin");
				}
				if(sidebar2repos == 'before'){
					$("#sidebar2").prependTo("#contentcontainer .outermargin");
				}
				if(sidebar2repos == 'hide'){
					$("#sidebar2").hide();
				}

	        }

			if($("#pagesidebarcontainer").length){

				if(mainsidebarrepos == 'after'){
					$("#pagesidebarcontainer").appendTo("#contentcontainer .outermargin");
				}else if(mainsidebarrepos == 'before'){
					$("#pagesidebarcontainer").prependTo("#contentcontainer .outermargin");
				}else if(mainsidebarrepos == 'bottom'){
					$("#pagesidebarcontainer").prependTo("#footercontainer .outermargin");
				}else if(mainsidebarrepos == 'hide'){
					$("#pagesidebarcontainer").hide();
				}
				
			 }else if( $("#mainsidebar").length ){

				if(mainsidebarrepos == 'after'){
					$("#mainsidebar").appendTo("#contentcontainer .outermargin");
				}else if(mainsidebarrepos == 'before'){
					$("#mainsidebar").prependTo("#contentcontainer .outermargin");
				}else if(mainsidebarrepos == 'bottom'){
					$("#mainsidebar").prependTo("#contentcontainer .outermargin");
				}else if(mainsidebarrepos == 'hide'){
					$("#mainsidebar").hide();
				}
				
	        }


	        if( $("#sidebar2").hasClass('out') ){ // outside first    .length

				if(sidebar2repos == 'after'){
					$("#sidebar2").appendTo("#contentcontainer .outermargin");
				}else if(sidebar2repos == 'before'){
					$("#sidebar2").prependTo("#contentcontainer .outermargin");
				}else if(sidebar2repos == 'bottom'){
					$("#sidebar2").prependTo("#contentcontainer .outermargin");
				}else if(sidebar2repos == 'hide'){
					$("#sidebar2").hide();
				}

	        }

			if( $("#topsidebar").length > 0 ){ // check top sidebar first


				if(toprepos == 'top'){
					$("#topsidebar").attr('style', 'width:100%;').prependTo("#topmenubar .outermargin");
				}
				if(toprepos == 'after'){
					$("#topsidebar").insertAfter( $("#maincontent") ).attr('style', 'width:100%;');
				}
				if(toprepos == 'before'){
					$("#topsidebar").attr('style', 'width:100%;').prependTo("#contentcontainer .outermargin");
				}

				if(toprepos == 'bottom'){
					$("#topsidebar").attr('style', 'width:100%;').appendTo("#contentcontainer .outermargin");
				}
				if(toprepos == 'hide'){
					$("#topsidebar").hide();
				}

				$("#topbarmargin").attr('style', 'width:100%;');

			}
	    }
	}
	

/**
 * HTML RESIZE RESPONSIVE
 * on resize
 * reorder sidebar html (index.php, page.php, gallery.php)
 */  
    /* On resize */
	var resizeId;
	$(window).resize(function() {
    		clearTimeout(resizeId);
    		resizeId = setTimeout(doneGlobalResizing, 20);
	});
	
		
		
	function doneGlobalResizing(){
		
		ResponsiveReorder(); // replace sidebar elements below content
		
		// headerbar height (pushing maincontainer below topbar if no header image  or slider)
		$('#headercontainer').css('min-height', $('#topbar .outermargin').height() );

	}


	
/**
 * LOADING MESSAGEBOX
 * body (index.php, page.php, gallery.php)
 */ 
	//$('body').append('<div class="loadbox"><span>Loading</span></div>');
	//$('body > .loadbox').hide().fadeIn(400);


/**
 * SCROLL TO TOP
 * window top (index.php, page.php, gallery.php)
 */ 
	var sttdspl = $wp_custom_vars['onepiece_identity_scrolltotop_display'];
	var stthtml = $wp_custom_vars['onepiece_identity_scrolltotop_html'];
	var sttmarg = $wp_custom_vars['onepiece_identity_scrolltotop_margin'];
	var sttpadd = $wp_custom_vars['onepiece_identity_scrolltotop_padding'];


	if(sttdspl != 'hi'){

	var butpos = "bottom:0px;right:0px;";
	// sttdspl = br ||  bl ||  tr || tl
	switch (sttdspl) {
    case "tl":
        butpos = "top:0px;left:0px;";
        break;
    case "bl":
        butpos = "bottom:0px;left:0px;";
        break;
    case "tr":
        butpos = "top:0px;right:0px;";
        break;
    default:
        butpos = "bottom:0px;right:0px;"; // br

	}
		var sttstyle = 'style="'+butpos+'margin:'+sttmarg+';padding:'+sttpadd+';"';
		var sttbut = '<a href="#" '+sttstyle+' class="scrollToTop"><span>'+stthtml+'</span></a>';

	$('#maincontent').append(sttbut);

	$('.scrollToTop').hide();
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});


	$(window).scroll(function(s){
		if ($(this).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}			  
    });

	}

    $('.site-logo').click(function(){
        
        if ($(window).scrollTop() > 100) {
		    $('html, body').animate({scrollTop : 0},800);
		    return false;
		} else {
			window.location.href = $(this).href;
		}
        
	});
	
	

	/**
	 * CONTENT POPUPBOX
	 * body (index.php, page.php, gallery.php)
	 */

	$('body').append('<div class="popupcloak"></div><div id="mainpopupbox"><div class="popupcontent outermargin"></div><div class="popupclosebutton"><webicon style="width:48px;height:48px;" icon="glyphicons:remove-sign"/></div></div>');


    $('#mainpopupbox').hide();
    $('.popupcloak').hide();
    $('div.childpages.pop .moretextbox').hide();
    
    function loadpopup( popcontent ){
		$('.popupcloak').fadeIn(300);
		$('#mainpopupbox .popupcontent').html( popcontent );
		$('body').css('overflow', 'hidden');
		$('#mainpopupbox').fadeIn(300);
    }
	function closepopup(){
		$('.popupcloak').fadeOut(300);
        
		$('body').css('overflow', 'auto');
		
		$('#mainpopupbox').fadeOut(300, function(){
		    
			$('#mainpopupbox .popupcontent').html('');
			
		});
	}

    $('div.childpages.pop li').click(function(){
		var content =  $(this).find('.subtitle').html() + $(this).find('.moretextbox').html();
		loadpopup( content );
		return false;
	});
	$('.popupcloak, .popupclosebutton, #mainpopupbox').click(function(){
		closepopup();
		return false;
	});
	$("#mainpopupbox .popupcontent").click(function(e) {
        e.stopPropagation();
   	});
	
	
	
	// post dynamic featured images
	$('.featured_gallery_box').on('click', 'ul.featured_image_nav li', function(pi){
		
			pi.preventDefault();

				var addthumb = '<li data-image="'+$(this).parent().parent().find('.post-coverimage img').attr('src')+'"><img src="'+$('.featured_gallery_box .post-coverimage').attr('data-image')+'" /></li>';
				
				//var newwidth = $(this).parent().parent().find('.post-coverimage img').width();
				var newlarge = $(this).attr('data-image');
				var newthumb = $(this).find('img').attr('src');
				var newsrcset = $(this).attr('data-image');
				
				//$(this).parent().parent().find('.post-coverimage img').attr('width',newwidth);
				$(this).parent().parent().find('.post-coverimage img').attr('srcset', newsrcset);
				$(this).parent().parent().find('.post-coverimage img').attr('src', newlarge);
				$(this).parent().parent().find('.post-coverimage').attr('data-image', newthumb);
				
				$('.featured_gallery_box ul.featured_image_nav').append(addthumb);
				$(this).remove();
				
  			return false;

		});
    
	
	

$(window).load(function() { 
						
	/**
	 * HTML THEME PAGE SCROLL
	 * smooth scroll
	 * html content anchors (index.php, page.php, gallery.php)
	 */  
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == 	this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
				scrollTop: target.offset().top
				}, 800);
				return false;
			}
		}
	}); 

	doneGlobalResizing();

	/**
	 * LOADER BOX
	 * onload/content loaded
	 */  
	$('body > .loadbox').fadeOut(1200);

});
 

});
});
