//--------------------------------------
// responsive videos
//--------------------------------------
(function($) 
{
	$(document).ready(function()
	{
		var els = $("iframe[src*='vimeo'], iframe[src*='youtube']");
		if(!els.length) return;
		
		els.each(function() {
			$(this)
				.data({
					'width':$(this).width(),
					'height':$(this).height(),
					'ratio':($(this).height() / $(this).width())
				})
				.removeAttr('height')
				.removeAttr('width');
		});
		$(window).resize(function() {
			els.each(function() {
				var pw = $(this).parent().width();
				if(pw < $(this).data('width')) {
					if($(this).width() != pw)
					{
						$(this)
							.width(pw)
							.height(pw * $(this).data('ratio'));
					}
				}
				else
				{
					if($(this).width() != $(this).data('width'))
					{
						$(this)
							.width($(this).data('width'))
							.height($(this).data('height'));
					}
				}
			});
		}).resize();
		$(window).trigger('resize');
	});
})(jQuery);