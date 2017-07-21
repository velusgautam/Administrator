<?php
require_once("developmentSecurityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ALL);
ini_set('display_errors', 'ON');
$error = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = null;
    $schlId = $_POST['schlId'];
    if (empty($schlId) || intval(trim($schlId)) == 0)
        $error .= 'School Code is Missing Please Try Again. <br>';
    $classId = $_POST['classId'];
    if (empty($classId) || intval(trim($classId)) == 0)
        $error .= 'Class Code is Missing Please Try Again. <br>';
    $studentId = $_POST['studentId'];
    if (empty($studentId) || intval(trim($studentId)) == 0)
        $error .= 'Student Code is Missing Please Try Again. <br>';
    $studentName = $_POST['studentName'];
    $academicYear = $_POST['academicYear'];
    $date = $_POST['date'];
    if (empty($date))
        $error .= 'Date is Missing Please Try Again. <br>';
    $date = date("Y-m-d", strtotime($_POST['date']));
    $paymentType = $_POST['paymentType'];
    if (strtolower(trim($paymentType)) == "cheque") {
        $chequeNumber = $_POST['chequeNumber'];
        $chequeDate = date("Y-m-d", strtotime($_POST['chequeDate']));
        $chequeBank = $_POST['chequeBank'];
    }
    if ($_POST['payment'] == "part") {
        $payment = 1;
        $paymentNow = intval(trim($_POST['paymentNow']));
        $developmentFees = intval(trim($_POST['developmentFees']));
        $balance = $developmentFees - $paymentNow;
        $waiveOff = intval(trim($_POST['waiveOff']));
        $addOn = intval(trim($_POST['addOn']));
        $balance = $balance - $waiveOff;
        $total = $paymentNow;
        if ($total == 0 || $total < 0)
            $error .= 'Some Error in Total  Try Again. <br>';
    } else {
        $payment = 0;
        $developmentFees = intval(trim($_POST['developmentFees']));
        if (intval($developmentFees) == 0)
            $error .= 'Some Error in Development Fees Try Again. <br>';
        $waiveOff = intval(trim($_POST['waiveOff']));
        $addOn = intval(trim($_POST['addOn']));
        $total = $developmentFees + $addOn - $waiveOff;
        $total = intval($total);
        $paymentNow = $total;
        $balance = 0;
        if ($total == 0 || $total < 0)
            $error .= 'Some Error in Total  Try Again. <br>';
    }
    if (!isset($error)) {

        $data['student_id'] = $db->escape($studentId);
        $data['student_name'] = $db->escape($studentName);
        $data['academic_year'] = $db->escape($academicYear);
        $data['date'] = $db->escape($date);
        if (trim($_POST['payment']) != "part") {
            $data['payment_type'] = $db->escape($paymentType);
            if (isset($chequeNumber))
                $data['cheque_no'] = $db->escape($chequeNumber);
            if (isset($chequeDate))
                $data['cheque_date'] = $db->escape($chequeDate);
            if (isset($chequeBank))
                $data['cheque_bank'] = $db->escape($chequeBank);
        }
        $data['development_fees'] = $db->escape($developmentFees);
        $data['waive_off'] = $db->escape($waiveOff);
        $data['add_on'] = $db->escape($addOn);
        $data['total'] = $db->escape($total);
        $data['payment_status'] = $db->escape($payment);

        $id = $db->query_insert(TABLE_STUDENT_DEVELOPMENT_FEE, $data);

        if (intval($id) > 0) {
            if ($payment == 1) {
                $dataPayment['student_id'] = $db->escape($studentId);
                $dataPayment['part_date'] = $db->escape($date);
                $dataPayment['development_fee_id'] = $db->escape($id);
                $dataPayment['payment_now'] = $db->escape($paymentNow);
                $dataPayment['balance'] = $db->escape($balance);
                $dataPayment['development_fee'] = $db->escape($developmentFees);
                $dataPayment['academic_year'] = $db->escape($academicYear);
                $dataPayment['waive_off'] = $db->escape($waiveOff);
                $dataPayment['payment_type'] = $db->escape($paymentType);
                if (isset($chequeNumber))
                    $dataPayment['cheque_no'] = $db->escape($chequeNumber);
                if (isset($chequeDate))
                    $dataPayment['cheque_date'] = $db->escape($chequeDate);
                if (isset($chequeBank))
                    $dataPayment['cheque_bank'] = $db->escape($chequeBank);
                $new_id = $db->query_insert(TABLE_STUDENT_DEVELOPMENT_FEE_PART, $dataPayment);
                redirect_to("../developmentFeesReceipt.php?id=" . $id . "&partId=" . $new_id);
            } else {

//                $studData['development_status'] = 0;
               // $studId = $db->query_update(TABLE_STUDENT, $studData, '`student_id`=' . $db->escape($studentId));
                redirect_to("../developmentFeesReceipt.php?id=" . $id);
            }
        }
    } else {
        $_SESSION['developmentFeeReceiptError'] = $error;
        redirect_to("../developmentFeePayment.php?id=" . $_POST['studentId']);
    }
} else {
    $_SESSION['developmentFeeReceiptError'] = $error;
    redirect_to("../developmentFeePayment.php?id=" . $_POST['studentId']);
}
$db->close();
exit;
?>
