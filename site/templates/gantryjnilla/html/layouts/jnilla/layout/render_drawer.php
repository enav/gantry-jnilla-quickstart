<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */

defined('JPATH_BASE') or die;
$doc = JDocumentHtml::getInstance();
?>
<?php if ($doc->countModules('jn-drawer-left')) : ?>
	<div class="jn-drawer jn-drawer-left">
		<jdoc:include type="modules" name="jn-drawer-left" style="standard" />
	</div>
<?php endif; ?>
<?php if ($doc->countModules('jn-drawer-right')) : ?>
	<div class="jn-drawer jn-drawer-right">
		<jdoc:include type="modules" name="jn-drawer-right" style="standard" />
	</div>
<?php endif; ?>

