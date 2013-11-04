<?php

if (!isset($user['Application'])) $user['Application'] = array('id'=>0, 'name'=>null, 'identifier'=>null, 'version'=>null, 'author'=>null, 'description'=>null);
$id = (int)$user['Application']['id'];

// Breadcrumbs
$this->Html->addCrumb('Applications', '/applications');
$this->Html->addCrumb((empty($user['Application']['name']) ? 'Add user' : $user['Application']['name']), null);

$s = null;

function verVal($key, $data) {
	return isset($data[$key]) ? $data[$key] : '';
}

function verValCh($key, $data) {
	return isset($data[$key]) ? 'checked="checked"' : '';
}

?>
<form action="<?php echo $this->Html->url(array("controller" => "applications", "action" => "edit", $user['Application']['id'], $user['Application']['name'])); ?>" method="post" role="form" class="form-horizontal">
	<div class="widget">
	    <ul class="nav nav-tabs">
	        <li class="active"><a href="#tab_application_basic" data-toggle="tab">Basic info</a></li>
	        <li><a href="#tab_application_screenshots" data-toggle="tab">Screenshots</a></li>
	        <li><a href="#tab_application_groupncats" data-toggle="tab">Groups &amp; Categories</a></li>
	        <li><a href="#tab_application_attachments" data-toggle="tab">Attachments</a></li>
	        <li><a href="#tab_application_other" data-toggle="tab">Other</a></li>
	    </ul>
	    <div class="tab-content bottom-margin">
			<div class="tab-pane active" id="tab_application_basic">
				<div class="padded">
					<div class="form-group">
						<label class="col-md-4 control-label">Application name</label>
						<div class="col-md-8">
							<input type="text" name="appData[name]" class="form-control" placeholder="iApplication" value="<?php echo $user['Application']['name']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Application icon</label>
						<div class="col-md-7">
							<input type="file" name="formFile[name]" class="form-control" />
						</div>
						<div class="col-md-1">
							<img src="<?php echo $this->Html->url('/', true); ?>Userfiles/Settings/Images/Icon?time=<?php echo time(); ?>" alt="Company logo" class="logo" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Application identifier</label>
						<div class="col-md-8">
							<input type="text" name="appData[identifier]" class="form-control" placeholder="com.example.myApp" value="<?php echo $user['Application']['identifier']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Application binary</label>
						<div class="col-md-8">
							<input type="file" name="formFile[name]" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Version number</label>
						<div class="col-md-8">
							<input type="text" name="appData[version]" class="form-control" placeholder="1.2.3" value="<?php echo $user['Application']['version']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Author</label>
						<div class="col-md-8">
							<input type="text" name="formData[name]" class="form-control" placeholder="My Company" value="<?php echo $user['Application']['author']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Description</label>
						<div class="col-md-8">
							<textarea type="text" name="formData[description]" class="form-control description" placeholder="App description"><?php echo verVal('description', $s); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-8">
							<input type="hidden" name="userData[id]" value="<?php echo $id; ?>" />
							<a href="<?php echo $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
							<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
							<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_application_screenshots">
				<div class="padded">
					<div class="form-group">
						<div class="col-md-offset-4 col-md-8">
							<a href="<?php echo $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
							<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
							<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_application_groupncats">
				<div class="padded">
					<div class="form-group">
						<div class="col-md-6">
							<p><label class="control-label">Select groups</label></p>
							<!-- Begin user selector -->
							<?php echo $this->element('DB/groupSelector', array('tableName'=>'selectedGroups')); ?>
							<!-- End user selector -->
						</div>
						<div class="col-md-6">
							<p><label class="control-label">Select categories</label></p>
							<!-- Begin user selector -->
							<?php echo $this->element('DB/categorySelector', array('tableName'=>'selectedCats')); ?>
							<!-- End user selector -->
						</div>
						<div class="col-md-offset-4 col-md-8">
							<a href="<?php echo $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
							<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
							<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_application_attachments">
				<div class="padded">
					<div class="form-group">
						<div class="col-md-offset-4 col-md-8">
							<a href="<?php echo $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
							<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
							<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_application_other">
				<div class="padded">
					<div class="form-group">
						<div class="col-md-offset-4 col-md-8">
							<a href="<?php echo $this->Html->url('/applications', true); ?>" class="btn btn-default">Cancel</a>
							<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
							<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</form>
