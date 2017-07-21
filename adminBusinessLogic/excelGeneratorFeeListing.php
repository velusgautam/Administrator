<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(0);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error;
		$condition = null;
		$fields = null;
		$headerNames = array();

			$error=null;

			if($_SESSION['Role'] === "1")
			{
				$_school = $_POST['school'];
			}
			else
			{
				$_school = $_SESSION['SchoolCode'];
			}

			$_stream = $_POST['stream'];
			$_class = $_POST['classSelect'];
			$_division = $_POST['division'];
			$_status = $_POST['status'];
			$_academicYear = $_POST['academicYear'];


		$count =0;
		$sSchool = null;
		$sStatus =null;
		$sAcademicYear =null;
		$sStream =null;
		$sClass = null;
		$sDivision = null;
		if(!empty($_school) && intval($_school) > 0)
		{
			$count++;
			$sSchool = "TSFP.schl_id= ".$_school;
		}
//		if(!empty($_status) && intval($_status) >= 0)
//		{
//			$count++;
//			$sStatus = "tss.status =".trim($_status);
//		}
		if(isset($_academicYear)&& $_academicYear !="All")
		{
			$count++;
			$sAcademicYear =  "TSFP.academic_year= '".$_academicYear."'";
		}

//		if(!empty($_stream) && intval($_stream) > 0 && !empty($_class) &&  $_class =="All")
//		{
//			$count++;
//			if( intval($_school)>0)
//				$sqlClass = "Select class_id FROM ".TABLE_CLASS_MAPPING." Where `stream_id` = ".trim($_stream)." AND schl_id =".$_school;
//			else
//				$sqlClass = "Select class_id FROM ".TABLE_CLASS_MAPPING." Where `stream_id` = ".trim($_stream);
//
//			$resultClass = $db->query($sqlClass);
//			while($rowClass = $db->fetch_array($resultClass))
//			{
//				$_classId .= $rowClass['class_id'].",";
//			}
//			$_classId = trim($_classId, ",");
//			$sStream= " FIND_IN_SET (tss.class_id, '".$_classId."') AND tss.stream_id='".$_stream."'";
//		}
//
//		if(!empty($_class) && intval($_class) > 0)
//		{
//			$count++;
//			$sClass = "tss.class_id= ".trim($_class);
//		}
//
//		if(!empty($_division) && intval($_division) > 0)
//		{
//			$count++;
//			$sDivision = "tss.division_id= ".trim($_division);
//		}

		$andCounter=0;
		if($count > 0)
		{
			$sql.=" WHERE ";
		}
		if(!empty($sSchool))
		{
			$andCounter =1;
			$sql.=$sSchool." ";
		}

		if(!empty($sAcademicYear))
		{
			if($andCounter!=0)
				$sql.= " AND ".$sAcademicYear." ";
			else
			{
				$andCounter =1;
				$sql.= $sAcademicYear." ";
			}
		}
//		if(!empty($sStream))
//		{
//			if($andCounter!=0)
//				$sql.= " AND ".$sStream." ";
//			else
//			{
//				$andCounter =1;
//				$sql.= $sStream." ";
//			}
//		}
//		if(!empty($sClass))
//		{
//			if($andCounter!=0)
//				$sql.= " AND ".$sClass." ";
//			else
//			{
//				$andCounter =1;
//				$sql.= $sClass." ";
//			}
//		}
//		if(!empty($sDivision))
//		{
//			if($andCounter!=0)
//				$sql.= " AND ".$sDivision." ";
//			else
//			{
//				$andCounter =1;
//				$sql.= $sDivision." ";
//			}
//		}
		if(intval($_status) > 0)
		{
			$sql .= " AND MONTH(TSFP.date) = '".$_status."'";
		}

		$sql .= " AND grand_total > 0 ORDER BY TSFP.date ASC";


//			$query = "Select tss.academic_year, tsc.school_name, tss.student_name,  tcc.class_name, tdv.division_name, IF( tss.stream_id =  '1',  'STATE',  IF( tss.stream_id =  '2',  'ICSE',  '' ) ) AS stream, TSFP.date, TSFP.grand_total
//			 FROM ".TABLE_STUDENT_FEE_PRIMARY." TSFP
//                        LEFT OUTER JOIN ".TABLE_STUDENT." tss ON (TSFP.student_id = tss.student_id)
//                        LEFT OUTER JOIN ".TABLE_SCHOOL." tsc ON (tss.schl_id = tsc.schl_id)
//                        LEFT OUTER JOIN ".TABLE_CLASS." tcc ON (tss.class_id = tcc.class_id)
//                        LEFT OUTER JOIN ".TABLE_DIVISION." tdv ON (tss.division_id = tdv.division_id)" . $sql;

		$query = "Select  DATE_FORMAT(TSFP.date,'%d-%m-%Y')as date, TSFP.id, TSFP.academic_year,tsc.school_name,  TSFP.student_name,    TSFP.class_name,TSFP.division_name, TSFP.stream,  TSFP.grand_total
     FROM ".TABLE_STUDENT_FEE_PRIMARY." TSFP

                        LEFT OUTER JOIN ".TABLE_SCHOOL." tsc ON (TSFP.schl_id = tsc.schl_id)


                        " . $sql;
		//echo $query;
		//echo $condition;
		//echo '';
		//break;

			$headerNames = array("Date","Receipt No","Academic Year",  "School Name", "Student Name",  "Class Name", "Division", "Stream", "Payment");

			require_once("excel.php");

			excel("StudentPaymentDetails", $query, $headerNames, "Student Fee Data");


	}
?>