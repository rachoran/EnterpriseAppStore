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
		<a href="<?php echo $this->Html->url('/', true); ?>" class="logo hidden-sm hidden-xs">
			<i class="icon-cloud-download"></i> <span>AppStore</span>
		</a>
		<div class="search-box">
			<input type="text" placeholder="SEARCH APPS" class="form-control" />
		</div>
		<ul class="side-menu">
			<li<?php echo checkMenu('notifications', $this); ?>>
				<a href="<?php echo $this->Html->url('/notifications', true); ?>"> <span class="badge badge-notifications pull-right alert-animated">5</span> <i class="icon-flag"></i> Notifications </a>
			</li>
		</ul>
		<div class="relative-w">
			<ul class="side-menu">
				<li<?php echo checkMenu('pages', $this); ?>>
					<a href="<?php echo $this->Html->url('/', true); ?>"> <span class="badge pull-right">17</span> <i class="icon-dashboard"></i> Dashboard </a>
				</li>
				<li<?php echo checkMenu('applications', $this); ?>>
					<a href="<?php echo $this->Html->url('/applications', true); ?>"> <span class="badge pull-right"><?php echo $menuCounts['applications']; ?></span> <i class="icon-briefcase"></i> Applications </a>
				</li>
				<li<?php echo checkMenu('users', $this); ?>>
					<a href="<?php echo $this->Html->url('/users', true); ?>"> <span class="badge pull-right"><?php echo $menuCounts['users']; ?></span> <i class="icon-user"></i> Users </a>
				</li>
				<li<?php echo checkMenu('groups', $this); ?>>
					<a href="<?php echo $this->Html->url('/groups', true); ?>"> <span class="badge pull-right"><?php echo ($menuCounts['groups'] + 1); ?></span> <i class="icon-group"></i> Groups </a>
				</li>
				<li<?php echo checkMenu('categories', $this); ?>>
					<a href="<?php echo $this->Html->url('/categories', true); ?>"> <span class="badge pull-right"><?php echo $menuCounts['categories']; ?></span> <i class="icon-list-ul"></i> Categories </a>
				</li>
				<li<?php echo checkMenu('policies', $this); ?>>
					<a href="<?php echo $this->Html->url('/policies', true); ?>" class="is-dropdown-menu"> <span class="badge pull-right"></span> <i class="icon-shield"></i> Policies </a>
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
				<li<?php echo checkMenu('settings', $this); ?>>
					<a href="<?php echo $this->Html->url('/settings', true); ?>" class="is-dropdown-menu"> <i class="icon-cogs"></i> Settings </a>
					<ul>
						<li> <a href="<?php echo $this->Html->url('/settings#company-information', true); ?>"> <i class="icon-list-alt"></i> Company Information </a> </li>
						<li> <a href="<?php echo $this->Html->url('/settings#invitation-message', true); ?>"> <i class="icon-table"></i> Invitation Message </a> </li>
						<!--<li> <a href="<?php echo $this->Html->url('/settings#device-management', true); ?>"> <i class="icon-table"></i> Device Management </a> </li>
						<li> <a href="<?php echo $this->Html->url('/settings#timezone', true); ?>"> <i class="icon-table"></i> Timezone </a> </li>-->
						<!--<li> <a href="<?php echo $this->Html->url('/settings#signing-credentials', true); ?>"> <i class="icon-table"></i> Signing Credentials </a> </li>
						<li> <a href="<?php echo $this->Html->url('/settings#download-app-catalog', true); ?>"> <i class="icon-table"></i> Download App Catalog </a> </li>
						<li> <a href="<?php echo $this->Html->url('/settings#authentication', true); ?>"> <i class="icon-table"></i> Authentication </a> </li>-->
						<li> <a href="<?php echo $this->Html->url('/settings#user-self-registration', true); ?>"> <i class="icon-table"></i> User Self-Registration </a> </li>
						<!--<li> <a href="<?php echo $this->Html->url('/settings#corporate-email-profile', true); ?>"> <i class="icon-table"></i> Corporate Email Profile </a> </li>-->
					</ul>
				</li>
				<li<?php echo checkMenu('analytics', $this); ?>>
					<a href="<?php echo $this->Html->url('/analytics', true); ?>" class="is-dropdown-menu"> <span class="badge pull-right"></span> <i class="icon-bar-chart"></i> Analytics </a>
					<ul>
						<li> <a href="charts.html#area_chart_anchor"> <i class="icon-random"></i> Area Chart </a> </li>
						<li> <a href="charts.html#circle_chart_anchor"> <i class="icon-bullseye"></i> Circular Chart </a> </li>
						<li> <a href="charts.html#bar_chart_anchor"> <i class="icon-signal"></i> Bar Chart </a> </li>
						<li> <a href="charts.html#line_chart_anchor"> <i class="icon-bar-chart"></i> Line Chart </a> </li>
					</ul>
				</li>
				<li<?php echo checkMenu('calendar', $this); ?>>
					<a href="<?php echo $this->Html->url('/calendar', true); ?>"> <span class="badge pull-right">11</span> <i class="icon-calendar"></i> Upload calendar </a>
				</li>
				<li<?php echo checkMenu('signing', $this); ?>>
					<a href="<?php echo $this->Html->url('/signing', true); ?>"> <span class="badge pull-right">0</span> <i class="icon-calendar"></i> Application signing </a>
				</li>
				<li<?php echo checkMenu('ideas', $this); ?>>
					<a href="<?php echo $this->Html->url('/ideas', true); ?>"> <span class="badge pull-right"></span> <i class="icon-comment"></i> Ideas </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url('/users/logout', true); ?>"> <span class="badge pull-right"></span> <i class="icon-signout"></i> Logout </a>
				</li>
			</ul>
		</div>
	</div>
</div>
