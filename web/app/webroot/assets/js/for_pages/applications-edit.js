function xinspect(o,i){
    if(typeof i=='undefined')i='';
    if(i.length>50)return '[MAX ITERATIONS]';
    var r=[];
    for(var p in o){
        var t=typeof o[p];
        r.push(i+'"'+p+'" ('+t+') => '+(t=='object' ? 'object:'+xinspect(o[p],i+'  ') : o[p]+''));
    }
    return r.join(i+'\n');
}

$('#binaryUpload').fileupload({
    url: env.baseUrl + 'applications/uploadApp',
    dataType: 'json',
    done: function (e, data) {
    	//alert(xinspect(data));
    	//alert(data.files[0].name);
    	$('.nav.nav-tabs li').removeClass('disabled');
		$('#tab_application_basic .disabled').prop('disabled', false);
		$('.nav.nav-tabs li a').unbind(".myclick");
    },
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#binaryUploadProgress .progress-bar').css('width', progress + '%');
    }
}).error(function (jqXHR, textStatus, errorThrown) {
	alert(errorThrown);
}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');


$(function() {
	$('.nav.nav-tabs li').addClass('disabled');
	$('#tab_application_basic .disabled').prop('disabled', true);
});