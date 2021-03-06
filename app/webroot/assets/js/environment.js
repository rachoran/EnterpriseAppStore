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
	
	// Error messages
	this.showError = function(message) {
		$('#errors').hide();
		$('#errors').html('<div class="widget"><div class="alert alert-danger alert-dismissable "><p><i class="icon-exclamation-sign"></i>' + message + '</p></div></div>');
		$('#errors').show(500);
	}
	
	// Forms - Checkboxes
	this.toggleAllCheckBoxes = function(selector, masterCheckbox) {
		var isOn = $(masterCheckbox).is(':checked');
		selector = '#' + selector + ' td input[type=checkbox]';
		$(selector).prop('checked', isOn);
	}
	
	// Tables - Selecting entire rows
	this.clickedRow = function() {
		$(this).hide();
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
			
			// Activating cickable table rows
			$('table tr.clickable').click(function() {
				var href = $(this).find('a.view').prop('href');
				if ($(this).find('a.view').prop('href')) document.location = href;
			});
		});
	}
	
}

var env = new environment();
env.init();