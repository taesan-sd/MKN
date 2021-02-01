<? 
include $_SERVER['DOCUMENT_ROOT']."/admin/config/api_function.php";

$list = OGApi_DB_GetMakeList('0', '0');

include '../../pages/preference.html';
include '../../pages/outline/preloader.html';
include '../../pages/outline/top.html';
include '../../pages/outline/sidebar.html';
include '../../pages/make/list.html';
include '../../pages/footer.html';
?>