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
		$error .= 'Please check School Name is Missing <br>';

//    $_applicationNo = $_POST['applicationNo'];
//	if (empty($_applicationNo))
//		$error .= 'Please check Application Number is Missing <br>';
	$_formNo = $_POST['formNo'];
	if (empty($_formNo))
		$error .= 'Please check Application Form Number is Missing <br>';
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

    $_classApplied = $_POST['classApplied'];
	if (empty($_classApplied))
		$error .= 'Please check Class Applied is Missing <br>';
	$_streamApplied = $_POST['streamApplied'];
	if (empty($_streamApplied))
		$error .= 'Please check Stream Applied is Missing <br>';

    $_contactName = $_POST['contactName'];
	if (empty($_contactName))
		$error .= 'Please check Contact Name is Missing <br>';

    $_contactNumber = "91" .$_POST['contactNumber'];
	if (empty($_POST['contactNumber']) )
		$error .= 'Please check Contact Numeber is Missing <br>';
	$_type = $_POST['type'];
		if (empty($_POST['type']) )
		$error .= 'Please check Admission Type is Missing <br>';



    if (!isset($error)) {


        $data['school_code'] = $db->escape($_schoolCode);
        $data['form_no'] = $db->escape($_formNo);
        $data['application_date'] = $db->escape($_admissionDate);
        $data['academic_year'] = $db->escape($_academicYear);
        $data['name'] = $db->escape($_name);
	    $data['contact_name'] = $db->escape($_contactName);
        $data['contact_number'] = $db->escape($_contactNumber);
        $data['class_applied'] = $db->escape($_classApplied);
        $data['stream_applied'] = $db->escape($_streamApplied);
        $data['application_status'] = "0";
        $data['admission_status'] = $db->escape($_type);


//        if (!empty($_POST['updateId']) && $_POST['updateId'] > 0)
//            $id = $db->query_update(TABLE_NEW_APPLICATION, $data, "id=" . trim($_POST['updateId']));
//        else
            $id = $db->query_insert(TABLE_NEW_APPLICATION, $data);


        if (isset($id) && is_int($id) || $id > 0) {


	        $feeSql = "SELECT fee_id, fee_name, amount  FROM " . TABLE_APPLICATION_FEE . " WHERE school_id=" . $_schoolCode;
	        $feeRows = $db->query_first($feeSql);


	        $dataR['count'] = 1;
	        $dataR['form_no'] = $db->escape($_formNo);
	        $dataR['application_no'] = $id;
	        $dataR['application_date'] = $db->escape($_admissionDate);
	        $dataR['amount'] = $db->escape($feeRows['amount']);
	        $dataR['school_code'] = $db->escape($_schoolCode);
	        $dataR['name'] = $db->escape($_name);
	        $dataR['entered_by'] = $db->escape($_SESSION['Name']);
	        $dataR['class_applied'] = $db->escape($_classApplied);


		        $rid = $db->query_insert(TABLE_APPLICATION_RECEIPT, $dataR);


            $result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				";

	        $result .= "<tr><td width=\"85%\"><br>Application Form Registered SuccessFully!!!</td>

                <td><a href='applicationReceipt.php?id=$id' class='btn-large btn-danger'><i class='icon-white icon-dollar'></i>Fee Payment</a> </td>
                </tr>";
	        $result .= "<tr><td width=\"85%\"><br><strong>Redirecting to Application Receipt.</strong></td></tr>";

	        $result .= "</table></div>

            ";
	        echo $result;
	        echo '<script type="text/javascript">';
	        echo 'setTimeout(function () {
                window.location.href= \'applicationReceipt.php?id='.$id.'\'; // the redirect goes here
			},2000);';
	        echo '</script>';

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