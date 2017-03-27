//--------------------------------------
// Jnilla Video v0.0.1
//--------------------------------------
(function($){
	$(document).ready(function(){
		
		// Init
		var videos = $('.jn-video video');
		
		// Prepare video
		videos.removeProp('controls');
		
		// Prepare controls
		videos.parent().find('.jn-video-play').addClass('active');
		videos.parent().find('.jn-video-seekbar .bar').html('');
		
		// Video events
		videos.on('play', function(){
			$(this).parent().find('.jn-video-play').removeClass('active')
			$(this).parent().find('.jn-video-pause').addClass('active');
		});
		
		videos.on('pause', function(){
			$(this).parent().find('.jn-video-play').addClass('active')
			$(this).parent().find('.jn-video-pause').removeClass('active');
		});
		
		// -------------------------
		// Events
		// -------------------------
		
		// Video click
		$('.jn-video video').on('click', function(){
			var video = $(this)[0];
			if(video.paused){
				video.play();
			}else{
				video.pause();
			}
			console.log(video);
		});
		// Video play
		$('.jn-video .jn-video-play').on('click', function(){
			var video = $(this).parent().find('video')[0];
			video.play();
		});
		// Video pause
		$('.jn-video .jn-video-pause').on('click', function(){
			var video = $(this).parent().find('video')[0];
			video.pause();
		});
		// Video timeupdate
		$('.jn-video video').on('timeupdate', function(){
			var video = $(this).parent().find('video')[0];
			var percentage = (100 / video.duration) * video.currentTime;
			percentage = Math.round(percentage * 100) / 100
			updateProgress($(this).parent().find('.jn-video-seekbar'), percentage);
		});
		// Seekbar click
		$('.jn-video .jn-video-seekbar').on('click', function(e){
			var video = $(this).parent().find('video')[0];
			var left = e.pageX - $(this).offset().left;
			var width = $(this).width()
			var percentage = left * 100 / width;
			percentage = Math.round(percentage * 100) / 100;
			var time = video.duration*percentage/100;
			console.log(width, left, percentage, video.duration, time);
			video.currentTime = time;
		});
		
		// -------------------------
		// Functions
		// -------------------------
		
		function updateProgress(bar, value){
			if(!bar.length) return;
			bar.find('.bar').css('width', value+'%');
		}
		
	});
})(jQuery);



