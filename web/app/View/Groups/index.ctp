<p>
	<a href="<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New group <i class="fa icon-plus"></i></a>
</p>
<table class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	        <th class="icon">Users</th>
	        <th class="name">Name</th>
	        <th class="edit">Edit</th>
	    </tr>
	</thead>
	<tbody>
		<tr>
	        <td class="icon"><span class="label label-<?php echo $labelType; ?>">230</span></td>
	        <td class="name">
	            <?php echo $this->Html->link('Every user', array('controller' => 'categories', 'action' => 'view', 0)); ?><br />
	            <small>(Define apps for all users)</small>
	        </td>
	        <td class="edit">
	        	&nbsp;
	        </td>
	    </tr>
	    <?php foreach ($groups as $group) { ?>
	    <tr>
	        <td class="icon"><span class="label label-default">13</span></td>
	        <td class="name">
	            <?php echo $this->Html->link($group['Group']['name'], array('controller' => 'categories', 'action' => 'view', $group['Group']['id'])); ?><br />
	            <small><?php if (strlen($group['Group']['description']) > 2) echo '('.$group['Group']['description'].')'; ?></small>
	        </td>
	        <td class="edit">
	        	<a href="<?php echo $this->Html->url(array("controller" => 'groups', "action" => "edit", $group['Group']['id'], $group['Group']['name'])); ?>">
	        		<i class="fa icon-edit"><span> Edit</span></i>
	        	</a>
	        	<br />
	        	<a href="<?php echo $this->Html->url(array("controller" => 'groups', "action" => "delete", $group['Group']['id'], $group['Group']['name'])); ?>" onclick="return confirmation('Are you sure you want to delete group <?php echo $group['Group']['name']; ?>?');">
	        		<i class="fa icon-ban-circle"><span> Delete</span></i>
	        	</a>
	        </td>
	    </tr>
	    <?php
	    }
	    unset($categories);
	    ?>
	</tbody>
</table>