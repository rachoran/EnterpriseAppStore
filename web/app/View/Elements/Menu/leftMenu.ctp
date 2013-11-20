<?php

// Supply active class to the right menu
function checkMenu($name, $t) {
	// debug($name);
	return (strtolower($t->name) == $name) ? " class='current'" : '';
}

?><div class="col-md-3">
	<div class="text-center">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	</div>
	<div class="side-bar-wrapper collapse navbar-collapse navbar-ex1-collapse">
		<a href="<?= $this->Html->url('/', true); ?>" class="logo hidden-sm hidden-xs">
			<img src="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Logo?time=<?= time(); ?>" alt="Go to home page" class="logo" />
			<!-- <i class="icon-cloud-download"></i> -->
			<span><?= $siteName; ?></span>
		</a>
		<form action="<?= $this->Html->url('/applications', true); ?>" method="post" class="search-box">
			<input type="text" placeholder="SEARCH APPS" name="search" value="<?= isset($searchTerm) ? $searchTerm : ''; ?>" class="form-control" />
		</form>
		<!-- Begin Notifications -->
		<?= $this->element('Menu/Sections/notifications'); ?>
		<!-- End Notifications -->
		<div class="relative-w">
			<ul class="side-menu">
				<!-- Begin Menu items -->
				<?= $this->element('Menu/Sections/home'); ?>
				<?= $this->element('Menu/Sections/applications'); ?>
				<?= $this->element('Menu/Sections/users'); ?>
				<?= $this->element('Menu/Sections/groups'); ?>
				<?= $this->element('Menu/Sections/categories'); ?>
				<?= $this->element('Menu/Sections/groups'); ?>
				<?= $this->element('Menu/Sections/settings'); ?>
				<?= $this->element('Menu/Sections/ideas'); ?>
				<?= $this->element('Menu/Sections/analytics'); ?>
				<?= $this->element('Menu/Sections/calendar'); ?>
				<!-- End Menu items -->
				<li>
					<a href="<?= $this->Html->url('/users/logout', true); ?>"> <i class="icon-signout"></i> Logout </a>
				</li>
			</ul>
		</div>
	</div>
</div>
