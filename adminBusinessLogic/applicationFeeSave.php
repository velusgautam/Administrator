<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$error;

		$_name = $_POST['name'];
		if (empty($_name))
			$error .= 'Please check Name is Missing <br>';

		$_amount = $_POST['amount'];
		if (empty($_amount))
			$error .= 'Please check Amount is Missing <br>';

		$_academicYear = $_POST['academicYear'];
		if (empty($_academicYear))
			$error .= 'Please check Academic Year is Missing <br>';

		$_school_id = $_POST['schl_id'];
		if (empty($_school_id))
			$error .= 'Please check School Name is Missing <br>';

		if (!isset($error)) {

			$data['fee_name'] = $db->escape($_name);
			$data['amount'] = $db->escape($_amount);
			$data['school_id'] = $db->escape($_school_id);
			$data['academic_year'] = $db->escape($_academicYear);
			$Sql = "Delete from `" . TABLE_APPLICATION_FEE . "` WHERE `school_id` = '" . trim($_school_id) . "'";
			$queryOut = $db->query($Sql);
			$id = $db->query_insert(TABLE_APPLICATION_FEE, $data);

			if (isset($id) && is_int($id) || $id > 0) {

				$result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				<tr><td width=\"100%\"><br>Application Fee Added SuccessFully!!!</td></tr>
  				</table></div>";
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