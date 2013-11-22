<div id="errors"><?php
$errors = Error::getAll();
if (!empty($errors)) {
	echo '<div class="widget">';
	foreach ($errors as $type=>$group) {
		switch ($type) {
			case Error::TypeOk:
				$alertType = 'success';
				$icon = 'icon-ok-circle';
				break;
			case Error::TypeWarning:
				$alertType = 'warning';
				$icon = 'icon-warning-sign';
				break;
			case Error::TypeError:
				$alertType = 'danger';
				$icon = 'icon-exclamation-sign';
				break;
			case Error::TypeInfo:
				$alertType = 'info';
				$icon = 'icon-info-sign';
				break;
		}
		echo '<div class="alert alert-'.$alertType.' alert-dismissable">
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->';
		foreach ($group as $message) {
			echo '<p><i class="'.$icon.'"></i> '.$message.'</p>';
		}
		echo '</div>';
		Error::clear();
	}
	echo '</div>';
}
?></div>