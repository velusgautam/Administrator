<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error = null;

		$checkbox = $_POST['checkbox'];

		if (empty($checkbox)) {
			$error .= 'No Students are Selected <br>';
		}

		$id = "('" . implode("','", $checkbox) . "');";

		$tcQuery = "";
		$jquery = "";
		$statusCheck = $_POST['type'];
		if (intval($statusCheck > 0)) {
			if (intval($statusCheck) == 1) {
				$_status = 3;
				$queryCondition = " `admission_status`='1',";
				foreach ($checkbox as &$value) {
					$sql = "select DATE_FORMAT(date,'%d-%m-%Y') as date, tc_number from " . TABLE_SCHOOL_TC . " where student_id=" . $value;
					$tcNumber = $db->query_first($sql);
					if ($db->affected_rows > 0) {
						$ad = $db->query_first("Select admission_id, academic_year from " . TABLE_STUDENT . " where student_id=" . $value);
						$tcUpdateQuery = "Select  tcdate, admin_no, academic_year FROM " . TABLE_ADMISSION_FORM . " WHERE id=" . $ad['admission_id'];
						$oldTcData = $db->query_first($tcUpdateQuery);
						$oldId = $db->query("INSERT INTO " . TABLE_TC_OLD . "(student_id, tc_number, academic_year, admission_no) values ('" . $value . "', '" . $oldTcData['tcdate'] . "', '" . $oldTcData['academic_year'] . "',
						'" . $oldTcData['admin_no'] . "')");
						$tcDate = $tcNumber['tc_number']."-".$tcNumber['date'];
						$tcQuery = "UPDATE " . TABLE_ADMISSION_FORM . " SET `tcdate`='" . $tcDate . "' WHERE id=" . $ad['admission_id'] . ";";

						$academicQuery = " UPDATE  " . TABLE_ADMISSION_FORM . " SET `academic_year`='".$ad['academic_year']."' WHERE id=" . $ad['admission_id'] . ";";
						$db->query($academicQuery);
						$db->query($tcQuery);
					}
					$jquery .= "$('table#studentTable tr#".$value."').remove(); ";
				}
			} elseif (intval($statusCheck) == 2) {
				$_status = 2;
				$queryCondition = "";
			} else
				$_status = 0;
		}

		if (!isset($error)) {

			$date = $db->escape(date("Y-m-d"));

			$sql = "UPDATE " . TABLE_STUDENT . " SET " . $queryCondition . " `status`='" . trim($_status) . "', `date`='" . trim($date) . "' WHERE student_id IN $id";
			$id = $db->query($sql);

			if (intval($id) > 0) {

				$result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				";

				$result .= "<tr><td width=\"85%\"><br>SAVED SuccessFully!!!</td></tr>";
				$result .= "<tr><td width=\"85%\"><br><strong>You must update the Admission Number of Each Student Manually.</strong></td></tr>";

				$result .= "</table></div>

            ";
				echo $result;
				echo "<script>".$jquery."</script>";
				//redirect_to("../printTc.php?studid=".trim($db->escape($_studId))."&id=".$id);
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
	} else {
		echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $error . "</div><br>Please try again with filling every field correctly</div>";
	}
?>