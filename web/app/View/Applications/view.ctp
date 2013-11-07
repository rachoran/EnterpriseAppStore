<?php

// Breadcrumbs
$this->Html->addCrumb('Applications', '/applications');
$this->Html->addCrumb($data['Application']['name'], null);

?>
<div class="widget">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_application_basic" data-toggle="tab">Basic info</a></li>
        <li><a href="#tab_application_screenshots" data-toggle="tab">Screenshots</a></li>
        <li><a href="#tab_application_resign" data-toggle="tab">Resign</a></li>
        <li><a href="#tab_application_attachments" data-toggle="tab">Attachments</a></li>
        <li><a href="#tab_application_comments" data-toggle="tab">Comments</a></li>
    </ul>
    <div class="tab-content bottom-margin">
		<div class="tab-pane active" id="tab_application_basic">
			<div class="padded">
				<div class="row">
					<div  class="col-md-10">
					
					</div>
					<div  class="col-md-2">
						<img src="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Icon?time=<?= time(); ?>" alt="Application logo" class="logo" />
					</div>
					<p>&nbsp;</p>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover">
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
							</tbody>
						</table>
					</div>
				</div>
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
		<div class="tab-pane" id="tab_application_comments">
			<div class="padded">
				
			</div>
		</div>
		<div style="clear:both;"><p>&nbsp;</p></div>
    </div>
</div>
<?php
if (count($appsList) > 1) {
?><div class="widget">
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
				    	$p = $item['Application']['platform'];
					    if ($p == 0 || $p == 1 || $p == 2) {
						    $icon = 'apple';
						    $ext = '.ipa';
						}
						elseif ($p == 3 || $p == 4 || $p == 5) {
						    $icon = 'android';
						    $ext = '.apk';
						}
						elseif ($p == 6 || $p == 7) {
						    $icon = 'windows';
						    $ext = '.xap';
						}
						elseif ($p == 8) {
						    $icon = 'globe';
						    $ext = null;
						}
						$current = ($data['Application']['id'] == $item['Application']['id']) ? ' <small>(Current build)</small>' : '';
				    ?>
				    <tr class="<?= $icon; ?>">
				        <td class="icon">
				        	<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'view', $item['Application']['id'], $item['Application']['name'])); ?>">
				        		<img src="<?= Storage::urlForIconForAppWithId($item['Application']['id'], $item['Application']['location']).'?t='.time(); ?>" alt="<?php echo $item['Application']['name']; ?>" />
				        	</a>
				        </td>
				        <td class="name">
				        	<?php
				        	//Detect special conditions devices
							$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
							$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
							$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
							$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
							$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
							
							if ($iPod || $iPhone || $iPad) {
							    echo $this->Html->link(__('Install build'), array('controller' => 'users', 'action' => 'view', $item['Application']['id']), array('class'=>'btn btn-default pull-right'));
							}
							elseif ($Android) {
							    echo $this->Html->link(__('Install build'), array('controller' => 'users', 'action' => 'view', $item['Application']['id']), array('class'=>'btn btn-default pull-right'));
							}
							else {
								echo $this->Html->link(__('Download build'), array('controller' => 'users', 'action' => 'view', $item['Application']['id']), array('class'=>'btn btn-default pull-right'));
							}
							?>
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
<?php } ?>
