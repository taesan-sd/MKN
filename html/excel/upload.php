<? 
include "../outline/_header.php"; 
$type = $_GET['type'];
?>

<section class="col-lg-4 float-lg-none mg-auto pd-sm-20 c1" id="upload_view">
	<h1 class="c1">EN</h1>
	<p class="c1"><span id="table_name"></span> data upload(xls, xlsx)</p>
	<input type="file" name="upFile" id="upFile" /><br>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="uploadFile()">upload</div>
</section>


<script type="text/javascript">
	var type = '<?=$type?>';

	$(document).ready(function() {
		switch(type) {
			case 'en_last_name':
				$('#table_name').text('Last name');		
				break;

			case 'en_first_name_male':
				$('#table_name').text('First name male');
				break;

			case 'en_first_name_female':
				$('#table_name').text('First name female');
				break;

			default :
				alert('error');
				break;
		}
	})

	function uploadFile() {
		$('.preloader').show();
		$('.preloader').css('background', 'rgba(0,0,0,0.5');

		var formData = new FormData();
		var file = $("#upFile")[0].files[0];
		formData.append("upFile", file);
		formData.append("table", type);
		// console.log(file);
		// console.log(formData);

		$.ajax({
			url: '../ajax/ajax.excel.php',
			type:'post',
            dataType:'json',
			processData: false,
			contentType: false,
			cache:false,
			data: formData,
			success: function(json) {
				$('.preloader').hide();
				alert(json.message);
				location.href = '../excel';
			}, error:function(request,status,error){
	        	// alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	        }
		});
}
</script>
