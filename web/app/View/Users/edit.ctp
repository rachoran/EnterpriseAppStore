<?php

if (!isset($user['User'])) $user['User'] = array('id'=>0, 'username'=>'', 'fullname'=>'', 'password'=>'', 'email'=>'', 'role'=>'user');
$id = (int)$user['User']['id'];

// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb((empty($user['User']['fullname']) ? 'Add user' : $user['User']['fullname']), null);

$changePassword = ($id) ? 'Change ' : '';

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array("controller" => "users", "action" => "edit", $user['User']['id'], $user['User']['fullname'])); ?>" method="post" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-user"></i> <?php echo $id ? 'Edit user "'.$user['User']['fullname'].'"' : 'Create user'; ?></h3>
				<div class="form-group">
					<label class="col-md-4 control-label">User name</label>
					<div class="col-md-8">
						<input type="text" name="userData[username]" class="form-control" placeholder="joedoe3330" value="<?php echo $user['User']['username']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Full Name</label>
					<div class="col-md-8">
						<input type="text" name="userData[fullname]" class="form-control" placeholder="John Doe" value="<?php echo $user['User']['fullname']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Email</label>
					<div class="col-md-8">
						<input type="text" name="userData[email]" class="form-control" placeholder="john.doe@example.com" value="<?php echo $user['User']['email']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label"><?php echo $changePassword; ?>Password</label>
					<div class="col-md-8">
						<input type="password" name="userData[password]" class="form-control" placeholder="mySup3rS3cr3tP4ssw0rd" value="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Verify Password</label>
					<div class="col-md-8">
						<input type="password" name="userData[password2]" class="form-control" placeholder="mySup3rS3cr3tP4ssw0rd" value="" />
					</div>
				</div>
				<?php
				if ($user['User']['role'] == 'owner') {
				?>
				<div class="form-group">
					<label class="col-md-4 control-label">Role</label>
					<div class="col-md-8">
						<select class="form-control" name="userData[role]">
							<option value="user">User</option>
							<option value="developer">Developer</option>
							<option value="admin">Administrator</option>
						</select>
					</div>
				</div>
				<?php
				}
				?>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<!-- Begin user selector -->
						<?php echo $this->element('DB/groupSelector', array('tableName'=>'selectedGroups')); ?>
						<!-- End user selector -->
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<input type="hidden" name="userData[id]" value="<?php echo $id; ?>" />
						<a href="<?php echo $this->Html->url('/users', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>