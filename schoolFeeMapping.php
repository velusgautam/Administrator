<?php




include_once('adminBusinessLogic/security.php');
if ($_SESSION['Role'] != "1") {
    redirect_to("developmentStudentListing.php");
    exit;
}
include_once('includes/headerPhp.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("includes/headerMeta.php");
    require_once("includes/headerStyles.php");
    require_once("includes/headerScripts.php");
    ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#save').click('change', function () {
                $("#preview").html('');
                $("#save").css("display", "none");
                $("#cancel").css("display", "none");
                $("#loading").css("display", "");
                $("#loading").html('<img src="http://www.gnradmin.com/assets/img/loader.gif" alt="Updating Fees...."/>');

                $("#staffForm").ajaxForm({
                    target: '#preview',
                    success: function (html) {
                        $("#save").css("display", "");
                        $("#cancel").css("display", "");
                        $("#loading").css("display", "none");
                        $('body').animate({scrollTop: 0}, 'slow');
                        var content = $("#preview1");
                        $('html').stop().animate({
                            scrollTop: $(content).offset().top
                        }, 'slow');
                    }
                }).submit();


            });

            $.ajax({
                method: "POST",
                url: "projectinc/feeSetting.php",
                data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
            }).done(function (data) {
                    document.getElementById('feeSettingData').innerHTML = data;
            });

            $('#academicYear').on('change', function () {
                $.ajax({
                    method: "POST",
                    url: "projectinc/feeSetting.php",
                    data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
                }).done(function (data) {
                    document.getElementById('feeSettingData').innerHTML = data;
                });
            });


        });
    </script>
    <?php
    //include('includes/checkbox_jquery_fee.php');
    error_reporting(1);
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
                <?php
                if ($_SESSION['feeSettingStatus'] == 1) {
                    $_SESSION['feeSettingStatus'] = null;
                    ?>
                    <div class="alert alert-success alert-block">
                        <a href="#" data-dismiss="alert" class="close">x</a>
                        <h4 class="alert-heading">Information!!!</h4>
                        <table width="100%" border="0">
                            <tbody>
                            <tr>
                                <td width="100%"><br>SuccessFully Set the Fees Data!!!</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                <?php } elseif ($_SESSION['feeSettingStatus'] == 2) {
                    $_SESSION['feeSettingStatus'] = null;
                    ?>
                    <div class="alert alert-warning alert-block">
                        <a href="#" data-dismiss="alert" class="close">x</a>
                        <h4 class="alert-heading">Information!!!</h4>
                        <table width="100%" border="0">
                            <tbody>
                            <tr>
                                <td width="100%"><br>Some Error Occurred. Please try again!!!</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
            <div class="top-bar">
                <h3><i class="icon-user"></i>Development Fees Setting.

                </h3>
            </div>

            <div class="well no-padding">

                <form id="feesSetting" method="post" class="form-horizontal" enctype="multipart/form-data"
                      action="adminBusinessLogic/feeSettingSave.php">
                    <div class="control-group">
                        <?php
                        $data = $db->query_first("Select TS.school_name FROM " . TABLE_SCHOOL . " TS WHERE `schl_id`=" . $_GET['id']);
                        $count = $db->affected_rows;
                        if ($count == 0 || $count > 1) {
                            redirect_to('schoolSetting.php');
                        }
                        print"<div align=\"center\"><h5>" . $data['school_name'] . "</h5>";
                        print "<input type='hidden' value='" . $_GET['id'] . "' name='schoolId' >";
                        ?>
                        <select name="academicYear" id="academicYear" style="width: 140px">
                            <option value="All">All</option>
                            <option
                                value="2013-2014" <?php echo (((date("n") < 5) && (date("Y") == 2014)) || ((date("n") >= 5) && (date("Y") == 2013))) ? "selected" : ""; ?>>
                                2013-2014
                            </option>
                            <option
                                value="2014-2015" <?php echo (((date("n") < 5) && (date("Y") == 2015)) || ((date("n") >= 5) && (date("Y") == 2014))) ? "selected" : ""; ?>>
                                2014-2015
                            </option>
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
                        <?php
                        print   "</div>";
                        ?>

                    </div>

                    <div class="control-group">
                        <div class="span12" id="feeSettingData">


                        </div>

                    </div>

                    <div class="form-actions stdFormAction">

                        <button type="reset" id="cancel" class="btn" tabindex="9">Cancel</button>
                        <input type="submit" class="btn btn-primary" id="save" tabindex="8" value="Save">

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