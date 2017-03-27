
//--------------------------------------
// Jnilla Anchor v0.0.1
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		$(document).on('click', '.jn-anchor', function(event){
			event.preventDefault();
			
			// Init
			var el = $(this);
			var anchor = el.attr('href');
			if(!$(anchor).length) return;
			var duration = el.data('duration');
			if (duration == null) duration = 500;
			var easing = el.data('easing');
			if (easing == null) easing = 'swing';
			var top = $(anchor).offset().top;
			
			// Transition
			$('html, body').animate({
				scrollTop: top
			}, duration, easing);
		});
		
	});
})(jQuery);



