//--------------------------------------
// menu-dropdown touch screen support
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		$('.menu-dropdown li.parent').mouseenter(function() {
			var This = $(this);
			setTimeout(function() {
				This.addClass('open');
			}, 50);
		});
		$('.menu-dropdown li.parent').mouseleave(function() {
			var This = $(this);
			setTimeout(function() {
				This.removeClass('open');
			}, 50);
		});
		$('.menu-dropdown li.parent > a').click(function(event) {
			if(!$(this).parent().hasClass('open'))
			{
				event.preventDefault();
			}
		});
	});
})(jQuery);


