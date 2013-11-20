<?php if (Me::minDev()) { ?>
<!--
<li<?= checkMenu('signing', $this); ?>>
	<a href="<?= $this->Html->url('/signing', true); ?>"> <span class="badge pull-right"><?= ($menuCounts['signing'] + 0); ?></span> <i class="icon-certificate"></i> Signing </a>
</li>
-->
<?php
}
if (Me::minAdmin()) {
?>
<li<?php echo checkMenu('settings', $this); echo checkMenu('signing', $this); echo checkMenu('apikeys', $this); ?>>
	<a href="#" class="is-dropdown-menu"> <i class="icon-cogs"></i> Settings </a>
	<ul>
		<li> <a href="<?= $this->Html->url('/settings', true); ?>"> <i class="icon-cog"></i> Preferences </a> </li>
		<li> <a href="<?= $this->Html->url('/apikeys', true); ?>"> <span class="badge pull-right"><?= $menuCounts['apikeys']; ?></span> <i class="icon-key"></i> API keys </a> </li>
		<!-- <li> <a href="<?= $this->Html->url('/signing', true); ?>"> <span class="badge pull-right"><?= $menuCounts['signing']; ?></span> <i class="icon-certificate"></i> Signing </a> </li> -->
	</ul>
</li>
<!--
TODO: Add policies to control the builds
<li<?= checkMenu('policies', $this); ?>>
	<a href="<?= $this->Html->url('/policies', true); ?>" class="is-dropdown-menu"> <span class="badge pull-right"></span> <i class="icon-shield"></i> Policies </a>
	<ul>
		<li> <a href="xxxxxxxxx"> <i class="icon-beaker"></i> App Usage </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-picture"></i> Dynamic Authentication </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Remote Control </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Self Updating App </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Data Wipe </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Require Passphrase </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Encrypted DAR </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Copy-Paste Protection </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Jailbreak/Root Protection </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> App Expiration </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Geofencing </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Location Masking </a> </li>
		<li> <a href="xxxxxxxxx"> <i class="icon-table"></i> Lockout Recovery </a> </li>
	</ul>
</li>
-->

<?php
}
?>
