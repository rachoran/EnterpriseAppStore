<?php

$group = $this->request->data['Group'];

// Breadcrumbs
$this->Html->addCrumb('Groups', '/groups');
$this->Html->addCrumb((empty($group['name']) ? 'Create group' : $group['name']), null);

$id = isset($group['id']) ? (int)$group['id'] : 0;

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<?php
			echo $this->Form->create('Group', array(
				'role' => 'form',
				'class' => 'form-horizontal'
			));
			?>
			<h3 class="form-title form-title-first"><i class="icon-group"></i> <?php echo $id ? 'Edit group "'.$group['name'].'"' : 'Create group'; ?></h3>
			<div class="form-group">
				<label class="col-md-4 control-label">Name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('name', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'Group name'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Description</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('description', array(
						'label' => false,
						'class'=>'form-control description',
						'placeholder'=>'Group description'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Group users</label>
				<div class="col-md-8">
				    <ul class="nav nav-tabs">
				        <li class="active"><a href="#tab_group_users" data-toggle="tab">Users</a></li>
				        <li><a href="#tab_group_applications" data-toggle="tab">Applications</a></li>
				    </ul>
				    <div class="tab-content bottom-margin">
						<div class="tab-pane active" id="tab_group_users">
							<p>&nbsp;</p>
							<!-- Begin user selector -->
							<?php echo $this->element('DB/userSelector'); ?>
							<!-- End user selector -->
						</div>
						<div class="tab-pane" id="tab_group_applications">
							<p>&nbsp;</p>
							<!-- Begin user selector -->
							<?php echo $this->element('DB/applicationSelector'); ?>
							<!-- End user selector -->
						</div>
				    </div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-8">
					<a href="<?php echo $this->Html->url('/groups', true); ?>" class="btn btn-default">Cancel</a>
					<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
					<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
				</div>
			</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>
