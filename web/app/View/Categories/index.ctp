<table class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	        <th class="icon">&nbsp;</th>
	        <th class="name">Name</th>
	        <th class="edit">Edit</th>
	    </tr>
	</thead>
	<tbody>
	    <?php foreach ($categories as $category) { ?>
	    <tr>
	        <td class="icon"><i class="fa <?php echo $category['Category']['icon']; ?>"></i></td>
	        <td class="name">
	            <?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
	        </td>
	        <td class="edit">
	        	<a href="<?php echo $this->Html->url(array("controller" => "categories", "action" => "edit", $category['Category']['id'])); ?>">
	        		<i class="fa icon-edit"><span> Edit</span></i>
	        	</a>
	        	<br />
	        	<a href="<?php echo $this->Html->url(array("controller" => "categories", "action" => "view", $category['Category']['id'])); ?>">
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