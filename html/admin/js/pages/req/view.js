$(function () {
	// body class
	$('body').addClass('theme-indigo');

	// left menu active
    $('.menu .list #reqlist').addClass('active');
})

function makeNameCard() {
	var no_mid = $('input[name=no_mid]').val();
	var email = $('input[name=email]').val();
	var last_name_ori = $('input[name=last_name_ori]').val();
	var first_name_ori = $('input[name=first_name_ori]').val();
	var last_name_kr = $('input[name=last_name_kr]').val();
	var first_name_kr = $('input[name=first_name_kr]').val();
	var last_name_cn = $('input[name=last_name_cn]').val();
	var first_name_cn = $('input[name=first_name_cn]').val();
	var last_name_en = $('input[name=last_name_en]').val();
	var first_name_en = $('input[name=first_name_en]').val();
	var first_name_meaning_kr = $('textarea[name=first_name_meaning_kr]').val();
	var first_name_meaning_en = $('textarea[name=first_name_meaning_en]').val();
	// console.log(last_name_kr);
	// console.log(first_name_kr);
	// console.log(last_name_cn);
	// console.log(first_name_cn);
	// console.log(last_name_en);
	// console.log(first_name_en);
	// console.log(first_name_meaning_kr);
	// console.log(first_name_meaning_en);

	if(last_name_kr == '' || first_name_kr == '' || last_name_en == '' || first_name_en == '') {
		return false;
	} else {
		$.ajax({
	        url: '../../config/api_function_make.php',
	        type:'post',
	        dataType:'json',
	        data:{
	        	type:'MAKE_NAME',
	        	no_mid:no_mid,
	        	email:email,
	        	last_name_ori:last_name_ori,
	        	first_name_ori:first_name_ori,
	            last_name_kr:last_name_kr,
	            first_name_kr:first_name_kr,
	            last_name_cn:last_name_cn,
	            first_name_cn:first_name_cn,
	            last_name_en:last_name_en.toUpperCase(),
	            first_name_en:first_name_en.toUpperCase(),
	            first_name_meaning_kr:first_name_meaning_kr,
	            first_name_meaning_en:first_name_meaning_en
	        },
	        success: function(data) {
	            if(data.result == "true") {
	            	$('#status').removeClass('btn-warning').addClass('btn-success').text('Complete');
	            	$('#make_name_form')[0].reset();
	            	sendMail(data.no, email, last_name_ori, first_name_ori);
	            } else {
	            	showBasicMessage(data.message);
	            }
	        }, error:function(request,status,error) {
	            // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	        }
	    });
	}
}

function sendMail(no, email, last_name_ori, first_name_ori) {
	$.ajax({
        url: '../../config/api_function_make.php',
        type:'post',
        dataType:'json',
        data:{
        	type:'SEND_MAIL',
        	mnid:no,
        	email:email,
        	last_name_ori:last_name_ori,
        	first_name_ori:first_name_ori,
        },
        success: function(data) {
            if(data.result == "true") {
            	showSuccessMessage();
            } else {
            	showBasicMessage(data.message);
            }
        }, error:function(request,status,error) {
            // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });
}