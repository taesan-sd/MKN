<? 
include $_SERVER['DOCUMENT_ROOT']."/admin/config/api_function.php";

$_mid = $_GET['mid'];
$mid = explode('M2R0E2Q0VTS', $_mid);
$user = OGApi_DB_GetPlayUserData('2', $mid[1]);
if($user['making'] == 'true') {
	$user_namecard = OGApi_DB_GetNameCardUserData('4', $mid[1]);
}

$info = OGApi_DB_GetNationalityData('3', $user['nationality']);

include '../../pages/preference.html';
include '../../pages/outline/preloader.html';
include '../../pages/outline/top.html';
include '../../pages/outline/sidebar.html';
include '../../pages/req/view.html';
include '../../pages/footer.html';
?>