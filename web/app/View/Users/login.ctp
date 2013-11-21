<?php echo $this->Form->create('User', array('role'=>'form')); ?>
	<h3 class="form-title form-title-first"><i class="icon-lock"></i> <?= __('Login'); ?> </h3>
	<div class="form-group">
		<label><?= __('Username'); ?></label>
		<?= $this->Form->input('username', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'johndoe3330'
		)); ?>
	</div>
	<div class="form-group">
		<label><?= __('Password'); ?></label>
		<?= $this->Form->input('password', array(
			'label' => false,
			'class' => 'form-control',
			'placeholder' => 'mySup3rS3cr3tP4ssw0rd'
		)); ?>
	</div>
	<div class="form-group">
		<div class="checkbox">
			<label>
				<?= $this->Form->checkbox('remember_me'); ?> Remember me for 1 day
			</label>
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-lg"><?= __('Sign in'); ?></button>
	<?php if (!$disableRegistration) { ?>
	<a href="<?= $this->Html->url('/users/register', true); ?>" class="btn btn-link"><?= __('Register'); ?></a>
	<?php } ?>
<?php echo $this->Form->end(); ?>
