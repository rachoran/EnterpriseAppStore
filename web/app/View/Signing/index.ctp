<?php

// Breadcrumbs
$this->Html->addCrumb('Signing', null);


?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<p>
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
				    <?php if (!empty($signings)) foreach ($signings as $signing) { ?>
				    <tr>
				        <td class="name">
				            <?= $signing['Signing']['name']; //$this->Html->link($signing['Signing']['name'], array('controller' => 'signing', 'action' => 'view', $signing['Signing']['id'])); ?><br />
				            <?php
				            if (!empty($signing['Signing']['certificate'])) {
				            ?>
				            <small class="col-md-5">
				            	<strong>Certificate: </strong>
				            	<a href="<?= $this->Html->url(array("controller" => 'signing', "action" => "downloadCert", $signing['Signing']['id'])); ?>" title="Download certificate">
				            		<?= $signing['Signing']['certificate']; ?>
				            		<i class="fa icon-cloud-download"></i>
				            	</a>
				            </small>
				            <?php
			            	}
			            	if (!empty($signing['Signing']['provisioning'])) {
			            	?>
				            <small class="col-md-5">
				            	<strong>Provisioning: </strong>
				            	<a href="<?= $this->Html->url(array("controller" => 'signing', "action" => "downloadProv", $signing['Signing']['id'])); ?>" title="Download provisioning">
				            		<?= $signing['Signing']['provisioning']; ?>
				            		<i class="fa icon-cloud-download"></i>
				            	</a>
				            </small>
				            <?php
				            }
				            ?>
				        </td>
				        <td class="edit">
				        	<a href="<?= $this->Html->url(array("controller" => 'signing', "action" => "edit", $signing['Signing']['id'], $signing['Signing']['name'])); ?>">
				        		<i class="fa icon-edit"><span> Edit</span></i>
				        	</a>
				        	<br />
				        	<a href="<?= $this->Html->url(array("controller" => 'signing', "action" => "delete", $signing['Signing']['id'], $signing['Signing']['name'])); ?>" onclick="return env.confirmation('Are you sure you want to delete signing <?php echo $signing['Signing']['name']; ?>?');">
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
							<p style="margin-top:45px;">No iOS certificates were found.</p>
						</td>
					</tr>
				    <?php
				    }
				    unset($signings);
				    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>