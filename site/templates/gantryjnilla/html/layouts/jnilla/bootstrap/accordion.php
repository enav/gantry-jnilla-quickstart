<?php
/**
 * @copyright   Copyright (C) 2015 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined('_JEXEC') or die;
//init
$options = $displayData;
if(!is_array($options)) throw new Exception('Invalid parameter "options" in '.__FILE__);
$elements = $options["elements"];
if(!is_array($elements)) throw new Exception('Invalid parameter "elements" in '.__FILE__);
$class = $options["class"];
if(empty($class)) $class = "";
$uid = $options["id"];
if(empty($uid)) $uid = "accordion-".uniqid();
?>
<div id="<?php echo $uid; ?>" class="accordion <? echo $class; ?>">
	<?php $n = -1; ?>
	<?php foreach($elements as $element) :?>
		<?php
		$n++;
		$itemId = "$uid-item-$n";
		?>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="<?php echo "#$uid"; ?>" href="<?php echo "#$itemId"; ?>">
					<?php echo $element["accordionHeading"]; ?>
				</a>
			</div>
			<div id="<?php echo $itemId; ?>" class="accordion-body collapse">
			<div class="accordion-inner">
				<?php echo $element["accordionBody"];?>
			</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>


