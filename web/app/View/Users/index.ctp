<?php

// Breadcrumbs
$this->Html->addCrumb('Users', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New user <i class="fa icon-plus"></i></a>
			</p>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th class="icon">&nbsp;</th>
				        <th class="name">User</th>
				    </tr>
				</thead>
				<tbody>
				    <?php
				    foreach ($users as $user) {
				    	$user = $user['User'];
				    ?>
				    <tr class="clickable">
				        <td class="icon">
					        <img src="<?= $user['gravatar_url']; ?>?s=56" alt="<?= $user['lastname'].', '.$user['firstname']; ?>" />
				        </td>
				        <td class="name">
				        	<?php if ($user['role'] != 'owner') { ?>
							<!-- Begin Edit & delete buttons -->
							<?= $this->element('Admin/Tables/edit', array('controller'=>'users', 'item'=>$user, 'name'=>$user['firstname'].' '.$user['lastname'])); ?>
							<!-- End Edit & delete buttons -->
				        	<?php } ?>
				            <?php
				            echo $this->Html->link($user['lastname'].', '.$user['firstname'], array('controller' => 'users', 'action' => 'view', $user['id'], $user['username']), array('class' => 'view'));
				            if ($user['role'] != 'owner') {
					            echo '<small>('.__('Owner').')</small>';
					        }
				            ?><br />
				            <small>Email <?php if (strlen($user['email']) > 2) echo '<a href="mailto:'.$user['email'].'" title="Email user '.$user['firstname'].' '.$user['lastname'].'">'.$user['email'].'</a>'; ?></small>
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