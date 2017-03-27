<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined('_JEXEC') or die;
//init
$options = $displayData;
if(!is_array($options)) throw new Exception('Invalid parameter "options" in '.__FILE__);
$elements = $options["elements"];
if(!is_array($elements)) throw new Exception('Invalid parameter "elements" in '.__FILE__);
$interval = $options["interval"];
if(empty($interval)) $interval = 6000;
$class = $options["class"];
if(empty($class)) $class = "slide";
$uid = $options["id"];
if(empty($uid)) $uid = "carousel-".uniqid();
?>
<div id="<?php echo $uid; ?>" class="carousel <? echo $class; ?>">
	<ol class="carousel-indicators">
		<?php $n = -1; ?>
		<?php foreach ($elements as $element) : ?>
			<?php $n++; ?>
			<li data-target="<?php echo "#$uid"; ?>" data-slide-to="<?php echo $n; ?>" <?php if($n == 0) echo "class=\"active\""?>></li>
		<?php endforeach; ?>
	</ol>
	<div class="carousel-inner">
		<?php $n = -1; ?>
		<?php foreach ($elements as $element) : ?>
			<?php $n++; ?>
			<div class="item <?php if($n == 0) echo "active"; ?>">
				<?php echo $element["itemContent"]; ?>
				<?php if(!empty($element["itemCaption"])) : ?>
					<div class="carousel-caption">
						<?php echo $element["itemCaption"]; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<a class="left carousel-control" href="<?php echo "#$uid"; ?>" data-slide="prev">‹</a>
	<a class="right carousel-control" href="<?php echo "#$uid"; ?>" data-slide="next">›</a>
</div>
<script type="text/javascript">
(function($)
{
	$(document).ready(function()
	{
		$('<?php echo "#$uid"; ?>').carousel({
			interval: <?php echo $interval; ?>
		});
	});
})(jQuery);
</script>


