<?php

$application = isset($this->request->data['Application']) ? $this->request->data['Application'] : null;

// Breadcrumbs
$this->Html->addCrumb('Applications', '/applications');
$this->Html->addCrumb((empty($application['name']) ? 'Add user' : $application['name']), null);

$config = json_decode($application['config'], true);

function verVal($key, $data) {
	return isset($data[$key]) ? $data[$key] : '';
}

function verValCh($key, $data) {
	return isset($data[$key]) ? 'checked="checked"' : '';
}

echo $this->Form->create('Application', array(
	'role' => 'form',
	'class' => 'form-horizontal',
	'id' => 'mainAppForm',
	'type' => 'file'
));
?>
<div class="widget">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_application_basic" data-toggle="tab">Basic info</a></li>
        <!-- <li><a href="#tab_application_screenshots" data-toggle="tab">Screenshots</a></li> -->
        <li><a href="#tab_application_permissions" data-toggle="tab">Permissions</a></li>
        <!-- <li><a href="#tab_application_attachments" data-toggle="tab">Attachments</a></li> -->
        <li><a href="#tab_application_other" data-toggle="tab">Other</a></li>
    </ul>
    <div class="tab-content bottom-margin">
		<div class="tab-pane active" id="tab_application_basic">
			<div class="padded">
				<div id="applicationTypeWrapper" class="form-group">
					<label class="col-md-4 control-label">Application type</label>
					<div class="col-md-8">
						<select name="data[Application][type]" id="appTypeSwitch" class="form-control">
							<option value="0"<?php if ($appType == 0) echo ' selected="selected"'; ?>>Native mobile app (.ipa or .apk)</option>
							<option value="1"<?php if ($appType == 1) echo ' selected="selected"'; ?>>iTunes or Google Play link</option>
							<option value="2"<?php if ($appType == 2) echo ' selected="selected"'; ?>>Mobile Web</option>
							<!-- <option value="3">iOS Web Clip</option> -->
						</select>
					</div>
				</div>
				<div class="form-group type0 type1 type2">
					<label class="col-md-4 control-label">Application name</label>
					<div class="col-md-8">
						<?php
						echo $this->Form->input('name', array(
							'label' => false,
							'id' => 'appName',
							'class'=>'form-control disabled',
							'placeholder'=>'MyApp',
							'readonly'=>true,
							'div'=>false
						));
						?>
					</div>
				</div>
				<div class="form-group type1 type2">
					<label class="col-md-4 control-label">Application url</label>
					<div class="col-md-8">
						<?php
						echo $this->Form->input('url', array(
							'label' => false,
							'id' => 'appUrl',
							'class'=>'form-control disabled',
							'required'=>false,
							'div'=>false
						));
						?>
					</div>
				</div>
				<div class="form-group type0 type1 type2">
					<label class="col-md-4 control-label">Application icon</label>
					<div class="col-md-7">
						<input type="file" name="iconFile" class="form-control disabled beforeUpload" />
					</div>
					<div class="col-md-1">
						<!--<img src="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Icon?time=<?= time(); ?>" alt="Application logo" class="logo" />-->
						<img src="<?= Storage::urlForIconForAppWithId($application['id'], $application['location']).'?t='.time(); ?>" alt="<?php echo $application['name']; ?>" class="logo" />
					</div>
				</div>
				<div class="form-group type0">
					<label class="col-md-4 control-label">Application identifier</label>
					<div class="col-md-8">
						<?php
						echo $this->Form->input('identifier', array(
							'label' => false,
							'id' => 'appIdentifier',
							'class'=>'form-control disabled',
							'placeholder'=>'com.example.myApp'
						));
						?>
					</div>
				</div>
				<div id="binaryUploadWrapper" class="form-group type0">
					<label class="col-md-4 control-label">Application binary</label>
					<div class="col-md-8">
						<input id="binaryUpload" type="file" name="appFile" class="form-control" /><br />
						<div id="binaryUploadProgress" class="progress">
							<div class="progress-bar progress-bar-success"></div>
						</div>
					</div>
				</div>
				<div class="form-group type0 type1 type2">
					<label class="col-md-4 control-label">Version number</label>
					<div class="col-md-8">
						<?php
						echo $this->Form->input('version', array(
							'label' => false,
							'class'=>'form-control disabled',
							'placeholder'=>'1.2.3'
						));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Author</label>
					<div class="col-md-8">
						<input type="text" name="formData[author]" class="form-control" placeholder="My Company" value="<?= verVal('author', $config); ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Short description</label>
					<div class="col-md-8">
						<textarea type="text" name="formData[description]" class="form-control description" placeholder="App description"><?= verVal('description', $config); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Full description</label>
					<div class="col-md-8">
						<textarea type="text" name="formData[fullDescription]" class="form-control description large" placeholder="App description"><?= verVal('fullDescription', $config); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<input id="appId" name="appId" type="hidden" value="<?= (int)$application['id']; ?>" />
						<a href="<?= $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right disabled">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right disabled">Apply</button>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane scrnsht" id="tab_application_screenshots">
			<div class="padded">
				<div class="screenshots">
					<!-- <div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 1" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 2" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 3" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 4" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 5" />
					</div> -->
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Screenshot 1</label>
					<div class="col-md-7">
						<input type="file" name="formFile[name]" class="form-control" />
					</div>
					<div class="col-md-1">
						<!-- <img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 1" class="logo" /> -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Screenshot 2</label>
					<div class="col-md-7">
						<input type="file" name="formFile[name]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Screenshot 3</label>
					<div class="col-md-7">
						<input type="file" name="formFile[name]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Screenshot 4</label>
					<div class="col-md-7">
						<input type="file" name="formFile[name]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Screenshot 5</label>
					<div class="col-md-7">
						<input type="file" name="formFile[name]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<a href="<?= $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right disabled">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right disabled">Apply</button>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_application_permissions">
			<div class="padded">
				<div class="form-group">
					<div class="col-md-6">
						<p><label class="control-label">Select groups</label></p>
						<!-- Begin user selector -->
						<?= $this->element('DB/groupSelector'); ?>
						<!-- End user selector -->
					</div>
					<div class="col-md-6">
						<p><label class="control-label">Select categories</label></p>
						<!-- Begin user selector -->
						<?= $this->element('DB/categorySelector'); ?>
						<!-- End user selector -->
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<a href="<?= $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right disabled">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right disabled">Apply</button>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_application_attachments">
			<div class="padded">
				<?php if (count($attachmentsList) > 0) { ?>
				<div class="form-group">
                    <label class="col-md-4 control-label">Existing attachments</label>
					<div class="col-md-8">
						<!-- Begin user selector -->
						<?= $this->element('DB/attachmentSelector', array('tableName'=>'selectedAtts')); ?>
						<!-- End user selector -->
                        <p>
                            <button type="submit" name="save" class="btn btn-danger pull-right">Delete selected</button>
                        </p>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="col-md-4 control-label">New attachment 1</label>
					<div class="col-md-8">
						<input type="file" name="attachments[0]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">New attachment 2</label>
					<div class="col-md-8">
						<input type="file" name="attachments[1]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">New attachment 3</label>
					<div class="col-md-8">
						<input type="file" name="attachments[2]" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<a href="<?= $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right disabled">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right disabled">Apply</button>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_application_other">
			<div class="padded">
				<div class="form-group">
					<label class="col-md-4 control-label">Sort</label>
					<div class="col-md-8">
						<?php
						echo $this->Form->input('sort', array(
							'label' => false,
							'class'=>'form-control',
							'placeholder'=>'Higher number = higher in the list, default 1000',
							'default' => 1000
						));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Application is enabled</label>
					<div class="col-md-1">
						<input type="checkbox" name="formData[enabled]" class="form-control"<?= verValCh('enabled', $config); ?> value="1" />
					</div>
					<div class="col-md-7">
						<small style="color: #999;">Marking the app as enabled means that users will see it in their app catalog. Leave the Enabled checkbox empty if you want to update other app information before making it available to users.</small>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Direct download</label>
					<div class="col-md-1">
						<input type="checkbox" name="formData[directDownload]" class="form-control"<?= verValCh('directDownload', $config); ?> value="1" />
					</div>
					<div class="col-md-7">
						<small style="color: #999;">Enabling the app for direct download allows users to install it on their devices via a direct download URL. You can find this URL on the app details page. Anyone who knows the direct download URL will be able to download and install the application without having to log in to the app catalog. Do not enable this feature if you want to restrict installation of this app to authenticated users only. <br />Note that when users install via direct download, they are not notified when an app update is added to the <?= $siteName; ?>.</small>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Mandatory</label>
					<div class="col-md-1">
						<input type="checkbox" name="formData[mandatory]" class="form-control"<?= verValCh('mandatory', $config); ?> value="1" />
					</div>
					<div class="col-md-7">
						<small style="color: #999;">Marking the app as mandatory means that users will be forced to install it when they launch an app catalog.</small>
					</div>
				</div>
                <div class="form-group">
					<label class="col-md-4 control-label">Basic app</label>
					<div class="col-md-1">
						<input type="checkbox" name="formData[basicApp]" class="form-control"<?= verValCh('basicApp', $config); ?> value="1" />
					</div>
					<div class="col-md-7">
						<small style="color: #999;">This app will be available to every user.</small>
					</div>
				</div>
                <p>&nbsp;</p>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<a href="<?= $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right disabled">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right disabled">Apply</button>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<?= $this->Form->end(); ?>
