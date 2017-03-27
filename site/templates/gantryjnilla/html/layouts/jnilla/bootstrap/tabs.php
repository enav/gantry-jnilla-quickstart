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
if(empty($uid)) $uid = "tabs-".uniqid();
?>
<div id="<?php echo $uid; ?>" class="bootstrap-tabs <?php echo $class; ?>">
	<ul class="nav nav-tabs">
		<?php $n = -1; ?>
		<?php foreach($elements as $element) :?>
			<?php
			$n++;
			$itemId = "$uid-item-$n";
			?>
			<li <?php if($n==0) echo 'class="active"'; ?>>
				<a href="<?php echo "#$itemId"; ?>" data-toggle="tab"><?php echo $element["tabLabel"];?></a>
			</li>
		<?php endforeach;?>
	</ul>
	<div class="tab-content">
		<?php $n = -1; ?>
		<?php foreach($elements as $element) :?>
			<?php
			$n++;
			$itemId = "$uid-item-$n";
			?>
			<div class="tab-pane fade <?php if($n==0) echo "in active"; ?>" id="<?php echo $itemId; ?>"><?php echo $element["paneContent"];?></div>
		<?php endforeach;?>
	</div>
</div>



