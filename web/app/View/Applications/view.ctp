<?php

// Breadcrumbs
$this->Html->addCrumb('Applications', '/applications');
$this->Html->addCrumb($data['Application']['name'], null);

?>
<div class="widget">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_application_basic" data-toggle="tab">Basic info</a></li>
        <!-- <li><a href="#tab_application_screenshots" data-toggle="tab">Screenshots</a></li> -->
        <!-- <li><a href="#tab_application_resign" data-toggle="tab">Resign</a></li> -->
        <!-- <li><a href="#tab_application_attachments" data-toggle="tab">Attachments</a></li> -->
        <?php if (count($appsList) > 1) { ?>
        <li><a href="#tab_application_history" data-toggle="tab">History</a></li>
        <?php } ?>
        <!-- <li><a href="#tab_application_comments" data-toggle="tab">Comments</a></li> -->
    </ul>
    <div class="tab-content bottom-margin">
		<div class="tab-pane active" id="tab_application_basic">
			<div class="padded">
				<div class="row">
					<div  class="col-md-10">
						<table class="table table-striped table-bordered table-hover">
							<tbody>
								<tr>
									<td colspan="2">
										<h1>
											<?php
											$icon = Platforms::iconForPlatform($data['Application']['platform']);
											$ext = Platforms::extensionForPlatform($data['Application']['platform']);
											?>
											<i class="icon-<?= $icon; ?>" style="margin-left:12px; margin-right:24px;"></i>
											<?= $data['Application']['name']; ?>
											<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'delete', $data['Application']['id'], TextHelper::safeText($data['Application']['name']))); ?>" onclick="return env.confirmation('Are you sure you want to delete all builds for <?= $data['Application']['name']; ?>?');" class="btn btn-default pull-right" style="margin-right:6px;">
								        		<i class="fa icon-ban-circle"><span> Delete</span></i>
								        	</a>
											<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'edit', $data['Application']['id'], TextHelper::safeText($data['Application']['name']))); ?>" class="btn btn-default pull-right" style="margin-right:6px;">
								        		<i class="fa icon-edit"><span> Edit</span></i>
								        	</a>
											<!-- Begin download/install button -->
											<?= $this->element('Admin/installButton', array('item'=>$data, 'id'=>$data['Application']['id'])); ?>
											<!-- End download/install button -->
										</h1>
									</td>
								</tr>
								<?php
								foreach ($basicInfo as $title=>$value) {
								?>
								<tr>
									<td><strong><?= $title; ?></strong></td>
									<td>
										<?php
										if (is_array($value)) {
											$br = (count($value) > 1) ? '<br />' : '';
											foreach ($value as $v) {
												echo $v.$br;
											}
										}
										else {
											echo $value;
										}
										?>
									</td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						<p>&nbsp;</p>
					</div>
					<div  class="col-md-2">
						<img src="<?= Storage::urlForIconForAppWithId($data['Application']['id'], $data['Application']['location']).'?t='.time(); ?>" alt="<?php echo $data['Application']['name']; ?>" class="logo" />
					</div>
				</div>
				<?php if (isset($appSystemInfo)) { ?>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th colspan="2">System info</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($appSystemInfo as $title=>$value) {
								?>
								<tr>
									<td><?= $title; ?></td>
									<td>
										<?php
										if (is_array($value)) {
											$br = (count($value) > 1) ? '<br />' : '';
											foreach ($value as $v) {
												echo $v.$br;
											}
										}
										else {
											echo $value;
										}
										?>
									</td>
								</tr>
								<?php
								}
								?>
								<tr>
									<td>Hosted on</td>
									<td><?= ($data['Application']['location'] == 0) ? __('Local server') : __('Amazon S3'); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="tab-pane" id="tab_application_screenshots">
			<div class="padded">
				<div class="screenshots">
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 1" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 2" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 3" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 4" />
					</div>
					<div class="image">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Applications/test/screen.png?time=<?= time(); ?>" alt="Screenshot 5" />
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_application_resign">
			<div class="padded">
				
			</div>
		</div>
		<div class="tab-pane" id="tab_application_attachments">
			<div class="padded">
				
			</div>
		</div>
		<?php if (count($appsList) > 1) { ?>
		<div class="tab-pane" id="tab_application_history">
			<div class="padded">
				<div class="widget">
					<div class="widget-content-white glossed">
						<div class="padded">
							<table id="appTable" class="table table-striped table-bordered table-hover selector-table">
								<thead>
								    <tr>
								        <th class="icon">&nbsp;</th>
								        <th class="name">Versions</th>
								        <th class="edit">Action</th>
								    </tr>
								</thead>
								<tbody>
								    <?php
								    foreach ($appsList as $item) {
								    	$icon = Platforms::iconForPlatform($item['Application']['platform']);
								    	$ext = Platforms::extensionForPlatform($item['Application']['platform']);
										$current = ($data['Application']['id'] == $item['Application']['id']) ? ' <small>(Current build)</small>' : '';
								    ?>
								    <tr class="<?= $icon; ?>">
								        <td class="icon">
								        	<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'view', $item['Application']['id'], $item['Application']['name'])); ?>">
								        		<img src="<?= Storage::urlForIconForAppWithId($item['Application']['id'], $item['Application']['location']).'?t='.time(); ?>" alt="<?php echo $item['Application']['name']; ?>" />
								        	</a>
								        </td>
								        <td class="name">
											<!-- Begin download/install -->
											<?= $this->element('Admin/installButton', array('item'=>$item)); ?>
											<!-- End download/install -->
								            <i class="icon-<?= $icon ?>" style="margin-right: 6px;"></i>
								            <?php echo $this->Html->link($item['Application']['name'], array('controller' => 'applications', 'action' => 'view', $item['Application']['id'])); ?>
								            <?= $current; ?>
								            <br />
							            	<?php
							            	if ($ext) {
							            	?>
								            <!--<small style="margin-right: 12px;">
								            	<strong>Download: </strong>
								            	<a href="" title="Download app">
								            		<?= $ext; ?>
								            		<i class="fa icon-cloud-download"></i>
								            	</a>
								            </small>-->
								            <small style="margin-right: 12px;"><strong>Date:</strong> <?= $item['Application']['created']; ?> </small>
							            	<?php
							            	}	
							            	?>
								        </td>
								        <td class="edit">
								        	<?php
								        	//echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'view', $item['Application']['id']), array('class'=>'btn btn-default'));
								        	//echo $this->Html->link(__('Delete'), array('controller' => 'users', 'action' => 'view', $item['Application']['id']), array('class'=>'btn btn-default'));
								        	?>
								        	<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'edit', $item['Application']['id'], $item['Application']['name'])); ?>">
								        		<i class="fa icon-edit"><span> Edit</span></i>
								        	</a>
								        	<br />
								        	<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'delete', $item['Application']['id'], $item['Application']['name'])); ?>" onclick="return env.confirmation('Are you sure you want to delete user <?php echo $item['Application']['name']; ?>?');">
								        		<i class="fa icon-ban-circle"><span> Delete</span></i>
								        	</a>
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
			</div>
		</div>
		<?php } ?>
		<div class="tab-pane" id="tab_application_comments">
			<div class="padded">
				
			</div>
		</div>
		<div style="clear:both;"><p>&nbsp;</p></div>
    </div>
</div>


