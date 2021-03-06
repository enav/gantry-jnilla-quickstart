<?php
/**
 * @copyright   Copyright (C) 2014 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */



defined('_JEXEC') or die;
require_once __DIR__ . '/helper.php';
jimport ( 'joomla.filesystem.folder' );
jimport ( 'joomla.filesystem.file' );

/**
 * Main plugin class.
 *
 */
class plgSystemJnilla extends JPlugin {

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
		if($app->isAdmin()) return false;
		$template = $app->getTemplate();
		$doc = JFactory::getDocument();

		// update global var
		global $jnilla;
		$jnilla = new stdClass();
		$jnilla->development = $this->params->get("development_mode", '0');
		$jnilla->uniqid = uniqid();

		// TODO make this line plugin config optin
		JHtml::_('bootstrap.framework');

		if($jnilla->development){
			plgSystemJnillaHelper::updateLessImporters();
			plgSystemJnillaHelper::compileJsImporter();
		}

		// TODO make this line plugin config optin
		if($jnilla->development){
			$uniqid = "?uniqid=".$jnilla->uniqid;
		}
		$doc->addScript("templates/$template/js-importer/jn-compiled.js$uniqid");

		// System message testing
		if($this->params->get("test_system_messages", "0") === "1")
		{
			$app->enqueueMessage("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "error");
			$app->enqueueMessage("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "message");
			$app->enqueueMessage("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "notice");
			$app->enqueueMessage("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "warning");
		}
	}
}



