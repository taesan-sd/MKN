<?php
@header("Content-type:text/html;charset=utf-8");
include_once $_SERVER['DOCUMENT_ROOT']."/admin/config/api_config.php";

// xml parse
// $xml  = get_xml_from_url();
// $info = array();
// foreach($xml as $k => $v) {
// 	$info[$k] = $v;
// }

// xml parse string
// function get_xml_from_url() {
// 	$url = "http://makeyourkoreanname.com/info.xml";
// 	$ch = curl_init();

// 	curl_setopt($ch, CURLOPT_URL, $url);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

// 	$xmlstr = curl_exec($ch);
// 	$xml = simplexml_load_string($xmlstr);
// 	curl_close($ch);

// 	return $xml;
// }


// DB Connect
function OGApi_DB_CN() {
	global $OGAPI_DB;
	$connect = new mysqli($OGAPI_DB["host"], $OGAPI_DB["id"], $OGAPI_DB["pass"], $OGAPI_DB["db"]);
	mysqli_set_charset($connect,"utf8");

	// Check connection
	if ($conn->connect_error) {
		return $conn->connect_error;
	} else {
		return $connect;
	}
}

// 멤버 카운트
function OGApi_DB_GetMemberCount() {
	global $TBL_MEMBER;

	$conn = OGApi_DB_CN();

	$query = "select count(*) as count from $TBL_MEMBER";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	mysqli_close($conn);
	if($result) {
		$res = mysqli_fetch_array($result);
		return $res['count'];
	} else {
		return $error;
	}
}

// 플레이 카운트
function OGApi_DB_GetPlayCount() {
	global $TBL_INPUT_DATA;

	$conn = OGApi_DB_CN();

	$query = "select count(*) as count from $TBL_INPUT_DATA";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	mysqli_close($conn);
	if($result) {
		$res = mysqli_fetch_array($result);
		return $res['count'];
	} else {
		return $error;
	}
}

// 네임카드 생성 카운트
function OGApi_DB_GetMakeCount() {
	global $TBL_MAKE_NAME_DATA;

	$conn = OGApi_DB_CN();

	$query = "select count(*) as count from $TBL_MAKE_NAME_DATA";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	mysqli_close($conn);
	if($result) {
		$res = mysqli_fetch_array($result);
		return $res['count'];
	} else {
		return $error;
	}
}

// 접속자 통계
function OGApi_DB_GetCounterLog() {
	global $TBL_COUNTER_LOG;

	$conn = OGApi_DB_CN();

	$query = "select count(*) as count from $TBL_COUNTER_LOG";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	mysqli_close($conn);
	if($result) {
		$res = mysqli_fetch_array($result);
		return $res['count'];
	} else {
		return $error;
	}
}

// 쿼리 조건문
function OGApi_DB_QueryWhere($where, $value) {
	switch ($where) {
		case '0':	// 
			$where = "";
			break;
		case '1':
			$where = "where making = 'false' and email != ''";
			break;
		case '2':
			$where = "where no = '$value'";
			break;
		case '3':
			$where = "where cc_fips = '$value'";
			break;
		case '4':
			$where = "where no_mid = '$value'";
			break;
	}
	return $where;
}

// 쿼리 정렬
function OGApi_DB_QuerySort($sort) {
	switch ($sort) {
		case '0':	// no 내림차순
			$order = "order by no DESC";
			break;
	}
	return $order;
}

// 플레이 리스트
function OGApi_DB_GetPlayList($where, $sort) {
	global $TBL_PLAY_DATA_LIST;

	$now = date('Y');

	$conn = OGApi_DB_CN();

	$where = OGApi_DB_QueryWhere($where, '');
	$order = OGApi_DB_QuerySort($sort);

	$query = "SELECT * FROM $TBL_PLAY_DATA_LIST $where $order";
	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	if($result) {
		$results['list'] = array();
		while($res = mysqli_fetch_array($result)) {
			// 생년월일 -> 나이 변환
			$birth_time = strtotime($res['birthday']);
			$birthday = date('Y', $birth_time);
			$age = ($now-$birthday)+1;

			// 네임카드 발급 여부
			if($res['making'] == 'true') {
				$making = 'O';
			} else {
				$making = 'X';
			}

			$resultArray = array(
				"no" => $res['no'],
				"last_name" => $res['last_name'],
				"first_name" => $res['first_name'],
				"gender" => $res['gender'],
				"birthday" => $age,
				"nationality" => $res['nationality'],
				"city" => $res['city'],
				"date_time" => date('Y.m.d', strtotime($res['date_time'])),
				"making" => $making,
				"email" => $res['email']
			);
			array_push($results['list'], $resultArray);
		}
		$results = $results['list'];
	} else {
		$results = $error;
	}
	return $results;
}

// 플레이 유저정보
function OGApi_DB_GetPlayUserData($where, $mid) {
	global $TBL_PLAY_DATA_LIST;

	$now = date('Y');

	$conn = OGApi_DB_CN();

	$where = OGApi_DB_QueryWhere($where, $mid);

	$query = "SELECT * FROM $TBL_PLAY_DATA_LIST $where $order";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	if($result) {
		$userInfo;
		while($res = mysqli_fetch_array($result)) {
			// 생년월일 -> 나이 변환
			$birth_time = strtotime($res['birthday']);
			$birthday = date('Y', $birth_time);
			$age = ($now-$birthday)+1;

			// 네임카드 발급 여부
			if($res['making'] == 'true') {
				$making = 'O';
			} else {
				$making = 'X';
			}

			// 성별 이미지 경로
			if($res['gender'] == 'MALE') {
				$user_img = '../../images/user.png';
			} else {
				$user_img = '../../images/user_female.png';
			}

			$userInfo['no'] = $res['no'];
			$userInfo['last_name'] = $res['last_name'];
			$userInfo['first_name'] = $res['first_name'];
			$userInfo['gender'] = $res['gender'];
			$userInfo['user_img'] = $user_img;
			$userInfo['birthday'] = $res['birthday'];
			$userInfo['age'] = $age;
			$userInfo['nationality'] = $res['nationality'];
			$userInfo['city'] = $res['city'];
			$userInfo['date_time'] = $res['date_time'];
			$userInfo['making'] = $res['making'];
			$userInfo['email'] = $res['email'];
		}
		$results = $userInfo;
	} else {
		$results = $error;
	}
	return $results;
}

// 네임카드 생성 리스트
function OGApi_DB_GetMakeList($where, $sort) {
	global $TBL_MAKE_NAME_DATA;

	$now = date('Y');

	$conn = OGApi_DB_CN();

	$where = OGApi_DB_QueryWhere($where, '');
	$order = OGApi_DB_QuerySort($sort);

	$query = "SELECT * FROM $TBL_MAKE_NAME_DATA $where $order";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;

	if($result) {
		$results['list'] = array();
		while($res = mysqli_fetch_array($result)) {
			$resultArray = array(
				"no" => $res['no'],
				"no_mid" => $res['no_mid'],
				"last_name_no" => $res['last_name_no'],
				"last_name_ori" => $res['last_name_ori'],
				"last_name_kr" => $res['last_name_kr'],
				"last_name_cn" => $res['last_name_cn'],
				"last_name_en" => $res['last_name_en'],
				"first_name_no" => $res['first_name_no'],
				"first_name_ori" => $res['first_name_ori'],
				"first_name_kr" => $res['first_name_kr'],
				"first_name_cn" => $res['first_name_cn'],
				"first_name_en" => $res['first_name_en'],
				"first_name_meaning_kr" => $res['first_name_meaning_kr'],
				"first_name_meaning_en" => $res['first_name_meaning_en'],
				"date_time" => date('Y.m.d', strtotime($res['date_time']))
			);
			array_push($results['list'], $resultArray);
		}
		$results = $results['list'];
	} else {
		$results = $error;
	}
	return $results;
}

// 네임카드 유저정보
function OGApi_DB_GetNameCardUserData($where, $no) {
	global $TBL_MAKE_NAME_DATA;

	$now = date('Y');

	$conn = OGApi_DB_CN();

	$where = OGApi_DB_QueryWhere($where, $no);

	$query = "SELECT * FROM $TBL_MAKE_NAME_DATA $where $order";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	
	if($result) {
		$userInfo_namecard;
		while($res = mysqli_fetch_array($result)) {
			$userInfo_namecard['no'] = $res['no'];
			$userInfo_namecard['no_mid'] = $res['no_mid'];
			$userInfo_namecard['last_name_no'] = $res['last_name_no'];
			$userInfo_namecard['last_name_ori'] = $res['last_name_ori'];
			$userInfo_namecard['last_name_kr'] = $res['last_name_kr'];
			$userInfo_namecard['last_name_cn'] = $res['last_name_cn'];
			$userInfo_namecard['last_name_en'] = $res['last_name_en'];
			$userInfo_namecard['first_name_no'] = $res['first_name_no'];
			$userInfo_namecard['first_name_ori'] = $res['first_name_ori'];
			$userInfo_namecard['first_name_kr'] = $res['first_name_kr'];
			$userInfo_namecard['first_name_cn'] = $res['first_name_cn'];
			$userInfo_namecard['first_name_en'] = $res['first_name_en'];
			$userInfo_namecard['first_name_meaning_kr'] = $res['first_name_meaning_kr'];
			$userInfo_namecard['first_name_meaning_en'] = $res['first_name_meaning_en'];
			$userInfo_namecard['date_time'] = $res['date_time'];
		}
		$results = $userInfo_namecard;
	} else {
		$results = $error;
	}
	return $results;
}

// 국가 리스트
function OGApi_DB_GetNationalityList() {
	global $TBL_COUNTRY_LIST;

	$conn = OGApi_DB_CN();

	$query = "SELECT * FROM $TBL_COUNTRY_LIST";

	$result = mysqli_query($conn, $query);
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
		$results = $results['list'];
	} else {
		$results = $error;
	}
	return $results;
}

// 국가 정보
function OGApi_DB_GetNationalityData($where, $value) {
	global $TBL_COUNTRY_LIST;

	$now = date('Y');

	$conn = OGApi_DB_CN();

	$where = OGApi_DB_QueryWhere($where, $value);

	$query = "SELECT * FROM $TBL_COUNTRY_LIST $where $order";

	$result = mysqli_query($conn, $query);
	$error = $conn -> error;
	if($result) {
		$info;
		while($res = mysqli_fetch_array($result)) {
			$info['cc_fips'] = $res['cc_fips'];
			$info['cc_iso'] = $res['cc_iso'];
			$info['tld'] = $res['tld'];
			$info['country_name'] = $res['country_name'];
		}
		$results = $info;
	} else {
		$results = $error;
	}
	return $results;
}
?>
