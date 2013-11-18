<?php
if (Me::minAdmin()) {
?>
<li<?php echo checkMenu('settings', $this); echo checkMenu('signing', $this); echo checkMenu('apikeys', $this); ?>>
	<a href="#" class="is-dropdown-menu"> <i class="icon-cogs"></i> Settings </a>
	<ul>
		<li> <a href="<?= $this->Html->url('/settings', true); ?>"> <i class="icon-cog"></i> Preferences </a> </li>
		<li> <a href="<?= $this->Html->url('/apikeys', true); ?>"> <span class="badge pull-right"><?= $menuCounts['apikeys']; ?></span> <i class="icon-key"></i> API keys </a> </li>
		<li> <a href="<?= $this->Html->url('/signing', true); ?>"> <span class="badge pull-right"><?= $menuCounts['signing']; ?></span> <i class="icon-certificate"></i> Signing </a> </li>
	</ul>
</li>
<?php
}
?>
