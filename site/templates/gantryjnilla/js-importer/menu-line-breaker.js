/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */

//--------------------------------------
// Menu line breaker
//--------------------------------------
(function($){
	$(document).ready(function(){
		$('.menu .item > span').each(function() {
			var str = $(this).text();
			if(str.indexOf('///') < 0) return;
			str = str.split('///');
			str = str.join('<br />');
			$(this).html(str);
		});
	});
})(jQuery);










