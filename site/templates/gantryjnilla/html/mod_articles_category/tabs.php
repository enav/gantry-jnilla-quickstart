<?php
defined('_JEXEC') or die;
foreach ($list as $item)
{
	$tabLabel = $item->title;
	$paneContent = $item->introtext." ".$item->fulltext;
	$options["elements"][] = array("tabLabel" => $tabLabel, "paneContent" => $paneContent);
}
echo JLayoutHelper::render("jnilla.bootstrap.tabs", $options);
?>



