<?php
if (Me::minAdmin()) {
?>
<li<?= checkMenu('groups', $this); ?>>
	<a href="<?= $this->Html->url('/groups', true); ?>"> <span class="badge pull-right"><?= ($menuCounts['groups'] + 0); ?></span> <i class="icon-group"></i> Groups </a>
</li>
<?php
}
?>
