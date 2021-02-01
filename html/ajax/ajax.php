<?
include_once('../config/dbconn.php');

$type = $_POST['type'];
$nationality = $_POST['nationality'];
$table = $_POST['table'];

$ip = $_POST['ip'];
$date = $_POST['date'];
$time = $_POST['time'];
$agent = $_POST['agent'];
$browser = $_POST['browser'];
$device = $_POST['device'];

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$nationality = $_POST['nationality'];
$city = $_POST['city'];

$no = $_POST['no'];

$last_name_table = $_POST['last_name_table'];
$first_name_table = $_POST['first_name_table'];
$month = $_POST['month'];

$mid = $_POST['mid'];
$last_name_no = $_POST['last_name_no'];
$last_name_ori = $_POST['last_name_ori'];
$last_name_kr = $_POST['last_name_kr'];
$last_name_cn = $_POST['last_name_cn'];
$last_name_en = $_POST['last_name_en'];
$last_name_meaning = $_POST['last_name_meaning'];
$root = $_POST['root'];
$first_name_no = $_POST['first_name_no'];
$first_name_ori = $_POST['first_name_ori'];
$first_name_kr = $_POST['first_name_kr'];
$first_name_cn = $_POST['first_name_cn'];
$first_name_en = $_POST['first_name_en'];
$first_name_meaning_kr = $_POST['first_name_meaning_kr'];
$first_name_meaning_en = $_POST['first_name_meaning_en'];

$mi_id = $_POST['mi_id'];
$mn_id = $_POST['mn_id'];
$email = $_POST['email'];
$password = $_POST['password'];

switch ($type) {
	case 'setNationality':
		$sql = "SELECT * FROM country";
		$result = mysqli_query($conn, $sql);
		$error = $conn -> error;
		if($result) {
			$results['list'] = array();
			while($res = mysqli_fetch_array($result)) {
				$resultArray = array(
					"cc_fips" => $res['cc_fips'],
					"cc_iso" => $res['cc_iso'],
					"tld" => $res['tld'],
					"country_name" => $res['country_name']
				);
				array_push($results['list'], $resultArray);
			}
			$results = array(
				'result' => 'true',
				'data' => $results['list']
			);
		} else {
			$results = array(
				'result' => 'false',
				'message' => $error
				);
		}
		break;

	case 'setCity':
		$sql = "SELECT * FROM world_cities_free WHERE cc_fips = '$nationality'";
		$result = mysqli_query($conn, $sql);
		$error = $conn -> error;
		if($result) {
			$results['list'] = array();
			while($res = mysqli_fetch_array($result)) {
				$resultArray = array(
					"cc_fips" => $res['cc_fips'],
					"cc_iso" => $res['cc_iso'],
					"full_name_nd" => $res['full_name_nd']
				);
				array_push($results['list'], $resultArray);
			}
			$results = array(
				'result' => 'true',
				'data' => $results['list']
			);
		} else {
			$results = array(
				'result' => 'false',
				'message' => $error
				);
		}
		break;

	case 'count_log':
		$sql = "select count(*) from $table where ipaddress='$ip' and regdate='$date'";
		$result = mysqli_query($conn, $sql);
		if($row = mysqli_fetch_array($result)) {
			if($row[0] == 0) {
				$sql = "insert into $table
			                set ipaddress = '$ip',
			                	ipaddress_hit = 1,
			                    regdate = '$date',
			                    time = '$time',
			                    user_agent = '$agent',
			                    browser = '$browser',
			                    device = '$device'";
			    $result = mysqli_query($conn, $sql);
		        $error = $conn -> error;
		        if($result) {
		        	$results = array(
						'result' => 'true',
						'message' => 'insert success',
					);

		        } else {
		        	$results = array(
						'result' => 'false',
						'message' => $error
					);
		        }
			} else {
				$sql = "update $table set ipaddress_hit=ipaddress_hit+1 where ipaddress='$ip'";
				$result = mysqli_query($conn, $sql);
				$error = $conn -> error;
		        if($result) {
		        	$results = array(
						'result' => 'true',
						'message' => 'update success',
					);

		        } else {
		        	$results = array(
						'result' => 'false',
						'message' => $error
					);
		        }
			}
		}
		break;

	case 'make_input_data':
		$sql = " insert into $table
	                set last_name = '$last_name',
	                    first_name = '$first_name',
	                    gender = '$gender',
	                    birthday = '$birthday',
	                    nationality = '$nationality',
	                    city = '$city',
	                    date_time = '".date('Y-m-d H:i:s')."',
	                    making = 'false'";
	    $result = mysqli_query($conn, $sql);
        $error = $conn -> error;
        if($result) {
        	$last_uid = mysqli_insert_id($conn);
        	$results = array(
				'result' => 'true',
				'message' => 'success',
				'no' => $last_uid
			);

        } else {
        	$results = array(
				'result' => 'false',
				'message' => $error
			);
        }
		break;

	case 'get_make_name_data':
		$sql = " select * from $table where no = $no ";
		$result = mysqli_query($conn, $sql);
        $error = $conn -> error;
        if($result) {
			$results['list'] = array();
			while($res = mysqli_fetch_array($result)) {
				$resultsArray = array (
					"no" => $res['no'],
					"last_name" => $res['last_name'],
					"first_name" => $res['first_name'],
					"gender" => $res['gender'],
					"birthday" => $res['birthday'],
					"nationality" => $res['nationality'],
					"city" => $res['city'],
					"date_time" => $res['date_time'],
				);
				array_push($results['list'], $resultsArray);
			} 
			$results = array(
				"result" => "true",
				"data" => $resultsArray
			);       
		} else {
			$results = array(
				"result" => "false",
				'message' => $error
			);
		}
		break;

	case 'make_name_data1':
		// 성 추출 쿼리
		$sql = " select * from $last_name_table where name_ori_en = '$last_name' ";
		$result = mysqli_query($conn, $sql);
        $error = $conn -> error;
        if($result) {
			$results['list'] = array();
			while($res = mysqli_fetch_array($result)) {
				$last_name_array = array (
					"no" => $res['no'],
					"name_ori_en" => $res['name_ori_en'],
					"name_kr" => $res['name_kr'],
					"name_cn" => $res['name_cn'],
					"name_en" => $res['name_en'],
					"meaning" => $res['meaning'],
					"root" => $res['root'],
					"date_time" => date("Y-m-d", strtotime($res['date_time'])),
				);
				array_push($results['list'], $last_name_array);
			}

			// 이름 추출 쿼리
			$_varkr = 'name_kr'.$month;
			$_varcn = 'name_cn'.$month;
			$_varen = 'name_en'.$month;
			$_varmean_kr = 'meaning_kr'.$month;
			$_varmean_en = 'meaning_en'.$month;

			$sql = " select * from $first_name_table where name_ori_en = '$first_name' ";
			$result = mysqli_query($conn, $sql);
			$error = $conn -> error;
			if($result) {
				$results['list'] = array();
				while($res = mysqli_fetch_array($result)) {
					$first_name_array = array (
						"no" => $res['no'],
						"name_ori_en" => $res['name_ori_en'],
						"name_kr" => $res[$_varkr],
						"name_cn" => $res[$_varcn],
						"name_en" => $res[$_varen],
						"meaning_kr" => $res[$_varmean_kr],
						"meaning_en" => $res[$_varmean_en],
						"date_time" => date("Y-m-d", strtotime($res['date_time'])),
					);
					array_push($results['list'], $first_name_array);
				}
				$results = array(
					"result" => "true",
					"last_name_array" => $last_name_array,
					"first_name_array" => $first_name_array,
				);
			} else {
				$results = array(
					"result" => "false",
					'message' => $error
				);
			}

		} else {
			$results = array(
				"result" => "false",
				'message' => $error
			);
		}
		break;

	case 'make_name_data2':
		$sql = " insert into $table
	                set no_mid = '$mid',
	                    last_name_no = '$last_name_no',
	                    last_name_ori = '$last_name_ori',
	                    last_name_kr = '$last_name_kr',
	                    last_name_cn = '$last_name_cn',
	                    last_name_en = '$last_name_en',
	                    last_name_meaning = '$last_name_meaning',
	                    root = '$root',
	                    first_name_no = '$first_name_no',
	                    first_name_ori = '$first_name_ori',
	                    first_name_kr = '$first_name_kr',
	                    first_name_cn = '$first_name_cn',
	                    first_name_en = '$first_name_en',
	                    first_name_meaning_kr = '$first_name_meaning_kr',
	                    first_name_meaning_en = '$first_name_meaning_en',
	                    date_time = '".date('Y-m-d H:i:s')."'";
	    $result = mysqli_query($conn, $sql);
        $error = $conn -> error;
        if($result) {
        	$last_uid = mysqli_insert_id($conn);
        	
        	$sql = " update make_input_data set making = 'true' where no = $mid ";
        	$result = mysqli_query($conn, $sql);
        	$error = $conn -> error;
        	if($result) {
        		$results = array(
					'result' => 'true',
					'message' => 'success',
					'no' => $last_uid
				);
        	} else {
        		$results = array(
					'result' => 'false',
					'message' => $error
				);	
        	}
        } else {
        	$results = array(
				'result' => 'false',
				'message' => $error
			);
        }
		break;

	case 'get_name_data':
		$sql = " select * from $table where no = $no ";
		$result = mysqli_query($conn, $sql);
		$error = $conn -> error;
		$results['list'] = array();
		if($result) {
			while($res = mysqli_fetch_array($result)) {
				$resultArray = array(
					"no" => $res['no'],
					"no_mid" => $res['no_mid'],
					// "nationality" => $res['nationality'],
					// "city" => $res['city'],
					// "birthday" => $res['birthday'],
					"last_name_no" => $res['last_name_no'],
					"last_name_ori" => $res['last_name_ori'],
					"last_name_kr" => $res['last_name_kr'],
					"last_name_cn" => $res['last_name_cn'],
					"last_name_en" => $res['last_name_en'],
					"last_name_meaning" => $res['last_name_meaning'],
					"root" => $res['root'],
					"first_name_no" => $res['first_name_no'],
					"first_name_ori" => $res['first_name_ori'],
					"first_name_kr" => $res['first_name_kr'],
					"first_name_cn" => $res['first_name_cn'],
					"first_name_en" => $res['first_name_en'],
					"first_name_meaning_kr" => $res['first_name_meaning_kr'],
					"first_name_meaning_en" => $res['first_name_meaning_en'],
					"date_time" => $res['date_time']
				);
				array_push($results['list'], $resultArray);
			}
			$results = array(
				'result' => 'true',
				'data' => $resultArray
			);
		} else {
			$results = array(
				'result' => 'false',
				'message' => $error
			);
		}
		break;

	case 'set_email':
		$sql = " update $table set email = '$email' where no = $mid ";
		$result = mysqli_query($conn, $sql);
    	$error = $conn -> error;
    	if($result) {
    		$results = array(
				'result' => 'true',
				'message' => 'success'
			);
    	} else {
    		$results = array(
				'result' => 'false',
				'message' => $error
			);	
    	}
		break;

	case 'reg_user':
		$encrypted_passwd = password_hash($password, PASSWORD_DEFAULT);
		$_email = explode('@', $email);
		$sql = " insert into $table
	                set mi_id = $mi_id,
	                	mn_id = $mn_id,
	                	email_address = '$email',
	                	password = '$encrypted_passwd',
	                	email_id = '$_email[0]',
	                	email_host = '$_email[1]',
	                	last_name = '$last_name',
	                    first_name = '$first_name',
	                    gender = '$gender',
	                    birthday = '$birthday',
	                    nationality = '$nationality',
	                    city = '$city',
	                    regdate = '".date('YmdHis')."'";
	    $result = mysqli_query($conn, $sql);
        $error = $conn -> error;
        if($result) {
        	$results = array(
				'result' => 'true',
				'message' => 'success'
			);

        } else {
        	$results = array(
				'result' => 'false',
				'message' => $error
			);
        }
		break;

	case 'get_member_confirm':
		$sql = " select count(*) as count from $table where mn_id = $no ";
		$result = mysqli_query($conn, $sql);
		$error = $conn -> error;
		if($result) {
			$res = mysqli_fetch_array($result);
			$results = array(
				'result' => 'true',
				'message' => 'success',
				'count' => $res['count']
			);
		} else {
			$results = array(
				'result' => 'false',
				'message' => $error
			);
		}
		break;

	default:
		# code...
		break;
}
echo json_encode($results);
?>