<?php

// Breadcrumbs
$this->Html->addCrumb('Categories', '/categories');
$this->Html->addCrumb($category['Category']['name'], null);

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<h3 class="form-title form-title-first"><i class="<?= $category['Category']['icon']; ?>"></i> <?= $category['Category']['name']; ?></h3>
			<p>
				<ul id="appTablePills" class="nav nav-pills">
					<li class="active"><a href="#all" data-toggle="pill">All</a></li>
					<li><a href="#apple" data-toggle="pill">iOS</a></li>
					<li><a href="#android" data-toggle="pill">Android</a></li>
					<li><a href="#windows" data-toggle="pill">Windows 8</a></li>
					<li><a href="#globe" data-toggle="pill">Web</a></li>
				</ul>
			</p>
			<table id="appTable" class="table table-striped table-bordered table-hover selector-table">
				<thead>
				    <tr>
				        <th class="icon">&nbsp;</th>
				        <th class="name">Application</th>
				    </tr>
				</thead>
				<tbody>
				    <?php
				    foreach ($data as $item) {
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
				    ?>
				    <tr class="<?= $icon; ?>">
				        <td class="icon">
				        	<a href="<?php echo $this->Html->url(array("controller" => 'applications', 'action' => 'view', $item['Application']['id'], $item['Application']['name'])); ?>">
				        		<img src="http://www.apps.ie/assets/images/developer_images/lemonsplat/CPLjobs_Android_app_icon.png" alt="<?php echo $item['Application']['name']; ?>" />
				        	</a>
				        </td>
				        <td class="name">
				            <i class="icon-<?= $icon ?>"></i>
				            <?php echo $this->Html->link($item['Application']['name'], array('controller' => 'users', 'action' => 'view', $item['Application']['id'])); ?>
				            <br />
				            <small class="col-md-5">
				            	<?php
				            	if ($ext) {
				            	?>
				            	<strong>Download: </strong>
				            	<a href="" title="Download app">
				            		<?= $ext; ?>
				            		<i class="fa icon-cloud-download"></i>
				            	</a>
				            	<?php } ?>
				            </small>
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