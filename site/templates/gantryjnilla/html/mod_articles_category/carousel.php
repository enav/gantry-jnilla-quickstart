<?php
// no direct access
defined('_JEXEC') or die;
foreach ($list as $item)
{
	$itemCaption = "<h4>{$item->title}-lorem ipsum</h4><p>lorem ipsum dolor sit amed</p>";
	$itemContent = $item->introtext." ".$item->fulltext;
	$options["elements"][] = array("itemContent" => $itemContent, "itemCaption" => $itemCaption);
}
echo JLayoutHelper::render("jnilla.bootstrap.carousel", $options);
