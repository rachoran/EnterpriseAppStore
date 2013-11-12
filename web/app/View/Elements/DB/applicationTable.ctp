<table id="appTable" class="table table-striped table-bordered table-hover selector-table">
	<thead>
	    <tr>
	        <th class="icon">&nbsp;</th>
	        <th class="name">Application</th>
	        <th class="edit">Action</th>
	    </tr>
	</thead>
	<tbody>
	    <?php
	    foreach ($apps as $item) {
	    	$icon = Platforms::iconForPlatform($item['Application']['platform']);
	    	$ext = Platforms::extensionForPlatform($item['Application']['platform']);
	    ?>
	    <tr class="<?= $icon; ?>">
	        <td class="icon">
	        	<a href="<?= $this->Html->url(array("controller" => 'applications', 'action' => 'view', $item[0]['id'], TextHelper::safeText($item[0]['name']))); ?>">
	        		<img src="<?= Storage::urlForIconForAppWithId($item[0]['id'], $item[0]['location']).'?t='.time(); ?>" alt="<?= $item[0]['name']; ?>" />
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
				    echo $this->Html->link(__('Install latest'), array('controller' => 'users', 'action' => 'view', $item[0]['id']), array('class'=>'btn btn-default pull-right'));
				}
				elseif ($Android) {
				    echo $this->Html->link(__('Install latest'), array('controller' => 'users', 'action' => 'view', $item[0]['id']), array('class'=>'btn btn-default pull-right'));
				}
				else {
					echo $this->Html->link(__('Download latest'), array('controller' => 'users', 'action' => 'view', $item[0]['id']), array('class'=>'btn btn-default pull-right'));
				}
	        	?>
	            <i class="icon-<?= $icon ?>" style="margin-right: 6px;"></i>
	            <?= $this->Html->link($item[0]['name'], array('controller' => 'applications', 'action' => 'view', $item[0]['id'], TextHelper::safeText($item['Application']['name']))); ?>
	            <small>(Latest: <?= $item[0]['version']; ?>)</small>
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
	            <small style="margin-right: 12px;"><strong>Builds:</strong> <?= $item[0]['count']; ?> </small>
            	<?php } ?>
	        </td>
	        <td class="edit">
	        	<a href="<?= $this->Html->url(array("controller" => 'applications', 'action' => 'edit', $item['Application']['id'], TextHelper::safeText($item['Application']['name']))); ?>">
	        		<i class="fa icon-edit"><span> Edit latest</span></i>
	        	</a>
	        	<br /><a href="<?= $this->Html->url(array("controller" => 'applications', 'action' => 'delete', $item['Application']['id'], TextHelper::safeText($item['Application']['name']))); ?>" onclick="return env.confirmation('Are you sure you want to delete all builds for <?= $item['Application']['name']; ?>?');">
	        		<i class="fa icon-ban-circle"><span> Delete all</span></i>
	        	</a>
	        </td>
	    </tr>
	    <?php
	    }
	    unset($items);
	    ?>
	</tbody>
</table>
