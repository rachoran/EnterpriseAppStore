<?php

function yesNo($ok, $no='NO') {
	return $ok ? '<strong style="color:#85B200;"><i class="icon-check"></i></strong>' : '<strong style="color:#D90000;"><i class="icon-exclamation-sign"></i></strong>';
}

function yesNoWarning($ok) {
	return $ok ? '<strong style="color:#85B200;"><i class="icon-check"></i></strong>' : '<strong style="color:#FF9326;"><i class="icon-exclamation-sign"></i></strong>';
}

?><h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('Permissions'); ?> (2 / 4)</h3>

<p>Now you have to set some basic folder permissions. System needs to have a write access some folders where it saves your applications, configuration, etc ... Unfortunately you won't be able to continue as long as there is any path marked in red.</p>

<p>Regarding the database configuration file, you don't have to make it writable but than, you'll have to edit the file manually.</p>

<table class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th>Location</th>
			<th width="20%">Result</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>/app/tmp/</td>
			<td><?= yesNo(preg_match('/Mac\ OS\ X/si', $_SERVER['HTTP_USER_AGENT'])); ?></td>
		</tr>
		<tr>
			<td>/app/Userfiles/</td>
			<td><?= yesNo(false); ?></td>
		</tr>
		<tr>
			<td>/app/webroot/Userfiles/</td>
			<td><?= yesNo((bool)@file_get_contents('https://s3-eu-west-1.amazonaws.com/ridiculousenterpriseappstore/test.txts')); ?></td>
		</tr>
		<tr>
			<td>/app/Config/database.php</td>
			<td><?= yesNoWarning((bool)@file_get_contents('https://s3-eu-west-1.amazonaws.com/ridiculousenterpriseappstore/test.txts')); ?></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>
	<a href="<?= $this->Html->url('/install/info', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
	<a href="<?= $this->Html->url('/install/database', true); ?>" title="<?= __('Next step'); ?>" class="btn btn-primary pull-right"><?= __('Installation'); ?></a>
</p>