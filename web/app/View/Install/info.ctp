<h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('Compatibility test'); ?> (1 / 4)</h3>

<p>Following will show you what features will be available to you based on your server configuration.</p>

<table class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th>Feature</th>
			<th width="10%" align="center">Result</th>
		</tr>
	</thead>
	<tbody>
		<? 
		foreach ($data['tests'] as $test) {
			$icon = ($test[1] ? 'check' : 'exclamation-sign');
			$color = ($test[1] ? '#85B200' : ((bool)$test[2] ? '#FF9326' : '#D90000'));
		?>
		<tr>
			<td><i class="icon-info-sign"></i> &nbsp; <?= $test[0]; ?></td>
			<td align="center"><strong style="color:<?= $color; ?>;"><i class="icon-<?= $icon; ?>"></i></strong></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<p>&nbsp;</p>

<p>
	<a href="<?= $this->Html->url('/install', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
	<a href="<?= $data['result'] ? $this->Html->url('/install/permissions', true) : '#'; ?>" title="<?= __('Next step'); ?>" class="btn btn-primary pull-right<?php if (!$data['result']) echo ' disabled'; ?>"><?= __('Next'); ?></a>
</p>