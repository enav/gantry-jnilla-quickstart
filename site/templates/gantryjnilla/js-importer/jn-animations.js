//--------------------------------------
// Jnilla Animate v0.0.3
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		if(!$('[class*="jn-animation-"]').length) return;
		
		// -------------------------
		// Init
		// -------------------------
		setTimeout(function(){
			pollScroll();
		}, 500);
		
		
		// -------------------------
		// Events
		// -------------------------
		
		$(window).scroll(function(){
			pollScroll();
		});
		
		$(document).resize(function(){
			pollScroll();
		});
		
		$('.jn-animation-hover').mouseenter(function(){
			setStatus($(this), true);
		});
		
		$('.jn-animation-hover').mouseleave(function(){
			if($(this).hasClass('jn-animation-repeat')) {
				setStatus($(this), false);
			}
		});
		
		
		// -------------------------
		// Functions
		// -------------------------
		
		// Poll elements to execute scroll meta event
		function pollScroll(){
			$('.jn-animation-scroll').each(function(){
				var el = $(this);
				if(isInViewport(el)){
					 setStatus(el, true);
				}else{
					if(el.hasClass('jn-animation-repeat')) {
						setStatus(el, false);
					}
				}
			});
		}
		
		// Set element status
		function setStatus(el, status){
			if(status){
				if(el.hasClass('jn-animation-active')) return;
				el.addClass('jn-animation-active');
			}
			else{
				if(!el.hasClass('jn-animation-active')) return;
				el.removeClass('jn-animation-active');
			}
		}
		
		// Calculates if the middle point of the element is inside the viewport boundari
		function isInViewport(el) {
			var winH = $(window).height();
			var scrollTop = $(window).scrollTop();
			var elTop = el.offset().top;
			var elH = el.outerHeight();
			var elMid = parseInt(elTop+(elH/2)-scrollTop);
			
			if((elMid <= winH) && (elMid >=0)){
				return true;
			}else{
				return false;
			}
		}
		
	});
})(jQuery);










