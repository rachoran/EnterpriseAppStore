<?php if (Me::minUser()) { ?>
<li<?= checkMenu('calendar', $this); ?>>
	<a href="<?= $this->Html->url('/calendar', true); ?>"> <i class="icon-calendar"></i> Calendar </a>
</li>
<?php } ?>