<?php
if (Me::minAdmin()) {
?>
<li<?= checkMenu('users', $this); ?>>
	<a href="<?= $this->Html->url('/users', true); ?>"> <span class="badge pull-right"><?= $menuCounts['users']; ?></span> <i class="icon-user"></i> Users </a>
</li>
<?php
}
?>
