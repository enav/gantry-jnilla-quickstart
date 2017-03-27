<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */

// JLayout to add Jnilla HUD data for modules and resources to the page:
defined ( '_JEXEC' ) or die ();

// init
$moduleHtml = & $displayData ['moduleHtml'];

// module has already HUD data:
if (preg_match ( '/<input class="jn-hud-mod-data"/', $moduleHtml ))
	return;

$moduleHtml = & $displayData ['moduleHtml'];
$mod = $displayData ['module'];
$position = $displayData ['position'];
$menusEditing = $displayData ['menusediting'];
$parameters = JComponentHelper::getParams ( 'com_modules' );
$redirectUri = '&return=' . urlencode ( base64_encode ( JUri::getInstance ()->toString () ) );
$editUrlBackend = JUri::base () . 'administrator/index.php?option=com_modules&task=module.edit&id=' . ( int ) $mod->id;
$editUrlFrontend = JUri::base () . 'index.php?option=com_config&controller=config.display.modules&id=' . ( int ) $mod->id . $redirectUri;
$id = $mod->id;
$title = htmlspecialchars ( $mod->title );
$module= htmlspecialchars ( $mod->module );
$showtitle = $mod->showtitle;
$style = htmlspecialchars ( $mod->style );
$params = json_decode($mod->params);
$blockClass = htmlspecialchars($params->block_class);
$moduleClassSfx = htmlspecialchars($params->moduleclass_sfx);

$hudData = '>
	<input class="jn-hud-mod-data"
		type="hidden"
		data-id="' . $id . '"
		data-title="' . $title . '"
		data-module="' . $module . '"
		data-position="' . $position . '"
		data-showtitle="' . $showtitle . '"
		data-style="' . $style . '"
		data-editurlbackend="' . $editUrlBackend . '"
		data-editurlfrontend="' . $editUrlFrontend . '"
		data-moduleclass_sfx="' . $moduleClassSfx . '"
		data-blockclass="' . $blockClass . '"
	>';

// add hud data element
$moduleHtml = preg_replace('/>/', $hudData, $moduleHtml, 1);

// add resources
JHtml::_ ( 'stylesheet', 'system/frontediting.css', array (), true );
JHtml::_ ( 'script', 'system/frontediting.js', false, true );
