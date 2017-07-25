<?php
	require_once("developmentSecurityInside.php");
	include_once('../dbcon/dbConfig.php');
	try {
		//Open database connection
		$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		mysql_select_db(DB_DATABASE, $con);
		if ($_GET["action"] == "list") {
			//Get record count
			if (isset($_GET["studid"])) {
				$result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM `" . TABLE_STUDENT_DEVELOPMENT_FEE . "`  WHERE `student_id`= " . $_GET["studid"] . " ");
				$row = mysql_fetch_array($result);
				$recordCount = $row['RecordCount'];
				$sql = "SELECT @a:=@a+1 sl, id, student_name, coalesce(add_on, 0) as add_on, academic_year, DATE_FORMAT(date,'%d-%m-%Y') as date, waive_off, development_fees, payment_type,cheque_no,cheque_date,cheque_bank, total  FROM `" . TABLE_STUDENT_DEVELOPMENT_FEE . "`,
            (SELECT @a:= 0) AS a WHERE `student_id`= " . $_GET["studid"] . " ORDER BY " . $_GET["jtSorting"] . " LIMIT " .
					$_GET["jtStartIndex"] . ",
            " . $_GET["jtPageSize"] . ";";
				$sqlOutput = mysql_query($sql);
			}
			
			$rows = array();
			while ($row = mysql_fetch_array($sqlOutput)) {
				$rows[] = $row;
			}

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $rows;
			print json_encode($jTableResult);
		}

		else if ($_GET["action"] == "delete") {
			//Delete from database
			$result = mysql_query("DELETE FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " WHERE id = " . $_POST["id"] . ";");
			$result = mysql_query("DELETE FROM " . TABLE_STUDENT_DEVELOPMENT_FEE_PART . " WHERE development_fee_id = " . $_POST["id"] . ";");
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			print json_encode($jTableResult);
		}
		mysql_close($con);

	} catch (Exception $ex) {
		$jTableResult = array();
		$jTableResult['Result'] = "ERROR";
		$jTableResult['Message'] = $ex->getMessage();
		print json_encode($jTableResult);
	}

?>