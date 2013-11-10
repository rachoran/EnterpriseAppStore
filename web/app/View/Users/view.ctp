<?php

$user = $user['User'];

// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb($user['firstname'].' '.$user['lastname'], null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<h3 class="form-title form-title-first"><i class="icon-user"></i> <?= $user['firstname'].' '.$user['lastname']; ?></h3>
			<p>
				<ul id="appTablePills" class="nav nav-pills">
					<!-- Begin pill selector -->
					<?= $this->element('DB/platformPillSelector'); ?>
					<!-- End pill selector -->
				</ul>
			</p>
			<!-- Begin pill selector -->
			<?= $this->element('DB/applicationTable'); ?>
			<!-- End pill selector -->
		</div>
	</div>
</div>