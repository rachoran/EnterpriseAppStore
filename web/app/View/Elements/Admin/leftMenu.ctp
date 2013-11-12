<?php

// Supply active class to the right menu
function checkMenu($name, $t) {
	return (strtolower($t->name) == $name) ? " class='current'" : '';
}

?><div class="col-md-3">
	<div class="text-center">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	</div>
	<div class="side-bar-wrapper collapse navbar-collapse navbar-ex1-collapse">
		<a href="<?= $this->Html->url('/', true); ?>" class="logo hidden-sm hidden-xs">
			<img src="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Logo?time=<?= time(); ?>" alt="Go to Dashboard" class="logo" />
			<!-- <i class="icon-cloud-download"></i> -->
			<span><?= $siteName; ?></span>
		</a>
		<form action="<?= $this->Html->url('/applications', true); ?>" method="post" class="search-box">
			<input type="text" placeholder="SEARCH APPS" name="search" value="<?= isset($searchTerm) ? $searchTerm : ''; ?>" class="form-control" />
		</form>
		<!--
		TODO: Create system notifications for other users like when an app is added (or tracked like when someone downloads an app)
		<ul class="side-menu">
			<li<?= checkMenu('notifications', $this); ?>>
				<a href="<?= $this->Html->url('/notifications', true); ?>"> <span class="badge badge-notifications pull-right alert-animated">5</span> <i class="icon-flag"></i> Notifications </a>
			</li>
		</ul>
		-->
		<div class="relative-w">
			<ul class="side-menu">
				<li<?= checkMenu('pages', $this); ?>>
					<a href="<?= $this->Html->url('/', true); ?>"> <i class="icon-dashboard"></i> Dashboard </a>
				</li>
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
				<li<?= checkMenu('users', $this); ?>>
					<a href="<?= $this->Html->url('/users', true); ?>"> <span class="badge pull-right"><?= $menuCounts['users']; ?></span> <i class="icon-user"></i> Users </a>
				</li>
				<li<?= checkMenu('groups', $this); ?>>
					<a href="<?= $this->Html->url('/groups', true); ?>"> <span class="badge pull-right"><?= ($menuCounts['groups'] + 1); ?></span> <i class="icon-group"></i> Groups </a>
				</li>
				<li<?= checkMenu('categories', $this); ?>>
					<a href="<?= $this->Html->url('/categories', true); ?>"> <span class="badge pull-right"><?= $menuCounts['categories']; ?></span> <i class="icon-list-ul"></i> Categories </a>
				</li>
				<!--
				TODO: Add policies to control the builds
				<li<?= checkMenu('policies', $this); ?>>
					<a href="<?= $this->Html->url('/policies', true); ?>" class="is-dropdown-menu"> <span class="badge pull-right"></span> <i class="icon-shield"></i> Policies </a>
					<ul>
						<li> <a href="xxxxxxxxx"> <i class="icon-beaker"></i> App Usage </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-picture"></i> Dynamic Authentication </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Remote Control </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Self Updating App </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Data Wipe </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Require Passphrase </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Encrypted DAR </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Copy-Paste Protection </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Jailbreak/Root Protection </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> App Expiration </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Geofencing </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Location Masking </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Lockout Recovery </a> </li>
					</ul>
				</li>
				-->
				<li<?= checkMenu('settings', $this); ?>>
					<a href="<?= $this->Html->url('/settings', true); ?>"> <i class="icon-cogs"></i> Settings </a>
				</li>
				<!--
				TODO: Create analytics
				<li<?= checkMenu('analytics', $this); ?>>
					<a href="<?= $this->Html->url('/analytics', true); ?>" class="is-dropdown-menu"> <span class="badge pull-right"></span> <i class="icon-bar-chart"></i> Analytics </a>
					<ul>
						<li> <a href="xxxxxxxxx"> <i class="icon-random"></i> Downloads per user </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-bullseye"></i> Events </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-signal"></i> Per device </a> </li>
						<li> <a href="xxxxxxxxx"> <i class="icon-bar-chart"></i> Per platform </a> </li>
					</ul>
				</li>
				TODO: Add calendar of uploaded
				<li<?= checkMenu('calendar', $this); ?>>
					<a href="<?= $this->Html->url('/calendar', true); ?>"> <span class="badge pull-right">11</span> <i class="icon-calendar"></i> Calendar </a>
				</li>
				TODO: Finish signing
				<li<?= checkMenu('signing', $this); ?>>
					<a href="<?= $this->Html->url('/signing', true); ?>"> <span class="badge pull-right"><?= $menuCounts['signing']; ?></span> <i class="icon-certificate"></i> Signing </a>
				</li>
				-->
				<li<?= checkMenu('ideas', $this); ?>>
					<a href="<?= $this->Html->url('/ideas', true); ?>"> <span class="badge pull-right"></span> <i class="icon-comment"></i> Ideas </a>
				</li>
				<li>
					<a href="<?= $this->Html->url('/users/logout', true); ?>"> <span class="badge pull-right"></span> <i class="icon-signout"></i> Logout </a>
				</li>
			</ul>
		</div>
	</div>
</div>
