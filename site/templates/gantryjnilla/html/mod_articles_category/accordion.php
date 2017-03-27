<?php
defined('_JEXEC') or die;
foreach ($list as $item)
{
	$accordionHeading = $item->title;
	$accordionBody= $item->introtext." ".$item->fulltext;
	$options["elements"][] = array("accordionHeading" => $accordionHeading, "accordionBody" => $accordionBody);
}
echo JLayoutHelper::render("jnilla.bootstrap.accordion", $options);
?>



