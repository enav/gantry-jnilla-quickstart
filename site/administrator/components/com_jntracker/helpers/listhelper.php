<?php

/**
 * @version    CVS: 0.0.1
 * @package    Com_Jntracker
 * @author     Jnilla.com <digitalcomputer2142@gmail.com>
 * @copyright  2016 Jnilla.com
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Jntracker Listhelper.
 *
 * @since  1.6
 */
abstract class JHtmlListhelper
{
	static function toggle($value = 0, $view, $field, $i)
	{
		$states = array(
			0 => array('icon-remove', JText::_('Toggle'), 'inactive btn-danger'),
			1 => array('icon-checkmark', JText::_('Toggle'), 'active btn-success')
		);

		$state  = \Joomla\Utilities\ArrayHelper::getValue($states, (int) $value, $states[0]);
		$text   = '<span aria-hidden="true" class="' . $state[0] . '"></span>';
		$html   = '<a href="#" class="btn btn-micro ' . $state[2] . '"';
		$html  .= 'onclick="return toggleField(\'cb'.$i.'\',\'' . $view . '.toggle\',\'' . $field . '\')" title="' . JText::_($state[1]) . '">' . $text . '</a>';

		return $html;
	}
}
