<?php

// Breadcrumbs
$this->Html->addCrumb('Signing', '/signing');


?><p>
	<a href="<?php echo $this->Html->url(array('controller' => 'signing', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">Add signing <i class="fa icon-plus"></i></a>
</p>
<table class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	        <th class="name">Name</th>
	        <th class="edit">Edit</th>
	    </tr>
	</thead>
	<tbody>
	    <?php foreach ($signings as $signing) { ?>
	    <tr>
	        <td class="name">
	            <?php echo $this->Html->link($signing['Signing']['name'], array('controller' => 'signing', 'action' => 'view', $signing['Signing']['id'])); ?>
	        </td>
	        <td class="edit">
	        	<a href="<?php echo $this->Html->url(array("controller" => 'signing', "action" => "edit", $signing['Signing']['id'], $signing['Signing']['name'])); ?>">
	        		<i class="fa icon-edit"><span> Edit</span></i>
	        	</a>
	        	<br />
	        	<a href="<?php echo $this->Html->url(array("controller" => 'signing', "action" => "delete", $signing['Signing']['id'], $signing['Signing']['name'])); ?>" onclick="return env.confirmation('Are you sure you want to delete signing <?php echo $signing['Signing']['name']; ?>?');">
	        		<i class="fa icon-ban-circle"><span> Delete</span></i>
	        	</a>
	        </td>
	    </tr>
	    <?php
	    }
	    unset($signings);
	    ?>
	</tbody>
</table>