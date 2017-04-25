//--------------------------------------
// Jnilla Window Height v1.0.0
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		if(!$('.jn-window-height').length) return;
		
		
		// -------------------------
		// Events
		// -------------------------
		$(window).resize(function(){
			$('.jn-window-height').height($(window).height());
		});
		$(window).trigger('resize');
		
		
	});
})(jQuery);




