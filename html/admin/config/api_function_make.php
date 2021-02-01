<?php
@header("Content-type:text/html;charset=utf-8");
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
//Load composer's autoloader
// require $_SERVER['DOCUMENT_ROOT']."/admin/libs/PHPMailer/vendor/autoload.php";
require $_SERVER['DOCUMENT_ROOT']."/admin/libs/PHPMailer/src/PHPMailer.php";
require $_SERVER['DOCUMENT_ROOT']."/admin/libs/PHPMailer/src/SMTP.php";
require $_SERVER['DOCUMENT_ROOT']."/admin/libs/PHPMailer/src/Exception.php";

include_once $_SERVER['DOCUMENT_ROOT']."/admin/config/api_config.php";

$type = $_POST['type'];
$no_mid = $_POST['no_mid'];
$mnid = $_POST['mnid'];
$email = $_POST['email'];
$last_name_ori = $_POST['last_name_ori'];
$first_name_ori = $_POST['first_name_ori'];
$last_name_kr = $_POST['last_name_kr'];
$first_name_kr = $_POST['first_name_kr'];
$last_name_cn = $_POST['last_name_cn'];
$first_name_cn = $_POST['first_name_cn'];
$last_name_en = $_POST['last_name_en'];
$first_name_en = $_POST['first_name_en'];
$first_name_meaning_kr = $_POST['first_name_meaning_kr'];
$first_name_meaning_en = $_POST['first_name_meaning_en'];

switch ($type) {
	case 'MAKE_NAME':
		OGApi_DB_SetMakeNameCard();
		break;

	case 'SEND_MAIL':
		OGApi_DB_SendMail();
		break;
}

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

// 네임카드 생성
function OGApi_DB_SetMakeNameCard() {
	global $TBL_MAKE_NAME_DATA;
	global $TBL_INPUT_DATA;
	global $no_mid, 
			$last_name_ori, $first_name_ori,
			$last_name_kr, $first_name_kr, 
			$last_name_cn, $first_name_cn, 
			$last_name_en, $first_name_en, 
			$first_name_meaning_kr, $first_name_meaning_en;

	$conn = OGApi_DB_CN();

	$query = "INSERT INTO $TBL_MAKE_NAME_DATA
	                SET no_mid = '$no_mid',
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
	$res = mysqli_query($conn, $query);
    $error = $conn -> error;
    if($res) {
    	// 플레이 데이터 업데이트
    	$last_uid = mysqli_insert_id($conn);

    	$query = "UPDATE $TBL_INPUT_DATA SET making = 'true' WHERE no = $no_mid";

    	$result = mysqli_query($conn, $query);
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

	echo json_encode($results);
}

function OGApi_DB_SendMail() {
	global $mnid, $email, $last_name_ori, $first_name_ori;
	$USER_FULL_NAME = $first_name_ori." ".$last_name_ori;
	$USER_NAME_CARD_LINK = 'http://makeyourkoreanname.com/sub/card.php?no='.$mnid;

	try {
		ob_start();
	    include_once ('../pages/email/name_card.html');
	    $content = ob_get_contents();
		
		// Instantiation and passing `true` enables exceptions
	    // Server settings
	    $mail = new PHPMailer\PHPMailer\PHPMailer;
	    $mail->CharSet    = 'UTF-8';
	    $mail->Encoding    = 'base64';
	    $mail->SMTPDebug  = '2';                      				// Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.mailplug.co.kr';               	// Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'yoyo1379@tsstation.com';               // SMTP username
	    $mail->Password   = 'whalwhal1436';                         // SMTP password
	    $mail->SMTPSecure = 'ssl';         							// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('yoyo1379@tsstation.com', 'MYKN CS');
	    $mail->addAddress($email, $USER_FULL_NAME);     // Add a recipient
	    // $mail->addAddress('ellen@example.com');               // Name is optional
	    // $mail->addReplyTo('info@example.com', 'Information');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    // Attachments - 첨부파일
	    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = '[MYKN] We have finished making your Korean name.';
	    $mail->Body    = $content;
	    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    ob_end_clean();
	    // echo $email."/".$USER_FULL_NAME."/".$USER_NAME_CARD_LINK."/".$content;

	    $results = array(
			'result' => 'true',
			'message' => 'Message has been sent',
		);

	} catch (Exception $e) {
		$results = array(
			'result' => 'false',
			'message' => 'Message could not be sent. Mailer Error: '.$mail->getMessage(),
		);
	}
	echo json_encode($results);
}
?>
