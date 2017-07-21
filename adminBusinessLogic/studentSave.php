<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(0);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error;

		$_applicationId = $_POST['applicationNo'];
		if (empty($_applicationId)) {
			$error .= 'Application Code is Missing, Please try again from Application Listing. <br>';
		}

		$_schoolId = $_POST['schlId'];
		if (empty($_schoolId)) {
			$error .= 'School Code is Missing, Please try again from Application Listing. <br>';
		}
		$_stream = $_POST['stream'];
		if (empty($_stream) || intval(trim($_stream)) == 0) {
			$error .= 'Please check Stream is Missing. <br>';
		}
		$_class = $_POST['class'];
		if (empty($_class) || intval(trim($_class)) == 0) {
			$error .= 'Please check Class is Missing. <br>';
		}
		$_division = $_POST['division'];
		if (empty($_division) || intval(trim($_division)) == 0) {
			$error .= 'Please check Division is Missing. <br>';
		}

		//$_date = $_POST['date'];
		$newDate = date("Y-m-d"); //, strtotime($_date));
//    if (empty($_date)) {
//        $error .= 'Please check Date of Registration Missing. <br>';
//    }

		$_academicYear = $_POST['academicYear'];
		if (empty($_academicYear)) {
			$error .= 'Please check Academic Year is Missing. <br>';
		}

		$_studentName = strtoupper(trim($_POST['studentName']));
		if (empty($_studentName)) {
			$error .= 'Please check Student Name is Missing. <br>';
		}

		$_status = $_POST['status'];
		if ($_status == "") {
			$error .= 'Please check Student Status is Missing. <br>';
		}
$_admissionStatus = $_POST['admissionStatus'];
		if ($_admissionStatus == "") {
			$error .= 'Please check Student Status is Missing. <br>';
		}

		if (!isset($error)) {

			$data['application_no'] = $db->escape($_applicationId);
			$data['schl_id'] = $db->escape($_schoolId);
			$data['date'] = $db->escape($newDate);
			$data['academic_year'] = $db->escape($_academicYear);
			$data['stream_id'] = $db->escape($_stream);
			$data['class_id'] = $db->escape($_class);
			$data['division_id'] = $db->escape($_division);
			$data['student_name'] = $db->escape($_studentName);
			$data['admission_status'] = $db->escape($_admissionStatus);

			if($_status == 1)
				$data['status'] = 3;
			else
				$data['status'] = $db->escape($_status);

			$data['registered_by'] = $db->escape($_SESSION['UserName']);


				$admnData['admission_date'] = $db->escape($newDate);
				$admnData['application_no'] = $db->escape($_applicationId);
				$admnData['school_code'] = $db->escape($_schoolId);
				$admnData['academic_year'] = $db->escape($_academicYear);
				$admnData['name'] = $db->escape($_studentName);
				$adminId = $db->query_insert(TABLE_ADMISSION_FORM, $admnData);

				if (isset($adminId) && intval($adminId) > 0) {
					$data['admission_id'] = $db->escape($adminId);
					$data['registered_date'] = $db->escape($newDate);
					$data['registered_class'] = $db->escape($_class);
					$data['registered_academic_year'] = $db->escape($_academicYear);
					$id = $db->query_insert(TABLE_STUDENT, $data);

					$appData['application_status'] = "1";
					if (intval(trim($db->escape($_applicationId))) > 0)
						$applicationStatus = $db->query_update(TABLE_NEW_APPLICATION, $appData, "application_no=" . intval(trim($db->escape($_applicationId))));
				}


			if (isset($id) && is_int($id) || $id > 0 && intval($applicationStatus) > 0) {

				$result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				<tr><td width=\"80%\"><br>Student Registered SuccessFully!!!</td>
                <td><a href='feePayment.php?id=$id' class='btn-large btn-danger'><i class='icon-white icon-dollar'></i>Fee Payment</a> </td>
                </tr></table></div>";
				echo $result;
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () {
                window.location.href= \'feePayment.php?id='.$id.'\'; // the redirect goes here
			},2000);';
				echo '</script>';


			} else {
				echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\"> Information!!!</h4>
			<h5> " . "Some Server Side Error</h5><br>Please try again with filling every field correctly</div>";
			}
		} else {
			echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $error . "</div><br>Please try again with filling every field correctly</div>";
		}
		$db->close();
		exit;
	}
?>