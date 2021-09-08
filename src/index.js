(function($){
	'use strict';
	function fixedHeader(){
		if( $('.home').length > 0 ){
			$( window ).scroll(function() {
				if (window.pageYOffset > 0 ) {
					$('.site-header').addClass('fixed-header');
					$('#site-navigation').addClass('navbar-light');
					$('#site-navigation').removeClass('navbar-dark');
				}
				else{
					$('.site-header').removeClass('fixed-header');
					$('#site-navigation').removeClass('navbar-light');
					$('#site-navigation').addClass('navbar-dark');
				}
				
			});
			$('.menu-item-has-children').on('mouseover', function(){
				if( window.pageYOffset == 0 ){
					$('.site-header').addClass('fixed-header');
				}
			});
			$('.site-header').on('mouseout', function(){
				if( window.pageYOffset == 0 ){
					$('.site-header').removeClass('fixed-header');
				}
			});
		}
		else{
			$('.site-header').addClass('fixed-header');
		}
	}
	$(document).ready(function(){
		fixedHeader();
	});

})(jQuery);
