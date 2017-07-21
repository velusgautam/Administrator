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
   
    $_status = $_POST['status'];
    $_academicYear = $_POST['academicYear'];
	$inside = 0;

    $sql = "Select TSDF.student_id, MONTHNAME(TSDF.date) as month, TSDF.student_name,TSC.class_name, TSS.school_code, TSDF.development_fees, TSDF.total, TSDF.waive_off, ((TSDF.development_fees + TSDF.add_on) - (TSDF.waive_off +TSDF.total)) as balance,
								TSDF.academic_year, TSDF.add_on FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
								INNER JOIN ".TABLE_STUDENT." TS on TSDF.student_id = TS.student_id
								INNER JOIN ".TABLE_SCHOOL." TSS on TS.schl_id= TSS.schl_id
								INNER JOIN ".TABLE_CLASS." TSC on TSC.class_id= TS.class_id


                        WHERE  TSDF.academic_year= '".$_academicYear."' ";




	 if(!empty($_school) && $_school != "All" )
	{
		$inside =1;
		$sql .= " AND  TSFP.schl_id= ".trim($_school)."" ;
	}

	if (intval($_status) > 0 )
	{
		$sql .= " AND MONTH(TSDF.date) = '".$_status."'";
	}

    $sql .= "  ORDER BY TSDF.date DESC ";

//	echo $sql."--".intval($_status);


$result = $db->query($sql);
$i=0;
	$total = 0;
echo '<table class="data-table">
						<thead>
							<tr >

								<th>Sl.No</th>
                                <th>Month</th>
                                <th>Student Name</th>
                                <th>School Code</th>
                                <th>Class Name</th>
                                <th>Academic Year</th>
                                <th>Development Fees</th>
                                <th>Waived Off</th>
                                 <th>Balance</th>
                                  <th>AddOn</th>
                                <th>Paid</th>
                               
                                <th>Details</th>
							</tr>
						</thead>
						<tbody >';
while($rows = $db->fetch_array($result))
{ $i++;

			$statusValue = "<span style='color:green'>".$rows['total']."</span>";
$total = $total + intval($rows['total'])	;

echo "
    <tr class=\"";  echo ($i % 2 == 0) ?" odd\">" : "even\">";
?>
   <td style="text-align: center"><?php echo $i; ?></td>
    <td style="text-align: center"><?php echo $rows['month']; ?></td>
    <td style="text-align: center"><?php echo $rows['student_name']; ?></td>
    <td style="text-align: center"><?php echo $rows['school_code']; ?></td>
    <td style="text-align: center"><?php echo $rows['class_name']; ?></td>
    <td style="text-align: center"><?php echo $rows['academic_year']; ?></td>
    <td style="text-align: center"><?php echo $rows['development_fees']; ?></td>
    <td style="text-align: center"><?php echo $rows['waive_off']; ?></td>
     <td style="text-align: center"><?php echo $rows['balance']; ?></td>
      <td style="text-align: center"><?php echo $rows['add_on']; ?></td>
    <td style="text-align: center"><?php echo $rows['total']; ?></td>
   
    <td style="text-align: center"><a href="developmentPreviousFeeListing.php?id=<?php echo $rows['student_id'] ?>"><button>Details</button></a> </td>
   

<?php
echo " </tr>";
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