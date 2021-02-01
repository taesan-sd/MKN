$(function () {
	// body class
	$('body').addClass('theme-indigo');

	// left menu active
    $('.menu .list #db').addClass('active');

    // progress hide
    $('#progress').hide();

    //Dropzone
    Dropzone.options.frmFileUpload = {
        paramName: "file",
        maxFilesize: 2
    };
})

function uploadData() {
	var formData = new FormData();
	var file;
	var nationality = $('#nationality option:selected').val();
	var type = $('#type option:selected').val();
	
	Dropzone.instances.forEach(function(item,index){
        file = item.files[0];
    });

	formData.append("upFile", file);
	formData.append("nationality", nationality);
	formData.append("type", type);

	// console.log(file);
	// console.log(nationality);
	// console.log(type);

	if(nationality == '' || type == '') {
		showBasicMessage('Select a nationality or type');
	} else if(!file) {
		showBasicMessage('No file');
	} else {		
		$.ajax({
			url: '../../config/api_function_excel.php',
			type:'post',
            dataType:'json',
			processData: false,
			contentType: false,
			cache:false,
			data: formData,
			beforeSend: function() {
				console.log('beforeSend');

				$('#progress').show();
				setTimeout(function() {
					$('#progress_bar').css('width', '25%');
				}, 3000);
				
			}, success: function(data) {
				console.log('success');

				var percentage = 0;
				var timer = setInterval(function() {
			    	percentage = percentage + 20;
			    	progress_bar_process(percentage, timer, data);
			    }, 1000);

				if(data.result == 'true') {
					console.log('location.reload');
				}

			}, error:function(request,status,error){
	        	showBasicMessage("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	        }
		});
	}	
}

function progress_bar_process(percentage, timer, data) {
	$('#progress_bar').css('width', percentage + '%');
	if(percentage > 100) {
		clearInterval(timer);
		setTimeout(function() {
			console.log('progress hide');
			location.reload();
		}, 2000);
	}
}