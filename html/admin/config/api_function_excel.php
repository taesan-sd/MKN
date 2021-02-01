<?php
@header("Content-type:text/html;charset=utf-8");
require_once "../libs/PHPExcel-1.8/Classes/PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.
require_once "../libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

include_once $_SERVER['DOCUMENT_ROOT']."/admin/config/api_config.php";
include_once $_SERVER['DOCUMENT_ROOT']."/admin/config/api_function_excel.php";

OGApi_DB_SetDBupload($_POST['nationality'], $_POST['type']);

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

function OGApi_DB_SetDBupload($nationality, $type) {
	global $TBL_NAME;
	global $TBL_COUNTRY;
	global $TBL_TYPE;

	switch ($nationality) {
		case 'US':
			$TBL_COUNTRY = 'en';
			break;
		case 'EU':
			$TBL_COUNTRY = 'eu';
			break;
	}

	switch ($type) {
		case 'last_name':
			$TBL_TYPE = 'last_name';
			break;

		case 'first_name_male':
			$TBL_TYPE = 'first_name_male';
			break;

		case 'first_name_female':
			$TBL_TYPE = 'first_name_female';
			break;
	}

	$TBL_NAME = $TBL_COUNTRY."_".$TBL_TYPE;

	$filename = iconv('UTF-8', 'EUC-KR', $_FILES['upFile']['tmp_name']);

	try { // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
		$objPHPExcel = new PHPExcel();

		$objReader = PHPExcel_IOFactory::createReaderForFile($filename);

		// 읽기전용으로 설정
		$objReader->setReadDataOnly(true);

		// 엑셀파일을 읽는다
		$objExcel = $objReader->load($filename);

		// 첫번째 시트를 선택
		$objExcel->setActiveSheetIndex(0);

		$objWorksheet = $objExcel->getActiveSheet();

		$rowIterator = $objWorksheet->getRowIterator();

		foreach ($rowIterator as $row) { // 모든 행에 대해서
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); 
		}

		$maxRow = $objWorksheet->getHighestRow();

		$conn = OGApi_DB_CN();
		$sql = "truncate table $TBL_NAME";	// db 초기화
		$result = mysqli_query($conn, $sql);
		$error = $conn -> error;
		if($result) {
			for ($i=2; $i<=$maxRow; $i++) {
				switch ($TBL_NAME) {
					case 'en_last_name':
					case 'eu_last_name':
						$no = $objWorksheet->getCell('A'.$i)->getValue(); 
						$name_ori_en = $objWorksheet->getCell('B'.$i)->getValue();
						$name_kr = $objWorksheet->getCell('C'.$i)->getValue();
						$name_cn = $objWorksheet->getCell('D'.$i)->getValue();
						$name_en = $objWorksheet->getCell('E'.$i)->getValue();
						$meaning = $objWorksheet->getCell('F'.$i)->getValue();
						$root = $objWorksheet->getCell('G'.$i)->getValue();
						$reg_date = $objWorksheet->getCell('H'.$i)->getValue();
						$reg_date = PHPExcel_Style_NumberFormat::toFormattedString($reg_date, 'YYYY-MM-DD'); // 날짜 형태의 셀을 읽을때는 toFormattedString를 사용
						$country = $objWorksheet->getCell('I'.$i)->getValue();
						$etc = $objWorksheet->getCell('J'.$i)->getValue();

						// echo $no.'<br/>';
						// echo $name_en.'<br/>';
						// echo $meaning.'<br/>';
						// echo $name_kr.'<br/>';
						// echo $name_cn.'<br/>';
						// echo $root.'<br/>';
						// echo $reg_date.'<br/>';

						$sql = "insert into $TBL_NAME
					                set name_ori_en = '$name_ori_en',
					                    name_kr = '$name_kr',
					                    name_cn = '$name_cn',
					                    name_en = '$name_en',
					                    meaning = '$meaning',
					                    root = '$root',
					                    date_time = '$reg_date',
					                    country = '$country',
					                    etc = '$etc'";
						break;

					case 'en_first_name_male':
					case 'en_first_name_female':
						$no = $objWorksheet->getCell('A'.$i)->getValue();
						$name_ori_en = $objWorksheet->getCell('B'.$i)->getValue();

						$name_kr1 = $objWorksheet->getCell('C'.$i)->getValue(); 
						$name_kr2 = $objWorksheet->getCell('D'.$i)->getValue(); 
						$name_kr3 = $objWorksheet->getCell('E'.$i)->getValue(); 
						$name_kr4 = $objWorksheet->getCell('F'.$i)->getValue(); 
						$name_kr5 = $objWorksheet->getCell('G'.$i)->getValue(); 
						$name_kr6 = $objWorksheet->getCell('H'.$i)->getValue(); 
						$name_kr7 = $objWorksheet->getCell('I'.$i)->getValue(); 
						$name_kr8 = $objWorksheet->getCell('J'.$i)->getValue(); 
						$name_kr9 = $objWorksheet->getCell('K'.$i)->getValue(); 
						$name_kr10 = $objWorksheet->getCell('L'.$i)->getValue(); 
						$name_kr11 = $objWorksheet->getCell('M'.$i)->getValue(); 
						$name_kr12 = $objWorksheet->getCell('N'.$i)->getValue(); 

						$name_cn1 = $objWorksheet->getCell('O'.$i)->getValue(); 
						$name_cn2 = $objWorksheet->getCell('P'.$i)->getValue(); 
						$name_cn3 = $objWorksheet->getCell('Q'.$i)->getValue(); 
						$name_cn4 = $objWorksheet->getCell('R'.$i)->getValue(); 
						$name_cn5 = $objWorksheet->getCell('S'.$i)->getValue(); 
						$name_cn6 = $objWorksheet->getCell('T'.$i)->getValue(); 
						$name_cn7 = $objWorksheet->getCell('U'.$i)->getValue(); 
						$name_cn8 = $objWorksheet->getCell('V'.$i)->getValue(); 
						$name_cn9 = $objWorksheet->getCell('W'.$i)->getValue(); 
						$name_cn10 = $objWorksheet->getCell('X'.$i)->getValue(); 
						$name_cn11 = $objWorksheet->getCell('Y'.$i)->getValue(); 
						$name_cn12 = $objWorksheet->getCell('Z'.$i)->getValue(); 

						$name_en1 = $objWorksheet->getCell('AA'.$i)->getValue();
						$name_en2 = $objWorksheet->getCell('AB'.$i)->getValue();
						$name_en3 = $objWorksheet->getCell('AC'.$i)->getValue();
						$name_en4 = $objWorksheet->getCell('AD'.$i)->getValue();
						$name_en5 = $objWorksheet->getCell('AE'.$i)->getValue();
						$name_en6 = $objWorksheet->getCell('AF'.$i)->getValue();
						$name_en7 = $objWorksheet->getCell('AG'.$i)->getValue();
						$name_en8 = $objWorksheet->getCell('AH'.$i)->getValue();
						$name_en9 = $objWorksheet->getCell('AI'.$i)->getValue();
						$name_en10 = $objWorksheet->getCell('AJ'.$i)->getValue();
						$name_en11 = $objWorksheet->getCell('AK'.$i)->getValue();
						$name_en12 = $objWorksheet->getCell('AL'.$i)->getValue();

						$meaning_kr1 = $objWorksheet->getCell('AM'.$i)->getValue();
						$meaning_kr2 = $objWorksheet->getCell('AN'.$i)->getValue();
						$meaning_kr3 = $objWorksheet->getCell('AO'.$i)->getValue();
						$meaning_kr4 = $objWorksheet->getCell('AP'.$i)->getValue();
						$meaning_kr5 = $objWorksheet->getCell('AQ'.$i)->getValue();
						$meaning_kr6 = $objWorksheet->getCell('AR'.$i)->getValue();
						$meaning_kr7 = $objWorksheet->getCell('AS'.$i)->getValue();
						$meaning_kr8 = $objWorksheet->getCell('AT'.$i)->getValue();
						$meaning_kr9 = $objWorksheet->getCell('AU'.$i)->getValue();
						$meaning_kr10 = $objWorksheet->getCell('AV'.$i)->getValue();
						$meaning_kr11 = $objWorksheet->getCell('AW'.$i)->getValue();
						$meaning_kr12 = $objWorksheet->getCell('AX'.$i)->getValue();

						$meaning_en1 = $objWorksheet->getCell('AY'.$i)->getValue();
						$meaning_en2 = $objWorksheet->getCell('AZ'.$i)->getValue();
						$meaning_en3 = $objWorksheet->getCell('BA'.$i)->getValue();
						$meaning_en4 = $objWorksheet->getCell('BB'.$i)->getValue();
						$meaning_en5 = $objWorksheet->getCell('BC'.$i)->getValue();
						$meaning_en6 = $objWorksheet->getCell('BD'.$i)->getValue();
						$meaning_en7 = $objWorksheet->getCell('BE'.$i)->getValue();
						$meaning_en8 = $objWorksheet->getCell('BF'.$i)->getValue();
						$meaning_en9 = $objWorksheet->getCell('BG'.$i)->getValue();
						$meaning_en10 = $objWorksheet->getCell('BH'.$i)->getValue();
						$meaning_en11 = $objWorksheet->getCell('BI'.$i)->getValue();
						$meaning_en12 = $objWorksheet->getCell('BJ'.$i)->getValue();

						$reg_date = $objWorksheet->getCell('BK'.$i)->getValue(); // G열
						$reg_date = PHPExcel_Style_NumberFormat::toFormattedString($reg_date, 'YYYY-MM-DD'); // 날짜 형태의 셀을 읽을때는 

						$sql = " insert into $TBL_NAME
					                set name_ori_en = '$name_ori_en',
					                	name_kr1 = '$name_kr1',
					                	name_kr2 = '$name_kr2',
					                	name_kr3 = '$name_kr3',
					                	name_kr4 = '$name_kr4',
					                	name_kr5 = '$name_kr5',
					                	name_kr6 = '$name_kr6',
					                	name_kr7 = '$name_kr7',
					                	name_kr8 = '$name_kr8',
					                	name_kr9 = '$name_kr9',
					                	name_kr10 = '$name_kr10',
					                	name_kr11 = '$name_kr11',
					                	name_kr12 = '$name_kr12',
					                	name_cn1 = '$name_cn1',
					                	name_cn2 = '$name_cn2',
					                	name_cn3 = '$name_cn3',
					                	name_cn4 = '$name_cn4',
					                	name_cn5 = '$name_cn5',
					                	name_cn6 = '$name_cn6',
					                	name_cn7 = '$name_cn7',
					                	name_cn8 = '$name_cn8',
					                	name_cn9 = '$name_cn9',
					                	name_cn10 = '$name_cn10',
					                	name_cn11 = '$name_cn11',
					                	name_cn12 = '$name_cn12',
					                	name_en1 = '$name_en1',
					                	name_en2 = '$name_en2',
					                	name_en3 = '$name_en3',
					                	name_en4 = '$name_en4',
					                	name_en5 = '$name_en5',
					                	name_en6 = '$name_en6',
					                	name_en7 = '$name_en7',
					                	name_en8 = '$name_en8',
					                	name_en9 = '$name_en9',
					                	name_en10 = '$name_en10',
					                	name_en11 = '$name_en11',
					                	name_en12 = '$name_en12',
					                    meaning_kr1 = '$meaning_kr1',
					                    meaning_kr2 = '$meaning_kr2',
					                    meaning_kr3 = '$meaning_kr3',
					                    meaning_kr4 = '$meaning_kr4',
					                    meaning_kr5 = '$meaning_kr5',
					                    meaning_kr6 = '$meaning_kr6',
					                    meaning_kr7 = '$meaning_kr7',
					                    meaning_kr8 = '$meaning_kr8',
					                    meaning_kr9 = '$meaning_kr9',
					                    meaning_kr10 = '$meaning_kr10',
					                    meaning_kr11 = '$meaning_kr11',
					                    meaning_kr12 = '$meaning_kr12',
					                    meaning_en1 = '$meaning_en1',
					                    meaning_en2 = '$meaning_en2',
					                    meaning_en3 = '$meaning_en3',
					                    meaning_en4 = '$meaning_en4',
					                    meaning_en5 = '$meaning_en5',
					                    meaning_en6 = '$meaning_en6',
					                    meaning_en7 = '$meaning_en7',
					                    meaning_en8 = '$meaning_en8',
					                    meaning_en9 = '$meaning_en9',
					                    meaning_en10 = '$meaning_en10',
					                    meaning_en11 = '$meaning_en11',
					                    meaning_en12 = '$meaning_en12',
					                    date_time = '$reg_date'";
						break;
				}

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
	        }
		} else {
			$results = array(
				'result' => 'false',
				'message' => $error
			);
		}
	} catch (exception $e) {
		$results = array(
			'result' => 'false',
			'message' => 'excel file error'
		);
	}
	echo json_encode($results);
}
?>
