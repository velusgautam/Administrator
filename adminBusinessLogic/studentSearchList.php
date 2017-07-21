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

    if($_SESSION['Role'] == "1")
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
			$sSchool = "tss.schl_id= ".$_school;
		}
		if(!empty($_status) && intval($_status) >= 0)
		{
			$count++;
			$sStatus = "tss.status =".trim($_status);
		}
		if(isset($_academicYear)&& $_academicYear !="All")
		{
			$count++;
			$sAcademicYear =  "tss.academic_year= '".$_academicYear."'";
		}

		if(!empty($_stream) && intval($_stream) > 0 && !empty($_class) &&  $_class =="All")
		{
			$count++;
			if( intval($_school)>0)
				$sqlClass = "Select class_id FROM ".TABLE_CLASS_MAPPING." Where `stream_id` = ".trim($_stream)." AND schl_id =".$_school;
			else
				$sqlClass = "Select class_id FROM ".TABLE_CLASS_MAPPING." Where `stream_id` = ".trim($_stream);

			$resultClass = $db->query($sqlClass);
			while($rowClass = $db->fetch_array($resultClass))
			{
				$_classId .= $rowClass['class_id'].",";
			}
			$_classId = trim($_classId, ",");
			$sStream= " FIND_IN_SET (tss.class_id, '".$_classId."') AND tss.stream_id='".$_stream."'";
		}

		if(!empty($_class) && intval($_class) > 0)
		{
			$count++;
			$sClass = "tss.class_id= ".trim($_class);
		}

		if(!empty($_division) && intval($_division) > 0)
		{
			$count++;
			$sDivision = "tss.division_id= ".trim($_division);
		}

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
		if(!empty($sStatus))
		{
			if($andCounter!=0)
				$sql.= " AND ".$sStatus." ";
			else
			{
				$andCounter =1;
				$sql.= $sStatus." ";
			}
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
		if(!empty($sStream))
		{
			if($andCounter!=0)
				$sql.= " AND ".$sStream." ";
			else
			{
				$andCounter =1;
				$sql.= $sStream." ";
			}
		}
		if(!empty($sClass))
		{
			if($andCounter!=0)
				$sql.= " AND ".$sClass." ";
			else
			{
				$andCounter =1;
				$sql.= $sClass." ";
			}
		}
		if(!empty($sDivision))
		{
			if($andCounter!=0)
				$sql.= " AND ".$sDivision." ";
			else
			{
				$andCounter =1;
				$sql.= $sDivision." ";
			}
		}



	//echo $sql;

$result = $db->query($sql);
$i=0;
	echo "<div style=\"width:100%; text-align:center; padding-top:10px; padding-bottom:10px; background-color:#eee;\">Student's Count: ".$db->affected_rows."</div>";
echo '<table class="data-table">
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
	if($rows['status']==1)
			$statusValue = "<span style='color:green'>Active</span>";
	elseif($rows['status']==0)
		$statusValue = "<span style='color:blue'>InActive</span>";
	elseif($rows['status']==3)
		$statusValue = "<span style='color:red'>Fee Unpaid</span>";
    elseif($rows['status']==4)
		$statusValue = "<span style='color:orange'>School Promotion</span>";
	elseif($rows['status']==5)
		$statusValue = "<span style='color:#ff0096'>TC Given</span>";
echo "
    <tr class=\"";  echo ($i % 2 == 0) ?" odd\">" : "even\">";
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