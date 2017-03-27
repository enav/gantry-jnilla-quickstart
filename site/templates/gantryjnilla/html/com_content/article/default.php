<?php
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$canEdit = $params->get('access-edit');
?>
<div class="article<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />

	<?php // action icons ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php // page header ?>
	<?php if ($this->params->get('show_page_heading') && trim($this->params->get('page_heading') != "")) : ?>
		<h1 class="page-header"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<?php // page header or page subheader ?>
	<?php if ($params->get('show_title')) : ?>
		<?php if ($this->params->get('show_page_heading') && trim($this->params->get('page_heading')) != "") : ?>
			<h2 itemprop="name" class="page-subheader"><?php echo $this->escape($this->item->title); ?></h2>
		<?php else : ?>
			<h1 itemprop="name" class="page-header"><?php echo $this->escape($this->item->title); ?></h1>
		<?php endif; ?>
	<?php endif; ?>

	<?php // article image ?>
	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
		<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
		<div class="article-image pull-<?php echo htmlspecialchars($imgfloat); ?>">
			<img
				<?php if ($images->image_fulltext_caption): ?>
					title="<?php htmlspecialchars($images->image_fulltext_caption); ?>"
				<?php endif; ?>
				src="<?php echo htmlspecialchars($images->image_fulltext); ?>"
				alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"
				itemprop="image"
			/>
		</div>
	<?php endif; ?>

	<?php // article content ?>
	<div class="artcle-fulltext" itemprop="articleBody">
		<?php echo $this->item->text; ?>
	</div>

	<?php // article pagination
	if (!empty($this->item->pagination) && $this->item->pagination) {
		echo $this->item->pagination;
	}
	?>
</div>


