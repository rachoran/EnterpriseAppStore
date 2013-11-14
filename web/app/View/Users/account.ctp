<?php

$user = $this->request->data['User'];

// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb(__('My account'), null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<?php
			echo $this->Form->create('User', array(
				'role' => 'form',
				'class' => 'form-horizontal'
			));
			?>
			<h3 class="form-title form-title-first"><i class="icon-user"></i> <?= $user['firstname'].' '.$user['lastname']; ?></h3>
			<div class="form-group">
				<label class="col-md-4 control-label">User name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('username', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'joedoe3330',
						'autocomplete' => 'off',
						'readonly' => true,
						'required' => true
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
						'placeholder'=>'John',
						'required' => true
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
						'placeholder'=>'Doe',
						'required' => true
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Email</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('email', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'john.doe@example.com',
						'required' => true
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
				<label class="col-md-4 control-label">Change Password</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('password', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'mySup3rS3cr3tP4ssw0rd',
						'value' => false,
						'autocomplete' => 'off'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Verify Password</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('password2', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'mySup3rS3cr3tP4ssw0rd',
						'autocomplete' => 'off'
					));
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-8">
					<a href="<?= $this->Html->url('/', true); ?>" class="btn btn-default">Cancel</a>
					<button type="submit" name="save" class="btn btn-primary pull-right">Save</button>
				</div>
			</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>