<?php
	if($_SESSION['Role'] != 1)
	{
		$result = $db->query_first("SELECT COUNT(*) AS RecordCount  FROM ".TABLE_NEW_APPLICATION." WHERE  academic_year = '".academicYear()."'  AND  admission_status = 1 AND  `school_code` =". $_SESSION['SchoolCode']);
		echo $result['RecordCount'];
	}
	else
	{
		$result = $db->query_first("SELECT COUNT(*) AS RecordCount  FROM ".TABLE_NEW_APPLICATION ." WHERE academic_year = '".academicYear()."' AND admission_status = 1");
		echo $result['RecordCount'];


	}
?>