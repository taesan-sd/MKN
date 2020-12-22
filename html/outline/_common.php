<?
include $_SERVER['DOCUMENT_ROOT']."/include/_function.php";
?>

<!-- 헤더 메인 -->
<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<meta name="description" content="make your korean name" />
		<meta name="keywords" content="kotact, mkn, makekoreanname, koreanname, makeyourkoreanname, makerealkoreanname, havekoreanname, 한국이름, 한국이름만들기, 이름짓기, 이름만들기, 한글이름, 한글이름만들기">

		<link rel="apple-touch-icon" sizes="57x57" href="">
		<link rel="apple-touch-icon" sizes="60x60" href="">
		<link rel="apple-touch-icon" sizes="72x72" href="">
		<link rel="apple-touch-icon" sizes="76x76" href="">
		<link rel="apple-touch-icon" sizes="114x114" href="">
		<link rel="apple-touch-icon" sizes="120x120" href="">
		<link rel="apple-touch-icon" sizes="144x144" href="">
		<link rel="apple-touch-icon" sizes="152x152" href="">
		<link rel="apple-touch-icon" sizes="180x180" href="">
		<link rel="icon" type="image/png" sizes="192x192"  href="">
		<link rel="icon" type="image/png" sizes="32x32" href="">
		<link rel="icon" type="image/png" sizes="96x96" href="">
		<link rel="icon" type="image/png" sizes="16x16" href="">
		<link rel="manifest" href="../favicon/m/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="">
		<meta name="theme-color" content="#ffffff">
		<link rel="shortcut icon" href="" type="image/x-icon" />
		<link rel="icon" href="" type="image/x-icon" />

		<title>MKN</title>

		<!-- templete free start -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/magnific-popup.css">

		<link rel="stylesheet" href="../css/owl.theme.css">
		<link rel="stylesheet" href="../css/owl.carousel.css">

		<!-- MAIN CSS -->
		<link rel="stylesheet" href="../css/tooplate-style.css">

		<script src="../js/jquery.js"></script>
		<script src="../js/jquery.form.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery.parallax.js"></script>
		<script src="../js/owl.carousel.min.js"></script>
		<script src="../js/jquery.magnific-popup.min.js"></script>
		<script src="../js/magnific-popup-options.js"></script>
		<script src="../js/modernizr.custom.js"></script>
		<script src="../js/smoothscroll.js"></script>
		<script src="../js/custom.js"></script>
		<!-- templete free end -->

		<script src="../js/jquery-bpopup-min.js"></script>

		<link rel="stylesheet" type="text/css" href="../css/main.css" />
		<link rel="stylesheet" type="text/css" href="../css/responsive.css" />

		<meta property="og:url" content="http://www.makekoreanname.com/" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="MKN">
		<meta property="og:title" content="MKN">
		<meta property="og:description" content="make your korean name" />
		<meta property="og:image" content="">
		<meta property="og:image:width" content="1920">
		<meta property="og:image:height" content="1080">
		<meta property="fb:app_id" content="" />
	</head>
<body>

<script type="text/javascript">
    var cookie_apply = getCookie("cookie_apply");

    $(document).ready(function() {
    	check_device(); // 디바이스 체크

    	// 쿠기 활성화
        console.log("get cookie : "+cookie_apply);
    	if(!cookie_apply) {
        	// 쿠키 비동의
        	$("#cookie_alert").slideToggle(1000);
        } else {
        	// 쿠키 동의
        	$("#cookie_alert").hide();
        }		

        // 탑 버튼 초기화
		// window.onscroll = function() {scrollFunction()};
    })

    // 쿠키 동의
    function cookie_confirm(type) {
    	if(type == "yes") {
    		setCookie("cookie_apply", 1, 365);
    		$("#cookie_alert").slideToggle(500);	
    	} else {
    		setCookie("cookie_apply", 1, 1);
    		$("#cookie_alert").slideToggle(500);	
    	}
    }

    // 탑 버튼 활성화
	function scrollFunction() {
		//Get the button
		var topBtn = document.getElementById("topBtn");

	  	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	    	topBtn.style.display = "block";
	  	} else {
	    	topBtn.style.display = "none";
	  	}
	}

	// 스크롤 탑
	function topFunction() {
		$('html, body').animate({scrollTop: '0'}, 500);
		$('html, body').scrollTop(0);
	}
</script>