<?php
session_start();
require_once("securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(0);



if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
    $sql = null;
    $_academicYear = $_POST['academicYear'];
    if (isset($_POST['schoolId'])) {
        $classSql = "Select class_id, class_name FROM " . TABLE_CLASS . " WHERE status = '0'";
        $classRows = $db->query($classSql);
        while ($classRow = $db->fetch_array($classRows)) {
            $className = trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name'])));
            $classId = $classRow['class_id'];
            $feeSql = "Select fee_id, fee_name FROM " . TABLE_FEES . " WHERE status = '0'";
            $feeRows = $db->query($feeSql);

            while ($feeRow = $db->fetch_array($feeRows)) {
                $feeName = trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name'])));
                $feeId = $feeRow['fee_id'];

                if (isset($_POST[$className . "-" . $feeName . "-check"])) {
                    $feeAmount = $_POST[$className . "-" . $feeName];
					$feeSelect = $_POST[$className . "-" . $feeName . "-select"];
                    $sql .= "( 'NULL', '" . $classId . "','" . $feeId . "','" . $feeAmount . "','" . $feeSelect . "','" . $_POST['schoolId'] . "','".$_academicYear."'),";
                }
            }
        }
    }
    $sql = rtrim($sql, ",");
    $dSql = $db->query("Delete  FROM " . TABLE_FEE_MAPPING . " WHERE `schl_id`=" . $_POST['schoolId'] ." AND academic_year = '".$_academicYear."'");
    $newSql = "INSERT INTO " . TABLE_FEE_MAPPING . " (`fee_map_id`, `class_id`, `fee_id`, `fee_amount`,`fee_select`, `schl_id`, `academic_year`) VALUES " . $sql;
    $id = $db->query($newSql);
    if (isset($id) && is_int($id) || $id > 0) {
	    $_SESSION['feeSettingStatus']=1;
       redirect_to('../schoolFeeMapping.php?id=' . $_POST['schoolId']);
    } else {
	    $_SESSION['feeSettingStatus']=2;
       redirect_to('../schoolFeeMapping.php?id=' . $_POST['schoolId']);
    }
}
$db->close();
exit;

?>