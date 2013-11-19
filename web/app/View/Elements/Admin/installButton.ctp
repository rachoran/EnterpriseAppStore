<?php
$item = $item['Application'];
if (!isset($id)) $id = $item['id'];

//Detect special conditions devices
$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
							
if ($iPod || $iPhone || $iPad) {
	if (Platforms::iOS($item['platform'])) {
    //echo $this->Html->link(__('Install latest'), array('controller' => 'applications', 'action' => 'iOSInstall', $id, TextHelper::safeText($item['name'])), array('class'=>'btn btn-default pull-right'));
    ?>
    <a href="itms-services://?action=download-manifest&url=<?= urlencode($this->Html->url(array("controller" => 'applications', 'action' => 'distributionplist', $id, TextHelper::safeText($item['name']).'.plist'), true)); ?>" class="btn btn-default pull-right">
    <!--<a href="itms-services://?action=download-manifest&url=<?= urlencode($this->Html->url('/38.plist', true)); ?>" class="btn btn-default pull-right">-->
	    <?= __('Install latest'); ?>
    </a>
    <?php
    }
}
elseif ($Android && Platforms::Android($item['platform'])) {
    echo $this->Html->link(__('Install latest'), array('controller' => 'applications', 'action' => 'download', $id, TextHelper::safeText($item['name'])), array('class'=>'btn btn-default pull-right'));
}
else {
	echo $this->Html->link(__('Download latest'), array('controller' => 'applications', 'action' => 'download', $id, TextHelper::safeText($item['name'])), array('class'=>'btn btn-default pull-right'));
}
?>