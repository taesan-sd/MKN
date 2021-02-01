<? 
include $_SERVER['DOCUMENT_ROOT']."/admin/config/api_function.php";

$list = OGApi_DB_GetNationalityList();

include '../../pages/preference.html';
include '../../pages/outline/preloader.html';
include '../../pages/outline/loadprogress.html';
include '../../pages/outline/top.html';
include '../../pages/outline/sidebar.html';
include '../../pages/db/file.html';
include '../../pages/footer.html';
?>