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

use JEventDispatcher;
use Joomla\Registry\Registry;
use JPluginHelper;
use JText;
use RegularLabs\Library\Document as RL_Document;
use RegularLabs\Library\Html as RL_Html;
use RegularLabs\Library\Protect as RL_Protect;
use RegularLabs\Library\RegEx as RL_RegEx;
use RegularLabs\Library\StringHelper as RL_String;

class Replace
{
	static $message = '';

	public static function replaceTags(&$string, $area = 'article', $context = '', $article = null)
	{
		Article::set($article);

		if (!is_string($string) || $string == '')
		{
			return false;
		}

		if (!RL_String::contains($string, Params::getTags(true)))
		{
			return false;
		}

		$params = Params::get();

		self::$message = '';


		// allow in component?
		if (RL_Protect::isRestrictedComponent(isset($params->disabled_components) ? $params->disabled_components : [], $area))
		{

			self::$message = JText::_('AA_OUTPUT_REMOVED_NOT_ENABLED');

			Protect::_($string);
		}

		Protect::_($string);

		switch ($area)
		{
			case 'article':
				$replace = self::prepareStringForArticles($string, $context);
				continue;
			case 'component':
				$replace = self::prepareStringForComponent($string);
				continue;
			default:
			case 'body':
				$replace = self::prepareStringForBody($string);
				continue;
		}

		if ($replace)
		{
			self::process($string);
		}

		RL_Protect::unprotect($string);

		return true;
	}

	private static function prepareStringForArticles(&$string, $context = '')
	{
		$params = Params::get();

		if (strpos($context, 'com_search.') === 0)
		{
			$limit = explode('.', $context, 2);
			$limit = (int) array_pop($limit);

			$string_check = substr($string, 0, $limit);

			if (!RL_String::contains($string_check, Params::getTags(true)))
			{
				return false;
			}
		}


		return true;
	}

	private static function prepareStringForComponent(&$string)
	{

		if (RL_Document::isFeed())
		{
			$s      = '(<item[^>]*>)';
			$string = RL_RegEx::replace($s, '\1<!-- START: AA_COMPONENT -->', $string);
			$string = str_replace('</item>', '<!-- END: AA_COMPONENT --></item>', $string);
		}

		if (strpos($string, '<!-- START: AA_COMPONENT -->') === false)
		{
			Area::tag($string, 'component');
		}

		$components = Area::get($string, 'component');

		foreach ($components as $component)
		{
			if (strpos($string, $component['0']) === false)
			{
				continue;
			}

			self::process($component['1']);
			$string = str_replace($component['0'], $component['1'], $string);
		}

		return false;
	}

	private static function prepareStringForBody(&$string)
	{

		return true;
	}

	public static function process(&$string)
	{
		list($start_tags, $end_tags) = Params::getTags();

		list($pre_string, $string, $post_string) = RL_Html::getContentContainingSearches(
			$string,
			$start_tags,
			$end_tags
		);

		if ($string == '' || !RL_String::contains($string, Params::getTags(true)))
		{
			$string = $pre_string . $string . $post_string;

			return;
		}

		$regex = Params::getRegex();

		if (!RL_RegEx::match($regex, $string))
		{
			$string = $pre_string . $string . $post_string;

			return;
		}

		$matches   = [];
		$break     = 0;
		$max_loops = 10;

		while (
			$break++ < $max_loops
			&& RL_String::contains($string, Params::getTags(true))
			&& RL_RegEx::matchAll($regex, $string, $matches)
		)
		{
			self::cleanMatches($matches);

			$items = Items::get($matches, self::$message);

			self::processMatch($string, $items);

			$matches = [];
		}

		$string = $pre_string . $string . $post_string;
	}

	private static function cleanMatches(&$matches)
	{
		foreach ($matches as &$match)
		{
			foreach ($match as $k => $v)
			{
				if ($k && is_numeric($k))
				{
					unset($match[$k]);
				}
			}
		}
	}

	private static function processMatch(&$string, $items)
	{
		foreach ($items as $item)
		{
			self::processData($string, $item);
		}
	}

	private static function processData(&$string, $item)
	{
		$output = self::getOutputHtml($item);

		$string = RL_String::replaceOnce($item->original_string, $output, $string);
	}

	private static function triggerContentPlugins($string)
	{
		$item          = Article::get();
		$item->text    = $string;
		$item->slug    = '';
		$item->catslug = '';

		$article_params = new Registry;
		$article_params->loadArray(['inline' => false]);

		$dispatcher = JEventDispatcher::getInstance();
		JPluginHelper::importPlugin('content');

		$dispatcher->trigger('onContentPrepare', ['com_content.article', &$item, &$article_params, 0]);

		return $item->text;
	}

	private static function getOutputHtml($item)
	{
		$params = Params::get();

		$html = implode('', $item->output);

		if ($params->force_content_triggers && strpos($html, '<!-- AA:CT -->') === false)
		{
			$html = self::triggerContentPlugins($html);
		}

		$html = str_replace('<!-- AA:CT -->', '', $html);

		$fix_html = isset($item->sets['0']->fixhtml) ? $item->sets['0']->fixhtml : $params->fix_html_syntax;

		if (empty($html) || !$fix_html)
		{
			return
				$item->opening_tags_main
				. $html
				. $item->closing_tags_main;
		}

		if (empty($item->opening_tags_main) || empty($item->closing_tags_main))
		{
			return
				$item->opening_tags_main
				. self::fixBrokenHtmlTags($html)
				. $item->closing_tags_main;
		}

		return self::fixBrokenHtmlTags(
			$item->opening_tags_main
			. $html
			. $item->closing_tags_main
		);
	}

	private static function fixBrokenHtmlTags($string)
	{
		$params = Params::get();

		$string = RL_Html::fix($string);

		if (!$params->place_comments)
		{
			return $string;
		}

		return Protect::wrapInCommentTags($string);
	}
}
