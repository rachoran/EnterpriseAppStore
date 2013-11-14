<h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('Permissions'); ?> (2 / 4)</h3>

<p>Now you have to set some basic folder permissions. System needs to have a write access some folders where it saves your applications, configuration, etc ... Unfortunately you won't be able to continue as long as there is any path marked in red.</p>

<p>Regarding the database configuration file, you don't have to make it writable but than, you'll have to edit the file manually.</p>

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
	<a href="<?= $this->Html->url('/install/info', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
	<a href="<?= $data['result'] ? $this->Html->url('/install/databse', true) : '#'; ?>" title="<?= __('Next step'); ?>" class="btn btn-primary pull-right<?php if (!$data['result']) echo ' disabled'; ?>"><?= __('Next'); ?></a>
</p>