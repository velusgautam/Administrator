<?php
	require_once("developmentSecurityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ALL);
ini_set('display_errors', 'ON');


if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
    $sql = null;
    $academicYear = $_POST['academicYear'];
    if (isset($_POST['schoolId'])) {
	    $classSql = "Select TC.class_id, TC.class_name FROM " . TABLE_CLASS . " as TC  WHERE TC.class_id IN (Select class_id FROM  " . TABLE_CLASS_MAPPING . " as TCM WHERE TCM.`schl_id`=" . $_POST['schoolId'] . ") AND TC.status = '0'";
        $classRows = $db->query($classSql);
        while ($classRow = $db->fetch_array($classRows)) {
            $className = trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name'])));
            $classId = $classRow['class_id'];
            $feeSql = "Select fee_id, fee_name FROM " . TABLE_FEES_DEVELOPMENT . " WHERE status = '0'";
            $feeRows = $db->query($feeSql);

            while ($feeRow = $db->fetch_array($feeRows)) {
                $feeName = trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name'])));
                $feeId = $feeRow['fee_id'];

                if (isset($_POST[$className . "-" . $feeName . "-check"])) {
                    $feeAmount = $_POST[$className . "-" . $feeName."-1"];
                    $feeReAmount = $_POST[$className . "-" . $feeName."-2"];

                    $sql .= "( 'NULL', '" . $classId . "','" . $feeId . "','" . $feeAmount . "','" . $feeReAmount . "','" . $_POST['schoolId'] . "','" . $academicYear . "'),";
                }
            }
        }
    }

    $sql = rtrim($sql, ",");
    $dSql = $db->query("Delete  FROM " . TABLE_DEVELOPMENT_FEE_MAPPING . " WHERE `schl_id`=" . $_POST['schoolId'] ." AND academic_year = '".$academicYear."'");
    $newSql = "INSERT INTO " . TABLE_DEVELOPMENT_FEE_MAPPING . " (`fee_map_id`, `class_id`, `fee_id`, `fee_amount`, `fee_re_amount`, `schl_id`, `academic_year`) VALUES " . $sql;
    $id = $db->query($newSql);
    if (isset($id) && is_int($id) || $id > 0) {
	    $_SESSION['developmentFeeSet'] = 1;
       redirect_to('../developmentFeeMapping.php?id=' . $_POST['schoolId']);
    } else {
	    $_SESSION['developmentFeeSet'] =2;
       redirect_to('../developmentFeeMapping.php?id=' . $_POST['schoolId']);
    }
}
$db->close();
exit;

?>