function environment() {

	this.baseUrl = null;
	
	// Confirmations
	this.confirmation = function(message) {
		var r = confirm(message)
		if (r == true) {
			return true;
		}
		else {
			return false;
		}
	}
	
	// Forms - Checkboxes
	this.toggleAllCheckBoxes = function(selector, masterCheckbox) {
		var isOn = $(masterCheckbox).is(':checked');
		selector = '#' + selector + ' td input[type=checkbox]';
		$(selector).prop('checked', isOn);
	}
	
	// Initialization
	this.init = function() {
		$(function() {
			// Handling tabs	
			$('a[data-toggle=tab]').on('click', function(e){
				$.cookie('last_tab', $(e.target).attr('href'));
			});
			
			// Activate latest tab, if it exists:
			var lastTab = $.cookie('last_tab');
			if (lastTab && $(lastTab)) {
				$('ul.nav-tabs').children().removeClass('active');
				$('a[href='+ lastTab +']').parents('li:first').addClass('active');
				$('div.tab-content').children().removeClass('active');
				$(lastTab).addClass('active');
			}
		});
	}
	
}

var env = new environment();
env.init();