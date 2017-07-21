<?php
include_once('adminBusinessLogic/security.php');
include_once('includes/headerPhp.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("includes/headerMeta.php");
    require_once("includes/headerStyles.php");
    require_once("includes/headerScripts.php");
    ?>
</head>
<body class="inside-body">
<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>
<?php include_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
    <?php include_once('includes/menu.php'); ?>
    <div class="row-fluid">
        <div class="span12">
            <div id='preview'>

            </div>

            <div class="top-bar">
                <h3><i class="icon-dollar"></i>Fee Payment</h3>
            </div>
            <?php
            $rows = $db->query_first("Select  ts.school_name,  st.schl_id,  tc.class_id
            FROM " . TABLE_STUDENT . " as st
             INNER JOIN " . TABLE_CLASS . " tc on tc.class_id = st.class_id
            INNER JOIN " . TABLE_SCHOOL . " ts on ts.schl_id = st.schl_id
            Where st.`student_id`=" . $_GET['id']);

            $_feeSql = "SELECT TS.`fee_name`, TFM.`fee_amount` , TFM.`fee_select`  FROM " . TABLE_FEES . " as TS  INNER JOIN " . TABLE_FEE_MAPPING . " as TFM ON TFM.fee_id = TS.fee_id WHERE TFM.`class_id`= " . $rows['class_id'] . " AND TFM.`schl_id` = " . $rows['schl_id'] . "";

            $feeRows = $db->query($_feeSql);



            ?>
            <div class="well no-padding">
                <div class="control-group">
                    <div align="center">
                        <h5><?php echo $rows['school_name'] ?></h5>
                        <select name="academicYear" id="academicYear" style="width: 140px">

                            <option
                                value="2015-2016" <?php echo (((date("n") < 5) && (date("Y") == 2016)) || ((date("n") >= 5) && (date("Y") == 2015))) ? "selected" : ""; ?>>
                                2015-2016
                            </option>
                            <option
                                value="2016-2017" <?php echo (((date("n") < 5) && (date("Y") == 2017)) || ((date("n") >= 5) && (date("Y") == 2016))) ? "selected" : ""; ?>>
                                2016-2017
                            </option>
                            <option
                                value="2017-2018" <?php echo (((date("n") < 5) && (date("Y") == 2018)) || ((date("n") >= 5) && (date("Y") == 2017))) ? "selected" : ""; ?>>
                                2017-2018
                            </option>
                            <option
                                value="2018-2019" <?php echo (((date("n") < 5) && (date("Y") == 2019)) || ((date("n") >= 5) && (date("Y") == 2018))) ? "selected" : ""; ?>>
                                2018-2019
                            </option>
                            <option
                                value="2019-2020" <?php echo (((date("n") < 5) && (date("Y") == 2020)) || ((date("n") >= 5) && (date("Y") == 2019))) ? "selected" : ""; ?>>
                                2019-2020
                            </option>

                        </select>
                    </div>
                </div>
                <div id="feeCollectionData">

                </div>


            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>


<script type="text/javascript">

    $(document).ready(function () {

        $.ajax({
            method: "POST",
            url: "projectinc/feeCollection.php",
            data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
        }).done(function (data) {
            document.getElementById('feeCollectionData').innerHTML = data;
            var fun;
            $("#feeCollectionData").find("script").each(function (i) {
                eval(document.getElementById("lastScripts").innerHTML);
                eval(document.getElementById("middleScripts").innerHTML);

            });
        });

        $('#academicYear').on('change', function () {
            $.ajax({
                method: "POST",
                url: "projectinc/feeCollection.php",
                data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
            }).done(function (data) {
                document.getElementById('feeCollectionData').innerHTML = data;
                $("#feeCollectionData").find("script").each(function (i) {
                    eval(document.getElementById("lastScripts").innerHTML);
                    eval(document.getElementById("middleScripts").innerHTML);

                });

            });
        });


    });


</script>
<?php include_once('includes/footerJavascript.php'); ?>

</html>