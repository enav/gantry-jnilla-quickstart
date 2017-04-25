//--------------------------------------
// Jnilla Video Background v1.0.0
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		if(!$('.jn-video-background').length) return;
		
		
		// -------------------------
		// Init
		// -------------------------
		
		// check if device is mobile and execute fallback mode
		if($(window).width() <= 1024){
			$('.jn-video-background video').remove();
			
			$('.jn-video-background img').each(function(){
				var img = $(this);
				var fallback = img.data('fallback');
				if(fallback){
					img.css('background-image', "url('"+fallback+"')");
				}
			});
			
			return;
		}
		
		
		// -------------------------
		// Events
		// -------------------------
		$(window).resize(function(){
			arrangeVideo();
		});
		$(window).trigger('resize');
		
		// timer
		var timer = setInterval(function() {
			arrangeVideo();
		}, 500);
		
		
		
		// -------------------------
		// Functions
		// -------------------------
		
		// center video to container
		function arrangeVideo(){
			$('.jn-video-background').each(function(){
				var video = $(this).find('video').eq(0);
				var videoWidth = video[0].videoWidth;
				var videoHeight = video[0].videoHeight;
				var videoTop = 0;
				var videoLeft = 0;
				var holder = $(this).find('img').eq(0);
				var holderWidth = holder.width();
				var holderHeight = holder.height();
				
				// skip if video is not loaded
				if(videoWidth === 0) return true;
				
				// resize the vide to cover the holder
				if(bestCoverMode(videoWidth, videoHeight, holderWidth, holderHeight)){
					videoHeight = holderWidth*videoHeight/videoWidth;
					videoWidth = holderWidth;
				}else{
					videoWidth = holderHeight*videoWidth/videoHeight;
					videoHeight = holderHeight;
				}
				
				// make sure to cover the area and avoid rounding issues
				videoHeight = videoHeight+2;
				videoWidth = videoWidth+2;
				
				// center the video
				videoLeft = -(videoWidth-holderWidth)/2;
				videoTop = 0;//-(videoHeight-holderHeight)/2;
				
				// prevent unnessesary dom updates
				if(videoWidth === video.data('width') && 
					videoHeight === video.data('height')){
					return true;
				}
				video.data('width', videoWidth);
				video.data('height', videoHeight);
				
				// apply css
				video.css({
					'width': videoWidth,
					'height': videoHeight,
					'top': videoTop,
					'left': videoLeft,
					'opacity': 1,
				});
				
			});
		}
		
		// determine best cover mode, return true if landscape
		function bestCoverMode(w1, h1, w2, h2){
			h1 = w2*h1/w1;
			if(h1 >= h2){
				return true;
			}
			return false;
		}
		
		
	});
})(jQuery);




