<? include "../outline/_header.php"; ?>

<div class="col-lg-12 col-sm-12 col-xs-12 text-xs-center gmarket-l pd-lg-t80 pd-lg-b80 pd-sm-t80 pd-sm-b80 pd-xs-t80 pd-xs-b80">
   <section class="col-lg-12 col-sm-12 col-xs-12 text-sm-center">
      <img src="../img/sub_title.png" class="width-xs-100 cursor" onclick="pageMove('../')">
   </section>
   <section class="thecenter_l layout-body col-lg-12 col-sm-11 col-xs-12 text-sm-center mg-lg-t80 mg-sm-t50 mg-xs-t50">
   		<div class="layout-body thecenter_l bg_white border-radius-5 col-lg-6 col-sm-12 pd-lg-t50 pd-lg-b50 pd-sm-t50 pd-sm-b50 pd-xs-t30 pd-xs-b40">
   			<p class="c2 gmarket-b fs-lg-20 fs-sm-20 fs-xs-20 mg-lg-b10 wb">Your name is very special!<br><span class="gmarket-l fs-lg-16 fs-sm-16 fs-xs-16 wb">당신의 이름은 아주 특별하군요!</span></p>
   			<p class="c2 gmarket-b fs-lg-20 fs-sm-20 fs-xs-20 mg-lg-b10 wb">Currently, your name is not in our data.<br><span class="gmarket-l fs-lg-16 fs-sm-16 fs-xs-16 wb">현재 당신의 이름은 우리 데이터에 없습니다.</span></p>
   			<p class="c2 gmarket-b fs-lg-20 fs-sm-20 fs-xs-20 mg-lg-b10 wb">If you wait a little bit, the support team will make name it and notify you by email.<br><span class="gmarket-l fs-lg-16 fs-sm-16 fs-xs-16 wb">조금만 기다려주시면 지원팀에서 작명하여 당신의 이메일로 알림 드리겠습니다.</span></p>
   			<br>
   			<div class="layout-body mg-sm-b10 mg-xs-b30">
	        	<label class="col-lg-3 col-sm-3 col-xs-12 pd-xs-0 c2 text-sm-right text-xs-left gmarket-b">E-mail<br><span class="c6">이메일</span></label>
	        	<input type="email" name="email" value="" placeholder="" class="col-sm-7-2 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
	      	</div>
	      	<div class="layout-body thecenter_l col-sm-9 mg-sm-b10 text-lg-right">
		        <button class="float-r mg-sm-l10 mg-xs-l10" id="commit" onclick="setEmail()">agree</button>
		        <button class="float-r mg-sm-l10 mg-xs-l0" id="cancel" onclick="pageMove('../')">cancel</button>
	      	</div>
   		</div>
   </section>
</div>

<? include "../outline/_footer_sub.php"; ?>

<script type="text/javascript">
	var mid = '<?=$_GET['mid']?>';

	$(document).ready(function() {
		if(!mid) {
			open_alert_popup('path is not valid.', '../', 0);
		}
	})

	function setEmail() {		
		var email = $('input[name=email]').val();
		if(email == '') {
			open_alert_popup('Please input your email', '', 1800);
         	$('input[name=email]').focus();
		} else {
			$.ajax({
				url: '../ajax/ajax.php',
				type:'post',
				dataType:'json',
				data:{
					type:"set_email",
					mid:mid,
					email:email,
					table:'make_input_data'
				},
				success: function(json) {
					if(json.result == "true") {
						open_alert_popup('Thank you. See you again', '../', 1800);
					} else {
						$('.preloader').hide();
						open_alert_popup(json.message, '', 1800);
					}
				}, error:function(request,status,error) {
					$('.preloader').hide();
					// alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		}		
	}
</script>