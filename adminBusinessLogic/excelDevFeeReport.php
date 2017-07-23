<?php
require_once("securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['excel']) && $_POST['excel'] == 'Excel Export') {
        $academicYear = trim($_POST['academicYear']);
		$schoolId = trim($_POST['school']);
		$month = trim($_POST['status']);
		$query =null;
		
		 if ($academicYear) {
            if ($_SESSION['Role'] == '1') {
					if($schoolId > 0 && $month != "All"  && $month > 0)
					{
							$query = "Select TSDF.student_id, TSDF.date, MONTHNAME(TSDF.date) as month,  TSDF.academic_year, TSDF.student_name, TSS.school_name,TSC.class_name, TSDF.development_fees, TSDF.add_on, TSDF.waive_off, TSDF.total, ((TSDF.development_fees + TSDF.add_on) - (TSDF.waive_off +TSDF.total)) as Balance  FROM "
									. TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
									INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
									INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
									INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
									WHERE TS.status=1 AND TSDF.academic_year = '" . $academicYear . "' AND TS.schl_id=  '" . $schoolId."' AND MONTH(TSDF.date) = '".$month."' ORDER BY TSDF.id DESC";
					}
					else if ($schoolId > 0 && $month == "All")
					{
							$query = "Select TSDF.student_id, TSDF.date,  MONTHNAME(TSDF.date) as month,  TSDF.academic_year, TSDF.student_name, TSS.school_name,TSC.class_name, TSDF.development_fees, TSDF.add_on, TSDF.waive_off, TSDF.total, ((TSDF.development_fees + TSDF.add_on) - (TSDF.waive_off +TSDF.total)) as Balance  FROM "
									. TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
									INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
									INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
									INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
									WHERE TS.status=1 AND TSDF.academic_year = '" . $academicYear . "' AND TS.schl_id=  '" . $schoolId."'  ORDER BY TSDF.id DESC";
					}
					else if ($schoolId == -1 && $month == "All")
					{
							$query = "Select TSDF.student_id, TSDF.date, MONTHNAME(TSDF.date) as month,  TSDF.academic_year, TSDF.student_name, TSS.school_name,TSC.class_name, TSDF.development_fees, TSDF.add_on, TSDF.waive_off, TSDF.total, ((TSDF.development_fees + TSDF.add_on) - (TSDF.waive_off +TSDF.total)) as Balance  FROM "
									. TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
									INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
									INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
									INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
									WHERE TS.status=1 AND TSDF.academic_year = '" . $academicYear . "' ORDER BY TSDF.id DESC";
					}

            	} elseif ($_SESSION['Role'] == '2') {
                		$query = "Select TSDF.student_id, TSDF.date,  MONTHNAME(TSDF.date) as month,  TSDF.academic_year, TSDF.student_name, TSS.school_name,TSC.class_name, TSDF.development_fees, TSDF.add_on, TSDF.waive_off, TSDF.total, ((TSDF.development_fees + TSDF.add_on) - (TSDF.waive_off +TSDF.total)) as Balance  FROM "
                    			. TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
								INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
								INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
								INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
								WHERE TS.status=1  AND TS.schl_id= " . $_SESSION['SchoolCode'] . " AND TSDF.academic_year = '" . $academicYear . "' ORDER BY TSDF.id DESC";
            	}
        
        }
		//  else {
		// 		if ($_SESSION['Role'] == '1') {

		// 					$query = "Select TSDF.student_id,TSDF.academic_year, TSDF.student_name, TSS.school_name,TSC.class_name, TSDF.development_fees,TSDF.waive_off, TSDF.total,
		// 							(TSDF.development_fees-(TSDF.waive_off +TSDF.total)) as Balance  FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
		// 							INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
		// 							INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
		// 							INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
		// 							WHERE TS.status=1 ORDER BY TSDF.id DESC";
		// 		} elseif ($_SESSION['Role'] == '2') {
		// 					$query = "Select TSDF.student_id,TSDF.academic_year, TSDF.student_name, TSS.school_name,TSC.class_name, TSDF.development_fees,TSDF.waive_off, TSDF.total,
		// 							(TSDF.development_fees-(TSDF.waive_off +TSDF.total)) as Balance  FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
		// 							INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
		// 							INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
		// 							INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
		// 							WHERE TS.status=1  AND TS.schl_id= " . $_SESSION['SchoolCode'] . " ORDER BY TSDF.id DESC";
		// 		}
        // }
       
        $headerNames = array("StudentID", "Date", "Month","Academic Year", "Student Name", "School Name", "Class Name", "Development Fees", "Add On", "Waived Off", "Paid", "Balance");

        require_once("excel.php");

        excel("DevelopmentReports", $query, $headerNames, "Student Development Data");

        redirect_to('../developmentFeeReport.php');
    }
}