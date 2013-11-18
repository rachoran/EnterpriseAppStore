<?php

$data = isset($data['Apikey']) ? $data['Apikey'] : null;
$id = isset($data['id']) ? (int)$data['id'] : 0;

// Breadcrumbs
$this->Html->addCrumb('API Keys', '/apikeys');
$this->Html->addCrumb((empty($data['name']) ? 'Create key' : $data['name']), null);


?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<?php
			echo $this->Form->create('Apikey', array(
				'role' => 'form',
				'class' => 'form-horizontal'
			));
			?>
			<h3 class="form-title form-title-first"><i class="icon-group"></i> <?php echo (bool)$id ? 'Edit key "'.$data['name'].'"' : 'Create new key'; ?></h3>
			<div class="form-group">
				<label class="col-md-4 control-label">Name</label>
				<div class="col-md-8">
					<?php
					echo $this->Form->input('name', array(
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'Key name'
					));
					?>
				</div>
				<?php
				if ($id) {
				?>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">API key</label>
				<div class="col-md-8">
					<input type="text" value="<?= $data['key']; ?>" readonly="readonly" class="form-control" onclick="this.select();" />	
				</div>
				<?php } ?>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-8">
					<a href="<?php echo $this->Html->url('/apikeys', true); ?>" class="btn btn-default">Cancel</a>
					<?php if ((bool)$id) echo '<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>'; ?>
					<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
				</div>
			</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>