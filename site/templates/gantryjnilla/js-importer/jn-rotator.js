//jn-rotator version 0.0.1

(function($){
	$(document).ready(function(){
		if(!$('.jn-rotator').length) return;
		
		var fitCount = 0;
		var rotatorWidth = 0;
		var itemWidth = 0;
		var queue = [];
		var left = 0;
		var flag = false;
		var xOffset = 0;
		var items;
		var itemsCount = 0;
		var cloningCount = 0;
		var interval = 0;
		var intervalCount = 0;
		
		// ---------------------------------------------
		// events
		// ---------------------------------------------
		
		// timer
		var timer = setInterval(function() {
			$('.jn-rotator').each(function(){
				interval = parseInt($(this).data('interval'));
				intervalCount = parseInt($(this).data('intervalCount'));
				if(isNaN(interval)) {
					interval = 2;
					$(this).data('interval', interval);
				}
				if(isNaN(intervalCount)) {
					intervalCount = 0;
				}
				if(intervalCount >= interval) {
					arrangeItems($(this));
					intervalCount = 0;
				}
				intervalCount++;
				$(this).data('intervalCount', intervalCount);
			});
		}, 1000);

		// resize
		$(window).resize(function() {
			$('.jn-rotator').each(function(){
				arrangeItems($(this), true);
			});
		}).resize();
		$(window).trigger('resize');
		
		
		// ---------------------------------------------
		// Arrange items
		// ---------------------------------------------
		function arrangeItems(jnRotator, arrangeOnly){
			items = jnRotator.find('.jn-rotator-item');
			
			// calc fit count
			rotatorWidth = jnRotator.width();
			itemWidth = items.width();
			fitCount = Math.floor(rotatorWidth/itemWidth);
			
			// prepare items
			itemsCount = (jnRotator.data('itemsCount'));
			queue = (jnRotator.data('queue'));
			if(itemsCount-2 < fitCount){
				// clone items as much as needed
				cloningCount = Math.ceil((fitCount/itemsCount))+1;
				for(var i=1; i<cloningCount; i++){
					items
						.clone()
						.css('left', rotatorWidth)
						.appendTo(jnRotator);
				}
				items = jnRotator.find('.jn-rotator-item');
			}
			
			// update states
			if(items.length != itemsCount){
				// update items count
				itemsCount = items.length;
				jnRotator.data('itemsCount', itemsCount);
				
				// update queue
				queue = [];
				for(var i=0; i<items.length; i++){
					queue.push(i);
				}
				jnRotator.data('queue', queue);
			}
			
			// calc offset
			xOffset = (rotatorWidth-(itemWidth*fitCount))/2;
			if(xOffset < 0) {
				xOffset = 0;
			}
			
			if(!arrangeOnly){
				// deactivate and arrange first item
				items.eq(queue[0])
					.removeClass('active')
					.css('left', -itemWidth);
				// rotate queue backwards
				queue.push(queue.shift()); 
			}
			
			// activate and arrange items
			left = 0;
			for(var i=0; i<fitCount; i++){
				items.eq(queue[i])
					.addClass('active')
					.css('left', left+xOffset)
					.css('z-index', fitCount-i);
				left = left+itemWidth;
			}
			
			// arrange the rest
			for(i=fitCount; i<items.length-1; i++){
				items.eq(queue[i]).css('left', rotatorWidth);
			}
		}
		
	});	
})(jQuery);