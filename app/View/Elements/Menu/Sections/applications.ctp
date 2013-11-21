<li<?= checkMenu('applications', $this); ?>>
	<a href="<?= $this->Html->url('/applications', true); ?>"> 
		<span class="badge pull-right"><?= $menuCounts['applications']; ?></span> <i class="icon-briefcase"></i> Applications 
	</a>
</li>
