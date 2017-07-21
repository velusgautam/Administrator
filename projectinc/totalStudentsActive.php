<?php
if($_SESSION['Role'] != 1)
{
    $result = $db->query_first("SELECT COUNT(*) AS RecordCount  FROM ".TABLE_STUDENT." WHERE  academic_year = '".academicYear()."' AND status = 1 AND  `schl_id` =". $_SESSION['SchoolCode']);
    echo $result['RecordCount'];
}
else
{
    $result = $db->query_first("SELECT COUNT(*) AS RecordCount  FROM ".TABLE_STUDENT ." WHERE  academic_year = '".academicYear()."' AND status = 1");
    echo $result['RecordCount'];
}
?>