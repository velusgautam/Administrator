<?php
	require_once("../adminBusinessLogic/securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error = null;

		if ($_SESSION['Role'] === "1") {
			$_school = $_POST['school'];
		}
		else {
			$_school = $_SESSION['SchoolCode'];
		}

		$_stream = $_POST['stream'];
		$_class = $_POST['classSelect'];
		$_division = $_POST['division'];
		$_status = $_POST['status'];
		$_academicYear = $_POST['academicYear'];
		$inside = 0;

		$sql = "Select  tss.student_id, tss.student_name, tsc.school_code, tcc.class_name, IF( tss.stream_id =  '1',  'STATE',  'ICSE' ) AS stream,
    tdv.division_name, tss.academic_year FROM " . TABLE_STUDENT . " tss
                        LEFT OUTER JOIN " . TABLE_SCHOOL . " tsc ON (tss.schl_id = tsc.schl_id)
                        LEFT OUTER JOIN " . TABLE_CLASS . " tcc ON (tss.class_id = tcc.class_id)
                        LEFT OUTER JOIN " . TABLE_DIVISION . " tdv ON (tss.division_id = tdv.division_id) WHERE tss.status = '1' AND tss.academic_year= '" . $_academicYear . "'";

		if (!empty($_school) && $_school != "All") {
			$inside = 1;
			$sql .= " AND  tss.schl_id= " . trim($_school) . "";
		}
		if (!empty($_stream) && $_stream != "All" && !empty($_class) && $_class == "All") {
			$inside = 1;
			$sqlClass = "Select class_id FROM " . TABLE_CLASS_MAPPING . " Where `stream_id` = " . trim($_stream);
			$resultClass = $db->query($sqlClass);
			while ($rowClass = $db->fetch_array($resultClass)) {
				$_classId .= $rowClass['class_id'] . ",";
			}
			$_classId = trim($_classId, ",");
			$sql .= " AND FIND_IN_SET (tss.class_id, '" . $_classId . "')";
		}

		if (!empty($_class) && $_class != "All") {
			$inside = 1;
			$sql .= "  AND tss.class_id  = '" . $_class . "'";
		}
		if (!empty($_division) && $_division != "All") {
			$inside = 1;
			$sql .= "  AND tss.division_id  = '" . $_division . "'";
		}

		//echo $sql;

		$result = $db->query($sql);
		$i = 0;
		$total = 0;
		echo '<table class="data-table">
						<thead>
							<tr >


								<th>ID</th>
								<th>StudentName</th>
                                <th>School</th>
								<th>Stream</th>
								<th>Class</th>
								<th>Division</th>
								<th>AcademicYear</th>
								<th class="center">Total</th>
								<th class="center">Paid</th>
								<th class="center">Waived</th>
								<th class="center">Balance</th>
							</tr>
						</thead>
						<tbody >';
		while ($rows = $db->fetch_array($result)) {
			$i++;
			$query2 = "SELECT SUM(IF(afm.fee_select = 'M', (afm.fee_amount * 12) , afm.fee_amount)) as total, x.paid as paid, x.waived, (SUM(IF(afm.fee_select = 'M', (afm.fee_amount * 12) , afm.fee_amount)) - x.waivepaid )as balance
			FROM `admin_fee_mapping` afm
			inner join admin_student ast on (ast.schl_id = afm.schl_id)
			AND (ast.class_id = afm.class_id),
			(Select GREATEST((sum(asfs.total) + sum(asfs.waive_off) ),0) as waivepaid, sum(asfs.waive_off) as waived, sum(asfs.total)as paid
			FROM admin_student_fee_secondary asfs
			where primary_id IN(Select id
			FROM admin_student_fee_primary where academic_year='" . $_academicYear . "' and student_id =" . $rows['student_id'] . ")) as x where ast.student_id = " . $rows['student_id'] . "";
			$dataVal = $db->query_first($query2);
			$totalRow = "<span style='color:green'>" . $dataVal['total'] . "</span>";
			$paidRow = "<span style='color:green'>" . $dataVal['paid'] . "</span>";
			$waivedRow = "<span style='color:green'>" . $dataVal['waived'] . "</span>";
			$balanceRow = "<span style='color:green'>" . $dataVal['balance'] . "</span>";
			$total = $total + intval($dataVal['total']);
			$paidTotal = $paidTotal + intval($dataVal['paid']);
			$waivedTotal = $waivedTotal + intval($dataVal['waived']);
			$balTotal = $balTotal + intval($dataVal['balance']);

			echo "
    <tr class=\"";
			echo ($i % 2 == 0) ? " odd\">" : "even\">";
			echo "

        <td>" . $rows['student_id'] . "</td>
        <td><a href='studentDetails.php?id=" . $rows['student_id'] . "' target='_blank'><b>" . $rows['student_name'] . "</b></a></td>
        <td>" . $rows['school_code'] . "</td>
        <td>" . $rows['stream'] . "</td>
        <td>" . $rows['class_name'] . "</td>
        <td>" . $rows['division_name'] . "</td>
        <td>" . $rows['academic_year'] . "</td>
        <td style=\"text-align:center\"><b>" . $totalRow . "</b></td>
        <td style=\"text-align:center\"><b>" . $paidRow . "</b></td>
        <td style=\"text-align:center\"><b>" . $waivedRow . "</b></td>
        <td style=\"text-align:center\"><b>" . $balanceRow . "</b></td>
    </tr>";

		}
		echo '<tr>

                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>

                                <th></th>
                                <th class="right" style="text-align: right; font-size:16px">Total :</th>
                                <th class="center" style="padding-right: 20px;font-size:16px">' . formatMoney($total) . '</th>
                                <th class="center" style="padding-right: 20px;font-size:16px">' . formatMoney($paidTotal) . '</th>
                                <th class="center" style="padding-right: 20px;font-size:16px">' . formatMoney($waivedTotal) . '</th>
                                <th class="center" style="padding-right: 20px;font-size:16px">' . formatMoney($balTotal) . '</th>
							</tr>';
		echo '</tbody><tfoot>
							<tr>


                                <th >ID</th>
                                <th >StudentName</th>
                                <th>School</th>
                                <th>Stream</th>
                                <th>Class</th>
                                <th>Division</th>
                                <th>AcademicYear</th>
                                <th class="center" style="padding-right: 20px;">Total</th>
                                <th class="center" style="padding-right: 20px;">Paid</th>
                                <th class="center" style="padding-right: 20px;">Waived</th>
                                <th class="center" style="padding-right: 20px;">Balance</th>
							</tr>
						</tfoot></table>';
	}
	else {
		echo "Try Again";
	}
?>