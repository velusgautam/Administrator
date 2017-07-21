<?php
require_once("securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set('log_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
    $error = null;


    $_schoolName = $_POST['schoolName'];
    if (empty($_schoolName)) {
        $error .= 'Please check School Name is Missing <br>';
    }
    $_schoolCode = $_POST['schoolCode'];
    if (empty($_schoolCode)) {
        $error .= 'Please check School Code is Missing <br>';
    }
    $_schoolAddress = $_POST['schoolAddress'];
    if (empty($_schoolAddress)) {
        $error .= 'Please check  School Address is Missing <br>';
    }


    if (!isset($error)) {
        $data['school_name'] = $db->escape($_schoolName);
        $data['school_code'] = $db->escape($_schoolCode);
        $data['school_address'] = $db->escape($_schoolAddress);
        $data['published'] = $db->escape("1");


//        if($_userId > 0)
//          $id = $db->query_update(TABLE_REGISTRATION_BASIC, $data,"Id=$_userId");
//        else
        $id = $db->query_insert(TABLE_SCHOOL, $data);
//

        if (isset($id) && is_int($id) || $id > 0) {

            $result = "<div class=\"alert alert-success alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!</h4>
  				<table border=\"0\" width=\"100%\" >
  				<tr><td width=\"100%\"><br>School  Registration Successfull!!!</td></tr>";
//            if($id != 1)
//            {
//                $result .= "<tr><td width=\"100%\" align=\"right\"><div class=\"btn-group\"  ><a href=\"bus-student_payment.php?id=".base64_encode($id*10101)."\" class=\"btn btn-warning  tip\" title=\"Click to Collect Payment\">Payment</a></div></td></tr>";
//            }
            $result .= "</table></div>";
            echo $result;

        } else {
            echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information!!!</h4>
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

