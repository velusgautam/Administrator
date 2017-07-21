<?php
require_once("securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
    $error;
    $_schoolCode = $_POST['schoolCode'];
	if (empty($_schoolCode))
		$error .= 'Please check School Code is Missing <br>';
    $_admissionNo = $_POST['admissionNo'];
	if (empty($_admissionNo))
		$error .= 'Please check Admission Number is Missing <br>';
    $_admissionDate = $_POST['date'];
	if (empty($_admissionDate))
		$error .= 'Please check Admission Date is Missing <br>';
    $_admissionDate = date("Y-m-d", strtotime($_admissionDate));
    $_academicYear = $_POST['academicYear'];
	if (empty($_academicYear))
		$error .= 'Please check Academic Year is Missing <br>';
    $_name = $_POST['name'];
	if (empty($_name))
		$error .= 'Please check Student Name is Missing <br>';
    $_nationality = $_POST['nationality'];
    $_gender = $_POST['gender'];
	if (empty($_gender))
		$error .= 'Please check Gender is Missing <br>';
    $_dob = $_POST['dateOfBirth'];
    $_dob = date("Y-m-d", strtotime($_dob));
	if (empty($_dob))
		$error .= 'Please check Date of Birth is Missing <br>';
    $_placeOfBirth = $_POST['placeOfBirth'];
    $_religion = $_POST['religion'];
    $_casteSubCaste = $_POST['casteSubCaste'];
    $_motherTongue = $_POST['motherTongue'];
    $_whetherSCT = $_POST['whetherSCT'];
    $_place = $_POST['place'];
    $_taluk = $_POST['taluk'];
    $_district = $_POST['district'];
    $_fathersName = $_POST['fathersName'];
	if (empty($_fathersName))
		$error .= 'Please check Father\'s Name is Missing <br>';
    $_fatherQualification = $_POST['fatherQualification'];
    $_fatherOccupation = $_POST['fatherOccupation'];
    $_fatherPhone = "91" .$_POST['fatherPhone'];
	if (empty($_POST['fatherPhone']) && empty($_POST['motherPhone']) )
		$error .= 'Please check Father\'s Phone Numeber or Mothers Phonenumber is Missing <br>';
    $_fatherEmail = $_POST['fatherEmail'];
    $_motherName = $_POST['motherName'];
	if (empty($_motherName))
		$error .= 'Please check Mother\'s Name is Missing <br>';
    $_motherQualification = $_POST['motherQualification'];
    $_motherOccupation = $_POST['motherOccupation'];
    $_motherPhone = "91" .$_POST['motherPhone'];
    $_motherEmail = $_POST['motherEmail'];
    $_noOfBrothers = $_POST['noOfBrothers'];
    $_noOfSisters = $_POST['noOfSisters'];
    $_standardLeaving = $_POST['standardLeaving'];
    $_previousSchool = $_POST['previousSchool'];
    $_tcDate = $_POST['tcDate'];
    $_parentAnnualIncom = $_POST['parentAnnualIncom'];
    $_permanentAddress = $_POST['permanentAddress'];
    $_resiNo = $_POST['resiNo'];
    $_officeNo = $_POST['officeNo'];


	// Transfer or New Join Status Codes
	if (isset($_POST['transfer']) && !isset($_POST['fresh'])) {
		if (isset($_POST['transfer-tc']))
			$_transferTc = $_POST['transfer-tc'];
		if (isset($_POST['transfer-mc']))
			$_transferMc = $_POST['transfer-mc'];
		if (isset($_POST['transfer-cc']))
			$_transferCc = $_POST['transfer-cc'];

		$_freshBc = 0;
		$_freshCc = 0;
	}

	if (isset($_POST['fresh']) && !isset($_POST['transfer'])) {
		if (isset($_POST['fresh-bc']))
			$_freshBc = $_POST['fresh-bc'];
		if (isset($_POST['fresh-cc']))
			$_freshCc = $_POST['fresh-cc'];

		$_transferTc =0;
		$_transferMc =0;
		$_transferCc =0;
	}

    if (!isset($error)) {

        $data['admin_no'] = $db->escape($_admissionNo);
        $data['school_code'] = $db->escape($_schoolCode);
        $data['admission_date'] = $db->escape($_admissionDate);
        $data['academic_year'] = $db->escape($_academicYear);
        $data['name'] = $db->escape($_name);
        $data['nationality'] = $db->escape($_nationality);
        $data['gender'] = $db->escape($_gender);
        $data['dob'] = $db->escape($_dob);
        $data['placeofbirth'] = $db->escape($_placeOfBirth);
        $data['religion'] = $db->escape($_religion);
        $data['caste'] = $db->escape($_casteSubCaste);
        $data['mothertongue'] = $db->escape($_motherTongue);
        $data['whethersct'] = $db->escape($_whetherSCT);
        $data['place'] = $db->escape($_place);
        $data['taluk'] = $db->escape($_taluk);
        $data['district'] = $db->escape($_district);
        $data['father_name'] = $db->escape($_fathersName);
        $data['father_qualification'] = $db->escape($_fatherQualification);
        $data['father_occupation'] = $db->escape($_fatherOccupation);
        $data['father_email'] = $db->escape($_fatherEmail);
        $data['father_phone'] = $db->escape($_fatherPhone);
        $data['mother_name'] = $db->escape($_motherName);
        $data['mother_qualification'] = $db->escape($_motherQualification);
        $data['mother_occupation'] = $db->escape($_motherOccupation);
        $data['mother_email'] = $db->escape($_motherEmail);
        $data['mother_phone'] = $db->escape($_motherPhone);
        $data['noofbro'] = $db->escape($_noOfBrothers);
        $data['noofsis'] = $db->escape($_noOfSisters);
        $data['standard_leaving'] = $db->escape($_standardLeaving);
        $data['prev_school'] = $db->escape($_previousSchool);
        $data['tcdate'] = $db->escape($_tcDate);
        $data['annual_income'] = $db->escape($_parentAnnualIncom);
        $data['permanent_address'] = $db->escape($_permanentAddress);
        $data['resi_no'] = $db->escape($_resiNo);
        $data['office_no'] = $db->escape($_officeNo);
	    if (isset($_POST['transfer']) && !isset($_POST['fresh'])) {
		    $_transferTc = $_POST['transfer-tc'];
		    $data['transfer_tc'] = $db->escape($_transferTc);
		    $_transferMc = $_POST['transfer-mc'];
		    $data['transfer_mc'] = $db->escape($_transferMc);
		    $_transferCc = $_POST['transfer-cc'];
		    $data['transfer_cc'] = $db->escape($_transferCc);
		    $data['fresh_bc'] = $db->escape($_freshBc);
		    $data['fresh_cc'] = $db->escape($_freshCc);
	    }
	    if (isset($_POST['fresh']) && !isset($_POST['transfer'])) {
		    $_freshBc = $_POST['fresh-bc'];
		    $data['fresh_bc'] = $db->escape($_freshBc);
		    $_freshCc = $_POST['fresh-cc'];
		    $data['fresh_cc'] = $db->escape($_freshCc);
		    $data['transfer_tc'] = $db->escape($_transferTc);
		    $data['transfer_mc'] = $db->escape($_transferMc);
		    $data['transfer_cc'] = $db->escape($_transferCc);
	    }
        $data['reg_status'] = "0";


        if (!empty($_POST['updateId']) && $_POST['updateId'] > 0)
            $id = $db->query_update(TABLE_ADMISSION_FORM, $data, "id=" . trim($_POST['updateId']));
        else
            $id = $db->query_insert(TABLE_ADMISSION_FORM, $data);

        if (isset($id) && is_int($id) || $id > 0) {

            $result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				";
            if (!empty($_POST['updateId']) && $_POST['updateId'] > 0) {
                $result .= "<tr><td width=\"100%\"><br>Application Form  Updated SuccessFully!!!</td></tr>";
            } else {
                $result .= "<tr><td width=\"100%\"><br>Application Form Registered SuccessFully!!!</td></tr>";
            }
            $result .= "</table></div>";
            echo $result;

        } else {
            echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\"> Information!!!</h4>
			<h5> " . "Some Server Side Error</h5><br>Please try again with filling every field correctly</div>";
        }
    } else {
        echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $error . "</div><br>Please try again with filling every field correctly</div>";
    }
    $db->close();
    exit;
}
?>