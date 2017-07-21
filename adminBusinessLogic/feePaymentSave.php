<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);
	ini_set('display_errors', 'OFF');
	$error = null;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql = null;
		$count = 0;
		$feeSql = "Select fee_id, fee_name FROM " . TABLE_FEES . " WHERE status = '0'";
		$feeRows = $db->query($feeSql);
		while ($feeRow = $db->fetch_array($feeRows)) {

			$feeName = trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name'])));

			if (intval($_POST['' . $feeName . 'monthTotal']) > 0) {
				//echo "\n".PHP_EOL.$feeName.":  ";
				//echo implode(",", $_POST[''.$feeName.'monthNames']).PHP_EOL;
				$count += 1;
			}
		}

		if ($count >= 0) {


			$schlId = $_POST['schlId'];
			if (empty($schlId) || intval(trim($schlId)) == 0)
				$error .= 'School Code is Missing Please Try Again. <br>';
			$classId = $_POST['classId'];
			if (empty($classId) || intval(trim($classId)) == 0)
				$error .= 'Class Code is Missing Please Try Again. <br>';
			$studentId = $_POST['studentId'];
			if (empty($studentId) || intval(trim($studentId)) == 0)
				$error .= 'Student Code is Missing Please Try Again. <br>';
			$studentName = $_POST['studentName'];
			$academicYear = $_POST['academicYear'];
//				$monthNames = $_POST['monthNames'];
			$date = $_POST['date'];
			if (empty($date))
				$error .= 'Date is Missing Please Try Again. <br>';
			$date = date("Y-m-d", strtotime($_POST['date']));
			$paymentType = $_POST['paymentType'];
			if (strtolower(trim($paymentType)) == "cheque") {
				$chequeNumber = $_POST['chequeNumber'];
				$chequeDate = date("Y-m-d", strtotime($_POST['chequeDate']));
				$chequeBank = $_POST['chequeBank'];
			}
			$grandTotal = intval(trim($_POST['grandTotal']));
//
		} else
			$error .= 'No Fees Selected. Please Select a Fees. <br>';

		if (!isset($error)) {
//			if (isset($monthNames))
//				$_monthNames = implode(",", $monthNames);

			$studentRowData = $db->query_first("Select class_name, division_name, IF( tss.stream_id = '1', 'STATE', 'ICSE' ) AS stream, academic_year from " . TABLE_STUDENT . "  tss
INNER JOIN " . TABLE_CLASS . " tcc ON (tss.class_id = tcc.class_id)
INNER JOIN " . TABLE_DIVISION . " tdv ON (tss.division_id = tdv.division_id)

where tss.student_id = ".$studentId);


			$data['student_id'] = $db->escape($studentId);
			$data['student_name'] = $db->escape($studentName);
			$data['academic_year'] = $db->escape($academicYear);
			$data['date'] = $db->escape($date);
			$data['schl_id'] = $db->escape($schlId);
			$data['class_name'] = $db->escape($studentRowData['class_name']);
			$data['division_name'] = $db->escape($studentRowData['division_name']);
			$data['stream'] = $db->escape($studentRowData['stream']);

			//$data['months_count'] = $db->escape(count($monthNames));
			$data['payment_type'] = $db->escape($paymentType);
			if (isset($chequeNumber))
				$data['cheque_no'] = $db->escape($chequeNumber);
			if (isset($chequeDate))
				$data['cheque_date'] = $db->escape($chequeDate);
			if (isset($chequeBank))
				$data['cheque_bank'] = $db->escape($chequeBank);
			$data['grand_total'] = $db->escape($grandTotal);

			$id = $db->query_insert(TABLE_STUDENT_FEE_PRIMARY, $data);
			if ($id > 0) {
				$queryString = null;
				$feeSql = "SELECT TS.`fee_name`,TS.`fee_id` , TFM.`fee_select`  FROM " . TABLE_FEES . " as TS  INNER JOIN " . TABLE_FEE_MAPPING . " as TFM ON TFM.fee_id = TS.fee_id
                            WHERE TFM.`class_id`= " . $classId . " AND TFM.`schl_id` = " .$schlId . " AND  TS.status = '0' AND TFM.academic_year = '".$studentRowData['academic_year']."'";
				$feeRows = $db->query($feeSql);

				while ($feeRow = $db->fetch_array($feeRows)) {
					//print_r($feeRow);
					$feeName = trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name'])));
					$feeId = $feeRow['fee_id'];
					$feeSelect = $feeRow['fee_select'];
					if (isset($_POST[$feeName . "_checkOff"]) && $_POST[$feeName . "_checkOff"] == 1) {
						if (intval($_POST['' . $feeName . 'monthTotal']) >= 0) {

							if ($feeSelect == "E" || $feeSelect == "Y") {
								$queryString .= "('NULL','" . $id . "','" . $feeId . "','" . $feeRow['fee_name'] . "','" . intval(trim($_POST[$feeName . "monthFee"])) . "','','".$feeSelect."','1',
								'" . intval(trim($_POST[$feeName . "monthFee"])) . "',
						'" . intval(trim($_POST[$feeName . "monthWaive"])) . "','" . intval(trim($_POST[$feeName . "monthTotal"])) . "'),";
							} else
							{
								$queryString .= "('NULL','" . $id . "','" . $feeId . "','" . $feeRow['fee_name'] . "','" . intval(trim($_POST[$feeName . "monthlyAmt"])) . "','" . implode(",", $_POST['' . $feeName . 'monthNames']) . "','".$feeSelect."',
						'" . count($_POST['' . $feeName . 'monthNames']) . "','" . intval(trim($_POST[$feeName . "monthFee"])) . "',
						'" . intval(trim($_POST[$feeName . "monthWaive"])) . "','" . intval(trim($_POST[$feeName . "monthTotal"])) . "'),";
						}
						}
					}
				}


				if ($queryString) {
					$queryString = rtrim($queryString, ",");
					$newSql = "INSERT INTO " . TABLE_STUDENT_FEE_SECONDARY . " (`fee_detail_id`, `primary_id`, `fee_id`, `fee_name`, `base`,`months`,`fee_type`,`count`,`amount`,`waive_off`,`total`) VALUES " . $queryString;

					$fid = $db->query($newSql);
				}
				if (isset($fid) && intval($fid) > 0 && intval($id) > 0) {
					$sData['status'] = 1;
					$sStatus = $db->query_update(TABLE_STUDENT,$sData, "student_id = ".$studentId);
					redirect_to("../feesReceipt.php?id=" . $id);
				}
			}
		} else {

			$_SESSION['feeReceiptError'] = $error;
			redirect_to("../feePayment.php?id=" . $_POST['studentId']);

		}
	} else {
		$_SESSION['feeReceiptError'] = $error;
		redirect_to("../feePayment.php?id=" . $_POST['studentId']);
	}
	$db->close();
	exit;

