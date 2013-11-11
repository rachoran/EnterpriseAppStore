<?php

$user = isset($this->request->data['User']) ? $this->request->data['User'] : null;
$id = isset($user['id']) ? (int)$user['id'] : 0;


// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb((empty($user['lastname']) ? __('Add user') : __('Edit').' '.$user['firstname'].' '.$user['lastname']), null);


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
			<h3 class="form-title form-title-first"><i class="icon-user"></i> <?php echo ((bool)$id) ? 'Edit user "'.$user['firstname'].' '.$user['lastname'].'"' : 'Create user'; ?></h3>
			<div class="form-group">
				<label class="col-md-4 control-label">User name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('username', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'joedoe3330',
						'autocomplete' => 'off',
						'readonly' => (bool)$id
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">First Name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('firstname', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'John'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Last Name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('lastname', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'Doe'
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
				<label class="col-md-4 control-label">Company</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('company', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'Joe\'s Sweets Delivery'
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
			// TODO: If this user is current user, they should not be able to edit
			if ($user['role'] != 'owner') {
			?>
			<div class="form-group">
				<label class="col-md-4 control-label">Role</label>
				<div class="col-md-8">
					<select class="form-control" name="data[User][role]">
						<option value="user"<?php if ($user['role'] == 'user') echo ' selected="selected"'; ?>>User</option>
						<option value="developer"<?php if ($user['role'] == 'developer') echo ' selected="selected"'; ?>>Developer</option>
						<option value="admin"<?php if ($user['role'] == 'admin') echo ' selected="selected"'; ?>>Administrator</option>
					</select>
					<?php
					// TODO: Would be good to have forms helper doing this
					//$this->Form->input('role', array('options' => $groups));
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