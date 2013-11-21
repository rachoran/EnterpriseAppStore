<?php

$user = $user['User'];

// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb($user['firstname'].' '.$user['lastname'], null);

?><div class="widget">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_group_user_info" data-toggle="tab">User info</a></li>
        <li><a href="#tab_group_applications" data-toggle="tab">Applications</a></li>
    </ul>
    <div class="tab-content bottom-margin">
		<div class="tab-pane active" id="tab_group_user_info">
			<div class="padded">
				<p>&nbsp;</p>
				<table class="table table-striped table-bordered table-hover">
					<tbody>
						<tr>
							<td colspan="2">
								<h1>
									<img src="<?= $user['gravatar_url']; ?>?s=112" alt="<?= $user['lastname'].', '.$user['firstname']; ?>" class="rounded-border" style="height:106px; margin-left:12px; margin-right:24px;" />
									<?= $user['lastname'].', '.$user['firstname']; ?>
								</h1>
							</td>
							<td style="vertical-align:middle; text-align:center; width:120px;">
								<a href="<?= $this->Html->url(array("controller" => 'users', 'action' => 'edit', $user['id'], $user['username'])); ?>" class="btn btn-default" style="margin-right:6px;">
					        		<i class="fa icon-edit"><span> Edit</span></i>
					        	</a>
							</td>
						</tr>
						<?php
						foreach ($basicInfo as $title=>$value) {
						?>
						<tr>
							<td width="220"><strong><?= $title; ?></strong></td>
							<td colspan="2">
								<?php
								if (is_array($value)) {
									$br = (count($value) > 1) ? '<br />' : '';
									foreach ($value as $v) {
										echo $v.$br;
									}
								}
								else {
									echo $value;
								}
								?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="tab_group_applications">
			<div class="padded">
				<p>&nbsp;</p>
				<p>
					<a href="<?= $this->Html->url(array('controller' => 'applications', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New application <i class="fa icon-plus"></i></a>
					<ul id="appTablePills" class="nav nav-pills">
						<!-- Begin pill selector -->
						<?= $this->element('DB/platformPillSelector', array('data' => $apps)); ?>
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
