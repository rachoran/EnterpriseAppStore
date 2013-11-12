<?php

// Breadcrumbs
$this->Html->addCrumb('Groups', '/groups');
$this->Html->addCrumb($group['Group']['name'], null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<h3 class="form-title form-title-first"><i class="icon-group"></i> <?= $group['Group']['name']; ?></h3>
		    <ul class="nav nav-tabs">
		        <li class="active"><a href="#tab_group_users" data-toggle="tab">Users</a></li>
		        <li><a href="#tab_group_applications" data-toggle="tab">Applications</a></li>
		    </ul>
		    <div class="tab-content bottom-margin">
				<div class="tab-pane active" id="tab_group_users">
					<p>&nbsp;</p>
					<!-- Begin user selector -->
					<?= $this->element('DB/userTable'); ?>
					<!-- End user selector -->
				</div>
				<div class="tab-pane" id="tab_group_applications">
					<p>&nbsp;</p>
					<p>
						<ul id="appTablePills" class="nav nav-pills" style="margin-left:12px;">
							<!-- Begin pill selector -->
							<?= $this->element('DB/platformPillSelector', array('data' => $group['Application'])); ?>
							<!-- End pill selector -->
						</ul>
					</p>
					<!-- Begin pill selector -->
					<?= $this->element('DB/applicationTable'); ?>
					<!-- End pill selector -->
				</div>
		    </div>
		</div>
	</div>
</div>