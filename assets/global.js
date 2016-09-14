/* Global */
jQuery(function ($) { 

$(document).ready(function() {    

/**
 * HTML RESIZE RESPONSIVE
 * on resize
 * reorder sidebar html (index.php, page.php, gallery.php)
 */  
    /* on resize */
	var resizeId;
	$(window).resize(function() {
    		clearTimeout(resizeId);
    		resizeId = setTimeout(doneGlobalResizing, 20);
	});
	function doneGlobalResizing(){
		ResponsiveReorder(); // replace sidebar elements below content
		$('#topbar').css('width', $(window).width() .'px'); // add topbar width resize
	}
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
	

    $(window).scroll(function(s){
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



});
 
 

 
 
});
