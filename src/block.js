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
	$(document).ready(function(){
		jbSliderBlock();
	});

})(jQuery);
