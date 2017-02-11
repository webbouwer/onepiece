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

		var small = 512;
		var toprepos = $wp_custom_vars['onepiece_elements_topsidebar_responsive'];



		
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
	        if( $("#sidebar2").hasClass('ins') ){ // inside first
	        $("#sidebar2").prependTo("#contentcontainer .outermargin");
	        }
	        if($("#pagesidebarcontainer").length){
	        $("#pagesidebarcontainer").prependTo("#contentcontainer .outermargin");
	        }else if($("#mainsidebar").length){
	        $("#mainsidebar").prependTo("#contentcontainer .outermargin");
	        }
	        if( $("#sidebar2").hasClass('out') ){ // outside last
	        $("#sidebar2").prependTo("#contentcontainer .outermargin");
	        }
	    }
	    if( $(window).width() <= small ){
			

			if( $("#bottomsidebar").length > 0 ){ // check top sidebar first
				$("#bottomsidebar").attr('style', 'width:100%;'); //.appendTo("#footercontainer .outermargin");
				$("#bottombarmargin").attr('style', 'width:100%;');
			}
			
	        // append    
	        if( $("#sidebar2").hasClass('ins') ){ // inside first
	        $("#sidebar2").appendTo("#contentcontainer .outermargin");
	        }
	        if($("#pagesidebarcontainer").length){ 
	        $("#pagesidebarcontainer").appendTo("#contentcontainer .outermargin");
	        }else if($("#mainsidebar").length){
	        $("#mainsidebar").appendTo("#contentcontainer .outermargin");
	        }
	        if( $("#sidebar2").hasClass('out') ){ // outside first
	        $("#sidebar2").appendTo("#contentcontainer .outermargin");
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

		var sttstyle = 'style="margin:'+sttmarg+';padding:'+sttpadd+';"';
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
	$('body').append('<div class="popupcloak"></div><div id="mainpopupbox"><div class="popupcontent outermargin"></div></div>');
    $('#mainpopupbox').hide();
    $('.popupcloak').hide();
    $('div.childpages.pop .moretextbox').hide();
    
    function loadpopup( popcontent ){
		$('.popupcloak').fadeIn(300);
		$('#mainpopupbox .popupcontent').html( popcontent )
		$('#mainpopupbox').fadeIn(300);
    }
	function closepopup(){
		$('.popupcloak').fadeOut(300);
		
		$('#mainpopupbox').fadeOut(300, function(){
			$('#mainpopupbox .popupcontent').html('');										 
		});
	}
    
    $('div.childpages.pop li').click(function(){
		var content =  $(this).find('.subtitle').html() + $(this).find('.moretextbox').html();
		loadpopup( content );
		return false;
	});
	
	$('.popupcloak').click(function(){
		closepopup();
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
