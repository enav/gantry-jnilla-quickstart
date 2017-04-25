//--------------------------------------
// Jnilla Carousel v1.0.0
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		if(!$('.jn-carousel').length) return;
		
		
		// -------------------------
		// Init
		// -------------------------
		
		// first run
		updateControls();
		
		
		// -------------------------
		// Events
		// -------------------------
		
		// window resize
		$(window).resize(function(){
			updateControls();
		});
		
		// carousel slid
		$('.jn-carousel').on('slid', function(){
			setTimeout(function(){
				updateControls();
			}, 250);
		});
		
		// -------------------------
		// Functions
		// -------------------------
		
		// update the carousel controls
		function updateControls(){
			$('.jn-carousel').each(function(){
				
				var mask = $(this).find('.carousel-indicators-mask').eq(0);
				var container = mask.find('.carousel-indicators').eq(0);
				var maskWidth = mask.width();
				var containerWidth = container.width();
				var containerLeft = 0;
				var offset = maskWidth - containerWidth;
				var active = container.find('.active').eq(0);
				if(!active.length) return;
				var activeWidth = active.width();
				var activeLeft = active.position().left;
				
				// center container
				if(offset >= 0){
					containerLeft = offset/2;
				}else{
					containerLeft = (maskWidth/2)-(activeWidth/2)-activeLeft;
					// limit container movement
					if(containerLeft > 0){
						containerLeft = 0;
					}else if(containerLeft < offset){
						containerLeft = offset;
					}
				}

				// apply css
				container.css({
					'left': containerLeft
				});
				
			});
		}
		
		
	});
})(jQuery);




