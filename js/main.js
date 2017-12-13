// JavaScript Document
(function ($, win) {
	
	$(function () {
		
		$('#banner .banner-slider').owlCarousel({ 
			autoPlay: 3000, //Set AutoPlay to 3 seconds
			slideSpeed: 1500,
			items : 3,
			itemsDesktop : [1200,1],
			itemsTablet : [768,1],
			itemsMobile : [480,1],
			navigation: true,
			navigationText : false,
			stopOnHover : true,
			pagination : false 
		});
		
		if ($(".common-slider")[0]) {		
			$(".common-slider").each(function() {
				var $this = $(this),
					slideItem = $this.attr('slider-item');
					if (!slideItem) {
						slideItem = 4;
					}
				$this.owlCarousel({ 
					autoPlay: 3000, //Set AutoPlay to 3 seconds
					slideSpeed: 1500,
					items : slideItem,
					itemsTablet : [1200,2],
					itemsMobile : [480,1],
					navigation: true,
					navigationText : false,
					stopOnHover : true,
					pagination : false 
				});
			});
		}
	});
}(jQuery, window));
