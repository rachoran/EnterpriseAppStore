<?php echo $this->Form->create('User', array('role'=>'form')); ?>
	<h3 class="form-title form-title-first"><i class="icon-lock"></i> <?= __('Register new user'); ?> </h3>
	<div class="form-group">
		<label><?= __('Username'); ?> <span>*</span></label>
		<?= $this->Form->input('username', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'johndoe3330'
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('Email'); ?> <span>*</span></label>
		<?= $this->Form->input('email', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'john.doe@example.com'
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('First name'); ?> <span>*</span></label>
		<?= $this->Form->input('firstname', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'John'
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('Last name'); ?> <span>*</span></label>
		<?= $this->Form->input('lastname', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'Doe'
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('Company'); ?></label>
		<?= $this->Form->input('company', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'Doe',
			'required' => false
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('Password'); ?> <span>*</span></label>
		<?= $this->Form->input('password', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'mySup3rS3cr3tP4ssw0rd'
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('Password verification'); ?> <span>*</span></label>
		<?= $this->Form->input('password2', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'mySup3rS3cr3tP4ssw0rd',
			'type' => 'password'
		)); ?>
	</div>
	<button type="submit" class="btn btn-primary btn-lg"><?= __('Register'); ?></button>
	<a href="<?= $this->Html->url('/users/login', true); ?>" class="btn btn-link"><?= __('Login'); ?></a>
<?php echo $this->Form->end(); ?>
