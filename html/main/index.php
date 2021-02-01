<?php
   // $access_ip = $_SERVER['REMOTE_ADDR']; // IP adress
   // $os = $this->getOS(); // 접속 OS 정보
   // $browser = $this->getBrowser(); // 브라우저 접속 정보
   // $date = date("YmdHis"); // 오늘 날짜시간
?>

<div class="col-lg-12 col-sm-12 col-xs-12 thecenter pd-lg-t0 pd-lg-b0 pd-sm-t80 pd-sm-b80 pd-xs-t80 pd-xs-b80 text-xs-center gmarket-l">
   <section class="col-lg-4 col-sm-12 col-xs-12 text-lg-right text-sm-center mg-lg-l100">
      <img src="../img/title.png" class="width-xs-50">
   </section>
   <section class="col-lg-6 col-sm-12 col-xs-12 text-lg-left mg-lg-t0 mg-sm-t50 mg-xs-t30">
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Last name<br><span class="c4">성</span></label>
         <input type="text" name="last_name" value="" placeholder="" class="col-sm-7-2 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">First name<br><span class="c4">이름</span></label>
         <input type="text" name="first_name" value="" placeholder="" class="col-sm-7-2 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Gender<br><span class="c4">성별</span></label>
         <input type="hidden" name="gender" value="">
         <select class="col-sm-7-2 col-xs-12 pd-sm-10 mg-sm-l10 mg-xs-l0" id="gender" onchange="selChange(this.value, 'gender')">
            <option value="">Choose</option>
            <option value="male">male</option>
            <option value="female">female</option>
         </select>
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30 text-xs-left">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Birthday<br><span class="c4">생년월일</span></label>
         <select id="select_year" onchange="javascript:lastday('select_year', 'select_month', 'select_day');" class="pd-sm-5 mg-sm-l10"></select>
         <select id="select_month" onchange="javascript:lastday('select_year', 'select_month', 'select_day');" class="pd-sm-5 mg-sm-l10"></select>
         <select id="select_day" class="pd-sm-5 mg-sm-l10"></select>
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Nationality<br><span class="c4">국가</span></label>
         <select id="nationality" class="col-sm-7-2 col-xs-12 pd-sm-10 mg-sm-l10" onchange="selChange(this.value, 'nationality')"></select>
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">City<br><span class="c4">도시</span></label>
         <input type="text" name="city" value="" placeholder="" class="col-sm-7-2 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10">
         <label class="col-lg-4 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b"></label>
         <button class="col-sm-7-2 col-xs-12 mg-sm-l10 mg-xs-l0" id="commit" onclick="inputData()">MAKE</button>
      </div>
   </section>
</div>

<!-- 네이버 애널리틱스 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
   wcs_add["wa"] = "9f412103e563d8";
   if(window.wcs) {
   wcs_do();
}
</script>

<script type="text/javascript">
   $(document).ready(function() {
      var data = accessLog();
      check_device();
      countLog(data);
      setBirthday('select_year', 'select_month');
      lastday('select_year', 'select_month', 'select_day');
      setNationality();
      // setCity();
   })

   function countLog(data) {
      var ip, date, time, agent, browser, device;
      ip = data['ip']
      date = data['date'];
      time = data['time'];
      agent = data['agent'];
      browser = data['browser'];
      device = data['device'];

      $.ajax({
         url: '../ajax/ajax.php',
         type:'post',
         dataType:'json',
         data:{
            type:"count_log",
            ip:ip,
            date:date,
            time:time,
            agent:agent,
            browser:browser,
            device:device,
            table:'counter_log'
         },
         success: function(data) {
            if(data.result == "true") {
               console.log(data);
            } else {
               $('.preloader').hide();
               open_alert_popup(data.message, '', 2000);
            }
         }, error:function(request,status,error) {
            $('.preloader').hide();
             // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
         }
      });
   }

   // 입력 데이터 저장
   function inputData() {
      var last_name = $('input[name=last_name]').val().toUpperCase();
      var first_name = $('input[name=first_name]').val().toUpperCase();
      var gender = $('input[name=gender]').val().toUpperCase();
      var year = $("#select_year option:selected").val();
      var month = $("#select_month option:selected").val();
      var day = $("#select_day option:selected").val();
      var birthday = year+"-"+month+"-"+day;
      var nationality = $("#nationality option:selected").val().toUpperCase();
      var city = $('input[name=city]').val().toUpperCase();
      // console.log(last_name);
      // console.log(first_name);
      // console.log(gender);
      // console.log(year);
      // console.log(month);
      // console.log(day);
      // console.log(birthday);
      // console.log(nationality);
      // console.log(city);

      if(last_name == '') {
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
         $('.preloader').show();
         $('.preloader').css('background', 'rgba(0,0,0,0.5');

         $.ajax({
            url: '../ajax/ajax.php',
            type:'post',
            dataType:'json',
            data:{
               type:"make_input_data",
               last_name:last_name,
               first_name:first_name,
               gender:gender,
               birthday:birthday,
               nationality:nationality,
               city:city,
               table:'make_input_data'
            },
            success: function(data) {
               if(data.result == "true") {
                  // console.log(data.no);
                  makeName1(data.no);
               } else {
                  $('.preloader').hide();
                  open_alert_popup(data.message, '', 2000);
               }
            }, error:function(request,status,error) {
               $('.preloader').hide();
                // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
         });
      }
   }

   // 이름 추출 1 - 입력한 데이터 db에서 가져오기
   function makeName1(no) {
      var last_name_table = '';
      var first_name_table = '';
      var last_name = '';
      var first_name = '';
      var birthArr = '';
      var month = '';
      var rowArr = new Array();

      $.ajax({
         url: '../ajax/ajax.php',
         type:'post',
         dataType:'json',
         data:{
            type:"get_make_name_data",
            no:no,
            table:'make_input_data'
         },
         success: function(json) {
            if(json.result == "true") {
               // if(json.data.nationality == 'US') {
                  last_name_table = 'en_last_name'; // 성 테이블
                  if(json.data.gender == 'MALE') {
                     first_name_table = 'en_first_name_male'; // 남 이름 테이블
                  } else {
                     first_name_table = 'en_first_name_female'; // 여 이름 테이블
                  }
                  last_name = json.data.last_name;
                  first_name = json.data.first_name;
                  birthArr = json.data.birthday.split('-');
                  month = birthArr[1];
                  makeName2(last_name_table, first_name_table, last_name, first_name, month, json.data.nationality, json.data.city, json.data.birthday, no);
               // } else {
               //    $('.preloader').hide();
               //    open_alert_popup('It is not a country that is currently being supported. I will apply as soon as possible.', '', 2000);
               // }
            } else {
               $('.preloader').hide();
               open_alert_popup(json.message, '', 2000);
            }
         }, error:function(request,status,error) {
            $('.preloader').hide();
             // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
         }
      });
   }

   // 이름 추출 2 - db에 있는 성과 이름인지 검사
   function makeName2(last_name_table, first_name_table, last_name, first_name, month, nationality, city, birthday, mid) {
      $.ajax({
         url: '../ajax/ajax.php',
         type:'post',
         dataType:'json',
         data:{
            type:"make_name_data1",
            last_name_table:last_name_table,
            first_name_table:first_name_table,
            last_name:last_name,
            first_name:first_name,
            month:month,
         },
         success: function(json) {
            if(json.result == "true") {
               console.log(json);
               if(!json.last_name_array || !json.first_name_array) {
                  $('.preloader').hide();
                  open_alert_popup('No last name and first name in DB', '../sub/support.php?mid='+mid, 2000);
                  
               } else if(json.last_name_array.name_kr == '' || json.last_name_array.name_kr == null || json.last_name_array.name_kr == 'null') {
                  $('.preloader').hide();
                  open_alert_popup('No last name in DB', '../sub/support.php?mid='+mid, 2000);
                  
               } else if(json.first_name_array.name_kr == '' || json.first_name_array.name_kr == null || json.first_name_array.name_kr == 'null') {
                  $('.preloader').hide();
                  open_alert_popup('No first name in DB', '../sub/support.php?mid='+mid, 2000);
                  
               } else {
                  $.ajax({
                     url: '../ajax/ajax.php',
                     type:'post',
                     dataType:'json',
                     data:{
                        type:'make_name_data2',
                        table:'make_name_data',
                        mid:mid,
                        // nationality:nationality,
                        // city:city,
                        // birthday:birthday,
                        last_name_no:json.last_name_array.no,
                        last_name_ori:json.last_name_array.name_ori_en,
                        last_name_kr:json.last_name_array.name_kr,
                        last_name_cn:json.last_name_array.name_cn,
                        last_name_en:json.last_name_array.name_en,
                        last_name_meaning:json.last_name_array.meaning,
                        root:json.last_name_array.root,
                        first_name_no:json.first_name_array.no,
                        first_name_ori:json.first_name_array.name_ori_en,
                        first_name_kr:json.first_name_array.name_kr,
                        first_name_cn:json.first_name_array.name_cn,
                        first_name_en:json.first_name_array.name_en,
                        first_name_meaning_kr:json.first_name_array.meaning_kr,
                        first_name_meaning_en:json.first_name_array.meaning_en
                     },
                     success: function(json) {
                        $('.preloader').hide();
                        if(json.result == "true") {
                           console.log(json);
                           location.href = '../sub/card.php?no='+json.no; 
                        } else {
                           $('.preloader').hide();
                           open_alert_popup(json.message, '', 2000);
                        }
                     }, error:function(request,status,error){
                        $('.preloader').hide();
                         // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                     }
                  });
               }
            } else {
               $('.preloader').hide();
               open_alert_popup(json.message, '', 2000);
            }
         }, error:function(request,status,error){
            $('.preloader').hide();
             // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
         }
      });
   }
</script>