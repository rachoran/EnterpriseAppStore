<form action="<?= $this->Html->url('/install/database', true); ?>" method="post">
	<h3 class="form-title form-title-first"><i class="icon-archive"></i> <?= __('Installation').' - '.__('Database'); ?> (3 / 4)</h3>
	
	<p>Here goes your database settings.</p>
	
	<div class="form-group">
		<label><?= __('Username'); ?></label>
		<input type="text" name="name" placeholder="db_user683" value="" class="form-control" />
	</div>
	<div class="form-group">
		<label><?= __('Password'); ?></label>
		<input type="text" name="password" placeholder="mySup3rS3cr3tP4ssw0rd" value="" class="form-control" />
	</div>
	<div class="form-group">
		<label><?= __('Host'); ?></label>
		<input type="text" name="host" placeholder="localhost" value="" class="form-control" />
	</div>
	
	<div class="form-group">
		<label><?= __('Database name'); ?></label>
		<input type="text" name="dbname" placeholder="corporate_appstore_db" value="" class="form-control" />
	</div>
	
	<p>&nbsp;</p>
	
	<p>Ok, so the database configuration file is not writable. You'll have to create it yourself. Please copy the following code into your clipboard and paste it into a file in <strong>/app/Config/</strong> called <strong>database.php</strong>.</p>
	<div class="form-group">
		<label><?= __('Database config'); ?></label>
		<textarea readonly="readonly" class="form-control" style="height:300px;">&lt;?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'enterpriseappstore',
	);
	
}
		</textarea>
	</div>
	
	
	<p>
		<a href="<?= $this->Html->url('/install/permissions', true); ?>" title="<?= __('Previous step'); ?>" class="btn btn-default"><?= __('Back'); ?></a>
		<button class="btn btn-primary pull-right"><?= __('Test'); ?></button>
	</p>
</form>