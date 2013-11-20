<?php

// Breadcrumbs
$this->Html->addCrumb('Ideas', null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<div class="paging pull-left">
				<?php
				echo $this->Paginator->numbers(array('first' => __('First'), 'last' => __('Last'), 'separator' => ''));
				?>
			</div>
			<p>
				<a href="<?= $this->Html->url(array('controller' => 'ideas', 'action' => 'edit', 'new')); ?>" class="btn btn-primary pull-right new">New idea <i class="fa icon-plus"></i></a>
			</p>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th class="name">Name</th>
				        <th class="name">Email</th>
				        <th class="name">Action</th>
				    </tr>
				</thead>
				<tbody>
				    <?php if (!empty($data)) foreach ($data as $item) { ?>
				    <tr class="clickable">
				        <td style="border-bottom: dotted 1px #ddd;"><?= $item['Idea']['name']; ?></td>
				        <td style="border-bottom: dotted 1px #ddd;"><?= $item['Idea']['email']; ?></td>
				        <td style="border-bottom: dotted 1px #ddd;">
							<a href="<?= $this->Html->url(array('controller' => 'ideas', 'action' => 'delete', $item['Idea']['id'], TextHelper::safeText($item['Idea']['name']))); ?>" class="btn pull-right" onclick="return env.confirmation('Are you sure you want to delete <?= $item['Idea']['name']; ?>?');">
								<i class="fa icon-ban-circle"><span> Delete</span></i>
							</a>
				        </td>
				    </tr>
				    <tr>
				    	<td colspan="3" style=" border: none; border-bottom: 2px solid #ddd;"><small><?= $item['Idea']['message']; ?></small></td>
				    </tr>
				    <?php
				    }
				    else {
				    ?>
					<tr>
						<td colspan="4" height="120" valign="middle" align="center" class="empty-cell">
							<p style="margin-top:45px;">No ideas were submitted yet.</p>
						</td>
					</tr>
				    <?php
				    }
				    unset($items);
				    ?>
				</tbody>
			</table>
			<div class="paging">
				<?php
				echo $this->Paginator->numbers(array('first' => __('First'), 'last' => __('Last'), 'separator' => ''));
				?>
			</div>
		</div>
	</div>
</div>
