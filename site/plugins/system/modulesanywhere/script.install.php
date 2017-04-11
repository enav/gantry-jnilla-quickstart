<?php
/**
 * @package         Modules Anywhere
 * @version         7.2.0
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2017 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/script.install.helper.php';

class PlgSystemModulesAnywhereInstallerScript extends PlgSystemModulesAnywhereInstallerScriptHelper
{
	public $name           = 'MODULES_ANYWHERE';
	public $alias          = 'modulesanywhere';
	public $extension_type = 'plugin';

	public function uninstall($adapter)
	{
		$this->uninstallPlugin($this->extname, 'editors-xtd');
	}

	public function onBeforeInstall($route)
	{
		$installed_version = $this->getVersion($this->getInstalledXMLFile());

		if (version_compare($installed_version, 7, '<'))
		{
			JFactory::getApplication()->enqueueMessage(
				'Modules Anywhere no longer supports the <code>{div}</code> tags.<br>'
				. 'If you are using these, you will need to replace them with normal html <code>&lt;div&gt;</code> tags.<br><br>'
				. 'If you still need this functionality, you will need to downgrade to Modules Anywhere v6.0.6.'
				, 'warning'
			);
		}
	}
}
