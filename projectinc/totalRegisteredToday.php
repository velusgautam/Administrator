<?php
if($_SESSION['Role'] != 1)
{
    $sqlQuery = "SELECT COUNT(*) AS RecordCount  FROM ".TABLE_STUDENT." WHERE  academic_year = '".academicYear()."' AND  date = '".date('Y-m-d')."' AND status = 1 AND  `schl_id` =". $_SESSION['SchoolCode'];
    $result = $db->query_first($sqlQuery);
    echo $result['RecordCount'];
}
else
{
    $sqlQuery = "SELECT COUNT(*) AS RecordCount  FROM ".TABLE_STUDENT ." WHERE academic_year = '".academicYear()."'  AND date = '".date('Y-m-d')."' AND status = 1";
    $result = $db->query_first($sqlQuery);
    echo $result['RecordCount'];
}

?>