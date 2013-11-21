<?php if (Me::minUser()) { ?>
<li<?= checkMenu('calendar', $this); ?>>
	<a href="<?= $this->Html->url('/calendar', true); ?>"> <span class="badge pull-right">11</span> <i class="icon-calendar"></i> Calendar </a>
</li>
<?php } ?>