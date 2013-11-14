<?php

function yesNo($ok, $no='NO') {
	return $ok ? '<strong style="color:#85B200;"><i class="icon-check"></i></strong>' : '<strong style="color:#D90000;"><i class="icon-exclamation-sign"></i></strong>';
}

function yesNoWarning($ok, $no='NO') {
	return $ok ? '<strong style="color:#85B200;"><i class="icon-check"></i></strong>' : '<strong style="color:#FF9326;"><i class="icon-exclamation-sign"></i></strong>';
}

$canDownloadFile = (bool)@file_get_contents('https://s3-eu-west-1.amazonaws.com/ridiculousenterpriseappstore/test.txt');

?><h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('Compatibility test'); ?> (1 / 4)</h3>

<p>Following will show you what features will be available to you based on your server configuration.</p>

<table class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th>Feature</th>
			<th width="10%" align="center">Result</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><i class="icon-info-sign"></i> &nbsp; iOS resigning</td>
			<td align="center"><?= yesNoWarning(preg_match('/Mac\ OS\ X/si', $_SERVER['HTTP_USER_AGENT']), 'Mac only'); ?></td>
		</tr>
		<tr>
			<td><i class="icon-info-sign"></i> &nbsp; Android resigning</td>
			<td align="center"><?= yesNoWarning(shell_exec('jarsigner'), 'No'); ?></td>
		</tr>
		<tr>
			<td><i class="icon-info-sign"></i> &nbsp; Amazon S3 storage</td>
			<td align="center"><?= yesNoWarning($canDownloadFile, 'Needs internet'); ?></td>
		</tr>
		<tr>
			<td><i class="icon-info-sign"></i> &nbsp; SMS notifications</td>
			<td align="center"><?= yesNoWarning($canDownloadFile, 'Needs internet'); ?></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>
	<a href="<?= $this->Html->url('/install', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
	<a href="<?= $this->Html->url('/install/permissions', true); ?>" title="<?= __('Next step'); ?>" class="btn btn-primary pull-right"><?= __('Next'); ?></a>
</p>