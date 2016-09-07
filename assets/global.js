/* Global */
jQuery(function ($) { 

$(document).ready(function() {    

    /* on resize */
	var resizeId;
	$(window).resize(function() {
    		clearTimeout(resizeId);
    		resizeId = setTimeout(doneGlobalResizing, 20);
	});
	function doneGlobalResizing(){
		ResponsiveReorder(); 
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


});
 
});