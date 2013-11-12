var didUploadAppBinary = false;

$('#binaryUpload').fileupload({
    url: env.baseUrl + 'applications/uploadApp',
    dataType: 'json',
    done: function (e, data) {
		if (data.result.data.id) {
			didUploadAppBinary = true;
	    	
	    	$('#appName').val(data.result.data.name);
	    	$('#appIdentifier').val(data.result.data.identifier);
	    	$('#appVersion').val(data.result.data.version);
	    	$('#appId').val(data.result.data.id);
	    	
	    	$('#tab_application_basic .disabled:not(.beforeUpload)').prop('readonly', true);
			$('#tab_application_basic .disabled.beforeUpload').prop('readonly', false);
			$('#mainAppForm button.disabled').prop('disabled', false);
			$('#binaryUploadWrapper, #applicationTypeWrapper').hide();
			$('.nav.nav-tabs li, button.disabled').removeClass('disabled');
		}
    },
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#binaryUploadProgress .progress-bar').css('width', progress + '%');
    }
}).error(function (jqXHR, textStatus, errorThrown) {
	alert(errorThrown);
});

function checkFields(val) {
	if (val == 0) {
		$('.type1, .type2').hide();
		$('.type0').show();
		
		$('.nav.nav-tabs li, #mainAppForm button').addClass('disabled');
		$('#mainAppForm input.disabled:not(#binaryUpload), textarea.disabled').prop('readonly', true);
		$('#mainAppForm button.disabled').prop('disabled', true);
	}
	else {
		$('#mainAppForm input, textarea').prop('readonly', false);
		$('#mainAppForm button.disabled').prop('disabled', false);
		$('.nav.nav-tabs li, button.disabled').removeClass('disabled');
		
		if (val == 1) {
			$('.type0, .type2').hide();
			$('.type1').show();
			$('#appUrl').attr('placeholder', 'https://itunes.apple.com/gb/app/ijenkins/id720123810?mt=8');
		}
		else if (val == 2) {
			$('.type0, .type1').hide();
			$('.type2').show();
			$('#appUrl').attr('placeholder', 'https://m.example.com/mobile-site/');
		}
	}
	if ($('#appName').val().length > 0) {
		$('#mainAppForm input.disabled').prop('readonly', true);
		$('#mainAppForm input.beforeUpload, textarea.disabled, #selectedGroups input, #selectedCats input').prop('readonly', false);
		$('#mainAppForm button.disabled').prop('disabled', false);
		$('#binaryUploadWrapper, #applicationTypeWrapper').hide();
		$('.nav.nav-tabs li, button.disabled').removeClass('disabled');
	}
}

$(function() {
	checkFields($('#appTypeSwitch').val());
	
	var id = $('#appId').val();
	if (!id || id == 0) {
		$.cookie('last_tab', '#tab_application_basic');
		$('ul.nav-tabs').children().removeClass('active');
		$('a[href='+ '#tab_application_basic' +']').parents('li:first').addClass('active');
		$('div.tab-content').children().removeClass('active');
		$('#tab_application_basic').addClass('active');
	}
	
	$('#appTypeSwitch').change(function() {
		var val = $(this).val();
		checkFields(val);
	});
});