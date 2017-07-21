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

		$studentList = "";
		$jquery = "";

		if($error == null)


				foreach ($checkbox as &$value) {

					$studentList .= " ".$value.",";

						$sql = "Delete from " . TABLE_STUDENT . " where student_id=" . $value;

						$id = $db->query($sql);

					//}
					$jquery .= "$('table#studentTable tr#".$value."').remove(); ";
				}

		}

$studentList = rtrim($studentList, ",");

			if (intval($id) > 0) {

				$result = "<div class=\"alert alert-error alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				";

				$result .= "<tr><td width=\"85%\"><br>Deleted SuccessFully!!!</td></tr>";
				$result .= "<tr><td width=\"85%\"><br><strong>The following students with Student ID's ".$studentList." is permanently Deleted from server.</strong></td></tr>";

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

?>