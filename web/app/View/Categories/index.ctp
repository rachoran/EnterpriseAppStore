<?php

// Breadcrumbs
$this->Html->addCrumb('Categories', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?= $this->Html->url(array('controller' => 'categories', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New category <i class="fa icon-plus"></i></a>
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
				            <?= $this->Html->link('Uncategorised apps', array('controller' => 'categories', 'action' => 'view', 0)); ?>
				            <span class="label label-default"><?= 23; ?></span>
				            <br />
				            <small></small>
				        </td>
				        <td class="edit">
				        	&nbsp;
				        </td>
				    </tr>-->
				    <?php
				    foreach ($categories as $category) {
						$count = (int)$category[0]['appsCount'];   
						if ($count == 0) {
							$style = ' style="color:#999;"';
						}
						else $style = '';
				    ?>
				    <tr class="clickable"<?= $style; ?>>
				        <td class="icon"><i class="fa <?= $category['Category']['icon']; ?>"></i></td>
				        <td class="name">
				            <?php
				            if ($count > 0) echo $this->Html->link(
				            	$category['Category']['name'],
				            	array(
				            		'controller' => 'categories',
				            		'action' => 'view',
									$category['Category']['id'],
									TextHelper::safeText($category['Category']['name'])
								),
				            	array(
				            		'class' => 'view'
								)
				            );
				            else echo $category['Category']['name'];
				            ?>
				             <span class="label label-default"><?= $count; ?></span>
				            <br />
				            <small><?php if (strlen($category['Category']['description']) > 2) echo '('.$category['Category']['description'].')'; ?></small>
				        </td>
				        <td class="edit">
				        	<a href="<?= $this->Html->url(array("controller" => "categories", "action" => "edit", $category['Category']['id'], TextHelper::safeText($category['Category']['name']))); ?>">
				        		<i class="fa icon-edit"><span> Edit</span></i>
				        	</a>
				        	<br />
				        	<a href="<?= $this->Html->url(array("controller" => "categories", "action" => "delete", $category['Category']['id'], TextHelper::safeText($category['Category']['name']))); ?>" onclick="return env.confirmation('Are you sure you want to delete category <?= $category['Category']['name']; ?>?');">
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