//--------------------------------------
// to top button behavior
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		var toTop = $('<div title="Go to Top" class="to-top btn btn-inverse"><span class="icon-chevron-up"></span> </div>').prependTo('body');
		toTop.click(function(){
			$('html, body').animate({
				scrollTop: $("body").offset().top
			}, 500);
		});
	});
	
})(jQuery);