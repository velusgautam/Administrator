<?php
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
define("_VALID_PHP", true);
include('../dbcon/dbConfig.php');
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$_id = $_POST['id'];
$_academicYear = $_POST['academic_year'];

?>

<div class="span12 ">
    <?php
    $i = 0;
    $classSql = "Select TC.class_id, TC.class_name FROM " . TABLE_CLASS . " as TC  WHERE TC.class_id IN (Select class_id FROM  " . TABLE_CLASS_MAPPING . " as TCM WHERE TCM.`schl_id`=" . $_id . ") AND TC.status = '0'";
    $classRows = $db->query($classSql);
    while ($classRow = $db->fetch_array($classRows)) {
        ?>
        <div
            class="span4 text-center block-seperator <?php echo ($i % 3 == 0) ? "no-left-margin" : "" ?>">
            <h5><?php echo $classRow['class_name']; ?></h5>
            <div>
                <div style="width: 64%; text-align: right; float: left;">New </div>
                <div style="width: 31%; float: left; text-align: right;">ReAdmission</div>
            </div>
            <div class="span12">
                <?php
                $feesSql = "Select fee_id, fee_name FROM " . TABLE_FEES_DEVELOPMENT . " WHERE status = '0'";
                $feesRows = $db->query($feesSql);
                while ($feeRow = $db->fetch_array($feesRows)) {
                    $data = $db->query_first("Select fee_amount, fee_re_amount FROM " . TABLE_DEVELOPMENT_FEE_MAPPING . " WHERE `class_id`=" . $classRow['class_id'] . " AND `fee_id`=" . $feeRow['fee_id'] .
                        "
													AND `schl_id`=" . $_id ." AND academic_year = '".$_academicYear."'");

                    ?>
                    <div class="checkbox">
                        <input type="checkbox"
                               id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . "-" . trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))) . "-check"; ?>"
                               class="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))); ?>"
                               name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . "-" . trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))) . "-check"; ?>"
                            <?php echo ((isset($data['fee_amount']) && intval($data['fee_amount'])> 0) || (isset($data['fee_re_amount']) && intval($data['fee_re_amount'])> 0)) ? " checked" : ""; ?>
                            >
                        <label class="control-label no-padding"><?php echo $feeRow['fee_name'] . ":"; ?> </label>

                        <input type="text"
                               id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))); ?>-1"
                               name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . "-" . trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>-1"
                               value="<?php echo (isset($data['fee_amount'])) ? $data['fee_amount'] : "0" ?>" style="width: 60px;margin-left: 120px;">
                        <input type="text"
                               id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))); ?>-2"
                               name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . "-" . trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>-2"
                               value="<?php echo (isset($data['fee_re_amount'])) ? $data['fee_re_amount'] : "0" ?>" style="width: 60px;">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        $i++;
    }
    ?>

</div>