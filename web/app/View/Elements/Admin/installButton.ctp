<?php
if (!isset($id)) $id = $item['Application']['id'];

//Detect special conditions devices
$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
							
if ($iPod || $iPhone || $iPad) {
    echo $this->Html->link(__('Install latest'), array('controller' => 'applications', 'action' => 'iOSInstall', $id, TextHelper::safeText($item['Application']['name'])), array('class'=>'btn btn-default pull-right'));
}
elseif ($Android) {
    echo $this->Html->link(__('Install latest'), array('controller' => 'applications', 'action' => 'download', $id, TextHelper::safeText($item['Application']['name'])), array('class'=>'btn btn-default pull-right'));
}
else {
	echo $this->Html->link(__('Download latest'), array('controller' => 'applications', 'action' => 'download', $id, TextHelper::safeText($item['Application']['name'])), array('class'=>'btn btn-default pull-right'));
}
?>