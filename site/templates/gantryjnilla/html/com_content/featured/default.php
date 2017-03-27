<?php
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>
<div class="blog-featured<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog">

	<?php // page header ?>
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1 class="page-header"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	<?php endif; ?>

	<?php // page subheader ?>
	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
		<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<span class="page-subheader"><?php echo $this->category->title; ?></span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>

	<?php // print blog items ?>
	<?php if (!empty($this->intro_items)) : ?>
		<div class="blog-items cols-<?php echo (int) $this->columns; ?>">
			<?php foreach ($this->intro_items as $key => &$item) : ?>
				<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
				<?php if ($rowcount == 1) : ?>
					<?php $row = $counter / $this->columns; ?>
					<div class="row-fluid">
				<?php endif; ?>
				<div class="span<?php echo round((12 / $this->columns)); ?>">
					<?php
					$this->item = & $item;
					echo $this->loadTemplate('item');
					$counter++;
					?>
				</div>
				<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php // pagination ?>
	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?> </div>
	<?php endif; ?>
</div>
