<?php
require_once("../adminBusinessLogic/securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ALL);
ini_set('display_errors','Off');
ini_set('log_errors', 'On');
if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */
{
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


    $sql = "Select tss.status, tss.student_id, tss.student_name, tsc.school_name, tcc.class_name, IF( tss.stream_id =  '1',  'STATE',  'ICSE' ) AS stream,
    tdv.division_name, tss.academic_year FROM ".TABLE_STUDENT." tss
                        LEFT OUTER JOIN ".TABLE_SCHOOL." tsc ON (tss.schl_id = tsc.schl_id)
                        LEFT OUTER JOIN ".TABLE_CLASS." tcc ON (tss.class_id = tcc.class_id)
                        LEFT OUTER JOIN ".TABLE_DIVISION." tdv ON (tss.division_id = tdv.division_id)";
if(!empty($_school) && $_school === "All" && intval($_status) >= 0  && isset($_academicYear))
{
$sql .= " WHERE tss.status =".trim($_status)." AND tss.academic_year= '".$_academicYear."'";
}
else if(!empty($_school) && !empty($_stream) && $_stream === "All" && intval($_status) >= 0  && isset($_academicYear) )
{
    $sql .= " WHERE tss.schl_id= ".trim($_school)." AND tss.status =".trim($_status)." AND tss.academic_year= '".$_academicYear."'";
}
else if(!empty($_school) && !empty($_stream) && !empty($_class) && $_class === "All" && intval($_status) >= 0  && isset($_academicYear))
{
    $sqlClass = "Select class_id FROM ".TABLE_CLASS_MAPPING." Where `stream_id` = ".trim($_stream);
    $resultClass = $db->query($sqlClass);
    while($rowClass = $db->fetch_array($resultClass))
    {
        $_classId .= $rowClass['class_id'].",";
    }
    $_classId = trim($_classId, ",");
    $sql .= " WHERE tss.schl_id= ".$_school." AND tss.status =".trim($_status)." AND tss.academic_year= '".$_academicYear."' AND FIND_IN_SET (tss.class_id, '".$_classId."')";

}
else if(!empty($_school) && !empty($_stream) && !empty($_class) && !empty($_division) && $_division === "All"  && intval($_status) >= 0  && isset($_academicYear))
{
    $sql .= " WHERE tss.schl_id= ".trim($_school)." AND tss.status =".trim($_status)." AND tss.class_id= ".trim($_class)." AND tss.academic_year= '".$_academicYear."'";
}
else if(!empty($_school) && !empty($_stream) && !empty($_class) && !empty($_division) &&  is_numeric($_division)  && intval($_status) >= 0  && isset($_academicYear))
{
    $sql .= " WHERE tss.schl_id= ".trim($_school)." AND tss.status =".trim($_status)." AND tss.class_id= ".trim($_class)." AND tss.division_id = ".trim($_division)." AND tss.academic_year= '".$_academicYear."'";
}

	//echo $sql;

$result = $db->query($sql);
$i=0;
echo '<table class="data-table" id="studentTable">
						<thead>
							<tr >
								<th style="width: 30px"><input type="checkbox" name="check_all" title="Select or DeSelect ALL" style="background-color:#ccc;"/></th>
								<th>StudentName</th>
                                <th>School</th>
								<th>Stream</th>
								<th>Class</th>
								<th>Division</th>
								<th>AcademicYear</th>
								<th class="center">Status</th>
							</tr>
						</thead>
						<tbody >';
while($rows = $db->fetch_array($result))
{ $i++;
	if($rows['status']==5)
			$statusValue = "<span style='color:green'>TC Given</span>";
	else
		$statusValue = "<span style='color:orange'>School Promotion</span>";
echo "
    <tr class=\"";  echo ($i % 2 == 0) ?"odd\" id=\"". $rows['student_id']."\">" : "even\" id=\"". $rows['student_id']."\">";
    echo"
        <td align=\"center\"><input name=\"checkbox[]\" type=\"checkbox\" class=\"idRow\" id=\"checkbox[]\" value=\"". $rows['student_id']."\"></td>
        <td>". $rows['student_name']."</td>
        <td>".$rows['school_name']."</td>
        <td>".$rows['stream']."</td>
        <td>".$rows['class_name']."</td>
        <td>".$rows['division_name']."</td>
        <td>".$rows['academic_year']."</td>
        <td style=\"text-align:center\"><b>". $statusValue."</b></td>
    </tr>";


}
echo '</tbody><tfoot>
							<tr>
								<th></th>
                                <th>StudentName</th>
                                <th>School</th>
                                <th>Stream</th>
                                <th>Class</th>
                                <th>Division</th>
                                <th>AcademicYear</th>
                                <th class="center">Status</th>
							</tr>
						</tfoot></table>';
}
else
{
    echo "Try Again";
}
?>