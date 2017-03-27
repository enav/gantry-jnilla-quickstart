/**
 * @copyright	 Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license	 GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

(function($)
{
	$(document).ready(function()
	{
		// init
		var baseUrl = $('body').data('baseurl');
		$('body').addClass('jn-hud-hide');
		if($.cookie('jnhudtoggle') === "1") toggleHud();
		
		// append layout labels
		$('.jn-group-row').each(function() {
			$(this).prepend($('<span class="jn-hud jn-hud-group-row-label label label-success">'+$(this).attr('id')+'</span>'));
		});
		$('<span class="jn-hud jn-hud-group-row-label label label-success">component-content</span>').insertBefore($('.component-content'));
		
		// append menu edit buttons
		$('.menu .item').each(function() {
			var itemId = $(this).parent().data('itemid');
			$(this).prepend($('<a class="jn-hud jn-hud-menu-item btn btn-danger btn-mini icon-edit" title="Edit Menu Item" target="_blank" href="'+baseUrl+'administrator/index.php?option=com_menus&task=item.edit&id='+itemId+'"></a>'));
		});
		
		// compose mod hud control
		var hudControl = $('<div class="btn-group"></div>');
		hudControl.append($('<a class="btn btn-inverse btn-mini action"></a>'));
		hudControl.append($('<button class="btn btn-danger btn-mini dropdown-toggle" data-toggle="dropdown" title="More Options"><span class="caret"></span></button>'));
		hudControl.append($('<ul class="dropdown-menu"></ul>'));
		
		// append main HUD widget
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
		
		// migrate mod hud data to memory and append mod hud controls
		$('.jn-hud-mod-data').each(function() {
			$(this).parent().data($(this).data());
			var jnHudMod = hudControl.clone();
			jnHudMod.addClass('jn-hud jn-hud-mod');
			jnHudMod.find('.action')
				.attr('href', $(this).data('editurlbackend'))
				.attr('target', '_blank')
				.attr('title', 'Block Class (Click to Edit Module)');
			var bClass = $(this).data('blockclass').split(/\s/);
			bClass = bClass[0];
			if(bClass){
				jnHudMod.find('.action').text(bClass);
			}
			else {
				jnHudMod.find('.action').text('- - -');
			}
			var node = jnHudMod.find('.dropdown-menu');
			node.append($('<li><a href="'+$(this).data('editurlbackend')+'" target="_blank"><span class="icon-edit"></span> Edit Module <small>Backend</small></a></li>'));
			node.append($('<li><a href="'+$(this).data('editurlfrontend')+'" target="_self"><span class="icon-edit"></span> Edit Module <small>Frontend</small></a></li>'));
			node.append($('<li class="divider"></li>'));
			node.append($('<li><a><strong>Title</strong> = '+$(this).data('title')+'</a></li>'));
			node.append($('<li><a><strong>Position</strong> = '+$(this).data('position')+'</a></li>'));
			node.append($('<li><a><strong>Block Class</strong> = '+$(this).data('blockclass')+'</a></li>'));
			node.append($('<li><a><strong>Class Suffix</strong> = '+$(this).data('moduleclass_sfx')+'</a></li>'));
			node.append($('<li class="divider"></li>'));
			node.append($('<li><a><strong>Module</strong> = '+$(this).data('module')+'</a></li>'));
			node.append($('<li><a><strong>Style</strong> = '+$(this).data('style')+'</a></li>'));
			node.append($('<li><a><strong>Show Title</strong> = '+$(this).data('showtitle')+'</a></li>'));
			node.append($('<li><a><strong>Id</strong> = '+$(this).data('id')+'</a></li>'));
			
			$(this).parent().prepend(jnHudMod);
			$(this).remove();
		});
		
		// window resize event
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
		
		// show Jnilla HUD
		jnHudMain.find('.action').click(function() {
			toggleHud();
			toggleHudCookie()
		});
		
		// show Jnilla HUD
		$( document ).keypress(function( keyCode ) {
			if ((keyCode.keyCode == 10 || keyCode.keyCode == 13) && keyCode.ctrlKey) {
				toggleHud();
				toggleHudCookie()
			}
		});
		
		// compile LESS
		jnHudMain.find('.compile-less').click(function() {
			compileLESSandReloadCSS();
		});
		$( document ).keypress(function( keyCode ) {
			if ((keyCode.keyCode == 10 || keyCode.keyCode == 13) && keyCode.shiftKey) {
				compileLESSandReloadCSS();
			}
		});
		function compileLESSandReloadCSS(){
			var el = $('head link[href*="css-compiled"]');
			if (el.data('working') === true) {
				 return;
			}
			el.data('working', true);
			if(!el.data('href')) el.data('href', el.attr('href'))
			var href = el.data('href');
			var href2 = href + "?time=" + new Date().getTime();;
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
		
		// toggle hud
		function toggleHud(){
			$('body')
				.toggleClass('jn-hud-hide')
				.toggleClass('jn-hud-layout-wires');
		}
		// toggle hud cookie
		function toggleHudCookie(){
			if ($.cookie('jnhudtoggle') === "0")
			{
				$.cookie('jnhudtoggle', '1');
			}else
			{
				$.cookie('jnhudtoggle', '0');
			}
		}
		
		// append headings index label
		$(':header').each(function() {
			var str = $(this).prop("tagName");
			$(this).prepend($('<span class="jn-hud badge badge-success">'+str+'</span>'));
		});
	});
})(jQuery);





