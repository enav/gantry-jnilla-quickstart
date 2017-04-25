//jn-parallax-bg version 0.0.2

(function($) {
	$(document).ready(function() {
		var els = $('.jn-parallax');
		if (!els.length) return;

		var el, elH, winH, top, offset;
		$(window).scroll(function() {
			winH = $(window).height();
			els.each(function() {
				el = $(this);
				elH = el.height();
				top = $(window).scrollTop() - el.offset().top;
				offset = top + winH;
				if(offset < 0){
					offset = 0;
				} else if(offset > (elH+winH)){
					offset = elH+winH;
				}
				//offset = offset * 100 / (elH+windowH);
				if(el.hasClass('jn-parallax-inverse')){
					offset = 100-(offset*100/(elH+winH));
				}else{
					offset = offset*100/(elH+winH);
				}
				
				el.css('background-position-y', offset+'%');
			});
		});
		$(window).trigger('scroll');

	});
})(jQuery);


