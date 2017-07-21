<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error = null;
		$_tc_number = $_POST['tc_number'];
		if (empty($_tc_number)) {
			$error .= 'Please check TC Number is Missing <br>';
		}
        $_studId = $_POST['studentId'];
		$_school = $_POST['school_name'];
		if (empty($_school)) {
			$error .= 'Please check School Name is Missing <br>';
		}
		$_hs_language = $_POST['hs_language'];
		if (empty($_hs_language)) {
			$error .= 'Please check Language Name is Missing <br>';
		}
		$_hs_electives	 = $_POST['hs_electives'];
		if (empty($_hs_electives)) {
			$error .= 'Please check Elective Name is Missing <br>';
		}
		$_admin_no = $_POST['admin_no'];
		if (empty($_admin_no)) {
			$error .= 'Please check Admission Number is Missing <br>';
		}
        $_medium_of_instruction = $_POST['medium_of_instruction'];
		if (empty($_medium_of_instruction)) {
			$error .= 'Please check Medium of Instruction is Missing <br>';
		}
        $_cumilative_recordno = $_POST['cumilative_recordno'];
		if (empty($_cumilative_recordno)) {
			$error .= 'Please check Cumulative Record Number is Missing <br>';
		}
        $_dateofadmission = $_POST['doa'];
		if (empty($_dateofadmission)) {
			$error .= 'Please check Date of Admission is Missing <br>';
		}
        $_student_name = $_POST['student_name'];
		if (empty($_student_name)) {
			$error .= 'Please check Student Name is Missing <br>';
		}
        $_fee_dues = $_POST['fee_dues'];
		if (empty($_fee_dues)) {
			$error .= 'Please check Fees Dues Column is Missing <br>';
		}
         $_gender = $_POST['gender'];
		if (empty($_gender)) {
			$error .= 'Please check Gender is Missing <br>';
		}
         $_fee_concessions	 = $_POST['fee_concessions'];
		if (empty($_fee_concessions)) {
			$error .= 'Please check Fees Concessions is Missing <br>';
		}
         $_nationality	 = $_POST['nationality'];
		if (empty($_nationality)) {
			$error .= 'Please check Nationality is Missing <br>';
		}
         $_scholarship	 = $_POST['scholarship'];
		if (empty($_scholarship)) {
			$error .= 'Please check Scholarship is Missing <br>';
		}
         $_religion	 = $_POST['religion'];
		if (empty($_religion)) {
			$error .= 'Please check Religion is Missing <br>';
		}
         $_medicalExamined = $_POST['medicalExamined'];
		if (empty($_medicalExamined)) {
			$error .= 'Please check Medically Examined is Missing <br>';
		}
         $_caste = $_POST['caste'];
		if (empty($_caste)) {
			$error .= 'Please check Caste is Missing <br>';
		}
         $_date_last_attendence = $_POST['date_last_attendence'];
		if (empty($_date_last_attendence)) {
			$error .= 'Please check Last Date of Attendence is Missing <br>';
		}
         $_father_name = $_POST['father_name'];
		if (empty($_father_name)) {
			$error .= 'Please check Father Name is Missing <br>';
		}
         $_tcapplication_date = $_POST['tcapplication_date'];
		if (empty($_tcapplication_date)) {
			$error .= 'Please check TC Application Date is Missing <br>';
		}
         $_mother_name = $_POST['mother_name'];
		if (empty($_mother_name)) {
			$error .= 'Please check Mother Name is Missing <br>';
		}
         $_dot = $_POST['dot'];
		if (empty($_mother_name)) {
			$error .= 'Please check Date of Tramsfer is Missing <br>';
		}
         $_whethersct = $_POST['whethersct'];
		if (empty($_whethersct)) {
			$error .= 'Please check SC/ST selection is Missing <br>';
		}
         $_no_schooldays = $_POST['no_schooldays'];
		if (empty($_no_schooldays)) {
			$error .= 'Please check No: of School Days is Missing <br>';
		}
         $_whetherqualified = $_POST['whetherqualified'];
		if (empty($_whetherqualified)) {
			$error .= 'Please check Qualification Criteria is Missing <br>';
		}
         $_no_schooldays_attended = $_POST['no_schooldays_attended'];
		if (empty($_no_schooldays_attended)) {
			$error .= 'Please check No: of School Days Attended is Missing <br>';
		}
        $_dob = $_POST['dob'];
		if (empty($_dob)) {
			$error .= 'Please check Date of Birth is Missing <br>';
		}
        $_conduct = $_POST['conduct'];
		if (empty($_conduct)) {
			$error .= 'Please check Conduct is Missing <br>';
		}
        $_place = $_POST['place'];
		if (empty($_place)) {
			$error .= 'Please check Place is Missing <br>';
		}
         $_taluk = $_POST['taluk'];
		if (empty($_taluk)) {
			$error .= 'Please check Taluk is Missing <br>';
		}
         $_district = $_POST['district'];
		if (empty($_district)) {
			$error .= 'Please check District is Missing <br>';
		}
         $_standard_leaving = $_POST['standard_leaving'];
		if (empty($_standard_leaving)) {
			$error .= 'Please check Standard Leaving is Missing <br>';
		}
        
       	if (!isset($error))
		{
            
            
			$data['date'] = $db->escape(date("Y-m-d"));
			$data['tc_number'] = trim($db->escape($_tc_number));
			$data['student_id'] = trim($db->escape($_studId));
			$data['school_name'] = $db->escape($_school);
            $data['admin_no'] = $db->escape($_admin_no);
            $data['cumilative_recordno'] = $db->escape($_cumilative_recordno);
            $data['student_name'] = $db->escape($_student_name);
            $data['gender'] = $db->escape($_gender);
            $data['nationality'] = $db->escape($_nationality);
            $data['religion'] = $db->escape($_religion);
            $data['caste'] = $db->escape($_caste);
            $data['father_name'] = $db->escape($_father_name);
            $data['mother_name'] = $db->escape($_mother_name);
            $data['whethersct'] = $db->escape($_whethersct);
            $data['whether_qualified'] = $db->escape($_whetherqualified);
            $data['dob'] = $db->escape(date("Y-m-d", strtotime($_dob)));
            $data['place'] = $db->escape($_place);
			$data['taluk'] = $db->escape($_taluk);
			$data['district'] = $db->escape($_district);
			$data['standard_leaving'] = $db->escape($_standard_leaving);            
			$data['hs_language'] = $db->escape($_hs_language);
			$data['hs_electives'] = $db->escape($_hs_electives);			
            $data['medium_of_instruction'] = $db->escape($_medium_of_instruction);
			$data['dot'] = $db->escape(date("Y-m-d",strtotime($_dot)));			
			$data['fee_dues'] = $db->escape($_fee_dues);
			$data['fee_concessions'] = $db->escape($_fee_concessions);
			$data['scholarship'] = $db->escape($_scholarship);
			$data['medicalExamined'] = $db->escape($_medicalExamined);
			$data['date_last_attendance'] = $db->escape(date("Y-m-d",strtotime($_date_last_attendence)));
			$data['tcapplication_date'] = $db->escape(date("Y-m-d",strtotime($_tcapplication_date)));
			$data['no_schooldays'] = $db->escape($_no_schooldays);			
			$data['no_schooldays_attended'] = $db->escape($_no_schooldays_attended);			
			$data['conduct'] = $db->escape($_conduct);
			

		$id = $db->query_insert(TABLE_SCHOOL_TC, $data);

			if(intval($id)>0)
			{

				$studData['status']=5;
				$studId = $db->query_update(TABLE_STUDENT,$studData," student_id='".$data['student_id']."'");

                 $result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				";

                $result .= "<tr><td width=\"85%\"><br>TC SAVED SuccessFully!!!</td>


                </tr>";
                $result .= "<tr><td width=\"85%\"><br><strong>Redirecting to TC Print.</strong></td></tr>";

            $result .= "</table></div>

            ";
            echo $result;
                
                echo '<script type="text/javascript">';
	        echo 'setTimeout(function () {
                window.location.href= \'printTc.php?id='.$id.'\';
			},2000);';
	        echo '</script>';
				//redirect_to("../printTc.php?studid=".trim($db->escape($_studId))."&id=".$id);
			}
			else
			{
				echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\"> Information!!!</h4>
			<h5> " . "Some Server Side Error</h5><br>Please try again with filling every field correctly</div>";

			}
		}
        else
        {
	        echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $error . "</div><br>Please try again with filling every field correctly</div>";
        }
	}
	else
	{
		 echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $error . "</div><br>Please try again with filling every field correctly</div>";
	}
?>