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
                $("#loading").html('<img src="assets/img/loader.gif" alt="Sending.."/>');
                $("#studentForm").ajaxForm({
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
    <h3><i class="icon-user"></i>Application Updation</h3>
</div>
<div class="well no-padding">
<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
      action="adminBusinessLogic/applicationSave.php">
<?php
$rows = $db->query_first("Select * from " . TABLE_APPLICATION . " Where `id`=" . $_GET['id']);
if ($_SESSION['Role'] == 1) {
    ?>
    <div class="control-group">
        <label class="control-label margin-schl">Select School </label>

        <div class="controls">
            <select class="span6 m-wrap margin-schl" data-placeholder="Choose School" tabindex="1" name="schoolCode"
                    id="schoolName">
                <?php
                $sql = "SELECT schl_id, school_code FROM `".TABLE_SCHOOL."` WHERE published='1' ORDER BY school_name ASC";
                $schoolRows = $db->query($sql);
                echo "<option value=\"\">Select</option>";
                while ($record = $db->fetch_array($schoolRows))
                {
                    echo "<option value=\"$record[schl_id]\" "; if($rows['school_code'] == $record[schl_id]){echo "Selected";} echo ">$record[school_code]</option>";
                }
                $schoolRows=NULL;
                $sql=NULL;
                ?>
            </select>
            <span id="wait_1" class="help-inline" style="display: none;"><img alt="Please Wait"
                                                                              src="assets/img/ajax-loader.gif"/></span>
        </div>
    </div>

<?php
}
else
{
    ?>
    <input type="hidden" value="<?php echo $_SESSION['SchoolCode'] ?>" name="schoolCode">
<?php
}


echo "<input type='hidden' value='" . $rows['id'] . "' name='updateId'>" . PHP_EOL . PHP_EOL;
//print_r($rows);

?>
<div class="control-group">
    <div align="center">
        <h5>Academic Details</h5>
    </div>
</div>
<div class="control-group">
    <div class="span4">
        <label class="control-label">Academic Year:</label>

        <div class="controls">
            <select class="input-block-level" data-placeholder="Choose a Academic Year" tabindex="2"
                    name="academicYear" id="academicYear">
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
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Admission Date:</label>

        <div class="controls">
            <input class="datepicker" type="text" tabindex="1" id="date"
                   value="<?php echo date("d-m-Y", strtotime($rows['admission_date'])); ?>"
                   name="date"/>
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Admission No:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="2" placeholder="Admission No" name="admissionNo" value="<?php echo $rows['admin_no']?>">
        </div>
    </div>
</div>
<div class="control-group">
    <div align="center">
        <h5>Previous School Information</h5>
    </div>

</div>
<div class="control-group">
    <div class="span4">
        <div class="span8">
            <label class="control-label appln-label-large">Standard which the pupil was <br> studying while leaving the
                school :</label>
        </div>
        <div class="span4">
            <select class="input-block-level" tabindex="3" placeholder="Last School Standard"
                    name="standardLeaving">
                <option>PRE KG</option>
                <option>KG</option>
                <option>Class I</option>
                <option>Class II</option>
                <option>Class III</option>
                <option>Class IV</option>
                <option>Class V</option>
                <option>Class VI</option>
                <option>Class VII</option>
                <option>Class VIII</option>
                <option>Class IX</option>
                <option>Class X</option>
                <option>Class XI</option>
                <option>Class XII</option>
            </select>

        </div>
    </div>

    <div class="span5">
        <div class="span7"><label class="control-label appln-label-large">Medium of instruction,the pupil<br> had taken
                in the previous school:</label></div>

        <div class="span5">
            <input type="text" class="input-block-level" tabindex="4"
                   placeholder="Medium of instruction"
                   name="previousSchool" value="<?php echo $rows['prev_school']; ?>">
        </div>
    </div>
    <div class="span3">
        <label class="control-label">T.C No And Date:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="5" placeholder="T.C No And Date:" name="tcDate"
                   value="<?php echo $rows['tcdate'] ?>">
        </div>
    </div>
</div>
<div class="control-group">
    <div align="center">
        <h5>Personal Details</h5>
    </div>

</div>
<div class="control-group">


    <div class="span5">
        <label class="control-label">Name:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="6" id="name" placeholder="Name" name="name"
                   value="<?php echo $rows['name'] ?>">
            <script type="text/javascript">
                var name = new LiveValidation('name', { validMessage: " ", wait: 500 });
                name.add(Validate.Presence, { failureMessage: "Please Enter name." });
            </script>
        </div>
    </div>
    <div class="span3">
        <label class="control-label">Gender:</label>

        <div class="controls">
            <div class="span4">
                <label class="radio"><span><input type="radio" name="gender" tabindex="7" value="Male" checked></span>
                    Male</label>
            </div>
            <div class="span6">
                <label class="radio"><span><input type="radio" name="gender" tabindex="8" value="Female"></span> Female</label>
            </div>

        </div>
    </div>
    <div class="span4">
        <label class="control-label">Date Of Birth:</label>

        <div class="controls">
            <input class="datepicker" type="text" name="dateOfBirth" tabindex="9"
                   value="<?php echo date("d-m-Y", strtotime($rows['dob'])); ?>" id="dateOfBirth"/>
            <script type="text/javascript">
                var dateOfBirth = new LiveValidation('dateOfBirth', { validMessage: " ", wait: 500 });
                dateOfBirth.add(Validate.Presence, { failureMessage: "Please Enter Date Of Birth." });
            </script>
        </div>

    </div>
</div>


<div class="control-group">

    <div class="span4">
        <label class="control-label">Nationality:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="10" placeholder="Nationality" name="nationality"
                   value="<?php echo $rows['nationality'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Place Of Birth:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="11" placeholder="Place Of Birth" name="placeOfBirth"
                   value="<?php echo $rows['placeofbirth'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Taluk/Dist:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="12" placeholder="Taluk/Dist" name="talukDist"
                   value="<?php echo $rows['talukdist'] ?>">
        </div>
    </div>

</div>


<div class="control-group">
    <div class="span4">
        <label class="control-label">Mother Tongue:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="13" placeholder="Mother Tongue" name="motherTongue"
                   value="<?php echo $rows['mothertongue'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Religion:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="14" placeholder="Religion" name="religion"
                   value="<?php echo $rows['religion'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Caste&SubCaste:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="15" placeholder="Caste&SubCaste"
                   name="casteSubCaste" value="<?php echo $rows['caste'] ?>">
        </div>
    </div>
</div>


<div class="control-group">
    <div class="span8">
        <div class="span6"><label class="control-label">Whether Schedule Caste/Tribe (If Yes,Please Specify):</label>
        </div>
        <div class="span6"><input type="text" class="input-block-level" tabindex="16"
                                  placeholder="Whether Schedule Caste/Tribe (If Yes,Please Specify)"
                                  name="whetherSCT" value="<?php echo $rows['whethersct'] ?>"></div>
    </div>

</div>

<div class="control-group">
    <div class="span4">
        <label class="control-label">Father's Name:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="17" placeholder="Father's Name" name="fathersName"
                   value="<?php echo $rows['father_name'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label appln-label-large">Father's <br>Qualification:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="18" placeholder="Father's Qualification"
                   name="fatherQualification" value="<?php echo $rows['father_qualification'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label appln-label-large">Father's <br>Occupation:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="19" placeholder="Father's Occupation"
                   name="fatherOccupation" value="<?php echo $rows['father_occupation'] ?>">
        </div>
    </div>
</div>

<div class="control-group">
    <div class="span4">
        <label class="control-label">Mother Name:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="20" placeholder="Mother Name"
                   name="motherName" value="<?php echo $rows['mother_name']; ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label appln-label-large">Mother's <br>Qualification:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="21" placeholder="Mother's Qualification"
                   name="motherQualification" value="<?php echo $rows['mother_qualification'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label appln-label-large">Mother's <br>Occupation:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="22" placeholder="Mother's Occupation"
                   name="motherOccupation" value="<?php echo $rows['mother_occupation'] ?>">
        </div>
    </div>
</div>

<div class="control-group">
    <div class="span4">
        <label class="control-label appln-label-large">Number Of <br> Brothers:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="23" placeholder="Number Of Brothers"
                   name="noOfBrothers" value="<?php echo $rows['noofbro'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label appln-label-large">Number Of<br> Sisters:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="24" placeholder="Number Of Sisters"
                   name="noOfSisters" value="<?php echo $rows['noofsis'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label appln-label-large">Parent Annual <br>Income:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="25"
                   placeholder="Parent Annual Income" name="parentAnnualIncom"
                   value="<?php echo $rows['annual_income'] ?>">
        </div>
    </div>

</div>

<div class="control-group">
    <div class="span8">
        <div class="span3">
            <label class="control-label">Permanent Address:</label>
        </div>
        <div class="span9">
            <input type="text" class="input-block-level" tabindex="26" placeholder="Permanent Address"
                   name="permanentAddress" value="<?php echo $rows['permanent_address'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">E-mail:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="27" placeholder="E-mail"
                   name="email" value="<?php echo $rows['email'] ?>">
        </div>
    </div>

</div>
<div class="control-group">
    <div class="span4">
        <label class="control-label">Mobile No:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="28" placeholder="Mobile No"
                   name="mobileNo" value="<?php if(!empty($rows['mobile_no'])) { echo substr($rows['mobile_no'], 2, 12); } ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Resi No:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="29" placeholder="Resi No" name="resiNo"
                   value="<?php echo $rows['resi_no'] ?>">
        </div>
    </div>
    <div class="span4">
        <label class="control-label">Office No:</label>

        <div class="controls">
            <input type="text" class="input-block-level" tabindex="30" placeholder="Office No" name="officeNo"
                   value="<?php echo $rows['office_no'] ?>">
        </div>
    </div>

</div>
<div class="form-actions stdFormAction">
    <button type="reset" class="btn" tabindex="31" id="cancel">Cancel</button>
    <button type="button" class="btn btn-primary" tabindex="32" id="save">Update</button>
    <!--    <input type="submit" class="btn btn-primary" tabindex="19" id="save" value="Save">-->

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