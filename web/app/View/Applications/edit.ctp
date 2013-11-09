<?php

if (!isset($data['Application'])) $data['Application'] = array('id'=>0, 'name'=>null, 'identifier'=>null, 'url'=>null, 'version'=>null, 'sort'=>1000, 'description'=>null, 'config'=>null);
$id = (int)$data['Application']['id'];

// Breadcrumbs
$this->Html->addCrumb('Applications', '/applications');
$this->Html->addCrumb((empty($data['Application']['name']) ? 'Add user' : $data['Application']['name']), null);

$s = json_decode($data['Application']['config'], true);

function verVal($key, $data) {
	return isset($data[$key]) ? $data[$key] : '';
}

function verValCh($key, $data) {
	return isset($data[$key]) ? 'checked="checked"' : '';
}

?>
<form id="mainAppForm" action="<?= $this->Html->url(array("controller" => "applications", "action" => "edit", $data['Application']['id'], $data['Application']['name'])); ?>" method="post" role="form" class="form-horizontal">
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
							<select name="appData[appType]" id="appTypeSwitch" class="form-control">
								<option value="0">Native mobile app (.ipa or .apk)</option>
								<option value="1">iTunes or Google Play link</option>
								<option value="2">Mobile Web</option>
								<!-- <option value="3">iOS Web Clip</option> -->
							</select>
						</div>
					</div>
					<div class="form-group type0 type1 type2">
						<label class="col-md-4 control-label">Application name</label>
						<div class="col-md-8">
							<input id="appName" type="text" name="appData[name]" class="form-control disabled" placeholder="iApplication" value="<?= $data['Application']['name']; ?>" />
						</div>
					</div>
					<div class="form-group type1 type2">
						<label class="col-md-4 control-label">Application url</label>
						<div class="col-md-8">
							<input id="appUrl" type="text" name="appData[url]" class="form-control disabled" placeholder="" value="<?= $data['Application']['url']; ?>" />
						</div>
					</div>
					<div class="form-group type0 type1 type2">
						<label class="col-md-4 control-label">Application icon</label>
						<div class="col-md-7">
							<input type="file" name="formFile[icon]" class="form-control disabled beforeUpload" />
						</div>
						<div class="col-md-1">
							<!--<img src="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Icon?time=<?= time(); ?>" alt="Application logo" class="logo" />-->
							<img src="<?= Storage::urlForIconForAppWithId($data['Application']['id'], $data['Application']['location']).'?t='.time(); ?>" alt="<?php echo $data['Application']['name']; ?>" class="logo" />
						</div>
					</div>
					<div class="form-group type0">
						<label class="col-md-4 control-label">Application identifier</label>
						<div class="col-md-8">
							<input id="appIdentifier" type="text" name="appData[identifier]" class="form-control disabled" placeholder="com.example.myApp" value="<?= $data['Application']['identifier']; ?>" />
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
							<input id="appVersion" type="text" name="appData[version]" class="form-control disabled" placeholder="1.2.3" value="<?= $data['Application']['version']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Author</label>
						<div class="col-md-8">
							<input type="text" name="formData[author]" class="form-control disabled beforeUpload" placeholder="My Company" value="<?= verVal('author', $s); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Description</label>
						<div class="col-md-8">
							<textarea id="wqefcqwrfqrfq" type="text" name="formData[description]" class="form-control description disabled beforeUpload" placeholder="App description"><?= verVal('description', $s); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-8">
							<input id="appId" type="hidden" name="appData[id]" value="<?= $id; ?>" />
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
						<div class="image">
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
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Screenshot 1</label>
						<div class="col-md-7">
							<input type="file" name="formFile[name]" class="form-control" />
						</div>
						<div class="col-md-1">
							<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 1" class="logo" />
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
							<?= $this->element('DB/groupSelector', array('tableName'=>'selectedGroups')); ?>
							<!-- End user selector -->
						</div>
						<div class="col-md-6">
							<p><label class="control-label">Select categories</label></p>
							<!-- Begin user selector -->
							<?= $this->element('DB/categorySelector', array('tableName'=>'selectedCats')); ?>
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
							<input type="text" name="appData[sort]" class="form-control disabled beforeUpload" placeholder="Higher number = higher in the list, default 1000" value="<?= $data['Application']['sort']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Application is enabled</label>
						<div class="col-md-1">
							<input type="checkbox" name="formData[enabled]" class="form-control disabled beforeUpload"<?= verValCh('enabled', $s); ?> value="1" />
						</div>
						<div class="col-md-7">
							<small style="color: #999;">Marking the app as enabled means that users will see it in their app catalog. Leave the Enabled checkbox empty if you want to update other app information before making it available to users.</small>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Direct download</label>
						<div class="col-md-1">
							<input type="checkbox" name="formData[directDownload]" class="form-control disabled beforeUpload"<?= verValCh('directDownload', $s); ?> value="1" />
						</div>
						<div class="col-md-7">
							<small style="color: #999;">Enabling the app for direct download allows users to install it on their devices via a direct download URL. You can find this URL on the app details page. Anyone who knows the direct download URL will be able to download and install the application without having to log in to the app catalog. Do not enable this feature if you want to restrict installation of this app to authenticated users only. <br />Note that when users install via direct download, they are not notified when an app update is added to the <?= $siteName; ?>.</small>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Mandatory</label>
						<div class="col-md-1">
							<input type="checkbox" name="formData[mandatory]" class="form-control disabled beforeUpload"<?= verValCh('mandatory', $s); ?> value="1" />
						</div>
						<div class="col-md-7">
							<small style="color: #999;">Marking the app as mandatory means that users will be forced to install it when they launch an app catalog.</small>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-md-4 control-label">Basic app</label>
						<div class="col-md-1">
							<input type="checkbox" name="formData[basicApp]" class="form-control disabled beforeUpload"<?= verValCh('basicApp', $s); ?> value="1" />
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
</form>
