<?php

// Breadcrumbs
$this->Html->addCrumb('Groups', '/groups');
$this->Html->addCrumb($group['Group']['name'], '/groups/edit/'.$group['Group']['id'].'/'.$group['Group']['name']);

if (!isset($group['Group'])) $group['Group'] = array('id'=>0, 'name'=>'', 'description'=>'', 'icon'=>'');
$id = (int)$group['Group']['id'];

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array("controller" => "groups", "action" => "edit", $group['Group']['id'], $group['Group']['name'])); ?>" method="post" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-group"></i> <?php echo $id ? 'Edit group "'.$group['Group']['name'].'"' : 'Create group'; ?></h3>
				<div class="form-group">
					<label class="col-md-4 control-label">Name</label>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" placeholder="Group name" value="<?php echo $group['Group']['name']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Description</label>
					<div class="col-md-8">
						<textarea type="text" name="description" class="form-control description" placeholder="Group description"><?php echo $group['Group']['description']; ?></textarea>
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
								<!-- Begin user selector -->
								<?php echo $this->element('DB/userSelector', array('tableName'=>'selectedUsers')); ?>
								<!-- End user selector -->
							</div>
							<div class="tab-pane" id="tab_group_applications">
								<!-- Begin user selector -->
								<?php echo $this->element('DB/applicationSelector', array('tableName'=>'selectedTables')); ?>
								<!-- End user selector -->
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<a href="<?php echo $this->Html->url('/groups', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
