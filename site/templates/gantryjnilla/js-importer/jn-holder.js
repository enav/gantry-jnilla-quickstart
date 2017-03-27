/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */

//--------------------------------------
// jn-holder v0.1.0
//--------------------------------------
(function($)
{
	$.fn.jn_holder = function() {
		// holders
		var box = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAPoAQMAAAEAanYxAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB98MBQYGOz5OK3kAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAk0lEQVR42u3BAQ0AAADCoPdPbQ43oAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAODIAPKYAAEZWDw9AAAAAElFTkSuQmCC";
		var tv = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAALuAQMAAAFwRJ6YAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB98MBQYGLcqanigAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAcUlEQVR42u3BAQEAAACAkP6v7ggKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAYdfcAATFnYvIAAAAASUVORK5CYII=";
		var wide = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAIzAQMAAAHe5JFpAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB98MBQYFGLcECcgAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAXElEQVR42u3BMQEAAADCoPVPbQwfoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOBuGL4AAdpWCJkAAAAASUVORK5CYII=";
		var cinema = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAGtAQMAAAHIYPzHAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB98MBQcQJdkbyfoAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAATElEQVR42u3BMQEAAADCoPVPbQdvoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAXgPV4gABVUxt5QAAAABJRU5ErkJggg==";
		// process
		return this.each(function() {
			if($(this).attr('data-holder') == 'done') return true;
			$(this).attr('data-holder','done');
			var src = $(this).attr('src');
			var ratio = $(this).data('ratio');
			if(ratio) $(this).css('background-image', "url('"+src+"')");
			switch (ratio) {
				case 'box':
				case '1:1':
					$(this).attr('src',box);
					break;
				case 'tv':
				case '4:3':
					$(this).attr('src',tv);
					break;
				case 'wide':
				case '16:9':
					$(this).attr('src',wide);
					break;
				case 'cinema':
				case '21:9':
					$(this).attr('src',cinema);
					break;
			}
		});
	}

	$(document).ready(function()
	{
		$('.jn-holder').jn_holder();
	});
})(jQuery);
