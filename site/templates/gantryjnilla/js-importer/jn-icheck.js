/**
 * @copyright	 Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license		 GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


//--------------------------------------
// Prepare elements for jn-icheck
//--------------------------------------
(function($)
{
	$(document).ready(function()
	{
		var els = $('input[type="checkbox"], input[type="radio"]');
		if (!els.length) return;
		els.parent().addClass('jn-icheck');
		els.iCheck({
			checkboxClass: 'jn-icheck-checkbox',
			radioClass: 'jn-icheck-radio',
		});
	});
})(jQuery);




