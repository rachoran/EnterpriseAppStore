<?php

// Breadcrumbs
$this->Html->addCrumb('API Keys', null);


?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
				<a href="<?php echo $this->Html->url(array('controller' => 'apikeys', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">Add key <i class="fa icon-plus"></i></a>
			</p>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th class="name">Name</th>
				        <th class="edit">Edit</th>
				    </tr>
				</thead>
				<tbody>
				    <?php if (!empty($data)) foreach ($data as $item) { ?>
				    <tr>
				        <td class="name">
				        	<div class="col-md-4">
					            <?= $item['Apikey']['name']; ?>
				        	</div>
				        	<div class="col-md-8">
				            	<input type="text" value="<?= $item['Apikey']['key']; ?>" readonly="readonly" class="form-control" onclick="this.select();" />
				        	</div>
				        </td>
				        <td class="edit">
				        	<a href="<?= $this->Html->url(array("controller" => 'apikeys', "action" => "edit", $item['Apikey']['id'], TextHelper::safeText($item['Apikey']['name']))); ?>">
				        		<i class="fa icon-edit"><span> Edit</span></i>
				        	</a>
				        	<br />
				        	<a href="<?= $this->Html->url(array("controller" => 'apikeys', "action" => "delete", $item['Apikey']['id'], TextHelper::safeText($item['Apikey']['name']))); ?>" onclick="return env.confirmation('Are you sure you want to delete API key <?php echo $item['Apikey']['name']; ?>?');">
				        		<i class="fa icon-ban-circle"><span> Delete</span></i>
				        	</a>
				        </td>
				    </tr>
				    <?php
				    }
				    else {
				    ?>
					<tr>
						<td colspan="4" height="120" valign="middle" align="center" class="empty-cell">
							<p style="margin-top:45px;">No keys were found.</p>
						</td>
					</tr>
				    <?php
				    }
				    unset($items);
				    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>