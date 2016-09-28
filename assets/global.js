/* Global */
/** JS code with custom variables
 *  
 * localize this script  
 * http://stackoverflow.com/questions/23763442/wordpress-custom-theme-mixing-php-and-javascript
 *
 */
jQuery(function ($) { 

$(document).ready(function() {    

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
		$('#topbar').css('width', $(window).width() +'px'); // add topbar width resize
	}
/**
 * RESPONSIVE ORDER
 * #contentcontainer .outermargin, #sidebar, #sidebar2, #pagesidebarcontainer (index.php, page.php, gallery.php)
 */
	function ResponsiveReorder(){
	    var small = 512;
	    if( $(window).width() > small ){
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
	    if( $(window).width() < small ){
	        // append    
	        if( $("#sidebar2").hasClass('ins') ){ // inside first
	        $("#sidebar2").appendTo("#contentcontainer . ");
	        }
	        if($("#pagesidebarcontainer").length){ 
	        $("#pagesidebarcontainer").appendTo("#contentcontainer .outermargin");
	        }else if($("#mainsidebar").length){
	        $("#mainsidebar").appendTo("#contentcontainer .outermargin");
	        }
	        if( $("#sidebar2").hasClass('out') ){ // outside first
	        $("#sidebar2").appendTo("#contentcontainer .outermargin");
	        }
	    }
	}
	ResponsiveReorder();
	
/**
 * LOADING MESSAGEBOX
 * body (index.php, page.php, gallery.php)
 */ 
	$('body').append('<div class="loadbox"><span>Loading</span></div>');
	$('body > .loadbox').hide().fadeIn(400);
	
/**
 * SCROLL TO TOP
 * window top (index.php, page.php, gallery.php)
 */ 
	$('#maincontent').append('<a href="#" class="scrollToTop"><span>Scroll To Top</span></a>');
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
	$('body').append('<div class="popupcloak"></div><div id="mainpopupbox"><div class="popupcontent"></div></div>');
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
    
    $('div.childpages.pop .readmore').click(function(){
		var content =  $(this).parent().find('.subtitle').html() + $(this).next('.moretextbox').html();
		loadpopup( content );
		return false;
	});
	
	$('.popupcloak').click(function(){
		closepopup();
		return false;
	});
    
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


/**
 * LOADER BOX
 * onload/content loaded
 */  
$('body > .loadbox').fadeOut(1200);

});
 
 

 
 
});
