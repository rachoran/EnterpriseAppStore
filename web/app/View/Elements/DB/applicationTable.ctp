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
	    if (!empty($apps)) foreach ($apps as $item) {
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
				<!-- Begin download/install -->
				<?= $this->element('Admin/installButton', array('item'=>$item, 'id'=>$item[0]['id'])); ?>
				<!-- End download/install -->
	            <i class="icon-<?= $icon ?>" style="margin-right: 6px;"></i>
	            <?= $this->Html->link($item[0]['name'], array('controller' => 'applications', 'action' => 'view', $item[0]['id'], TextHelper::safeText($item['Application']['name']))); ?>
	            <small>(Latest: <?= $item[0]['version']; ?>)</small>
	            <br />
            	<?php
            	if ($ext) {
            	?>
	            <small style="margin-right: 12px;"><strong>Builds:</strong> <?= $item[0]['count']; ?> </small>
            	<?php } ?>
	        </td>
	        <td class="edit">
	        	<a href="<?= $this->Html->url(array("controller" => 'applications', 'action' => 'edit', $item['Application']['id'], TextHelper::safeText($item['Application']['name']))); ?>">
	        		<i class="fa icon-edit"><span> Edit latest</span></i>
	        	</a>
	        	<?php
	        	if (Me::minAdmin()) {
	        	?>
	        	<br /><a href="<?= $this->Html->url(array("controller" => 'applications', 'action' => 'deleteAll', $item['Application']['id'], TextHelper::safeText($item['Application']['name']))); ?>" onclick="return env.confirmation('Are you sure you want to delete all builds for <?= $item['Application']['name']; ?>?');">
	        		<i class="fa icon-ban-circle"><span> Delete all</span></i>
	        	</a>
	        	<?php
	        	}
	        	?>
	        </td>
	    </tr>
	    <?php
	    }
	    else {
	    ?>
		<tr>
			<td colspan="3" height="120" valign="middle" align="center" class="empty-cell">
				<p style="margin-top:45px;">No applications were found.</p>
			</td>
		</tr>
	    <?php } ?>
	</tbody>
		<?php
	    //}
	    unset($items);
	    ?>
	</tbody>
</table>
