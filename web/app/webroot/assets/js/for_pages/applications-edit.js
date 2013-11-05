$('#binaryUpload').fileupload({
    url: env.baseUrl + 'thirdparty/jQuery-File-Upload/server/php/index.php',
    dataType: 'json',
    done: function (e, data) {
    	alert(data.files.length);
    	
    	$.each(data.files, function (index, file) {
            $('#wqefcqwrfqrfq').text($('#wqefcqwrfqrfq').text() + "\n" + file.name);
        });
    },
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#binaryUploadProgress .progress-bar').css('width', progress + '%');
        alert(env.baseUrl + 'thirdparty/jQuery-File-Upload/server/php/index.php');
    }
}).error(function (jqXHR, textStatus, errorThrown) {
	alert(errorThrown);
}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');