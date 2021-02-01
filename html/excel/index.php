<? include "../outline/_header.php"; ?>

<section class="col-lg-4 float-lg-none mg-auto pd-sm-20" id="select_view">
	<h1 class="c1">EN</h1>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="pageView('en_last_name')">Last name upload</div>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="pageView('en_first_name_male')">First name upload(male)</div>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="pageView('en_first_name_female')">First name upload(female)</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		open_alert_popup('path is not valid.', '../', 2000);

		// 관리자페이지에서 업로드
		// var curl = bUrl(window.location.href);
		// var result = LoginCheck();
		// if(!result) {
		// 	pageMove('../member/login.php?curl='+curl);
		// } else {
		// 	var session_m_no = aUrl(getSeesion("m_no"));
		// 	var session_m_id = aUrl(getSeesion("m_id"));
		// 	$.ajax({
	 //            url: '../ajax/ajax.member.php',
	 //            type:'post',
	 //            dataType:'json',
	 //            data:{
	 //               type:"get_user_info",
	 //               email:session_m_id
	 //            },
	 //            success: function(data) {
	 //               if(data.result == "true") {
	 //                  console.log(data);
	 //               } else {
	 //                  showBasicMessage(data.message);
	 //                  // console.log(data.message);
	 //               }
	 //            }, error:function(request,status,error) {
	 //                // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	 //            }
	 //        });
		// }
	});

	function pageView(table) {
		pageMove('./upload.php?type='+table);
	}
</script>
