<form action="<?= $this->Html->url('/install/database', true); ?>" method="post">
	<h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('Database'); ?> (3 / 4)</h3>
	
	<p>Here goes your database settings.</p>
	
	<div class="form-group">
		<label><?= __('Username'); ?></label>
		<input type="text" name="db[login]" placeholder="db_user683" value="<?= $db['login']; ?>" class="form-control" />
	</div>
	<div class="form-group">
		<label><?= __('Password'); ?></label>
		<input type="text" name="db[password]" placeholder="mySup3rS3cr3tP4ssw0rd" value="<?= $db['password']; ?>" class="form-control" />
	</div>
	<div class="form-group">
		<label><?= __('Host'); ?></label>
		<input type="text" name="db[host]" placeholder="localhost" value="<?= $db['host']; ?>" class="form-control" />
	</div>
	
	<div class="form-group">
		<label><?= __('Database name'); ?></label>
		<input type="text" name="db[database]" placeholder="corporate_appstore_db" value="<?= $db['database']; ?>" class="form-control" />
	</div>
	
	<!--<div class="form-group">
		<label><?= __('Install test tables'); ?></label>
		<input type="checkbox" name="db[test]" value="1"<?= isset($db['test']) ? ' checked="checked"' : ''; ?> class="form-control" />
	</div>-->
	
	<p>&nbsp;</p>
	
	<?php
	if ($dbOk && $dbFileNotWritable) {
	?>
	<p>Ok, so the database configuration file is not writable. You'll have to create it yourself. Please copy the following code into your clipboard and paste it into a file in <strong>/app/Config/</strong> called <strong>database.php</strong>.</p>
	<div class="form-group">
		<label><?= __('Database config'); ?></label>
		<textarea readonly="readonly" class="form-control" style="height:320px;">&lt;?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '<?= $db['host']; ?>',
		'login' => '<?= $db['login']; ?>',
		'password' => '<?= $db['password']; ?>',
		'database' => '<?= $db['database']; ?>',
		//'unix_socket' => '/var/mysql/mysql.sock', // Might be needed if the mysql socket is not set properly
	);
	
}</textarea>
	</div>
	<div class="form-group">
		<div class="alert alert-warning">
			<strong>Warning!!!</strong> Do not press install &amp; Next until you create the database.php configuration file!!!
		</div>
	</div>
	<?php } ?>
	
	
	<p>
		<a href="<?= $this->Html->url('/install/permissions', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
		<?php
		if (!$dbOk) {
		?>
		<input type="hidden" name="go" value="0" />
		<button class="btn btn-primary pull-right"><?= __('Test'); ?></button>
		<?php
		}
		else {
		?>
		<input type="hidden" name="go" value="1" />
		<button class="btn btn-success pull-right"><?= __('Install &amp; Next'); ?></button>
		<?php
		}
		?>
	</p>
</form>