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
    $error = null;

    $_staffName = $_POST['staffName'];
    if (empty($_staffName)) {
        $error .= 'Please check Staff Name is Missing <br>';
    }
    $_staffUserName = $_POST['staffUserName'];
    if (empty($_staffUserName)) {
        $error .= 'Please check Staff User Name is Missing <br>';
    }
    $_staffPassword = md5($_POST['staffPassword']);
    if (empty($_staffPassword)) {
        $error .= 'Please check Staff Password is Missing <br>';
    }
    $_date = $_POST['date'];
    if (empty($_date)) {
        $error .= 'Please check Date of Registration Missing <br>';
    }

    $_roleId = $_POST['roleId'];
    $_role = explode("~", $_roleId);
    if (empty($_roleId)) {
        $error .= 'Please check Role is Missing <br>';
    }
    $_school = $_POST['school'];
    if (empty($_school)) {
        $error .= 'Please check School is Missing <br>';
    }
    $_phoneNumber = $_POST['phoneNumber'];
    if (empty($_phoneNumber)) {
        $error .= 'Please check Phone Number is Missing <br>';
    }


    if (!isset($error)) {

        $data['name'] = strtoupper(trim($db->escape($_staffName)));
        $data['username'] = $db->escape($_staffUserName);
        $data['password'] = $db->escape($_staffPassword);
        $newDate = date("Y-m-d", strtotime($_date));
        $data['date'] = $db->escape($newDate);
        $data['role_name'] = $db->escape($_role[1]);
        $data['role_id'] = $db->escape($_role[0]);
        $data['schl_id'] = $db->escape($_school);
        $data['phone_number'] = $db->escape(trim("91" . $_phoneNumber));


//        if($_userId > 0)
//          $id = $db->query_update(TABLE_REGISTRATION_BASIC, $data,"Id=$_userId");
//        else
        $id = $db->query_insert(TABLE_USER, $data);
//

        if (isset($id) && is_int($id) || $id > 0) {

            $result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<table border=\"0\" width=\"100%\" >
  				<tr><td width=\"100%\"><br>Staff Registered SuccessFully!!!</td></tr>";
//            if($id != 1)
//            {
//                $result .= "<tr><td width=\"100%\" align=\"right\"><div class=\"btn-group\"  ><a href=\"bus-student_payment.php?id=".base64_encode($id*10101)."\" class=\"btn btn-warning  tip\" title=\"Click to Collect Payment\">Payment</a></div></td></tr>";
//            }
            $result .= "</table></div>";
            echo $result;

        } else {
            echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\" Information!!!</h4>
			<h5> " . "Some Server Side Error</h5> Please try again with filling every field correctly</div>";
        }
    } else {
        echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			" . $error . "Please try again with filling every field correctly</div>";
    }
    $db->close();
    exit;
}
?>
