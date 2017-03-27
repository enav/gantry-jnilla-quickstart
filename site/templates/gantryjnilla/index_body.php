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

	<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-93171252-1', 'auto'); ga('send', 'pageview'); </script>

</body>

