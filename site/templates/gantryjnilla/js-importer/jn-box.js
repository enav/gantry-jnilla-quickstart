//jn-box version 0.0.3

(function($)
{
	$(document).ready(function()
	{
		if(!$('.jn-box').length) return;
		// init jn-box
		var addClass;
		var target;
		var jnBox = $('<div id="jn-box" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><div class="modal-body"></div></div>');
		jnBox.modal('hide');
		var modalBody = jnBox.find('.modal-body').eq(0);
		var loadingHtml = '<div style="width: 50%; margin: 30px auto;" class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>';
		modalBody.html(loadingHtml);
		
		// events
		$('.jn-box').click(function(event){
			event.preventDefault();
			// is a link
			if($(this).prop("tagName") == "A") {
				var href = $(this).attr('href');
				// url is an image
				if(/\.(?:jpg|jpeg|gif|png|svg)$/i.test(href)){
					var img = $('<img class="jn-box-img"/>');
					img.attr('src', href);
					img.on('load', function(){
						modalBody.find('*').remove();
						modalBody.append(img);
					});
					jnBox.modal('show');
				}else{
					// url is not an image
					var selector = $(this).data('selector');
					if(addClass!=null && target==null)jnBox.removeClass(addClass);
					if(addClass!=null && target!=null)$(target).removeClass(addClass);
					if(target!=null)$(target).find('*').remove();
					target = $(this).data('target');
					addClass = $(this).data('class');
					//if not desire modal
					if(target!=null){
						$(target).addClass('active');
						$(target).html(loadingHtml).load(href+' '+selector, function(response, status, xhr ){
							if ( status == "error" ) {
								modalBody.html('<p class="lead">Error (�_�)</p>');
							}
						});
						$(target).addClass(addClass);
					}else{
						//if desire modal
						modalBody.load(href+' '+selector, function(response, status, xhr ){
							if ( status == "error" ) {
								modalBody.html('<p class="lead">Error (�_�)</p>');
							}
						});
						jnBox.addClass(addClass);
						jnBox.modal('show');
					}
				}
			}else if($(this).prop("tagName") == "IMG") {
				var src = $(this).attr('src');
				modalBody.html('<img class="jn-box-img" src="'+src+'"/>');
				jnBox.modal('show');
			}
		});
		
		jnBox.on('show', function(event){
			modalBody.find('.jn-box-img').unbind('load');
			var scroll = $(document).scrollTop();
			jnBox.css('top', scroll+20);
		});
		
		jnBox.on('hidden', function(event){
			modalBody.html(loadingHtml);
			jnBox.css('top', 'auto');
			$('.jn-box-img').unbind('load');
		});
		
	});
	
})(jQuery);