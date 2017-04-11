<?php
/**
 * @copyright   Copyright (C) 2015 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

$templateName = $app->getTemplate();
if(!JFactory::getUser()->guest)
{
	$suffix = "?id=".uniqid();
}
?>
<link rel="apple-touch-icon" href="templates/<?php echo $templateName ;?>/favicon/apple-touch-icon.png<?php echo $suffix; ?>" sizes="180x180">
<link rel="icon" type="image/png" href="templates/<?php echo $templateName ;?>/favicon/favicon-32x32.png<?php echo $suffix; ?>" sizes="32x32">
<link rel="icon" type="image/png" href="templates/<?php echo $templateName ;?>/favicon/favicon-16x16.png<?php echo $suffix; ?>" sizes="16x16">



