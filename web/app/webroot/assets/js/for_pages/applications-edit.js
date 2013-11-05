$('#binaryUpload').fileupload({
    url: env.baseUrl + 'thirdparty/jQuery-File-Upload/server/php/index.php',
    dataType: 'json',
    done: function (e, data) {
    	//alert(JSON.parse(data));
    	
    	$.each(data.files, function (index, file) {
            $('#wqefcqwrfqrfq').text($('#wqefcqwrfqrfq').text() + "\n" + file.name);
        });
    },
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#binaryUploadProgress .progress-bar').css('width', progress + '%');
    }
}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');