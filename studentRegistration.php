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
    $booster->js_minify = true;
    $booster->js_source = '../assets/js/livevalidation_standalone.compressed.js';
    echo $booster->js_markup();
    ?>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#save').click('change', function () {
                $("#preview").html('');
                $("#save").css("display", "none");
                $("#cancel").css("display", "none");
                $("#loading").css("display", "");
                $("#loading").html('<img src="assets/img/loader.gif" alt="Sending.."/>');
                $("#studentForm").ajaxForm({
                    target:  '#preview',
                    success: function (html) {
                        $("#save").css("display", "");
                        $("#cancel").css("display", "");
                        $("#loading").css("display", "none");
                        $('html').animate({scrollTop: 0}, 'slow');
                        $('body').animate({scrollTop: 0}, 'slow');
                        var content = $("#preview1");
                        $('html').stop().animate({
                            scrollTop: $(content).offset().top
                        }, 'slow');
                    }
                }).submit();
            });

        });
            function finishAjax(id, response) {
                $('#wait_1').hide();
                $('#' + id).html(unescape(response));
                $('#' + id).fadeIn();
            }

            function finishAjax_tier_three(id, response) {
                $('#wait_2').hide();
                $('#' + id).html(unescape(response));
                $('#' + id).fadeIn();
            }

            function finishAjax_division(id, response) {
                $('#wait_3').hide();
                $('#' + id).html(unescape(response));
                $('#' + id).fadeIn();
            }

    </script>
</head>

<body class="inside-body">

<?php

if (!isset($_GET[id]) || $_GET[id] <= 0) {
    redirect_to('applicationListing.php');
} else {
    $data = $db->query_first("Select tc.class_name, ts.`school_name`, ta.name,ta.school_code, ta.academic_year, ta.class_applied, ta.stream_applied, ta.admission_status from " . TABLE_NEW_APPLICATION . " ta
    INNER JOIN " . TABLE_SCHOOL . " ts ON ts.schl_id = ta.school_code
    LEFT OUTER JOIN " . TABLE_CLASS . " tc ON tc.class_id = ta.class_applied
    where ta.`application_no`=" . trim($_GET[id]));
}
include_once('includes/topBody.php');
?>
<?php
include_once("includes/topMessagesBar.php");
include_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
    <?php include_once('includes/menu.php'); ?>

    <div class="row-fluid">
        <div class="span12">
            <div id='preview'></div>

            <div class="top-bar">
                <h3><i class="icon-user"></i>Student Registration</h3>
            </div>
            <div class="well no-padding">
                <form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
                      action="adminBusinessLogic/studentSave.php">


                    <?php
                    echo "<input type='hidden' value='" . intval(trim($_GET['id'])) . "' name='applicationNo'>" . PHP_EOL;
                    echo "<input type='hidden' value='" . $data['school_code'] . "' name='schlId'>" . PHP_EOL . PHP_EOL;
                    echo "<input type='hidden' value='" . $data['name'] . "' name='studentName'>" . PHP_EOL . PHP_EOL;
                    echo "<input type='hidden' value='" . $data['academic_year'] . "' name='academicYear'>" . PHP_EOL . PHP_EOL;
                    echo "<input type='hidden' value='" . $data['admission_status'] . "' name='admissionStatus'>" . PHP_EOL . PHP_EOL;
                    if(intval($data['school_code'])>0)
                    {
	                    echo "<script>
                        $(document).ready(function(){
                       $.get(\"projectinc/studentRegPreDD.php\", {
                        func: \"streamSelect\",
                        schl_id: \"" . $data['school_code'] . "-".$data['stream_applied']."-".$data['class_applied']."\",
                        },
                        function(response){

                       setTimeout(\"finishAjax('result_1', '\"+escape(response)+\"')\", 0);
                   });
                   return false;
                   });
                       </script>";
                    }
                    ?>
                    <div class="control-group">
                        <div align="center"><h5><?php echo $data['school_name'] ?></h5></div>
                    </div>
                    <div class="control-group">
                        <div class="span3"><label class="control-label">Name: <?php echo $data['name']; ?></label></div>
                        <div class="span3"><label class="control-label">Admission
                                                                        Date: <?php echo date("d-m-Y"); ?></label></div>
                        <div class="span3"><label class="control-label">Academic
                                                                        Year: <?php echo $data['academic_year']; ?></label></div>
                        <div class="span3"><label class="control-label">Class Applied: <?php echo $data['class_name']; ?></label></div>
                    </div>
                    <div class="control-group">
                        <div align="center"><h5>Academic Details</h5></div>
                    </div>

                    <div class="control-group">

                        <div class="span4" id="result_1">
                            <label class="control-label">Stream:</label>

                            <div class="controls">
                                <select class="input-block-level" data-placeholder="Choose a Stream" tabindex="1"
                                        name="stream">
	                                <option value="1" <?php echo (trim($data['stream_applied']) == 1)?"Selected":""; ?>>STATE</option>
	                                <option value="2" <?php echo (trim($data['stream_applied']) == 2)?"Selected":""; ?>>ICSE</option>
                                </select>
                            </div>
                        </div>


                        <div class="span4" id="result_2">
                            <label class="control-label">Class:</label>

                            <div class="controls">
                                <select class="input-block-level" data-placeholder="Choose Standard" tabindex="2"
                                        name="class">

                                </select>
                            </div>
                        </div>


                        <div class="span4" id="result_3">
                            <label class="control-label">Division:</label>

                            <div class="controls">
                                <select class="input-block-level" data-placeholder="Choose Division" tabindex="3"
                                        name="division">

                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="control-group">

                        <div class="span4">
                            <label class="control-label">Status:</label>

                            <div class="controls">
                                <select class="input-block-level" tabindex="4" data-placeholder="Choose Caste"
                                        tabindex="1" name="status">

                                    <option value="1">Active</option>
                                    <option value="2">In Active</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-actions stdFormAction">

                        <button type="reset" class="btn" tabindex="5" id="cancel">Cancel</button>
                        <button type="button" class="btn btn-primary" tabindex="6" id="save">Save</button>
                        <div id='loading'></div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>


</body>
<?php include_once('includes/footerJavascript.php'); ?>

</html>