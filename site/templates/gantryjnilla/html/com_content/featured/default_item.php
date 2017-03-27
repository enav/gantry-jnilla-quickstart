<?php
defined('_JEXEC') or die;
// Create a shortcut for params.
$params = $this->item->params;
$item = $this->item;
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
?>

<?php // blog item ?>
<div class="blog-item" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<div class="row-fluid">
		<div class="span4">
			<?php // item image ?>
			<div class="blog-item-image">
				<a href="<?php echo $link; ?>" class="thumbnail">
					<?php echo JLayoutHelper::render('jnilla.content.intro_image',
						array(
							'params' => $params,
							'item' => $this->item,
							'attr' => 'class="jn-holder" data-ratio="tv"')); ?>
				</a>
			</div>
		</div>
		<div class="span8">
			<?php // item title ?>
			<h4 class="blog-item-title">
				<a href="<?php echo $link; ?>">
					<?php echo $item->title; ?>
				</a>
			</h4>

			<?php // item info ?>
			<p class="blog-item-info">
				<strong><?php echo JText::_('JPUBLISHED'); ?>:</strong>
				<?php echo JHTML::_('date', $item->created, "M d, Y"); ?>
			</p>

			<?php // item introtext ?>
			<?php if ($params->get('show_intro')) :?>
				<p class="blog-item-introtext"><?php echo JHtml::_('string.truncate', strip_tags($item->introtext), 255); ?></p>
			<?php endif; ?>

			<?php // item readmore ?>
			<p class="blog-item-readmore">
				<a href="<?php echo $link; ?>"><?php echo JText::_('COM_CONTENT_READ_MORE_TITLE'); ?></a>
			</p>
		</div>
	</div>
</div>
