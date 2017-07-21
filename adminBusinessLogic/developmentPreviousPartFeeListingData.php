<?php
	require_once("developmentSecurityInside.php");
	include_once('../dbcon/dbConfig.php');
	try {
		//Open database connection
		$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		mysql_select_db(DB_DATABASE, $con);
		if ($_GET["action"] == "list") {
			//Get record count
			if (isset($_GET["studid"]) && isset($_GET['ay'])) {
				$result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM `" . TABLE_STUDENT_DEVELOPMENT_FEE_PART . "`  WHERE `student_id`= " . $_GET["studid"] . " ");
				$row = mysql_fetch_array($result);
				$recordCount = $row['RecordCount'];
				$sql = "SELECT @a:=@a+1 sl, tsdp.part_id, tsd.id, tsdp.payment_now, tsdp.balance, tsdp.waive_off, tsd.development_fees as development_fees, tsdp.academic_year,  tsd.student_name, tsd.academic_year, DATE_FORMAT(tsdp.part_date,'%d-%m-%Y') as date,
				tsdp.payment_type,tsdp.cheque_no,tsdp.cheque_date,tsdp.cheque_bank,
				tsd.total  FROM `" . TABLE_STUDENT_DEVELOPMENT_FEE_PART . "` tsdp
             INNER JOIN `" . TABLE_STUDENT_DEVELOPMENT_FEE."` tsd  ON tsd.student_id = tsdp.student_id, (SELECT @a:= 0) AS a WHERE tsdp.`student_id`= " . $_GET["studid"] . "  ORDER BY " . $_GET["jtSorting"] . " LIMIT " .
					$_GET["jtStartIndex"] . ",
            " . $_GET["jtPageSize"] . ";";


				$sqlOutput = mysql_query($sql);
			}
			
			//echo $sql;

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