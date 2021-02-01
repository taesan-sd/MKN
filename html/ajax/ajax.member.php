<?
include_once('../config/dbconn.php');

$type = $_POST['type'];

$id = $_POST['email'];
$pw = $_POST['password'];

$sql = " SELECT * FROM member WHERE email_address='$id' ";
$rs = mysqli_query($conn, $sql);

$count = mysqli_num_rows($rs);
$user_info = mysqli_fetch_array($rs);
$error = $conn -> error;

switch ($type) {
	case 'login_user':
		if($count == 1) {
			if($user_info['password'] == $pw) {
				$m_no = $user_info['no'];
				$m_id = $user_info['email_address'];
				$l_name = $user_info['last_name'];
				$f_name = $user_info['first_name'];
				$nickname = $user_info['nick_name'];
				$is_admin = $user_info['is_admin'];
				$results = array(
					"result" => "true",
					"message" => "login success",
					"m_no" => $m_no,
					"m_id" => $m_id,
					"l_name" => $l_name,
					"name" => $name,
					"f_name" => $f_name,
					"nickname" => $nickname,
					"is_admin" => $is_admin);
			} else {
				$results = array(
					"result" => "false",
					"message" => "Passwords do not match.");
			}
		} else {
			$results = array(
				"result" => "false",
				"message" => "There is no registered Email.");
		}
		break;

	case 'get_user_info':
		if($rs) {
			$m_no = $user_info['no'];
			$m_id = $user_info['email_address'];
			$l_name = $user_info['last_name'];
			$f_name = $user_info['first_name'];
			$nickname = $user_info['nick_name'];
			$is_admin = $user_info['is_admin'];
			$results = array(
				'result' => 'true',
				'message' => 'success',
				"m_no" => $m_no,
				"m_id" => $m_id,
				"l_name" => $l_name,
				"f_name" => $f_name,
				"nickname" => $nickname,
				"is_admin" => $is_admin);
		} else {
			$results = array(
				"result" => "false",
				"message" => $error);
		}		
		break;

	default:
		# code...
		break;
}
echo json_encode($results);
?>