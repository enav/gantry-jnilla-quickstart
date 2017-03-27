/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */

//--------------------------------------
// Jnilla Productivity v0.0.1
//--------------------------------------


//--------------------------------------
// Tweak chosen params
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		$('select').chosen({
			search_contains:true,
			disable_search_threshold:0
		});
	});
})(jQuery);


//--------------------------------------
// Add productivity feature on menu item type selection
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		var target = $('#collapseTypes');
		if(!target.length) return;
		
		// collect data
		var items = target.find('.choose_type');
		
		// init control
		var jnActions = $('<select id="jn-productivity-menu-item-types" data-placeholder="Jnilla Productivity..."></select>');
		var option = $('<option></option>');
		jnActions.append(option.clone()); 
		
		// create select and store data
		items.each(function(){
			var newOption = option.clone();
			// remove nested items and fetch text
			var text =  $(this)
				.clone()
				.children()
				.remove()
				.end()
				.text()
				.trim();
			if(text === '') return;
			newOption
				.text(text)
				.data('item', $(this));
			jnActions.append(newOption);
		});
		jnActions.insertBefore(target);
		
		// enable chosen plugin on select
		jnActions.chosen({
			search_contains:true,
			disable_search_threshold:0
		});
		
		// events
		jnActions.chosen().change(function(){
			$(this).find('option:selected').data('item')[0].onclick();
		});
	});
})(jQuery);


//--------------------------------------
//Add productivity feature on module type selection
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		var target = $('#new-modules-list');
		if(!target.length) return;
		// collect data
		var items = target.find('a');
		
		// init control
		var jnActions = $('<select id="jn-productivity-module-types" data-placeholder="Jnilla Productivity..."></select>');
		var option = $('<option></option>');
		jnActions.append(option.clone());
		
		// create select and store data
		items.each(function(){
			var newOption = option.clone();
			// remove nested items and fetch text
			var text =  $(this)
				.text()
				.trim();
			if(text === '') return;
			newOption
				.text(text)
				.data('href', $(this).attr('href'));
			jnActions.append(newOption);
		});
		jnActions.insertBefore(target);
		
		// enable chosen plugin on select
		jnActions.chosen({
			search_contains:true,
			disable_search_threshold:0
		});
		
		// events
		jnActions.chosen().change(function(){
			window.location.href = $(this).find('option:selected').data('href');
		});
	});
})(jQuery);


//--------------------------------------
// Add productivity feature on main menu
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		var target = $('#menu');
		if(!target.length) return;
		if(target.hasClass('disabled')) return;
		
		// collect data
		var items = target.find('a:not([href="#"])')
		
		// init control
		var jnActions = $('<select id="jn-productivity-main-menu" data-placeholder="Jnilla Productivity..."></select>');
		var option = $('<option></option>');
		jnActions.append(option.clone());
		
		// create select and store data
		items.each(function(){
			var newOption = option.clone();
			// remove nested items and fetch text
			var text =  $(this)
				.text()
				.trim();
			if(text === '') return;
			newOption
				.text(text)
				.data('href', $(this).attr('href'));
			jnActions.append(newOption);
		});
		jnActions.insertBefore(target);
		
		// enable chosen plugin on select
		jnActions.chosen({
			search_contains:true,
			disable_search_threshold:0,
			width: "150"
		});
		
		// events
		jnActions.chosen().change(function(){
			window.location.href = $(this).find('option:selected').data('href');
		});
	});
})(jQuery);
