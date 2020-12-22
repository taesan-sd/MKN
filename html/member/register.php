<? include "../outline/_header.php"; ?>

<div class="col-lg-12 col-sm-12 col-xs-12 thecenter-l pd-lg-t80 pd-lg-b80 pd-sm-t80 pd-sm-b80 pd-xs-t80 pd-xs-b80 gmarket-l">
   <section class="col-lg-12 col-sm-12 col-xs-12 text-sm-center">
      <img src="../img/sub_title.png" class="width-xs-100 cursor" onclick="pageMove('../')">
   </section>
   <section class="col-lg-4 col-sm-12 col-xs-12 text-lg-right text-sm-center mg-lg-l100 mg-lg-t50 mg-sm-t50 mg-xs-t30">
      <img src="../img/title_signup.png" class="width-xs-50">
   </section>
   <section class="col-lg-6 col-sm-12 col-xs-12 text-lg-left mg-lg-t50 mg-sm-t50 mg-xs-t30">
   	  <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">E-mail<br><span class="c4">이메일</span></label>
         <input type="email" name="email" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Password<br><span class="c4">비밀번호</span></label>
         <input type="password" name="password" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Last name<br><span class="c4">성</span></label>
         <input type="text" name="last_name" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">First name<br><span class="c4">이름</span></label>
         <input type="text" name="first_name" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Gender<br><span class="c4">성별</span></label>
         <input type="hidden" name="gender" value="">
         <select class="col-sm-6 col-xs-12 pd-sm-10 mg-sm-l10 mg-xs-l0" id="gender" onchange="selChange(this.value, 'gender')">
            <option value="">Choose</option>
            <option value="MALE">male</option>
            <option value="FEMALE">female</option>
         </select>
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30 text-xs-left">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Birthday<br><span class="c4">생년월일</span></label>
         <select id="select_year" onchange="javascript:lastday('select_year', 'select_month', 'select_day');" class="pd-sm-5 mg-sm-l10"></select>
         <select id="select_month" onchange="javascript:lastday('select_year', 'select_month', 'select_day');" class="pd-sm-5 mg-sm-l10"></select>
         <select id="select_day" class="pd-sm-5 mg-sm-l10"></select>
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Nationality<br><span class="c4">국가</span></label>
         <select id="nationality" class="col-sm-6 col-xs-12 pd-sm-10 mg-sm-l10" onchange="selChange(this.value, 'nationality')"></select>
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">City<br><span class="c4">도시</span></label>
         <input type="text" name="city" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body thecenter_l col-sm-4-2 mg-sm-b10 text-lg-right">
         <button class="float-r mg-sm-l10 mg-xs-l10" id="commit" onclick="signUp()">agree</button>
         <button class="float-r mg-sm-l10 mg-xs-l0" id="cancel" onclick="pageMove('../')">cancel</button>
  	  </div>
   </section>
</div>

<? include "../outline/_footer_sub.php"; ?>

<script type="text/javascript">
	var no = '<?=$_GET['no']?>';
	var mn_id = no;
	var mi_id;

   	$(document).ready(function() {
   		setBirthday('select_year', 'select_month');
   		lastday('select_year', 'select_month', 'select_day');
      	setNationality();

    	if(!no) {
			open_alert_popup('path is not valid.', '../', 0);
		} else {
			getUserData(no);
		}
   	})

   	function getUserData(no) {
   		$.ajax({
			url: '../ajax/ajax.php',
			type:'post',
			dataType:'json',
			data:{
				type:"get_name_data",
				no:no,
				table:'make_name_data'
			},
			success: function(json) {
				if(json.result == "true") {
					console.log(json);
					getUserData2(json.data.no_mid);
					mi_id = json.data.no_mid;
					$('input[name=last_name]').val(json.data.last_name_ori);
					$('input[name=first_name]').val(json.data.first_name_ori);
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

   	function getUserData2(mid) {
   		$.ajax({
			url: '../ajax/ajax.php',
			type:'post',
			dataType:'json',
			data:{
				type:"get_make_name_data",
				no:mid,
				table:'make_input_data'
			},
			success: function(json) {
				if(json.result == "true") {
					console.log(json);
					$('input[name=gender]').val(json.data.gender);
					$('#gender').val(json.data.gender).attr('selected', 'selected');
					var birth = json.data.birthday.split('-');
					var year = birth[0];
					var month = birth[1];
					var day = birth[2];
					$('#select_year').val(year).attr('selected', 'selected');
					$('#select_month').val(month).attr('selected', 'selected');
					$('#select_day').val(day).attr('selected', 'selected');
					$('#nationality').val(json.data.nationality).attr('selected', 'selected');
					$('input[name=city]').val(json.data.city);
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

   	function signUp() {
   		var email = $('input[name=email]').val();
   		var password = $('input[name=password]').val();
   		var last_name = $('input[name=last_name]').val().toUpperCase();
		var first_name = $('input[name=first_name]').val().toUpperCase();
		var gender = $('input[name=gender]').val().toUpperCase();
		var year = $("#select_year option:selected").val();
        var month = $("#select_month option:selected").val();
        var day = $("#select_day option:selected").val();
		var birthday = year+"-"+month+"-"+day;
		var nationality = $("#nationality option:selected").val().toUpperCase();
	    var city = $('input[name=city]').val().toUpperCase();

      	if(email == '') {
      		open_alert_popup('Please input your email.', '', 2000);
	        $('input[name=email]').focus();
      	} else if(password == '') {
      		open_alert_popup('Please input your password.', '', 2000);
	        $('input[name=password]').focus();
      	} else if(last_name == '') {
	        open_alert_popup('Please input your last name.', '', 2000);
	        $('input[name=last_name]').focus();
	    } else if(first_name == '') {
	        open_alert_popup('Please input your first name', '', 2000);
	        $('input[name=first_name]').focus();
	    } else if(gender == '') {
	        open_alert_popup('Please select your gender.', '', 2000);
	        $('#gender').focus();
	    } else if(year == '' || typeof year == 'undefined') {
	        open_alert_popup('Please enter your birth', '', 2000);
	    } else if(month == '' || typeof month == 'undefined') {
	        open_alert_popup('Please enter your birth', '', 2000);
	    } else if(day == '' || typeof day == 'undefined') {
	        open_alert_popup('Please enter your birth', '', 2000);
	    } else if(nationality == '' || typeof nationality == 'undefined') {
	        open_alert_popup('Please select your nationality', '', 2000);
	    } else if(city == '') {
	        open_alert_popup('Please input your city', '', 2000);
	    } else {
	    	var result_email = checkEmail('email'); // 이메일 유효성 체크
	    	var result_pw = chkPW('password'); // 비밀번호 유효성 체크

	    	if(result_email && result_pw) {
	    		$('.preloader').show();
	         	$('.preloader').css('background', 'rgba(0,0,0,0.5');

	         	console.log(email);
			    console.log(password);
			    console.log(last_name);
		      	console.log(first_name);
		      	console.log(gender);
		      	console.log(birthday);
		      	console.log(nationality);
		      	console.log(city);

	         	$.ajax({
		            url: '../ajax/ajax.php',
		            type:'post',
		            dataType:'json',
		            data:{
		               type:"reg_user",
		               mi_id:mi_id,
		               mn_id:mn_id,
		               email:email,
		               password:password,
		               last_name:last_name,
		               first_name:first_name,
		               gender:gender,
		               birthday:birthday,
		               nationality:nationality,
		               city:city,
		               table:'member'
		            },
		            success: function(data) {
		               if(data.result == "true") {
		                  $('.preloader').hide();
		                  open_alert_popup('Congratulations on joining.', '../sub/card.php?no='+mn_id, 2000);
		               } else {
		                  $('.preloader').hide();
		                  if(data.message.indexOf('unique_email_address') != -1) {
		                  	open_alert_popup('This email is in use.', '', 2000);
		                  } else if(data.message.indexOf('unique_user_id') != -1) {
		                  	open_alert_popup('Users already joined.', '', 2000);
		                  }
		               }
		            }, error:function(request,status,error) {
		               $('.preloader').hide();
		                // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		            }
		        });
	        }
	    }
   	}
</script>