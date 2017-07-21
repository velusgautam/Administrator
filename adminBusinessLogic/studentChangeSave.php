<?php
require_once("securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
    $error = null;
    if ($_SESSION['Role'] === "1") {
        $_school = $_POST['cschool'];
    } else {
        $_school = $_SESSION['SchoolCode'];
    }

    $_stream = $_POST['stream'];
    $_class = $_POST['classSelect'];
    $_division = $_POST['division'];
    $_status = $_POST['status'];
    $_academicYear = $_POST['academicYear'];

    $date = date("Y-m-d");
    if (empty($_stream)) {
        $error .= 'Please check Stream is Missing <br>';
    }

    if (empty($_school)) {
        $error .= 'Please check School is Missing <br>';
    }

    if (empty($_class)) {
        $error .= 'Please check Class is Missing <br>';
    }

    if (empty($_division)) {
        $error .= 'Please check Division is Missing <br>';
    }

    if (empty($_status)) {
        $error .= 'Please check Status is Missing <br>';
    }

    if (empty($_academicYear)) {
        $error .= 'Please check Academic Year is Missing <br>';
    }

    $checkbox = $_POST['checkbox'];

    if (empty($checkbox)) {
        $error .= 'No Students are Selected <br>';
    }

    $id = "('" . implode("','", $checkbox) . "');";


    if (!isset($error) && is_numeric(trim($_school)) && is_numeric(trim($_stream)) && is_numeric(trim($_class)) && is_numeric(trim($_division)) && is_numeric(trim($_status))) {
        $appendQuery = null;
        if(intval($_status)==3)
        {
//            $developmentStatus = 1;
            $admissionStatus = 2;
            $appendQuery = ",  `admission_status`= '". trim($admissionStatus) ."'";
        }
        if(intval($_status)==4)
        {

            $admissionStatus = 1;
            $appendQuery = ",  `admission_status`= '". trim($admissionStatus) ."'";
        }
        
        $sql = "UPDATE " . TABLE_STUDENT . " SET `schl_id`='" . trim($_school) . "', `promoted_by`='" . trim($_SESSION['Name']) . "', `date`='" . trim($date) . "', `stream_id`='" . trim($_stream) . "', `class_id`='" . trim($_class) . "', `division_id`='" . trim($_division) . "', `status`='" . trim($_status) . "',
        `academic_year`='" . trim($_academicYear) . "' ".$appendQuery." WHERE student_id IN $id";
        //echo $sql;
        $id = $db->query($sql);

        if (isset($id) && is_int($id) || $id > 0) {
            redirect_to("../studentPromotion.php?status=1");
        } else {
            redirect_to("../studentPromotion.php?status=2");
        }
    } else {
        redirect_to("../studentPromotion.php?status=3");
    }

}
?>