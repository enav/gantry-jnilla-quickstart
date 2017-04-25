<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */



defined('_JEXEC') or die;

/*
 * default Jnilla chrome style
 */
function modChrome_standard($module, &$params, &$attribs)
{
	global $jnilla;
	$blockClass = htmlspecialchars($params->get('block_class'));
	$moduleTag = htmlspecialchars($params->get('module_tag', "div"));
	$headerTag = htmlspecialchars($params->get('header_tag', "h3"));
	$headerClass = htmlspecialchars($params->get('header_class'));
	if($jnilla->development){
		$id = $module->id;
		$editUrl = JUri::base()."administrator/index.php?option=com_modules&task=module.edit&id=$id";
		$data = '<input class="jn-hud-mod-data"
			type="hidden"
			data-id="'.$id.'"
			data-blockclass="'.$blockClass.'"
			data-edit="'.$editUrl.'" >';
	}
	?>
	<div class="jn-block <?php echo $blockClass; ?>">
		<?php echo $data; ?>
		<<?php echo $moduleTag; ?> class="module-wrap">
			<?php if ($module->showtitle) : ?>
				<<?php echo $headerTag; ?> class="module-title <?php echo $headerClass; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
			<?php endif; ?>
			<div class="module-content">
				<?php echo $module->content; ?>
				<div class="clearfix"></div>
			</div>
		</<?php echo $moduleTag; ?>>
	</div>
	<?php
}




