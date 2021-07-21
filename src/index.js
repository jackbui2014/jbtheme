(function($){
	'use strict';
	function fixedHeader(){
		if( $('.home').length > 0 ){
			$( window ).scroll(function() {
				if (window.pageYOffset > 0 ) {
					$('.site-header').addClass('fixed-header');
				}
				else{
					$('.site-header').removeClass('fixed-header');
				}
				
			});
		}
	}
	$(document).ready(function(){
		fixedHeader();
	});

})(jQuery);
