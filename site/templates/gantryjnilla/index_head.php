<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined ( '_JEXEC' ) or die ();
?>
<head>
	<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
		<meta name="viewport" content="width=960px">
	<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
		<meta name="viewport" content="width=1200px">
	<?php else : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php endif; ?>

	<?php
	// add resources
	JHtml::_('bootstrap.framework');
	$gantry->displayHead();
	?>
</head>








