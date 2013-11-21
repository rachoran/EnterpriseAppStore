<?php if (Me::minDev()) { ?>
<li<?= checkMenu('categories', $this); ?>>
	<a href="<?= $this->Html->url('/categories', true); ?>"> <span class="badge pull-right"><?= $menuCounts['categories']; ?></span> <i class="icon-list-ul"></i> Categories </a>
</li>
<?php } ?>