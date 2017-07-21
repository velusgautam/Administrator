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
    $booster->js_minify = TRUE;
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
                $("#loading").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');

                $("#staffForm").ajaxForm({
                    target: '#preview',
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
    </script>
</head>
<body class="inside-body">

<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>

<?php include_once("includes/topNewMessagesBar.php"); ?>

<div class="container">

    <?php include_once('includes/menu.php'); ?>

    <div class="row-fluid">

        <div class="span12">
            <div id='preview'></div>

            <div class="top-bar">
                <h3><i class="icon-user"></i>Staff Registration</h3>
            </div>

            <div class="well no-padding">


                <form id="staffForm" method="post" class="form-horizontal" enctype="multipart/form-data"
                      action="adminBusinessLogic/staffSave.php">

                    <!--        --><?php //if($_SESSION['Role'] == 1)
                    //        {
                    //
                    ?>
                    <!--            <div class="control-group" >-->
                    <!--                <label class="control-label margin-schl">Select School </label>-->
                    <!--                <div class="controls">-->
                    <!--                    <select class="span6 m-wrap margin-schl" data-placeholder="Choose School" tabindex="1" name="schoolName">-->
                    <!--                        --><?php //include_once('projectinc/schlDDStudentReg.php');?>
                    <!--                    </select>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!---->
                    <!--        --><?php //} ?>


                    <div class="control-group">
                        <div align="center"><h5>Staff Details</h5></div>
                    </div>
                    <div class="control-group">
                        <div class="span4">
                            <label class="control-label">Name:</label>

                            <div class="controls">
                                <input type="text" class="input-block-level" placeholder="Name" name="staffName"
                                       id="staffName" tabindex="1">
                                <script type="text/javascript">
                                    var staffName = new LiveValidation('staffName', { validMessage: " ", wait: 500 });
                                    staffName.add(Validate.Presence, { failureMessage: "Please Check Staff Name" });
                                    staffName.add(Validate.Exclusion, { within: [ ',', '@', '!', '`', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '}', '{', ']', '[', '"', ';', ':', "'", '/' ], partialMatch: true, failureMessage: "Please Check Letters" });
                                    staffName.add(Validate.Length, { minimum: 3, maximum: 15 });
                                </script>
                            </div>
                        </div>

                        <div class="span4">
                            <label class="control-label">Role:</label>

                            <div class="controls">
                                <select class="input-block-level" data-placeholder="Choose Role" tabindex="2"
                                        name="roleId">

                                    <option value="2~Staff">Staff</option>
                                    <option value="1~Administrator">Administrator</option>

                                </select>
                            </div>
                        </div>


                        <div class="span4">
                            <label class="control-label">Date:</label>

                            <div class="controls">
                                <input class="datepicker" type="text" name="date" tabindex="3"
                                       value="<?php echo date("d-m-Y"); ?>" id="date"/>
                                <script type="text/javascript">
                                    var date = new LiveValidation('date', { validMessage: " ", wait: 500 });
                                    date.add(Validate.Presence, { failureMessage: "Please Check Application Number" });

                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span4">
                            <label class="control-label">Username:</label>

                            <div class="controls">
                                <input type="text" class="input-block-level" placeholder="Username" name="staffUserName"
                                       id="staffUserName" tabindex="4">
                                <script type="text/javascript">
                                    var staffUserName = new LiveValidation('staffUserName', { validMessage: " ", wait: 500 });
                                    staffUserName.add(Validate.Presence, { failureMessage: "Please Check UserName " });
                                    staffUserName.add(Validate.Length, { minimum: 3, maximum: 15 });
                                </script>
                            </div>
                        </div>
                        <div class="span4">
                            <label class="control-label">Password:</label>

                            <div class="controls">
                                <input type="password" class="input-block-level" placeholder="Password"
                                       name="staffPassword" id="staffPassword" tabindex="5">
                                <script type="text/javascript">
                                    var staffPassword = new LiveValidation('staffPassword', { validMessage: " ", wait: 500 });
                                    staffPassword.add(Validate.Presence, { failureMessage: "Please Check Password " });
                                    staffPassword.add(Validate.Length, { minimum: 3, maximum: 15 });
                                </script>
                            </div>
                        </div>
                        <div class="span4">
                            <label class="control-label">School:</label>

                            <div class="controls">
                                <select class="input-block-level" data-placeholder="Choose a School" name="school"
                                        tabindex="6">

                                    <?php include_once('projectinc/schoolDropDownLogin.php'); ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div align="center"><h5>Phone Number</h5></div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label class="control-label">Phone Number:</label>

                            <div class="controls">
                                <input type="text" class="input-block-level" placeholder="9876543210" name="phoneNumber"
                                       id="phoneNumber" tabindex="7">
                                <script type="text/javascript">
                                    var phoneNumber = new LiveValidation('phoneNumber', { validMessage: " ", wait: 100 });
                                    phoneNumber.add(Validate.Presence, { failureMessage: "Please Enter Phone Number 10 Digits Only" });
                                    phoneNumber.add(Validate.Exclusion, { within: [ ',', '@', '!', '`', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '}', '{', ']', '[', '"', ';', ':', "'", '/' ], partialMatch: true, failureMessage: "Please Enter only Numbers" });
                                    phoneNumber.add(Validate.Length, { minimum: 10, maximum: 10 });
                                    phoneNumber.add(Validate.Numericality);
                                </script>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions stdFormAction">

                        <button type="reset" id="cancel" class="btn" tabindex="9">Cancel</button>
                        <button type="button" class="btn btn-primary" id="save" tabindex="8">Save</button>
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