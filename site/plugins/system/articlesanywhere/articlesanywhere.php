<?php
/**
 * @package         Articles Anywhere
 * @version         6.0.3
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2017 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

if (!is_file(__DIR__ . '/vendor/autoload.php'))
{
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

use RegularLabs\ArticlesAnywhere\Plugin;

/**
 * Plugin that loads articles
 */
class PlgSystemArticlesAnywhere extends Plugin
{
	public $_alias       = 'articlesanywhere';
	public $_title       = 'ARTICLES_ANYWHERE';
	public $_lang_prefix = 'AA';

	public $_has_tags = true;
}
