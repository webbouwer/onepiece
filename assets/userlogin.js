jQuery(function($) {
		$(document).ready(function(){

		$('ul.tabcontainer li').hide();
                //$("ul.tabcontainer li").eq(0).slideDown();

		$('ul.tabmenu li,div.resetlogin').on('click', function(){
															   
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('li.tab').slideUp();
			}else{

			$('ul.tabmenu li,div.resetlogin ').removeClass('active');
            $(this).addClass('active');
			$('li.tab').slideUp();
			if($(this).hasClass('resetlogin')){
    			$("ul.tabcontainer li").eq($(3).index()).slideDown();
			}else{
    			$("ul.tabcontainer li").eq($(this).index()).slideDown();
			}

			}
			return false;
		});
		});
	});
