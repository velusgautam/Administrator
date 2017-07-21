<?php
if($_SESSION['Role'] != 1)
{
    $result = $db->query_first("SELECT SUM(grand_total) AS total  FROM ".TABLE_STUDENT_FEE_PRIMARY." WHERE   academic_year = '".academicYear()."' AND  `schl_id` =". $_SESSION['SchoolCode']);
    $data =  (intval($result['total'])>0)? $result['total'] : 0;
	echo formatMoney($data);
}
else
{
    $result = $db->query_first("SELECT SUM(grand_total) AS total  FROM ".TABLE_STUDENT_FEE_PRIMARY." WHERE   academic_year = '".academicYear()."' ");
	$data =  (intval($result['total'])>0)? $result['total'] : 0;
	echo formatMoney($data);
}
?>