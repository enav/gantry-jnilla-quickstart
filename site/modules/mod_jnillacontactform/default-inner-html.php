<?php
/**
 * @copyright	 Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license		 GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die;
?>


<div class="control-group">
	<small class="icon-info-sign"> All fields with an * are required.</small>
</div>
<div class="control-group">
	<label for="{prefix}[name]">Name</label>
	<input type="text" id="{prefix}[name]"
		 name="{prefix}[name]" placeholder="Name">
	<input type="hidden" name="{prefix}-label[name]" value="Name">
</div>
<div class="control-group">
	<label for="{prefix}[email]">Email</label>
	<input type="email" id="{prefix}[email]"
		 name="{prefix}[email]" placeholder="Email"
		 class="validate-email">
	<input type="hidden" name="{prefix}-label[email]" value="Email">
</div>
<div class="control-group">
	<label for="{prefix}[message]">Message <span class="star">*</span></label>
	<textarea id="{prefix}[message]" name="{prefix}[message]"
		rows="5" placeholder="Message"></textarea>
	<input type="hidden" name="{prefix}-label[message]" value="Message">
</div>
<div class="control-group display-on-click">
	<label class="checkbox"> <input type="checkbox" name="{prefix}[copy]" value="1">Send me a copy</label>
</div>
<div class="control-group display-on-click">
	<label for="grecaptcha">reCaptcha <span class="star">*</span></label>
	<div id="{prefix}-g-recaptcha" class="g-recaptcha" data-sitekey="{site-key}" style="transform:scale(0.77);transform-origin:0 0"></div>
</div>
<div class="control-group display-on-click">
	<button class="btn btn-primary validate" type="submit">Send Form</button>
</div>




