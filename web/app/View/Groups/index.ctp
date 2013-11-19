<?php

// Breadcrumbs
$this->Html->addCrumb('Groups', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?= $this->Html->url(array('controller' => 'groups', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New group <i class="fa icon-plus"></i></a>
			</p>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th class="icon">Users</th>
				        <th class="icon">Apps</th>
				        <th class="name">Name</th>
				    </tr>
				</thead>
				<tbody>
					<!--
					TODO: Plan group for all users properly
					<tr>
				        <td class="icon"><span class="label label-<?= $labelType; ?>"><?= $menuCounts['users']; ?></span></td>
				        <td class="icon"><span class="label label-<?= $labelType; ?>"><?= $menuCounts['applications']; ?></span></td>
				        <td class="name">
				            Every user<br />
				            <small>(Define apps for all users)</small>
				        </td>
				        <td class="edit">
				        	<a href="<?= $this->Html->url(array('controller' => 'groups', 'action' => "edit", 0, 'all')); ?>">
				        		<i class="fa icon-edit"><span> Edit</span></i>
				        	</a>
				        </td>
				    </tr>
				    -->
				    <?php if (!empty($groups)) foreach ($groups as $group) { ?>
				    <tr class="clickable">
				        <td class="icon"><span class="label label-default"><?= count($group['User']); ?></span></td>
				        <td class="icon"><span class="label label-default"><?= count($group['Application']); ?></span></td>
				        <td class="name">
							<!-- Begin Edit & delete buttons -->
							<?= $this->element('Admin/Tables/edit', array('controller'=>'groups', 'item'=>$group['Group'])); ?>
							<!-- End Edit & delete buttons -->
				            <?= $this->Html->link($group['Group']['name'], array('controller' => 'groups', 'action' => 'view', $group['Group']['id'], TextHelper::safeText($group['Group']['name'])), array('class' => 'view')); ?><br />
				            <small><?php if (strlen($group['Group']['description']) > 2) echo '('.$group['Group']['description'].')'; ?></small>
				        </td>
				    </tr>
				    <?php
				    }
				    else {
				    ?>
					<tr>
						<td colspan="4" height="120" valign="middle" align="center" class="empty-cell">
							<p style="margin-top:45px;">No groups were found.</p>
						</td>
					</tr>
				    <?php
				    }
				    unset($groups);
				    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>