<?php

// Breadcrumbs
$this->Html->addCrumb('Settings', null);

$s = isset($settings) ? $settings : NULL;

function verVal($key, $settings) {
	return isset($settings[$key]) ? $settings[$key] : '';
}

function verValCh($key, $settings) {
	return isset($settings[$key]) ? 'checked="checked"' : '';
}

?>
<div class="widget">
	<form action="<?php echo $this->Html->url(array("controller" => "settings", "action" => "index")); ?>" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
		<div class="accordion" id="accordion2">
			<button type="submit" name="save" class="btn btn-primary pull-right save">Save</button>
			<div class="accordion-group widget-content-white glossed" style="clear:both;">
				<div class="padded">
					
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#company-information">
							<h3 class="form-title form-title-first"><i class="icon-hand-right"></i> Company information</h3>
						</a>
					</div>
					<div id="company-information" class="accordion-body collapse in">
						<div class="accordion-inner">
							<div class="form-group">
								<label class="col-md-3 control-label">Server name</label>
								<div class="col-md-9">
									<input type="text" name="settings[companyServerName]" class="form-control" placeholder="Name of this site / app" value="<?php echo verVal('companyServerName', $s); ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Company name</label>
								<div class="col-md-9">
									<input type="text" name="settings[companyName]" class="form-control" placeholder="Company name" value="<?php echo verVal('companyName', $s); ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Logo</label>
								<div class="col-md-7">
									<input type="file" name="file[logo]" class="form-control" accept="image/*"  />
								</div>
								<div class="col-md-2">
									<img src="<?php echo $this->Html->url('/', true); ?>Userfiles/Settings/Images/Logo?time=<?php echo time(); ?>" alt="Company logo" class="logo" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Touch icon</label>
								<div class="col-md-8">
									<input type="file" name="file[icon]" class="form-control" accept="image/*"  />
								</div>
								<div class="col-md-1">
									<img src="<?php echo $this->Html->url('/', true); ?>Userfiles/Settings/Images/Icon?time=<?php echo time(); ?>" alt="Company logo" class="logo" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Support email</label>
								<div class="col-md-9">
									<input type="text" name="settings[companySupportEmail]" class="form-control" placeholder="support@my-company.com" value="<?php echo verVal('companySupportEmail', $s); ?>" />
									<input type="checkbox" name="settings[companySupportEmailSendDeviceNotifications]"<?php echo verValCh('companySupportEmailSendDeviceNotifications', $s); ?> /> <span>Send email to this email address when a new device is registered</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Description</label>
								<div class="col-md-9">
									<textarea type="text" name="settings[companyDescription]" class="form-control description" placeholder="Company description"><?php echo verVal('companyDescription', $s); ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="accordion-group widget-content-white glossed">
				<div class="padded">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#invitation-message">
							<h3 class="form-title form-title-first"><i class="icon-envelope-alt"></i> Invitation message</h3>
						</a>
					</div>
					<div id="invitation-message" class="accordion-body collapse in">
						<div class="accordion-inner">
							<div class="form-group">
								<label class="col-md-3 control-label">User Invitation template</label>
								<div class="col-md-9">
									<textarea type="text" name="settings[invitationUserTemplate]" class="form-control description large" placeholder="HTML for user invitation email"><?php echo verVal('invitationUserTemplate', $s); ?></textarea>
									<a href="#" title="" onclick="return env.confirmation('Are you sure you want to revert to the original message?');">Reset to original template</a>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">MDM Enrollment Message</label>
								<div class="col-md-9">
									<textarea type="text" name="settings[invitationMDMTemplate]" class="form-control description large" placeholder="HTML for MDM invitation email"><?php echo verVal('invitationMDMTemplate', $s); ?></textarea>
									<a href="#" title="" onclick="return env.confirmation('Are you sure you want to revert to the original message?');">Reset to original template</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
						
			<div class="accordion-group widget-content-white glossed">
				<div class="padded">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#user-self-registration">
							<h3 class="form-title form-title-first"><i class="icon-lock"></i> User Self-Registration</h3>
						</a>
					</div>
					<div id="user-self-registration" class="accordion-body collapse in">
						<div class="accordion-inner">
							<div class="form-group">
								<label class="col-md-3 control-label">Allow user registrations</label>
								<div class="col-md-9">
									<input type="checkbox" name="settings[sefRegAllow]"<?php echo verValCh('sefRegAllow', $s); ?> /> <span>Allow users to register without an invitation</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Email Domain Whitelist</label>
								<div class="col-md-9">
									<textarea type="text" name="settings[sefRegDomains]" id="sefRegDomains" class="form-control description" placeholder="my-company.co.uk"><?php echo verVal('sefRegDomains', $s); ?></textarea>
									<small>Place multiple domain entries each on a separate line, leave empty to keep this feature disabled</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<button type="submit" name="save" class="btn btn-primary pull-right save">Save</button>			
		</div>
	</form>
</div>