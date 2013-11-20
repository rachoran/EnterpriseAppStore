<?php if (Me::minAdmin()) { ?>
<li<?= checkMenu('ideas', $this); ?>>
	<a href="#" class="is-dropdown-menu"> <span class="badge pull-right"><?= $menuCounts['ideas']; ?></span> <i class="icon-comment"></i> Ideas </a>
	<ul>
		<li> <a href="<?= $this->Html->url('/ideas', true); ?>"> <span class="badge pull-right"><?= $menuCounts['ideas']; ?></span> <i class="icon-comments"></i> Ideas </a> </li>
		<li> <a href="<?= $this->Html->url('/ideas/edit', true); ?>"> <i class="icon-comment-alt"></i> Send idea </a> </li>
	</ul>
</li>
<?php } else { ?>
<li<?= checkMenu('ideas', $this); ?>>
	<a href="<?= $this->Html->url('/ideas/edit', true); ?>"> <span class="badge pull-right"></span> <i class="icon-comment"></i> Ideas </a>
</li>
<?php } ?>
