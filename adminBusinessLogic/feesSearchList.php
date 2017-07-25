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
	$inside = 0;

    $sql = "Select TSFP.id, DATE_FORMAT(TSFP.date,'%d-%m-%Y')as date, TSFP.grand_total, TSFP.student_id, TSFP.student_name, tsc.school_code, TSFP.class_name, TSFP.stream,
    TSFP.division_name, TSFP.academic_year FROM ".TABLE_STUDENT_FEE_PRIMARY." TSFP

                        LEFT OUTER JOIN ".TABLE_SCHOOL." tsc ON (TSFP.schl_id = tsc.schl_id)


                        WHERE  TSFP.academic_year= '".$_academicYear."' AND grand_total > 0 ";




	 if(!empty($_school) && $_school != "All" )
	{
		$inside =1;
		$sql .= " AND  TSFP.schl_id= ".trim($_school)."" ;
	}
//	if(!empty($_stream) && $_stream != "All" )
//	{
//		$inside =1;
//		$sqlClass = "Select class_id FROM ".TABLE_CLASS_MAPPING." Where `stream_id` = ".trim($_stream);
//		$resultClass = $db->query($sqlClass);
//		while($rowClass = $db->fetch_array($resultClass)){
//			$_classId .= $rowClass['class_id'].",";
//		}
//		$_classId = trim($_classId, ",");
//		$sql .= " AND FIND_IN_SET (tss.class_id, '".$_classId."')";
//	}
//
//	if(  !empty($_class) && $_class != "All" )
//	{
//		$inside =1;
//		$sql .= "  AND tss.class_id  = '".$_class."'";
//	}
//	if(!empty($_division) && $_division != "All"  )
//	{
//		$inside =1;
//		$sql .= "  AND tss.division_id  = '".$_division."'";
//	}
	if (intval($_status) > 0 )
	{
		$sql .= " AND MONTH(TSFP.date) = '".$_status."'";
	}

    $sql .= "  ORDER BY TSFP.date ASC ";

//	echo $sql."--".intval($_status);


$result = $db->query($sql);
$i=0;
	$total = 0;
echo '<table class="data-table">
						<thead>
							<tr >

								<th>Date</th>
								<th>Re #</th>
								<th>StudentName</th>
                                <th>School</th>
								<th>Stream</th>
								<th>Class</th>
								<th>Division</th>
								<th>AcademicYear</th>
								<th class="center">Payment</th>
							</tr>
						</thead>
						<tbody >';
while($rows = $db->fetch_array($result))
{ $i++;

			$statusValue = "<span style='color:green'>".$rows['grand_total']."</span>";
$total = $total + intval($rows['grand_total'])	;

echo "
    <tr class=\"";  echo ($i % 2 == 0) ?" odd\">" : "even\">";
    echo"
        <td>". $rows['date']."</td>
        <td>". $rows['id']."</td>
        <td>". $rows['student_name']."</td>
        <td>".$rows['school_code']."</td>
        <td>".$rows['stream']."</td>
        <td>".$rows['class_name']."</td>
        <td>".$rows['division_name']."</td>
        <td>".$rows['academic_year']."</td>
        <td style=\"text-align:center\"><b>". $statusValue."</b></td>
    </tr>";


}
echo '<tr>

                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="right" style="text-align: right; font-size:16px">Total :</th>
                                <th class="center" style="padding-right: 20px;font-size:16px">'.$total.'</th>
							</tr>';
echo '</tbody><tfoot>
							<tr>

                                <th style="padding-left: 20px">Date</th>
                                <th>Re #</th>
                                <th>StudentName</th>
                                <th>School</th>
                                <th>Stream</th>
                                <th>Class</th>
                                <th>Division</th>
                                <th>AcademicYear</th>
                                <th class="center" style="padding-right: 20px;">Payment</th>
							</tr>
						</tfoot></table>';
}
else
{
    echo "Try Again";
}
?>