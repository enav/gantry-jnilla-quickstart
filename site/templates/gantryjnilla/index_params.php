<?php
/**
 * @copyright   Copyright (C) 2015 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined ( '_JEXEC' ) or die ();
// init
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$templateParams = $app->getTemplate(true)->params;
$menuParams = $app->getMenu()->getActive()->params;
if($menuParams) $bodyClass = htmlspecialchars($menuParams->get('body_class'));
$this->language = $doc->language;
$this->direction = $doc->direction;

// request vars
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');

// body class
$bodyClases = $option
. ' view-' . $view
. ($layout ? ' layout-' . $layout : ' no-layout')
. ($task ? ' task-' . $task : ' no-task')
. ($itemid ? ' itemid-' . $itemid : '')
. (" $bodyClass");


