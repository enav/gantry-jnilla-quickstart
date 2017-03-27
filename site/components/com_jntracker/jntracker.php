<?php
/**
 * @version    CVS: 0.0.1
 * @package    Com_Jntracker
 * @author     Jnilla.com <digitalcomputer2142@gmail.com>
 * @copyright  2016 Jnilla.com
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Jntracker', JPATH_COMPONENT);
JLoader::register('JntrackerController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Jntracker');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
