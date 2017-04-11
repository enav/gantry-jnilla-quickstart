<?php
defined ( '_JEXEC' ) or die ();
?>
<body class="<?php echo $bodyClases; ?>" data-baseurl="<?php echo JUri::base(); ?>">
	<div id="jn-wrap" class="jn-drawer-body">
		<?php echo JLayoutHelper::render('jnilla.layout.render_group', array('group' => 'jn-top', 'rows' => 1)); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_group', array('group' => 'jn-header', 'tag' => 'header')); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_group', array('group' => 'jn-before')); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_main_body'); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_group', array('group' => 'jn-after')); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_group', array('group' => 'jn-footer', 'tag' => 'footer')); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_group', array('group' => 'jn-bottom', 'rows' => 1)); ?>
		<?php echo JLayoutHelper::render('jnilla.layout.render_debug'); ?>
	</div>
	<?php echo JLayoutHelper::render('jnilla.layout.render_drawer'); ?>
</body>

