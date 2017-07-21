<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(0);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error;
		$condition = null;
		$fields = null;
		$headerNames = array();
		if (isset($_POST['school'])) {
			if (trim($_POST['school']) == "All") {
				if (trim($_POST['division']) != "All" && trim($_POST['class']) != "All" && trim($_POST['stream']) != "All" && isset($_POST['division']) && isset($_POST['class']) && isset($_POST['stream'])) {
					$condition = "  tss.`status`= '" . $_POST['status'] . "' AND  tss.`class_id`= '" . $_POST['class'] . "' AND  tss.`division_id`= '" . $_POST['division'] . "' AND  tss.`stream_id`= '" . $_POST['stream'] . "'";
				} else if (trim($_POST['division']) == "All" && trim($_POST['class']) == "All" && trim($_POST['stream']) != "All" && isset($_POST['division']) && isset($_POST['class'])) {
					$condition = " tss.`status`= '" . $_POST['status'] . "' AND   tss.`stream_id`= '" . $_POST['stream'] . "'";
				} else if (!isset($_POST['division']) && trim($_POST['class']) == "All" && trim($_POST['stream']) != "All") {
					$condition = " tss.`status`= '" . $_POST['status'] . "' AND   tss.`stream_id`= '" . $_POST['stream'] . "'";
				} else if (!isset($_POST['division']) && !isset($_POST['class']) && trim($_POST['stream']) == "All") {
					$condition = " tss.`status`= '" . $_POST['status'] . "' ";
				} else if (!isset($_POST['division']) && !isset($_POST['class']) && !isset($_POST['stream'])) {
					$condition = " tss.`status`= '" . $_POST['status'] . "' ";
				}
			} else if (intval(trim($_POST['school'])) > 0) {
				if (trim($_POST['division']) != "All" && trim($_POST['class']) != "All" && trim($_POST['stream']) != "All" && isset($_POST['division']) && isset($_POST['class'])) {
					$condition = " tss.`schl_id`= '" . intval(trim($_POST['school'])) . "' AND tss.`status`= '" . $_POST['status'] . "' AND  tss.`class_id`= '" . $_POST['class'] . "' AND  tss.`division_id`= '" . $_POST['division'] . "' AND  tss.`stream_id`= '" . $_POST['stream'] . "'";
				} else if (trim($_POST['division']) == "All" && trim($_POST['class']) == "All" && trim($_POST['stream']) != "All" && isset($_POST['division']) && isset($_POST['class'])) {
					$condition = "tss.`schl_id`= '" . intval(trim($_POST['school'])) . "' AND tss.`status`= '" . $_POST['status'] . "' AND   tss.`stream_id`= '" . $_POST['stream'] . "'";
				} else if (!isset($_POST['division']) && trim($_POST['class']) == "All" && trim($_POST['stream']) != "All") {
					$condition = "tss.`schl_id`= '" . intval(trim($_POST['school'])) . "' AND tss.`status`= '" . $_POST['status'] . "' AND   tss.`stream_id`= '" . $_POST['stream'] . "'";
				} else if (!isset($_POST['division']) && !isset($_POST['class']) && trim($_POST['stream']) == "All") {
					$condition = "tss.`schl_id`= '" . intval(trim($_POST['school'])) . "' AND tss.`status`= '" . $_POST['status'] . "' ";
				}
			}

		} else {
			if (trim($_POST['division']) != "All" && trim($_POST['class']) != "All" && trim($_POST['stream']) != "All" && isset($_POST['division']) && isset($_POST['class'])) {
				$condition = " tss.`schl_id`= '" . $_SESSION['SchoolCode'] . "' AND tss.`status`= '" . $_POST['status'] . "' AND  tss.`class_id`= '" . $_POST['class'] . "' AND  tss.`division_id`= '" . $_POST['division'] . "' AND  tss.`stream_id`= '" . $_POST['stream'] . "'";
			} else if (trim($_POST['division']) == "All" && trim($_POST['class']) == "All" && trim($_POST['stream']) != "All" && isset($_POST['division']) && isset($_POST['class'])) {
				$condition = "tss.`schl_id`= '" . $_SESSION['SchoolCode'] . "' AND tss.`status`= '" . $_POST['status'] . "' AND   tss.`stream_id`= '" . $_POST['stream'] . "'";
			} else if (!isset($_POST['division']) && trim($_POST['class']) == "All" && trim($_POST['stream']) != "All") {
				$condition = "tss.`schl_id`= '" . $_SESSION['SchoolCode'] . "' AND tss.`status`= '" . $_POST['status'] . "' AND   tss.`stream_id`= '" . $_POST['stream'] . "'";
			} else if (!isset($_POST['division']) && !isset($_POST['class']) && trim($_POST['stream']) == "All") {
				$condition = "tss.`schl_id`= '" . $_SESSION['SchoolCode'] . "' AND tss.`status`= '" . $_POST['status'] . "' ";
			}
		}

		if ($_POST['adminNo'] == 1) {
			$fields .= " taa.admin_no,";
			array_push($headerNames, "Admission No");
		}

		if ($_POST['studentName'] == 1) {
			$fields .= " tss.student_name,";
			array_push($headerNames, "Student Name");
		}
		if ($_POST['schoolName'] == 1) {
			$fields .= " tsc.school_name,";
			array_push($headerNames, "School Name");
		}
		if ($_POST['streamCheck'] == 1) {
			$fields .= " IF( tss.stream_id =  '1',  'STATE',  'ICSE' ) AS stream, ";
			array_push($headerNames, "Stream");
		}
		if ($_POST['classCheck'] == 1) {
			$fields .= " tcc.class_name, ";
			array_push($headerNames, "Class Name");
		}
		if ($_POST['divisionCheck'] == 1) {
			$fields .= " tdv.division_name, ";
			array_push($headerNames, "Division Name");
		}
		if ($_POST['dob'] == 1) {
			$fields .= "DATE_FORMAT(taa.dob,'%d-%m-%Y') as dob, ";
			array_push($headerNames, "D.O.B");
		}
		if ($_POST['fatherName'] == 1) {
			$fields .= " taa.father_name,";
			array_push($headerNames, "Father Name");
		}
		if ($_POST['fNumber'] == 1) {
			$fields .= " taa.father_phone,";
			array_push($headerNames, "Father Mobile");
		}
		if ($_POST['motherName'] == 1) {
			$fields .= " taa.mother_name,";
			array_push($headerNames, "Mother Name");
		}
		if ($_POST['mNumber'] == 1) {
			$fields .= " taa.mother_phone,";
			array_push($headerNames, "Mother Mobile");
		}
		if ($_POST['statusCheck'] == 1) {
			$fields .= " IF( tss.status =  '1',  'ACTIVE',  'TERMINATED' ) AS status, ";
			array_push($headerNames, "Status");
		}

		$fields = rtrim(trim($fields), ",");
		if (empty($fields)) {
			echo "
			<script type=\"text/javascript\">
			alert('No Data. Please Select any one or more fields.')
			</script>";

		} else {
			$query = "Select " . $fields . "
		FROM " . TABLE_STUDENT . " tss
        INNER JOIN " . TABLE_ADMISSION_FORM . " taa ON (taa.id = tss.admission_id)
        INNER JOIN " . TABLE_SCHOOL . " tsc ON (tss.schl_id = tsc.schl_id)
        INNER JOIN " . TABLE_CLASS . " tcc ON (tss.class_id = tcc.class_id)
        INNER JOIN " . TABLE_DIVISION . " tdv ON (tss.division_id = tdv.division_id)
        WHERE " . $condition;

			//echo $query;

			require_once("excel.php");

			excel("StudentDetails", $query, $headerNames, "Student Data");

		}
	}
?>