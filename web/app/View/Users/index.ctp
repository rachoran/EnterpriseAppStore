<?php

// Breadcrumbs
$this->Html->addCrumb('Users', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New user <i class="fa icon-plus"></i></a>
			</p>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th class="icon">&nbsp;</th>
				        <th class="name">User</th>
				        <th class="edit">Edit</th>
				    </tr>
				</thead>
				<tbody>
				    <?php foreach ($users as $user) { ?>
				    <tr>
				        <td class="icon">
					        <img src="<?php echo $user['User']['gravatar_url']; ?>?s=56" alt="<?php echo $user['User']['fullname']; ?>" />
				        </td>
				        <td class="name">
				            <?php echo $this->Html->link($user['User']['fullname'], array('controller' => 'users', 'action' => 'view', $user['User']['id'], $user['User']['username'])); ?><br />
				            <small>Email <?php if (strlen($user['User']['email']) > 2) echo '<a href="mailto:'.$user['User']['email'].'" title="Email user '.$user['User']['fullname'].'">'.$user['User']['email'].'</a>'; ?></small>
				        </td>
				        <td class="edit">
				        	<a href="<?php echo $this->Html->url(array("controller" => 'users', 'action' => 'edit', $user['User']['id'], $user['User']['username'])); ?>">
				        		<i class="fa icon-edit"><span> Edit</span></i>
				        	</a>
				        	<?php
				        	if ($user['User']['role'] != 'owner') {
				        	?>
				        	<br />
				        	<a href="<?php echo $this->Html->url(array("controller" => 'users', 'action' => 'delete', $user['User']['id'], $user['User']['username'])); ?>" onclick="return env.confirmation('Are you sure you want to delete user <?php echo $user['User']['fullname']; ?>?');">
				        		<i class="fa icon-ban-circle"><span> Delete</span></i>
				        	</a>
				        	<?php
				        	}
				        	?>
				        </td>
				    </tr>
				    <?php
				    }
				    unset($users);
				    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>