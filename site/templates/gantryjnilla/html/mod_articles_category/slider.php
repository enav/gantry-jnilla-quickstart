<?php
// no direct access
defined ( '_JEXEC' ) or die ();

$uid = "slider-".uniqid();
?>
<div id="<?php echo $uid; ?>" class="carousel slide <?php echo $moduleclass_sfx; ?>">
	<ol class="carousel-indicators">
		<?php $n = -1; ?>
		<?php foreach ($list as $item) : ?>
			<?php $n++; ?>
			<li data-target="<?php echo "#$uid"; ?>" data-slide-to="<?php echo $n; ?>" <?php if($n==0) echo "class=\"active\""?>>
			</li>
		<?php endforeach; ?>
	</ol>

	<!-- Carousel items -->
	<div class="carousel-inner">
		<?php $n = -1; ?>
		<?php foreach ($list as $item) : ?>
			<?php $n++; ?>
			<div class="item <?php if($n==0) echo "active"; ?>">
				<?php echo $item->introtext.$item->fulltext; ?>
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
			interval: 6000
		});
	});
})(jQuery);
</script>








