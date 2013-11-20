<?php
if (isset($name)) {
	$item['name'] = $name;
}
?>
<a href="<?= $this->Html->url(array('controller' => $controller, 'action' => 'delete', $item['id'], TextHelper::safeText($item['name']))); ?>" class="btn pull-right" onclick="return env.confirmation('Are you sure you want to delete <?= $item['name']; ?>?');">
	<i class="fa icon-ban-circle"><span> Delete</span></i>
</a>
<a href="<?= $this->Html->url(array('controller' => $controller, 'action' => 'edit', $item['id'], TextHelper::safeText($item['name']))); ?>" class="btn pull-right">
	<i class="fa icon-edit"><span> Edit</span></i>
</a>
