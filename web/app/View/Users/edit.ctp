<?php

$user = $this->request->data['User'];

// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb((empty($user['fullname']) ? 'Add user' : $user['fullname']), null);

$id = isset($user['id']) ? (int)$user['id'] : 0;

$changePassword = isset($id) ? 'Change ' : '';

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<?php
			echo $this->Form->create('User', array(
				'role' => 'form',
				'class' => 'form-horizontal'
			));
			?>
			<h3 class="form-title form-title-first"><i class="icon-user"></i> <?php echo isset($id) ? 'Edit user "'.$this->request->data['User']['fullname'].'"' : 'Create user'; ?></h3>
			<div class="form-group">
				<label class="col-md-4 control-label">User name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('username', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'joedoe3330',
						'autocomplete' => 'off'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Full Name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('fullname', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'John Doe'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Email</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('User.email', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'john.doe@example.com'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label"><?php echo $changePassword; ?>Password</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('password', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'mySup3rS3cr3tP4ssw0rd',
						'autocomplete' => 'off'
					));
					?>
				</div>
			</div>
			<?php
			if ($this->request->data['User']['role'] == 'owner') {
			?>
			<div class="form-group">
				<label class="col-md-4 control-label">Role</label>
				<div class="col-md-8">
					<!-- <select class="form-control" name="userData[role]">
						<option value="user">User</option>
						<option value="developer">Developer</option>
						<option value="admin">Administrator</option>
					</select> -->
					<?php
					$this->Form->input('role', array('options' => $groups));
					?>
				</div>
			</div>
			<?php
			}
			?>
			<div class="form-group">
				<label class="col-md-4 control-label">Groups</label>
				<div class="col-md-8">
					<!-- Begin groups selector -->
					<?php echo $this->element('DB/groupSelector'); ?>
					<!-- End groups selector -->
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-8">
					<a href="<?php echo $this->Html->url('/users', true); ?>" class="btn btn-default">Cancel</a>
					<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
					<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
				</div>
			</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>