<?php

// Breadcrumbs
$this->Html->addCrumb('Categories', '/categories');
$this->Html->addCrumb($category['Category']['name'], null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<h3 class="form-title form-title-first"><i class="<?= $category['Category']['icon']; ?>"></i> <?= $category['Category']['name']; ?></h3>
			<p>
				<ul id="appTablePills" class="nav nav-pills">
					<!-- Begin pill selector -->
					<?= $this->element('DB/platformPillSelector', array('data' => $category['Application'])); ?>
					<!-- End pill selector -->
				</ul>
			</p>
			<!-- Begin pill selector -->
			<?= $this->element('DB/applicationTable'); ?>
			<!-- End pill selector -->
		</div>
	</div>
</div>