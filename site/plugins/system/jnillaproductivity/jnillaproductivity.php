<?php defined('_JEXEC') or die;
/**
 * @copyright   Copyright (C) 2014 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */



defined('JPATH_BASE') or die;

/**
 * Main plugin class.
 *
 */
class plgSystemJnillaProductivity extends JPlugin {

	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 */
	public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
	}

	public function onAfterInitialise() {
		$app = JFactory::getApplication();
		if(!$app->isAdmin()) return false;
		$template = $app->getTemplate();
		if($template != "isis") return false;
		JHtml::_('bootstrap.framework');
		JHtmlFormbehavior::chosen();
		JHtml::_('script', 'media/plg_system_jnillaproductivity/js/behavior.js', false);
		JHtml::stylesheet('media/plg_system_jnillaproductivity/css/styles.css');
	}
}






