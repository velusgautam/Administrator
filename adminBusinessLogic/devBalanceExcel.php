<?php


	error_reporting(0);
	date_default_timezone_set('Asia/Kolkata');

	if (PHP_SAPI == 'cli') die('This example should only be run from a Web Browser');

	require_once('PHPExcel.php');

	function excel($filename, $query, $headerNames, $sheetTitle) {

		if (empty($sheetTitle)) $sheetTitle = "Sheet1";
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$cellColumns = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P");

		// Execute the database query
		$result = mysql_query($query) or die(mysql_error());

		// Comments from Velu : Loop from the Input Name Array Field Names
		$limit = count($headerNames);
		$count = 0;
		while ($count < $limit) {
			$objPHPExcel->getActiveSheet()->SetCellValue($cellColumns[$count] . '1', $headerNames[$count]);
			$objPHPExcel->getActiveSheet()->getColumnDimension($cellColumns[$count])->setWidth(20);
			$count++;
		}

		$rowCount = 2;
		// Iterate through each result from the SQL query in turn
		// We fetch each database result row into $row in turn
		while ($row = mysql_fetch_array($result)) {
			$count = 0;
			$query2 = "SELECT SUM(IF(afm.fee_select = 'M', (afm.fee_amount * 12) , afm.fee_amount)) as total, x.paid as paid, x.waived, (SUM(IF(afm.fee_select = 'M', (afm.fee_amount * 12) , afm.fee_amount)) - x.waivepaid )as balance
			FROM `admin_fee_mapping` afm
			inner join admin_student ast on (ast.schl_id = afm.schl_id)
			AND (ast.class_id = afm.class_id),
			(Select GREATEST((sum(asfs.total) + sum(asfs.waive_off) ),0) as waivepaid, sum(asfs.waive_off) as waived, sum(asfs.total)as paid
			FROM admin_student_fee_secondary asfs
			where primary_id IN(Select id
			FROM admin_student_fee_primary where academic_year='".$row['academic_year']."' and student_id =".$row['student_id'].")) as x where ast.student_id = ".$row['student_id']."";
			$balanceresult = mysql_query($query2) or die(mysql_error());
			$newCounter =0;
			$row2 = mysql_fetch_array($balanceresult);
			while ($count < $limit) {
				if ($cellColumns[$count] == "H" ||$cellColumns[$count] == "I" ||$cellColumns[$count] == "J"||$cellColumns[$count] == "K"  ) {
						$objPHPExcel->getActiveSheet()->SetCellValue($cellColumns[$count] . $rowCount, $row2[$newCounter]);
						$count++;
						$newCounter++;
				}
				else {
					$objPHPExcel->getActiveSheet()->SetCellValue($cellColumns[$count] . $rowCount, $row[$count]);
					$count++;
				}
			}

			$rowCount++;
		}

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Wixzi School Administrator")->setLastModifiedBy("School Administrator")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("School Document with Confidential Data Auto Generated.")->setKeywords("office 2007 openxml php")->setCategory("Auto Generated School Reports.");

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle($sheetTitle);
		//freezing first row
		$objPHPExcel->getActiveSheet()->freezePane('B2');
		//column width

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

?>