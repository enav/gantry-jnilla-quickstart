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

namespace RegularLabs\ArticlesAnywhere;

defined('_JEXEC') or die;

class Article
{
	static $article = null;

	public static function get($key = null)
	{
		if (is_null($key))
		{
			return self::$article ?: (object) [];
		}

		return isset(self::$article->{$key}) ? self::$article->{$key} : null;
	}

	public static function set($article)
	{
		self::$article = $article;
	}

}
