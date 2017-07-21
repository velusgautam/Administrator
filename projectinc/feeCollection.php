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


$rows = $db->query_first("Select st.schl_id, st.student_id, st.student_name, st.academic_year, st.stream_id, tc.class_name, tc.class_id,  td.division_name, ts.school_name, st.application_no
            FROM " . TABLE_STUDENT . " as st
            INNER JOIN " . TABLE_CLASS . " tc on tc.class_id = st.class_id
            INNER JOIN " . TABLE_DIVISION . " td on td.division_id = st.division_id
            INNER JOIN " . TABLE_SCHOOL . " ts on ts.schl_id = st.schl_id
            Where st.`student_id`=" . $_id ." ");
$stream = ($rows['stream_id'] == 2) ? "ICSE" : "STATE";


?>

<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
      action="adminBusinessLogic/feePaymentSave.php">
    <?php
    echo "<input type='hidden' value='" . intval(trim($rows['schl_id'])) . "' name='schlId'>" . PHP_EOL;
    echo "<input type='hidden' value='" . intval(trim($rows['class_id'])) . "' name='classId'>" . PHP_EOL;
    echo "<input type='hidden' value='" . $rows['student_id'] . "' name='studentId'>" . PHP_EOL . PHP_EOL;
    echo "<input type='hidden' value='" . $rows['student_name'] . "' name='studentName'>" . PHP_EOL . PHP_EOL;
    echo "<input type='hidden' value='" . $_academicYear . "' name='academicYear'>" . PHP_EOL . PHP_EOL;
    ?>

    <div class="control-group">
        <div class="span3"><label
                class="control-label">Name: <?php echo $rows['student_name']; ?></label></div>
        <div class="span3"><label class="control-label">Current Academic
                Year: <?php echo $rows['academic_year']; ?></label></div>
        <div class="span2"><label class="control-label">Stream: <?php echo $stream; ?></label></div>
        <div class="span2"><label
                class="control-label">Class: <?php echo $rows['class_name']; ?></label></div>
        <div class="span2"><label
                class="control-label">Division: <?php echo $rows['division_name']; ?></label></div>
    </div>
    <div class="control-group">
        <div class="span4">
            <label class="control-label">Date:</label>

            <div class="controls">
                <input class="datepicker" type="text" tabindex="3" id="date"
                       value="<?php echo date("d-m-Y"); ?>" name="date"/>

            </div>


        </div>
        <div class="span6">
            <div class="span3">
                <label class="control-label" style="padding-left: 15px">Type of Payment: </label>
            </div>
            <div class="span9">

                <label style="float: left"><input type="radio" name="paymentType" id="cash" value="Cash" tabindex="3" checked/> <span style="padding-right: 40px; ">Cash</span></label>
                <label style="float: left">
                    <input type="radio" name="paymentType" id="cheque" tabindex="4" value="Cheque"/> Cheque <br>

                </label>
                <nobr>
                    <input type="text" class="span4" name="chequeNumber" id="cN" placeholder="Cheque Number" disabled="disabled" tabindex="5" autocomplete="off"/>
                    <input type="text" id="cD" class="span4 datepicker" name="chequeDate" data-date-format="dd-mm-yyyy" placeholder="Cheque Date" disabled="disabled" tabindex="6" autocomplete="off"/>
                    <input type="text" id="cB" class="span4" name="chequeBank" placeholder="Cheque Bank" disabled="disabled" tabindex="7"/></nobr>

            </div>
        </div>

    </div>
    <?php

    $_feepaidStatus = "Select fee_name, months, fee_type FROM " . TABLE_STUDENT_FEE_SECONDARY . " where primary_id IN(Select id FROM " . TABLE_STUDENT_FEE_PRIMARY . " where student_id=" . $rows['student_id'] . " AND academic_year='"
        . $_academicYear . "')";
    $_feePaidDetails = $db->fetch_all_array($_feepaidStatus);
    $feeData[] = null;
    foreach ($_feePaidDetails as $value) {
        if ($value['fee_type'] == "M") {


            $months[trim(strtolower(preg_replace('/\s+/', '', $value['fee_name'])))] .= ",".$value['months'];

        }
        if ($value['fee_type'] == "Y") {
            $_tempfeeName=trim(strtolower(preg_replace('/\s+/', '', $value['fee_name'])));

            array_push($feeData, $_tempfeeName);

        }
    }



    $i = 0;
    $_count = 0;
    $_feeSql = "SELECT TS.`fee_name`, TFM.`fee_amount` , TFM.`fee_select`  FROM " . TABLE_FEES . " as TS  INNER JOIN " . TABLE_FEE_MAPPING . " as TFM ON TFM.fee_id = TS.fee_id
                            WHERE TFM.`class_id`= " . $rows['class_id'] . " AND TFM.`schl_id` = " . $rows['schl_id'] . " AND TFM.academic_year = '".$_academicYear."'";

    $feeRows = $db->query($_feeSql);
    if($db->affected_rows == 0){

        echo '<script type="text/javascript" id="middleScripts">
                alert("Please Configure School Fee Settings for this school for Academic Year : '.$_academicYear.'");
            </script>';
    }

    while ($feeRow = $db->fetch_array($feeRows)) {


        $_tname = trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name'])));
        if(($feeRow['fee_select'] == "M" && count(array_filter(explode(",", $months[$_tname]))) < 12) ||($feeRow['fee_select'] == "Y" && !in_array($_tname, $feeData))||($feeRow['fee_select'] == "E") ){
            $i++;
            $_count = ($feeRow['fee_select'] == "M") ? $_count + 1 : $_count;
            $count = $count + 1;
            ?>
            <div class="control-group">
                <div class="span4">

                    <?php if ($feeRow['fee_select'] == "Y") { ?>
                        <div class="span6">

                            <label class="control-label" style="font-size: 13px">
                                <input type="checkbox" value="1" id="checkOff<?php echo $i ?>" name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))) . "_checkOff" ?>" tabindex="<?php echo $i + 7 ?>"
                                    >
                                <?php echo $feeRow['fee_name']; ?> for one year is :</label>
                        </div>
                    <?php
                    } elseif ($feeRow['fee_select'] == "M") {
                        ?>
                        <div class="span5">

                            <label class="control-label" style="font-size: 13px">
                                <input type="checkbox" value="1" id="checkOff<?php echo $i ?>" name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))) . "_checkOff" ?>" tabindex="<?php echo $i + 7 ?>">
                                <?php echo $feeRow['fee_name']; ?> for :</label>
                        </div>
                    <?php
                    } elseif ($feeRow['fee_select'] == "E") {
                        ?>
                        <div class="span6">

                            <label class="control-label" style="font-size: 13px">
                                <input type="checkbox" value="1" id="checkOff<?php echo $i ?>" name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))) . "_checkOff" ?>" tabindex="<?php echo $i + 7 ?>"
                                    <?php echo ($feeRow['fee_select'] == "E") ? "checked" : ""; ?>>
                                <?php echo $feeRow['fee_name']; ?> for one year is :</label>
                        </div>
                    <?php } ?>

                    <div class="span6">

                        <?php if ($feeRow['fee_select'] == "M") {
                            ?>
                            <select multiple
                                    name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>monthNames[]"
                                    id="monthId<?php echo $i ?>">

                                <?php if(!in_array("May",explode(",", $months[$_tname]))){?><option value="May">May</option><?php }?>
                                <?php if(!in_array("June",explode(",", $months[$_tname]))){?><option value="June">June</option><?php }?>
                                <?php if(!in_array("July",explode(",", $months[$_tname]))){?><option value="July">July</option><?php }?>
                                <?php if(!in_array("August",explode(",", $months[$_tname]))){?><option value="August">August</option><?php }?>
                                <?php if(!in_array("September",explode(",", $months[$_tname]))){?><option value="September">September</option><?php }?>
                                <?php if(!in_array("October",explode(",", $months[$_tname]))){?><option value="October">October</option><?php }?>
                                <?php if(!in_array("November",explode(",", $months[$_tname]))){?><option value="November">November</option><?php }?>
                                <?php if(!in_array("December",explode(",", $months[$_tname]))){?><option value="December">December</option><?php }?>
                                <?php if(!in_array("January",explode(",", $months[$_tname]))){?><option value="January">January</option><?php }?>
                                <?php if(!in_array("February",explode(",", $months[$_tname]))){?><option value="February">February</option><?php }?>
                                <?php if(!in_array("March",explode(",", $months[$_tname]))){?><option value="March">March</option><?php }?>
                                <?php if(!in_array("April",explode(",", $months[$_tname]))){?><option value="April">April</option><?php }?>
                            </select>


                        <?php } ?>

                        <input type="hidden" id="monthlyAmt<?php echo $i ?>"
                               name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>monthlyAmt"
                               value="<?php echo $feeRow['fee_amount'] ?>">
                    </div>
                </div>
                <div class="span3">
                    <div class="span6 text-right" style="padding-left: 14px"><label class="control-label">Fees
                            Amount:</label></div>
                    <div class="span4 text-left">
                        <input type="text" style="text-align: right; width: 40px" name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>monthFee"
                               id="monthFee<?php echo $i ?>" <?php echo ($feeRow['fee_select'] == "E") ? "value=\"" . $feeRow['fee_amount'] . "\"" : "value=\"0\""; ?>
                               readonly>
                    </div>
                </div>
                <div class="span2">
                    <div class="span5 text-right" style="margin-left: 10px"><label class="control-label">WaiveOff</label></div>
                    <div class="span4 text-left">
                        <input type="text" value="0" style="text-align: right; width: 40px" name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>monthWaive"
                               id="monthWaive<?php echo $i ?>">
                    </div>
                </div>
                <div class="span3">
                    <div class="span5" style="margin-left: 30px"><label class="control-label">Total Amount</label></div>
                    <div class="span4 text-left">
                        <input type="text" value="0" style="text-align: right; width: 40px" name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>monthTotal"
                               id="eachTotal<?php echo $i ?>" readonly>
                    </div>
                </div>

                <?php if ($feeRow['fee_select'] == "M") { ?>
                    <script type="text/javascript" id="middleScripts">

                            $("#monthId<?php echo $i ?>").change(function () {
                                if (document.getElementById('checkOff<?php echo $i ?>').checked) {
                                    selectCalc<?php echo $i ?>();
                                }
                                else {
                                    $('#monthFee<?php echo $i ?>').val(0);
                                    $('#eachTotal<?php echo $i ?>').val(0);
                                    $('#waiveOff<?php echo $i ?>').val(0);
                                    Total();
                                }
                            });

                            $("input[id='checkOff<?php echo $i ?>']").change(function () {
                                if (document.getElementById('checkOff<?php echo $i ?>').checked) {
                                    selectCalc<?php echo $i ?>();
                                }
                                else {
                                    $('#monthFee<?php echo $i ?>').val(0);
                                    $('#eachTotal<?php echo $i ?>').val(0);
                                    $('#waiveOff<?php echo $i ?>').val(0);
                                    Total();
                                }
                            });

                            function selectCalc<?php echo $i ?>() {
                                var total = "";
                                $('select[name^="<?php echo trim(strtolower(preg_replace('/\s+/', '', $feeRow['fee_name']))); ?>monthNames"]').val(function (i, val) {
                                    total = total + " " + val;
                                    return val;
                                });
                                if (total.trim() == 'null')
                                    $('#monthFee<?php echo $i ?>').val(0);
                                else {

                                    var array = total.split(',');
                                    var len = array.length;
                                    var amtTotal = parseInt($('#monthlyAmt<?php echo $i ?>').val()) * parseInt(len);
                                    $('#monthFee<?php echo $i ?>').val(amtTotal);
                                    Total();
                                }
                                Total();
                            }

                            $("#monthWaive<?php echo $i ?>").change(function () {
                                Total()
                            });
                            $('#monthId<?php echo $i ?>').multiselect({selectedText: "# of # Months"});
                            Total();

                            $("#date, #cD").datepicker();
                            var date = new LiveValidation('date', { validMessage: " ", wait: 500 });
                            date.add(Validate.Presence, { failureMessage: "Please Check Date" });

                    </script>
                <?php } ?>
            </div>


        <?php
        }
    }
    ?>
    <div class="control-group">
        <div class="span6">
            <h5>Grand Total</h5>
        </div>
        <div class="span6 text-right" id="total" style="font-weight: bold; font-size: 15px; padding-right: 60px">

        </div>
        <input type="hidden" name="grandTotal" value="0" id="grandTotal">
    </div>
    <div class="form-actions stdFormAction">

        <button type="reset" id="cancel" class="btn" tabindex="9">Cancel</button>
        <input type="submit" id="save" class="btn btn-primary" tabindex="100" value="Save"/>

        <div id='loading'></div>
    </div>
</form>
<script type="text/javascript" id="lastScripts">


        $('#cN').hide();
        $('#cD').hide();
        $('#cB').hide();
        $('#cheque').click(function () {
            $('#cN').removeAttr("disabled");
            $('#cD').removeAttr("disabled");
            $('#cB').removeAttr("disabled");
            $('#cN').show();
            $('#cD').show();
            $('#cB').show();
        });

        $('#cash').click(function () {
            $('#cN').attr("disabled", "disabled");
            $('#cD').attr("disabled", "disabled");
            $('#cB').attr("disabled", "disabled");
            $('#cN').hide();
            $('#cD').hide();
            $('#cB').hide();
        });




    $("#monthId").change(function () {
        calculation();
    });

    $("input[id^='monthWaive']").change(function () {
        calculation();
    });

    $("input[id^='checkOff']").change(function () {
        calculation();
    });

    function calculation() {
        var total = "";
        var i;
        for (i = <?php echo $_count+1; ?>; i <<?php echo $count+1?>; i++) {

            if (document.getElementById('checkOff' + i).checked) {


                var amtTotal = parseInt($('#monthlyAmt' + i).val());

                $('#monthFee' + i).val(amtTotal);
                if (!isNaN(parseInt(amtTotal) - parseInt($('#waiveOff' + i).val())) && (parseInt(amtTotal) - parseInt($('#waiveOff' + i).val())) > 0) {
                    $('#eachTotal' + i).val(parseInt(amtTotal) - parseInt($('#waiveOff' + i).val()));
                }
                else {
                    $('#eachTotal' + i).val(0);
                }

                Total();
            }
            else {
                $('#monthFee' + i).val(0);
                $('#eachTotal' + i).val(0);
                $('#waiveOff' + i).val(0);
                Total();
            }

        }
    }
    function Total() {
        var i;

        for (i = 1; i <<?php echo $count+1?>; i++) {
            var total = parseInt($('#monthFee' + i).val()) - parseInt($('#monthWaive' + i).val());

            if (parseInt(total) < 0) {
                $('#monthWaive' + i).val(0);
                var total = parseInt($('#monthFee' + i).val());
                alert('Please Enter Waive Off less than fee amount.')
            }
            if (isNaN(total)) {
                $('#eachTotal' + i).val(0);
            }
            else {
                if (parseInt(total) < 0)
                    total = 0;
                $('#eachTotal' + i).val(total);
            }
            grandTotal();
        }
    }
    function grandTotal() {
        var j;
        var grandTotal = 0;
        for (j = 1; j <<?php echo $count+1?>; j++) {


            var grandTotal = parseInt(grandTotal) + parseInt($('#eachTotal' + j).val());

        }

        if (isNaN(grandTotal)) {
            $("#total").html('0');
        }
        else {
            $("#total").html('Rs. ' + grandTotal + '.00');
            $("#grandTotal").val(grandTotal);
        }


    }

</script>

<?php
$db->close();
?>

