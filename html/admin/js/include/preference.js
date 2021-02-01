// 디바이스 체크
function check_device() { 
   var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson'); 
   var device_name = ''; 
   for (var word in mobileKeyWords) {
      if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
         device_name = mobileKeyWords[word]; 
         break; 
      }
   }
   setCookie("m_device", device_name, 365); 
}

// 쿠키 저장
function setCookie(cookieName, value, exdays){
   var exdate = new Date();
   exdate.setDate(exdate.getDate() + exdays);
   var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
   document.cookie = cookieName + "=" + cookieValue +"; path=/";
}

// 쿠키 삭제
function deleteCookie(cookieName){
   var expireDate = new Date();
   expireDate.setDate(expireDate.getDate() - 1);
   document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString() + "; path=/";
}

// 쿠키 읽기
function getCookie(cookieName) {
   cookieName = cookieName + '=';
   var cookieData = document.cookie;
   var start = cookieData.indexOf(cookieName);
   var cookieValue = '';
   if(start != -1){
      start += cookieName.length;
      var end = cookieData.indexOf(';', start);
      if(end == -1)end = cookieData.length;
      cookieValue = cookieData.substring(start, end);
   }
   return unescape(cookieValue);
}

// 세션 저장
function setSession(sessionName, value) {
  if (window.sessionStorage) {
    sessionStorage.setItem(sessionName, value);
  }
}

// 세션 읽기
function getSeesion(sessionName) {
  if (window.sessionStorage) {
    var result = sessionStorage.getItem(sessionName);
  }
  return result;
}

// 세션 삭제
function deleteSeesion(sessionName) {
  if (window.sessionStorage) {
    if(sessionName) {
      sessionStorage.removeItem(sessionName);
    } else {
      sessionStorage.clear();
    }
  }
}


// 로딩 활성
function wrapWindowByMask() {
   //화면의 높이와 너비를 구한다.
   var maskHeight = $(document).height(); 
   // var maskWidth = $(document).width();
   var maskWidth = window.document.body.clientWidth;

   var mask = "<div id='mask' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
   var loadingImg = '';

   loadingImg += "<div id='loadingImg' style='position:absolute; left:50%; top:50%; transform: translate(-50%,-50%); display:none; z-index:10000;'>";
   loadingImg += " <img src='../image/common/viewLoading4.gif'/>";
   loadingImg += "</div>";  

   //화면에 레이어 추가
   $('body').append(mask).append(loadingImg)

   //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
   $('#mask').css({
      'width' : maskWidth,
      'height': maskHeight,
      'opacity' : '0.2'
   }); 

   //마스크 표시
   $('#mask').show();   

   //로딩중 이미지 표시
   $('#loadingImg').show();
}

// 로딩 비활성
function closeWindowByMask() {
   $('#mask, #loadingImg').hide();
   $('#mask, #loadingImg').remove();  
}

// 알림창 활성화
function open_alert_popup(text, url, auto) {
  $('body').css('overflow', 'hidden');
   $(".alert_popup").text(text);
   $('.alert_popup').bPopup({
    positionStyle: 'fixed',
    modalClose: true,
    opacity: 0.6,
    followSpeed: 1000, //can be a string ('slow'/'fast') or int
    speed: 300,
    transition: 'slideDown',
    transitionClose: 'slideBack',
    autoClose: auto,
    follow: [false, false],
    position: ["50%","50%"],
    onClose: function() { 
      $('body').css('overflow', 'auto');
      if(url) {
        location.href = url;  
      }
    }
  });
}

//숫자 콤마 찍기
function number_comma(number) {
  return number.replace(/(\d)(?=(?:\d{3})+(?!\d))/g,'$1,');
}

// 현재 언어 가져오기
function getLanguage() {
  var lang = navigator.language || navigator.userLanguage;
  lang = lang.toLowerCase(); //받아온 값을 소문자로 변경
  lang = lang.substring(0, 2); //소문자로 변경한 갚의 앞 2글자만 받아오기
  return lang;
}

// 생년월일 select
function setBirthday(y_id, m_id) {
  var start_year = "0"; // 시작할 년도 
  var today = new Date(); 
  var today_year = today.getFullYear(); 
  var index = 0; 
  for(var y=start_year; y<=today_year; y++) { //start_year ~ 현재 년도 
    document.getElementById(y_id).options[index] = new Option(y, y); 
    index++; 
  }
  index=0; 
  for(var m=1; m<=12; m++) { 
    document.getElementById(m_id).options[index] = new Option(m, m);
    index++;
  }

  // 초기 선택값
  $('#'+y_id).val('1980');
  $('#'+m_id).val('9');
}

// 년과 월에 따라 마지막 일 구하기 
function lastday(y_id, m_id, d_id) { 
  var Year = document.getElementById(y_id).value; 
  var Month = document.getElementById(m_id).value; 
  var day = new Date(new Date(Year,Month,1)-86400000).getDate(); 
  var dayindex_len = document.getElementById(d_id).length; 
  if(day>dayindex_len) { 
    for(var i=(dayindex_len+1); i<=day; i++) { 
      document.getElementById(d_id).options[i-1] = new Option(i, i); 
    } 
  } else if(day<dayindex_len) { 
    for(var i=dayindex_len; i>=day; i--) {
      document.getElementById(d_id).options[i] = null; 
   } 
  } 
}

// 셀렉트박스 선택값 
function selChange(val, name) {
  // console.log(val);
  $('input[name='+name+']').val(val);
}

// set 국가
function setNationality() {
  var html = '';
  var arrData = new Array();

  $.ajax({
     url: '../ajax/ajax.php',
     type:'post',
     dataType:'json',
     data:{
        type:"setNationality",
     },
     success: function(data){
        if(data.result == "true") {
           arrData.push(data.data);
           html = '<option value="">Choose</option>';
           for(var i=0; i<arrData.length; i++) {
              for(var j=0; j<arrData[i].length; j++) {
                 html += '<option value="'+arrData[i][j].cc_fips+'" cc_fips="'+arrData[i][j].cc_fips+'" cc_iso="'+arrData[i][j].cc_iso+'" tld="'+arrData[i][j].tld+'">'+arrData[i][j].country_name+'</option>';
              }
           }
           $('#nationality').append(html);
           
        } else {
           open_alert_popup(data.message, '', 2000);
        }
     }, error:function(request,status,error){
         // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
     }
  });
}

// set 도시 - 사용안함
function setCity(cc_fips) {
  var arrData = new Array();

  $.ajax({
     url: '../ajax/ajax.php',
     type:'post',
     dataType:'json',
     data:{
        type:"setCity",
        nationality:cc_fips,
     },
     success: function(data) {
        if(data.result == "true") {
           arrData.push(data.data);
           for(var i=0; i<arrData.length; i++) {
              for(var j=0; j<arrData[i].length; j++) {
                 console.log(arrData[i][j]);
              }
           }
        } else {
           open_alert_popup(data.message, '', 2000);
        }
     }, error:function(request,status,error){
         // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
     }
  });
}

// 페이지 이동
function pageMove(url) {
  location.href = url;
}

function checkEmail(input_email) {
  var email = $('input[name='+input_email+']').val();
  var reg_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
  if(!reg_email.test(email)) {
    open_alert_popup('The E-mail address is not valid.', '', 2000);
    $('input[name='+input_email+']').focus();
    return false;    
  } else {
    console.log("이메일 통과"); 
    return true;      
  }
}

// 비밀번호 유효성 체크
function chkPW(input_name) {
  var pw = $('input[name='+input_name+']').val();
  var num = pw.search(/[0-9]/g);
  var eng = pw.search(/[a-z]/ig);
  var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

  if(pw.length < 8 || pw.length > 20){
    open_alert_popup('Please enter the password between 8 and 20 digits.', '', 2000);
    $('input[name='+input_name+']').focus();
    return false;
  } else if(pw.search(/\s/) != -1) {
    open_alert_popup('Please enter the password without spaces.', '', 2000);
    $('input[name='+input_name+']').focus();
    return false;
  } else if(num < 0 || eng < 0 || spe < 0 ) {
    open_alert_popup('Please enter a mixture of English, Numeric, and Special Characters.', '', 2000);
    $('input[name='+input_name+']').focus();
    return false;
  } else {
    console.log("비밀번호 통과"); 
    return true;
  }
}

// 로그인 체크
function LoginCheck() {
  var cookie_m_no = getCookie("m_no");
  var cookie_m_id = getCookie("m_id");
  var session_m_no = getSeesion("m_no");
  var session_m_id = getSeesion("m_id");

  if((aUrl(cookie_m_no) == aUrl(session_m_no)) && (aUrl(cookie_m_id) == aUrl(session_m_id))) {
    // 로그인 완료
    return true;

  } else {
    // 로그인 페이지 이동
    return false;
  }
}

// 로그아웃
function Logout() {
  deleteCookie('m_id');
  deleteCookie('m_no');
  deleteSeesion('m_id');
  deleteSeesion('m_no');
  pageMove(location.protocol+"//"+location.host);
}

// url 암호화
function bUrl(str) {
  _str = window.btoa(str);
  return _str;
}

// url 복호화
function aUrl(str) {
  _str = window.atob(str);
  return _str;
}