import ScrollOut from "scroll-out";

(function($){
	'use strict';
	function jbSliderBlock(){
		if( $('.jb-slider-inner').length > 0 ){
			var slidestoshow = 1,
					arrowcontrol = false,
					slideSpeed = 1000,
					slidestosroll = 1;
			$('.jb-slider-inner').each(function(e){
					slidestoshow = parseInt($(this).attr('data-slidetoshow')),
					arrowcontrol = $(this).attr('data-arrowcontrol'),
					slideSpeed = parseInt($(this).attr('data-sliderspeed')),
					slidestosroll = parseInt($(this).attr('data-slidestoscroll'));
					if( arrowcontrol == "true" ){
						arrowcontrol = true;
					}
					else{
						arrowcontrol = false;
					}
					$(this).slick({
					autoplay: true,
					arrows:arrowcontrol,
					slidestosroll: slidestosroll,
					slidesToShow: slidestoshow,
					speed: slideSpeed
				});
			});
		}
	}

	function jbTestimonial(){
		if( $('.jb-testimonial-list-wrapper').length > 0 ){
			$('.jb-testimonial-list-wrapper').each(function(e){
				$(this).slick({
					autoplay: true,
					arrows: false,
					dots: true,
					slidesToShow: 1

				});
			});
		}
	}
	$(window).load(function(){		
		$('body').addClass('loaded');
		ScrollOut({
			onShown(el) {
					if(  el.classList.contains('fadeInUp') ){
						el.classList.add("animate__fadeInUp");
					}
					else if( el.classList.contains('fadeInLeft') ){
						el.classList.add("animate__fadeInLeft");
					}
					else if( el.classList.contains('fadeInRight') ){
						el.classList.add("animate__fadeInRight");
					}
			}
		});
	})
	$(document).ready(function(){
		jbSliderBlock();
		jbTestimonial();
		
	});

})(jQuery);
