<? include "../outline/_header.php"; ?>

<input type="hidden" name="last_name_no" value="<?=$_GET['no']?>" />

<div class="col-lg-12 col-sm-12 col-xs-12 text-xs-center gmarket-l pd-lg-t80 pd-lg-b80 pd-sm-t80 pd-sm-b80 pd-xs-t80 pd-xs-b80">
   <section class="col-lg-12 col-sm-12 col-xs-12 text-sm-center">
      <img src="../img/sub_title.png" class="width-xs-100 cursor" onclick="pageMove('../')">
   </section>
   <section class="thecenter_l layout-body col-lg-12 col-sm-11 col-xs-12 text-sm-center mg-lg-t80 mg-sm-t50 mg-xs-t50">
   		<div class="thecenter_l card_bg col-lg-6 col-sm-12 pd-lg-t50 pd-lg-b50 pd-sm-t50 pd-sm-b50 pd-xs-t30 pd-xs-b40">
   			<p class="c2 fs-lg-20 fs-sm-20 fs-xs-20 mg-lg-b10">Name card</p>
   			<p class="c2 fs-lg-18 fs-sm-18 fs-xs-18 gmarket-m">네임 카드</p>
   			<div class="layout-body border-xs-bottom col-lg-12 col-sm-12 col-xs-12 mg-lg-t30 mg-sm-t30 mg-xs-t30 pd-xs-b20">
   				<label class="col-lg-5 col-sm-5 col-xs-12 c2 fs-lg-18 fs-sm-18 fs-xs-16 text-sm-right text-xs-center gmarket-b pd-lg-0 pd-sm-0 pd-xs-0">
   					English name<br>
   					<span class="c5">영어 이름</span>
   				</label>
   				<img src="../img/img_line_card.png" class="hidden-xs float-l mg-lg-l30 mg-lg-r30 mg-sm-l30 mg-sm-r30 mg-xs-l20 mg-xs-r20">
   				<label class="col-lg-5 col-sm-5 col-xs-12 fs-lg-20 fs-sm-20 fs-xs-16 gmarket-m text-lg-left text-sm-left text-xs-center pd-lg-0 pd-sm-0 pd-xs-0 mg-lg-t15 mg-sm-t15 mg-xs-t10">
   					<span id="last_name_ori"></span>
   					&nbsp&nbsp
   					<span id="first_name_ori"></span>
   				</label>
   			</div>
   			<div class="layout-body border-xs-bottom col-lg-12 col-sm-12 mg-lg-t30 mg-sm-t30 mg-xs-t30 pd-xs-t30 pd-xs-b20">
   				<label class="col-lg-5 col-sm-5 col-xs-12 c2 fs-lg-18 fs-sm-18 fs-xs-16 text-sm-right text-xs-center gmarket-b pd-lg-0 pd-sm-0 pd-xs-0">
   					Korean name<br>
   					<span class="c5">한글 이름</span>
   				</label>
   				<img src="../img/img_line_card.png" class="hidden-xs float-l mg-lg-l30 mg-lg-r30 mg-sm-l30 mg-sm-r30 mg-xs-l20 mg-xs-r20">
   				<label class="col-lg-5 col-sm-5 col-xs-12 fs-lg-20 fs-sm-20 fs-xs-16 gmarket-m text-lg-left text-sm-left text-xs-center pd-lg-0 pd-sm-0 pd-xs-0 mg-lg-t0 mg-sm-t0 mg-xs-t10">
   					<label class="text-lg-center">
   						<span class="gmarket-b fs-lg-30 fs-sm-30 fs-xs-24" id="last_name_kr"></span><br>
   						<span class="c2 gmarket-l fs-lg-14 fs-sm-14 fs-xs-12" id="last_name_en"></span><br>
   						<span class="gmarket-l fs-lg-20 fs-sm-20 fs-xs-20" id="last_name_cn"></span>
   					</label>
   						&nbsp&nbsp
   					<label class="text-lg-center">
	   					<span class="gmarket-b fs-lg-30 fs-sm-30 fs-xs-24" id="first_name_kr"></span><br>
	   					<span class="c2 gmarket-l fs-lg-14 fs-sm-14 fs-xs-12" id="first_name_en"></span><br>
	   					<span class="gmarket-l fs-lg-20 fs-sm-20 fs-xs-20" id="first_name_cn"></span>
   					</label>
   				</label>
   			</div>
   			<div class="layout-body card_meaning_bg col-lg-12 col-sm-12 pd-lg-t50 pd-lg-b50 pd-sm-t50 pd-sm-b50 pd-xs-t20 pd-xs-b20 mg-xs-t40">
   				<label class="col-lg-5 col-sm-5 col-xs-12 c2 fs-lg-18 fs-sm-18 fs-xs-16 text-sm-right text-xs-center gmarket-b pd-lg-0 pd-sm-0 pd-xs-0">
   					Name meaning<br>
   					<span class="c5">이름의 뜻</span>
   				</label>
   				<img src="../img/img_line_card.png" class="hidden-xs float-l mg-lg-l30 mg-lg-r30 mg-sm-l30 mg-sm-r30">
   				<div class="col-sm-5 col-xs-12 text-lg-left text-sm-left pd-lg-0 pd-sm-0 pd-xs-t10">
	   				<div class="blurEffect" id="meaning_wrap">
		   				<label>	
		   					<span class="gmarket-l" id="first_name_meaning_en"></span><br>
		   					<span class="gmarket-l fs-lg-20 fs-sm-20 fs-xs-16" id="first_name_meaning_kr"></span>
						</label>
					</div>
					<label class="gmarket-m mg-xs-t10 wb" id="meaning_wrap2">
						<span class="c5"><span class="c2 cursor" onclick="pageMove('../member/register.php?no=<?=$_GET['no']?>')">Click</span> if you want to know what your name means</span><br>
						<!-- pageMove('../member/register.php') -->
						<span class="c5">이름의 뜻이 궁금하다면 <span class="c2 cursor" onclick="pageMove('../member/register.php?no=<?=$_GET['no']?>')">클릭</span>하세요.</span>
					</label>
				</div>
   			</div>
   		</div>
   </section>
   <section class="thecenter_l layout-body col-lg-6 col-sm-11 col-xs-12 mg-lg-t20 mg-sm-t20 mg-xs-t20">
   	<div class="col-lg-12 text-lg-right">
   		<img src="../img/btn_share_instargram.png" class="btn_share float-r cursor mg-lg-l10 mg-sm-l10 mg-xs-l10" onclick="snsSharing('instargram')">
   		<img src="../img/btn_share_facebook.png" class="btn_share float-r cursor mg-lg-l10 mg-sm-l10 mg-xs-l10" onclick="snsSharing('facebook')">
   		<p class="float-r c7 gmarket-l mg-lg-t5 mg-sm-t5 mg-xs-t5">SNS Sharing</p>
   	</div>
   </section>
</div>

<? include "../outline/_footer_sub.php"; ?>

<script type="text/javascript">
	$(document).ready(function() {
		var no = '<?=$_GET['no']?>';
		if(!no) {
			open_alert_popup('path is not valid.', '../', 0);
		} else {
			getConfirmMember(no); // 회원가입된 회원인지 체크
			getNameData(no); // make name 불러오기
		}
	})

	function getConfirmMember(no) {
		$.ajax({
			url: '../ajax/ajax.php',
			type:'post',
			dataType:'json',
			data:{
				type:"get_member_confirm",
				table:"member",
				no:no,
			},
			success: function(json) {
				if(json.result == "true") {
					if(json.count == 1) {
						$('#meaning_wrap').removeClass('blurEffect');
						$('#meaning_wrap2').hide();	
					}
				} else {
					open_alert_popup(json.message, '', '');
				}
			}, error:function(request,status,error){
				// alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}

	function getNameData(no) {
		$.ajax({
			url: '../ajax/ajax.php',
			type:'post',
			dataType:'json',
			data:{
				type:"get_name_data",
				table:"make_name_data",
				no:no,
			},
			success: function(json) {
				if(json.result == "true") {
					$('#last_name_ori').text(json.data.last_name_ori);
					$('#first_name_ori').text(json.data.first_name_ori);
					$('#last_name_kr').text(json.data.last_name_kr);
					$('#last_name_en').text(json.data.last_name_en);
					$('#last_name_cn').text(json.data.last_name_cn);
					$('#last_name_meaning').text(json.data.last_name_meaning);
					$('#first_name_kr').text(json.data.first_name_kr);
					$('#first_name_en').text(json.data.first_name_en);
					$('#first_name_cn').text(json.data.first_name_cn);
					$('#first_name_meaning_kr').text(json.data.first_name_meaning_kr);
					$('#first_name_meaning_en').text(json.data.first_name_meaning_en);
				} else {
					open_alert_popup(json.message, '', '');
				}
			}, error:function(request,status,error){
				// alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}

	function snsSharing(type) {
		var linkUrl = window.location.href;
		if(type == 'facebook') {
			window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(linkUrl));
		} else if(type == 'instargram') {
			window.open('https://api.instagram.com/oauth/authorize/?client_id=&redirect_uri='+linkUrl+'&response_type=code');	
		}
	}

	function tempClcik() {
		open_alert_popup('임시적으로 활성화 중 입니다.', '', 2000);
		$('#meaning_wrap').removeClass('blurEffect');
	}
</script>