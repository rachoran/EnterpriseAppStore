function confirmation(message) {
	var r = confirm(message)
	if (r == true) {
		return true;
	}
	else {
		return false;
	}
}

function toggleAllCheckBoxes(selector, masterCheckbox) {
	var isOn = $(masterCheckbox).is(':checked');
	selector = '#' + selector + ' td input[type=checkbox]';
	$(selector).prop('checked', isOn);
}