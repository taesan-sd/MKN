<? 
include $_SERVER['DOCUMENT_ROOT']."/admin/config/api_function.php";
$totalMemberCount = OGApi_DB_GetMemberCount();
$totalPlayCount = OGApi_DB_GetPlayCount();
$totalMakeCount = OGApi_DB_GetMakeCount();
$totlaVisitCount = OGApi_DB_GetCounterLog();

include '../../pages/preference.html';
include '../../pages/outline/preloader.html';
include '../../pages/outline/top.html';
include '../../pages/outline/sidebar.html';
include '../../pages/main/main.html';
include '../../pages/footer.html';
?>