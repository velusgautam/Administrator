<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(0);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error;

		$_applicationId = $_POST['applicationId'];
		if (empty($_applicationId) || intval(trim($_applicationId)) == 0) {
			$error .= 'Please check Application ID is Missing. <br>';
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

		$_studentName = strtoupper(trim($_POST['studentName']));
		if (empty($_studentName)) {
			$error .= 'Please check Student Name is Missing. <br>';
		}

		$_status = $_POST['status'];
		if ($_status == "") {
			$error .= 'Please check Student Status is Missing. <br>';
		}

		if (!isset($error) && intval($_POST['applicationId']) >0  && intval($_POST['updateId'])>0) {

			$data['stream_id'] = $db->escape($_stream);
			$data['class_id'] = $db->escape($_class);
			$data['division_id'] = $db->escape($_division);
			$data['student_name'] = $db->escape(strtoupper($_studentName));
			$data['status'] = $db->escape($_status);
			$data['registered_by'] = $db->escape($_SESSION['UserName']);

			$admData['name'] = $db->escape(strtoupper($_studentName));




					$id = $db->query_update(TABLE_STUDENT, $data, 'student_id='.intval(trim($_POST['updateId'])));
					$ta = $db->query_update(TABLE_ADMISSION_FORM, $admData, 'id='.intval(trim($_POST['applicationId'])));




			if (isset($id) && is_int($id) || $id > 0 && intval($ta) > 0) {

				$result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				<tr><td width=\"80%\"><br>Student Updated SuccessFully!!!</td>

                </tr></table></div>";
				echo $result;



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