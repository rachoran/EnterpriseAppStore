<?php

if (!isset($signing['Signing'])) $signing['Signing'] = array('id'=>0, 'name'=>'', 'password'=>'');
$id = (int)$signing['Signing']['id'];

// Breadcrumbs
$this->Html->addCrumb('Signing', '/signing');
$this->Html->addCrumb((empty($group['Signing']['name']) ? 'Create signing' : $group['Signing']['name']), null);


?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array("controller" => "signing", "action" => "edit", $signing['Signing']['id'], $signing['Signing']['name'])); ?>" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-certificate"></i> <?php echo $id ? 'Edit signing "'.$signing['Signing']['name'].'"' : 'Create signing'; ?></h3>
				<div class="form-group">
					<label class="col-md-4 control-label">Signing name</label>
					<div class="col-md-8">
						<input type="text" name="formData[name]" class="form-control" placeholder="My Company Enterprise Profile" value="<?= $signing['Signing']['name']; ?>" autocomplete="off" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Certificate</label>
					<div class="col-md-8">
						<input type="file" name="formFile[certificate]" class="form-control" accept="application/x-pkcs12" />
						<small><?= !empty($signing['Signing']['certificate']) ? 'Currently <strong>'.$signing['Signing']['certificate'].'</strong>, a' : 'A'; ?>ccepts only .p12 files</small>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Certificate Password</label>
					<div class="col-md-8">
						<input type="password" name="formData[password]" class="form-control" placeholder="mySup3rS3cr3tP4ssw0rd" autocomplete="off" value="<?= !empty($signing['Signing']['name']) ? 'password' : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Provisioning profile</label>
					<div class="col-md-8">
						<input type="file" name="formFile[provisioning]" class="form-control" />
						<small><?= !empty($signing['Signing']['provisioning']) ? 'Currently <strong>'.$signing['Signing']['provisioning'].'</strong>, a' : 'A'; ?>ccepts only .mobileprovision files</small>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<input type="hidden" name="formData[id]" value="<?php echo $id; ?>" />
						<a href="<?php echo $this->Html->url('/signing', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>