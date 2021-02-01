$(function () {
	// body class
	$('body').addClass('theme-indigo');

	// left menu active
    $('.menu .list #reqlist').addClass('active');
})

// 페이지 이동
function view(no) {
	var no = 'M2R0E2Q0VTS'+no;
  	location.href = './view.php?mid='+no;
}