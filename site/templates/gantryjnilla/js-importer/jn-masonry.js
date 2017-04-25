//--------------------------------------
// Jnilla  Masonry v1.0.0
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		if(!$('.jn-masonry').length) return;
		
		
		// -------------------------
		// Init
		// -------------------------
		
		// prepare mansonrys
		$('.jn-masonry').append($('<div class="clearfix"></div>'));
		
		// first run
		updateMasonry();
		
		
		// -------------------------
		// Events
		// -------------------------
		
		// window resize
		$(window).resize(function(){
			updateMasonry();
		});
		
		
		// -------------------------
		// Functions
		// -------------------------
		
		// update masonry
		function updateMasonry(){
			$('.jn-masonry').each(function(){
				var items = $(this).find('.jn-masonry-item');
				if (!items.length) return true;
				var desktopCols = $(this).data('desktop-cols');
				if(!desktopCols) desktopCols = 2;
				var tabletCols = $(this).data('tablet-cols');
				if(!tabletCols) tabletCols = 4;
				var mobileCols = $(this).data('mobile-cols');
				if(!mobileCols) mobileCols = 4;
				var desktopHeight = $(this).data('desktop-height');
				if(!desktopHeight) desktopHeight = 200;
				var tabletHeight = $(this).data('tablet-height');
				if(!tabletHeight) tabletHeight = 150;
				var mobileHeight = $(this).data('mobile-height');
				if(!mobileHeight) mobileHeight = 100;
				var windowWidth = $(window).width();
				var masonryWidth = $(this).width();
				var n1 = 0;
				var n2 = 0;
				var rowItems = [];
				var rowHeight = [];
				var rowWidth = 0;
				var rowCols = 0;
				var itemWidth = 0;
				
				// define value by device size
				if(windowWidth >= 980){
					rowCols = desktopCols;
					rowHeight = desktopHeight;
				}else if((windowWidth >= 768) && (windowWidth <= 979)){
					rowCols = tabletCols;
					rowHeight = tabletHeight;
				}else if(windowWidth <= 767){
					rowCols = mobileCols;
					rowHeight = mobileHeight;
				}
				
				items.each(function(){
					// calc row width
					itemWidth = $(this).data('width');
					rowWidth = rowWidth+itemWidth;
					rowItems.push(this);
					n1++;
					n2++;
					if((n1 > rowCols-1) || (n2 > items.length-1)){
						// transform width in pixel to relative
						$(rowItems).each(function(){
							itemWidth = $(this).data('width');
							itemWidth = itemWidth*100/rowWidth;
							$(this).css({
								'width': itemWidth+'%',
								'height': rowHeight,
							});
						});
						// make sure to use available masonry width
						rowWidth = 0;
						$(rowItems).each(function(){
							rowWidth = rowWidth+$(this).width();
						});
						// reset
						n1 = 0;
						rowItems = [];
						rowWidth = 0;
					}
				});
				
				
			});
		}
		
	});
})(jQuery);




