(function($){
	'use strict';
	
	$(function(){
		var controlwpadminbar = $("#wpadminbar").is("div");
		if(controlwpadminbar == "") {
		} else {
			var controlwpadminbarh = $("#wpadminbar").height();
			var controltopareah = $(".header").height();
			$('.header').css('top',controlwpadminbarh + 'px');
		}
	});
		
} )( jQuery );