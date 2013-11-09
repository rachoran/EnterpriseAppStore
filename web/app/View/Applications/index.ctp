<?php

// Breadcrumbs
$this->Html->addCrumb('Applications', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?php echo $this->Html->url(array('controller' => 'applications', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New application <i class="fa icon-plus"></i></a>
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