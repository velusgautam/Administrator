<?php
require_once('adminBusinessLogic/developmentSecurity.php');
require_once('includes/headerPhp.php'); ?>
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
<?php require_once('includes/topBody.php'); ?>
<?php require_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
    <?php include_once('includes/developmentMenu.php'); ?>
    <div class="row-fluid">
        <div class="span12">
            <div id='preview'>
                <?php
                if (isset($_SESSION['developmentFeeReceiptError'])) {
                    echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $_SESSION['developmentFeeReceiptError'] . "</div><br>Please try again with filling every field correctly</div>";
                    $_SESSION['developmentFeeReceiptError'] = null;
                }
                //                $academicYr = $db->query_first("Select academic_year from ".TABLE_STUDENT." where student_id=".intval($_GET['id']));
                ?>
            </div>

            <div class="top-bar">
                <h3><i class="icon-dollar"></i>Fee Payment</h3>
            </div>


            <div class="well no-padding">
                <div class="control-group text-center" >

<label>Academic Year</label>
                        <select name="academicYear" id="academicYear" style="width: 140px">


                            <option
                                value="2017-2018" <?php echo (((date("n") < 5) && (date("Y") == 2017)) || ((date("n") >= 5) && (date("Y") == 2016))) ? "selected" : ""; ?>>
                                2017-2018
                            </option>
                            <option
                                value="2018-2019" <?php echo (((date("n") < 5) && (date("Y") == 2018)) || ((date("n") >= 5) && (date("Y") == 2019))) ? "selected" : ""; ?>>
                                2018-2019
                            </option>
                            <option
                                value="2019-2020" <?php echo (((date("n") < 5) && (date("Y") == 2019)) || ((date("n") >= 5) && (date("Y") == 2020))) ? "selected" : ""; ?>>
                                2019-2020
                            </option>

                        </select>
                </div>

                    <div id="feeCollectionData">

                    </div>


            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function () {

        $.ajax({
            method: "POST",
            url: "projectinc/developmentFeeCollection.php",
            data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
        }).done(function (data) {
            document.getElementById('feeCollectionData').innerHTML = data;
            var fun;
            $("#feeCollectionData").find("script").each(function (i) {
                eval(document.getElementById("lastScripts").innerHTML);
//                eval(document.getElementById("middleScripts").innerHTML);

            });
        });

        $('#academicYear').on('change', function () {
            $.ajax({
                method: "POST",
                url: "projectinc/developmentFeeCollection.php",
                data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
            }).done(function (data) {
                document.getElementById('feeCollectionData').innerHTML = data;
                $("#feeCollectionData").find("script").each(function (i) {
                    eval(document.getElementById("lastScripts").innerHTML);
//                    eval(document.getElementById("middleScripts").innerHTML);

                });

            });
        });
    });
</script>
<?php include_once('includes/footerJavascript.php'); ?>
</body>
</html>