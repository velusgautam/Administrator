<?php
if($_SESSION['Role'] != 1)
{
    $sqlQuery = "SELECT COUNT(*) AS RecordCount  FROM ".TABLE_STUDENT." WHERE  academic_year = '".academicYear()."' AND  `schl_id` =". $_SESSION['SchoolCode'];
    $result = $db->query_first( $sqlQuery);
    echo ($result['RecordCount'] == "")?0:$result['RecordCount'];
}
else
{
    $result = $db->query_first("SELECT COUNT(*) AS RecordCount  FROM ".TABLE_STUDENT ." WHERE academic_year = '".academicYear()."' ");
     echo ($result['RecordCount'] == "")?0:$result['RecordCount'];
}
?>