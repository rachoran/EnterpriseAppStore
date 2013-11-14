<h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('SUCCESS'); ?> (4 / 4)</h3>

<h4><?= __('Congratulations'); ?></h4>

<p><?= __('You have successfully installed Enterprise AppStore.'); ?></p>

<p>&nbsp;</p>

<p>
	<a href="<?= $this->Html->url('/install/database', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
	<a href="<?= $this->Html->url('/users/login', true); ?>" title="<?= __('Login'); ?>" class="btn btn-success pull-right"><?= __('Login to the system'); ?></a>
</p>