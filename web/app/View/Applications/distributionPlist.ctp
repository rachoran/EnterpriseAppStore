<?php
$debug = false;

if ($debug) echo '<textarea style="width:900px; height:500px;">';

$app = $app['Application'];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>items</key>
	<array>
		<dict>
			<key>assets</key>
			<array>
				<dict>
					<key>kind</key>
					<string>software-package</string>
					<key>url</key>
					<string><?= $this->Html->url('/applications/download/'.$app['id'].'/'.TextHelper::safeText($app['name']).'.ipa', true); ?></string>
				</dict>
				<?php if (isset($largeIcon)) {  ?><dict>
					<key>kind</key>
					<string>full-size-image</string>
					<?php if (isset($needsShine) && $needsShine) { ?><key>needs-shine</key>
					<true/>
					<?php } ?><key>url</key>
					<string><?= $largeIcon; ?></string>
				</dict><?php } ?>
				<?php if (isset($smallIcon)) {  ?><dict>
					<key>kind</key>
					<string>display-image</string>
					<?php if (isset($needsShine) && $needsShine) { ?><key>needs-shine</key>
					<true/>
					<?php } ?><key>url</key>
					<string><?= $smallIcon; ?></string>
				</dict><?php } ?>
			</array>
			<key>metadata</key>
			<dict>
				<key>bundle-identifier</key>
				<string><?= $app['identifier']; ?></string>
				<key>bundle-version</key>
				<string><?= $app['version']; ?></string>
				<key>kind</key>
				<string>software</string>
				<key>subtitle</key>
				<string></string>
				<key>title</key>
				<string><?= TextHelper::escape($app['name']); ?></string>
			</dict>
		</dict>
	</array>
</dict>
</plist><?php
if ($debug) echo '</textarea>';
?>