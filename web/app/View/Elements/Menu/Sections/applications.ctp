<li<?= checkMenu('applications', $this); ?>>
	<a href="<?= $this->Html->url('/applications', true); ?>"> 
		<span class="badge pull-right"><?= $menuCounts['applications']; ?></span> <i class="icon-briefcase"></i> Applications 
	</a>
	<!--
	TODO: Add policies to control the builds
	<ul>
		<li> <a href="xxxxxxxxx"> <i class="icon-briefcase"></i> All apps </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-apple"></i> iOS </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-android"></i> Android </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-windows"></i> Windows </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-globe"></i> iTunes or Play </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-globe"></i> Web Clips </a> </li>
	</ul>
	-->
</li>
