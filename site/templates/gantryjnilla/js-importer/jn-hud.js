//--------------------------------------
// Jnilla HUD v1.0.0
//--------------------------------------
(function($){
	$(document).ready(function(){
		//--------------------------------------
		// init
		//--------------------------------------
		if(!$('body.development').length) return;
		
		var baseUrl = $('body').data('baseurl');
		$('body').addClass('jn-hud-hide');
		if(typeof $.cookie('jnhudtoggle') === 'undefined'){
			$.cookie('jnhudtoggle', '1');
		};
		if($.cookie('jnhudtoggle') === "1") toggleHud();
		
		// append index labels to heading elements
		$(':header').each(function() {
			var str = $(this).prop("tagName");
			$(this).append($('<span class="jn-hud text-error"> ['+str+']</span>'));
		});
		
		// append template section labels
		$('.jn-group-row').each(function() {
			$(this).prepend($('<span class="jn-hud jn-hud-group-row-label label label-important">'+$(this).attr('id')+'</span>'));
		});
		$('<span class="jn-hud jn-hud-group-row-label label label-important">component-content</span>').insertBefore($('.component-content'));
		
		// generate hud control
		var hudControl = $('<div class="btn-group"></div>');
		hudControl.append($('<a class="btn btn-inverse btn-mini action"></a>'));
		hudControl.append($('<button class="btn btn-danger btn-mini dropdown-toggle" data-toggle="dropdown" title="More Options"><span class="caret"></span></button>'));
		hudControl.append($('<ul class="dropdown-menu"></ul>'));
		
		// generate and append main HUD widget
		var jnHudMain = hudControl.clone();
		jnHudMain
			.attr('id', 'jn-hud-main')
			.addClass('dropup');
		jnHudMain.find('.action')
			.text( 'Loading...')
			.attr('title', 'Toggle Jnilla HUD (Ctrl+Enter)');
		jnHudMain.find('.dropdown-toggle .caret').attr('class', 'icon-cog');
		var node = jnHudMain.find('.dropdown-menu');
		node.append($('<li><a href="'+baseUrl+'administrator/index.php?option=com_config" target="_blank"><span class="icon-link"></span> Login <small>Backend</small></a></li>'));
		node.append($('<li><a href="component/users" target="_self"><span class="icon-link"></span> Login <small>Frontend</small></a></li>'));
		node.append($('<li><a class="compile-less"><span class="icon-refresh"></span> Compile LESS <small>(Shift+Enter)</small></a></li>'));
		$("body").append(jnHudMain);
		
		// migrate mod data to memory and append edit buttons
		$('.jn-hud-mod-data').each(function() {
			$(this).parent().data($(this).data());
			var jnHudMod = $('<a class="jn-hud jn-hud-mod btn btn-mini btn-danger"></a>');
			jnHudMod
				.attr('href', $(this).data('edit'))
				.attr('target', '_blank')
				.attr('title', 'Click to Edit ['+$(this).data('id')+']');
			var bClass = $(this).data('blockclass').split(/\s/);
			bClass = bClass[0];
			if(bClass){
				jnHudMod.text(bClass);
			}
			else {
				jnHudMod.text('- Edit -');
			}
			
			$(this).parent().prepend(jnHudMod);
			$(this).remove();
		});
		
		
		//--------------------------------------
		// events
		//--------------------------------------

		// window resize
		var tFlag = false;
		$(window).resize(function(){
			if(tFlag) return;
			tFlag = true;
			setTimeout(function (){
				var winW = $(window).width();
				var winH = $(window).height();
				jnHudMain.find('.action').text(winW+'x'+winH);
				tFlag = false;
			}, 500);
		});
		$(window).trigger('resize');
		
		// toggle hud action
		jnHudMain.find('.action').click(function() {
			toggleHud();
			toggleHudCookie()
		});
		
		// toggle hud action hotkey
		$( document ).keypress(function( keyCode ) {
			if ((keyCode.keyCode == 10 || keyCode.keyCode == 13) && keyCode.ctrlKey) {
				toggleHud();
				toggleHudCookie()
			}
		});
		
		// compile less acction
		jnHudMain.find('.compile-less').click(function() {
			compileLESSandReloadCSS();
		});
		
		// compile less action shortcut
		$( document ).keypress(function( keyCode ) {
			if ((keyCode.keyCode == 10 || keyCode.keyCode == 13) && keyCode.shiftKey) {
				compileLESSandReloadCSS();
			}
		});
		
		
		//--------------------------------------
		// functions
		//--------------------------------------
		
		// compile less and reload css
		function compileLESSandReloadCSS(){
			var el = $('head link[href*="css-compiled"]');
			if (el.data('working') === true) {
				 return;
			}
			el.data('working', true);
			if(!el.data('href')) el.data('href', el.attr('href'))
			var href = el.data('href');
			var href2 = href + "?time=" + new Date().getTime();
			console.log('Compile LESS - Begin');//debug
			jnHudMain
				.tooltip('destroy')
				.tooltip({title:'Compile LESS - Begin'})
				.tooltip('show');
			// compile
			$.get(document.location.origin+document.location.pathname)
				.done(function() {
					el.attr('href', href2);
					el.data('working', false);
					console.log('Compile LESS - Success');//debug
					jnHudMain
						.tooltip('destroy')
						.tooltip({title:'Compile LESS - Success'})
						.tooltip('show');
					
				})
				.fail(function() {
					el.data('working', false);
					console.log('Compile LESS - Fail');//debug
					jnHudMain
						.tooltip('destroy')
						.tooltip({title:'Compile LESS - Fail'})
						.tooltip('show');
				})
				.done(function() {
					setTimeout(function() {
						jnHudMain.tooltip('destroy')
					}, 2000);
				});
		}
		
		// toggle hud classes
		function toggleHud(){
			$('body')
				.toggleClass('jn-hud-hide')
				.toggleClass('jn-hud-layout-wires');
		}
		
		// toggle hud cookie state
		function toggleHudCookie(){
			if ($.cookie('jnhudtoggle') === "0" )
			{
				$.cookie('jnhudtoggle', '1');
			}else
			{
				$.cookie('jnhudtoggle', '0');
			}
		}
	});
})(jQuery);





