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
 * RESPONSIVE ORDER
 * #topbarmargin, #topsidebar, #contentcontainer .outermargin, #sidebar, #sidebar2, #pagesidebarcontainer (index.php, page.php, gallery.php)
 */
 
 
	if( $("#topsidebar").length > 0 ){ // check top sidebar first
		var topstyleside = $("#topsidebar").attr('style');
		var topstylemain = $("#topbarmargin").attr('style');
	}
 
	function ResponsiveReorder(){
	    var small = 512;
		
	    if( $(window).width() > small ){
			
			if( $("#topsidebar").length > 0 ){ // check top sidebar first
				$("#topsidebar").attr('style', topstyleside).prependTo("#topmenubar .outermargin");
				$("#topbarmargin").attr('style', topstylemain);
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
	    if( $(window).width() < small ){
			
			if( $("#topsidebar").length > 0 ){ // check top sidebar first
				$("#topsidebar").attr('style', 'width:100%;').prependTo("#contentcontainer .outermargin");;
				$("#topbarmargin").attr('style', 'width:100%;');
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
	    }
	}
	ResponsiveReorder();
	

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
		
		
		//$('#topbar').css('width', $(window).width() +'px'); // add topbar width resize
		
		/* adjust mobile header
		if( $('#pagecontainer').hasClass("mobile")  ){
		
		if(  $("#headercontainer").height() >= ( $(window).height() / 2.5 ) ){
			
			$("#sliderbox-head").css( 'height' , $(window).height() + 'px' );
			
		}else{
			
			$("#sliderbox-head").css( 'height' , 'auto' );
		
		}
		
	
		} // end mobile
		*/
		
		// headerbar height (fade bglayer)
		
		$('#headerbar').css( 'height' , $(window).height()/3*2 + 'px' );
		//$('#headerbar .bglayer').css( 'height' , $(window).height()/3*2 + 'px' ); //called in htmlhead.php in resizeend function
	}
	
	doneGlobalResizing();

	
	
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
