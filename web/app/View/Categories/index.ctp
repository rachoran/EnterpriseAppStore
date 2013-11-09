<?php

// Breadcrumbs
$this->Html->addCrumb('Categories', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New category <i class="fa icon-plus"></i></a>
			</p>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th class="icon">&nbsp;</th>
				        <th class="name">Name</th>
				        <th class="edit">Edit</th>
				    </tr>
				</thead>
				<tbody>
				    <!--<tr>
				        <td class="icon"><i class="fa icon-sort-by-attributes"></i></td>
				        <td class="name">
				            <?php echo $this->Html->link('Uncategorised apps', array('controller' => 'categories', 'action' => 'view', 0)); ?>
				            <span class="label label-default"><?php echo 23; ?></span>
				            <br />
				            <small></small>
				        </td>
				        <td class="edit">
				        	&nbsp;
				        </td>
				    </tr>-->
				    <?php foreach ($categories as $category) { ?>
				    <tr>
				        <td class="icon"><i class="fa <?php echo $category['Category']['icon']; ?>"></i></td>
				        <td class="name">
				            <?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
				             <span class="label label-default"><?php echo $category[0]['appsCount']; ?></span>
				            <br />
				            <small><?php if (strlen($category['Category']['description']) > 2) echo '('.$category['Category']['description'].')'; ?></small>
				        </td>
				        <td class="edit">
				        	<a href="<?php echo $this->Html->url(array("controller" => "categories", "action" => "edit", $category['Category']['id'], $category['Category']['name'])); ?>">
				        		<i class="fa icon-edit"><span> Edit</span></i>
				        	</a>
				        	<br />
				        	<a href="<?php echo $this->Html->url(array("controller" => "categories", "action" => "delete", $category['Category']['id'], $category['Category']['name'])); ?>" onclick="return env.confirmation('Are you sure you want to delete category <?php echo $category['Category']['name']; ?>?');">
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
		</div>
	</div>
</div>