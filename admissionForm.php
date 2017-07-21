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
					}}).submit();
			});

			$('#transfer').click(function () {
				$('#fresh').prop('checked', false);
				$('#fresh-bc').prop('checked', false);
				$('#fresh-cc').prop('checked', false);
			});

			$('#fresh').click(function () {
				$('#transfer').removeAttr("checked");
				$('#transfer-tc').removeAttr("checked");
				$('#transfer-mc').removeAttr("checked");
				$('#transfer-cc').removeAttr("checked");
			});

			$('input[name^="transfer-"]').click(function(){
				$('input[name^="transfer-"]:checked').each(function ()
				{
					$('#transfer').prop('checked', true);
				});
			});

			$('input[name^="fresh-"]').click(function(){
				$('input[name^="fresh-"]:checked').each(function ()
				{
					$('#fresh').prop('checked', true);
				});
			});
		});



		function Birth_Date_Reset() {
			document.getElementById("dateOfBirth").value = "";
		}


		function Calculate_Age() {

			var days;
			var months;
			var years;

			//input parameter
			var createdatevalue = document.getElementById("date").value;
			var fird = createdatevalue.substring(0, 2)
			var firm = createdatevalue.substring(3, 5)
			var firy = createdatevalue.substring(6, 10)


			var createdatevalue = document.getElementById("dateOfBirth").value;
			var lasd = createdatevalue.substring(0, 2)
			var lasm = createdatevalue.substring(3, 5)
			var lasy = createdatevalue.substring(6, 10)


			if (lasd != "" && lasm != "" && lasy != "") {


				var bool = false;
				if (lasy > firy) {
					alert("Date of Birth should not be greater than Today's Date");
					Birth_Date_Reset();
					return false;
				}
				else if ((lasm > firm) && !(lasy < firy)) {
					alert("Date of Birth should not be greater than Today's Date");
					Birth_Date_Reset();
					return false;
				}
				else if ((lasd > fird) && !(lasy < firy) && !(lasm < firm)) {
					alert("Date of Birth should not be greater than Today's Date");
					Birth_Date_Reset();
					return false;
				} else if (bool) {
					Birth_Date_Reset();
					return false;
				} else {
					if (fird >= lasd) {
						days = Number(fird) - Number(lasd);
						if (firm >= lasm) {
							months = Number(firm) - Number(lasm);
							years = Number(firy) - Number(lasy);
						}
						else {
							months = Number(firm) + 12 - Number(lasm);
							//years = f.AddYears(-1).Year - l.Year;
							years = Number(firy) - 1 - Number(lasy);
						}
					}
					else {
						days = (Number(fird) + 30) - Number(lasd);
						if ((Number(firm) - 1) >= Number(lasm)) {
							months = Number(firm) - 1 - Number(lasm);
							years = Number(firy) - Number(lasy);
						}
						else {
							months = Number(firm) - 1 + 12 - Number(lasm);
							years = Number(firy) - 1 - Number(lasy);
						}
					}

					if (days < 0) {
						days = 0 - Number(days);
					}
					if (months < 0) {
						months = 0 - Number(months);
					}

					var strAge = null;
					var strYear = "Year";
					var strMonth = "Month";

					if (Number(years) > 1) {
						strYear = "Years";
					}
					if (Number(months) > 1) {
						strMonth = "Months";
					}


					strAge = years + strYear + " - " + months + strMonth;

					document.getElementById("age").innerHTML = "(" + strAge + ")";
				}
			}

		}

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
<div class="top-bar" style="background-color: #FF780F;">
	<h3><i class="icon-user"></i>Student Admission Registration</h3>
</div>
<div class="well no-padding">
<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
      action="adminBusinessLogic/admissionSave.php">
<?php
	if ($_SESSION['Role'] == 1) {
		?>
		<div class="control-group">
			<label class="control-label margin-schl">Select School </label>

			<div class="controls">
				<select class="span6 m-wrap margin-schl" data-placeholder="Choose School" tabindex="1" name="schoolCode"
				        id="schoolName">
					<?php include_once('projectinc/schlDDStudentReg.php'); ?>
				</select>
		            <span id="wait_1" class="help-inline" style="display: none;"><img alt="Please Wait"
		                                                                              src="assets/img/ajax-loader.gif"/></span>
			</div>
		</div>

	<?php
	} else {
		?>
		<input type="hidden" value="<?php echo $_SESSION['SchoolCode'] ?>" name="schoolCode">
	<?php
	}
?>
<div class="control-group headings">
	<div align="center">
		<h5>Academic Details</h5>
	</div>
</div>
<div class="control-group">

	<div class="span4">
		<label class="control-label">Admission Date:</label>

		<div class="controls">
			<input class="datepicker" type="text" tabindex="2" id="date" value="<?php echo date("d-m-Y"); ?>"
			       name="date"/>
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Admission No:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="3" placeholder="Admission No" name="admissionNo" id="admissionNo">
			<script type="text/javascript">
				var admissionNo = new LiveValidation("admissionNo", { validMessage: " ", wait: 500 });
				admissionNo.add(Validate.Presence, { failureMessage: "Please Enter Admission Number." });
			</script>

		</div>
	</div>
	<div class="span4">
		<label class="control-label">Academic Year:</label>

		<div class="controls">
			<select class="input-block-level" data-placeholder="Choose a Academic Year" tabindex="4"
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

</div>
<div class="control-group headings">
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
			<select class="input-block-level" tabindex="5" placeholder="Last School Standard"
			        name="standardLeaving">
				<option>PREPARATORY</option>
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
			<input type="text" class="input-block-level" tabindex="6"
			       placeholder="Medium of instruction"
			       name="previousSchool">
		</div>
	</div>
	<div class="span3">
		<label class="control-label">T.C No And Date:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="7" placeholder="T.C No And Date:" name="tcDate">
		</div>
	</div>
</div>
<div class="control-group headings">
	<div align="center ">
		<h5>Personal Details</h5>
	</div>

</div>
<div class="control-group">

	<div class="span5">
		<label class="control-label">Name:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="8" id="name" placeholder="Name" name="name">
			<script type="text/javascript">
				var nameer = new LiveValidation("name", { validMessage: " ", wait: 500 });
				nameer.add(Validate.Presence, { failureMessage: "Please Enter Name." });
			</script>
		</div>
	</div>
	<div class="span3">
		<label class="control-label">Gender:</label>

		<div class="controls">
			<div class="span4">
				<label class="radio" style="margin-left: -40px;margin-top: 5px;"><span><input type="radio" name="gender" tabindex="9" value="Male" checked></span>
					Male</label>
			</div>
			<div class="span6">
				<label class="radio" style="margin-left: -25px;margin-top: 5px;"><span><input type="radio" name="gender" tabindex="10" value="Female"></span> Female</label>
			</div>

		</div>
	</div>
	<div class="span4">
		<label class="control-label">Date Of Birth:</label>

		<div class="controls" style="float: left">
			<input class="datepicker" style="width: 80px" type="text" name="dateOfBirth" tabindex="11" value=""
			       id="dateOfBirth" onchange="Calculate_Age()"/>
			<script type="text/javascript">
				var dateOfBirth = new LiveValidation('dateOfBirth', { validMessage: " ", wait: 500 });
				dateOfBirth.add(Validate.Presence, { failureMessage: " " });
			</script>

		</div>
		<span style="float: left;padding-left: 5px;padding-top: 5px" id="age"></span>

	</div>
</div>

<div class="control-group">

	<div class="span4">
		<label class="control-label">Nationality:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="12" placeholder="Nationality" name="nationality" value="Indian">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Place Of Birth:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="13" placeholder="Place Of Birth" name="placeOfBirth">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Taluk/Dist:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="14" placeholder="Taluk/Dist" name="talukDist">
		</div>
	</div>

</div>

<div class="control-group">
	<div class="span4">
		<label class="control-label">Mother Tongue:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="15" placeholder="Mother Tongue" name="motherTongue">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Religion:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="16" placeholder="Religion" name="religion">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Caste&SubCaste:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="17" placeholder="Caste&SubCaste"
			       name="casteSubCaste">
		</div>
	</div>
</div>

<div class="control-group">
	<div class="span8">
		<div class="span6"><label class="control-label">Whether Schedule Caste/Tribe (If Yes,Please Specify):</label>
		</div>
		<div class="span6"><input type="text" class="input-block-level" tabindex="18"
		                          placeholder="Whether Schedule Caste/Tribe (If Yes,Please Specify)"
		                          name="whetherSCT" value="No"></div>
	</div>

</div>
<div class="control-group headings">
	<div align="center ">
		<h5>Parents/Guardian Details</h5>
	</div>

</div>

<div class="control-group">
	<div class="span6">
		<label class="control-label">Father's Name:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="19" placeholder="Father's Name" name="fathersName" id="fathersName">
			<script type="text/javascript">
				var fathersName = new LiveValidation('fathersName', { validMessage: " ", wait: 500 });
				fathersName.add(Validate.Presence, { failureMessage: "Enter Father's Name" });
			</script>
		</div>
	</div>

	<div class="span6">
		<label class="control-label">Mother Name:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="20" placeholder="Mother Name" id="motherName" name="motherName">
			<script type="text/javascript">
				var motherName = new LiveValidation('motherName', { validMessage: " ", wait: 500 });
				motherName.add(Validate.Presence, { failureMessage: "Enter Mother's Name  " });
			</script>
		</div>
	</div>
</div>
<div class="control-group">
	<div class="span6">
		<label class="control-label appln-label-large">Father's <br>Qualification:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="21" placeholder="Father's Qualification"
			       name="fatherQualification">
		</div>
	</div>
	<div class="span6">
		<label class="control-label appln-label-large">Mother's <br>Qualification:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="22" placeholder="Mother's Qualification"
			       name="motherQualification">
		</div>
	</div>

</div>

<div class="control-group">

	<div class="span6">
		<label class="control-label appln-label-large">Father's <br>Occupation:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="23" placeholder="Father's Occupation"
			       name="fatherOccupation">
		</div>
	</div>
	<div class="span6">
		<label class="control-label appln-label-large">Mother's <br>Occupation:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="24" placeholder="Mother's Occupation"
			       name="motherOccupation">
		</div>
	</div>
</div>

<div class="control-group">

	<div class="span6">
		<label class="control-label">Father's Phone:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" id="fatherPhone" tabindex="25" placeholder="Father's Phone"
			       name="fatherPhone">
			<script type="text/javascript">
				var fatherPhone = new LiveValidation('fatherPhone', { validMessage: " ", wait: 500 });
				fatherPhone.add(Validate.Presence, { failureMessage: " " });
				fatherPhone.add(Validate.Numericality, { failureMessage: " " });
			</script>
		</div>
	</div>
	<div class="span6">
		<label class="control-label">Mother's Phone:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" id="motherPhone" tabindex="26" placeholder="Mother's Phone"
			       name="motherPhone">
			<script type="text/javascript">
				var motherPhone = new LiveValidation('motherPhone', { validMessage: " ", wait: 500 });
				motherPhone.add(Validate.Presence, { failureMessage: " " });
				motherPhone.add(Validate.Numericality, { failureMessage: " " });
			</script>
		</div>
	</div>
</div>

<div class="control-group">

	<div class="span6">
		<label class="control-label">Father's Email:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="27" placeholder="Father's Email"
			       name="fatherEmail">
		</div>
	</div>
	<div class="span6">
		<label class="control-label">Mother's Email:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="28" placeholder="Mother's Email"
			       name="motherEmail">
		</div>
	</div>
</div>

<div class="control-group">
	<div class="span4">
		<label class="control-label appln-label-large">Number Of <br> Brothers:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="29" placeholder="Number Of Brothers"
			       name="noOfBrothers">
		</div>
	</div>
	<div class="span4">
		<label class="control-label appln-label-large">Number Of<br> Sisters:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="30" placeholder="Number Of Sisters"
			       name="noOfSisters">
		</div>
	</div>
	<div class="span4">
		<label class="control-label appln-label-large">Parent Annual <br>Income:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="31"
			       placeholder="Parent Annual Income" name="parentAnnualIncom">
		</div>
	</div>

</div>

<div class="control-group">
	<div class="span12">
		<div class="span2">
			<label class="control-label">Permanent Address:</label>
		</div>
		<div class="span10">

			<textarea class="input-block-level" tabindex="32" placeholder="Permanent Address"
			          name="permanentAddress"></textarea>
		</div>
	</div>

</div>
<div class="control-group">

	<div class="span6">
		<label class="control-label">Resi No:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="33" placeholder="Residense No" name="resiNo">
		</div>
	</div>
	<div class="span6">
		<label class="control-label">Office No:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="34" placeholder="Office No" name="officeNo">
		</div>
	</div>

</div>
<div class="control-group">
	<div align="center"><h5>Student Information</h5></div>
</div>
<div class="control-group">

	<div class="span5 offset1">
		<fieldset>
			<div class="checkbox">
				<input type="checkbox" id="transfer" name="transfer" level="parent" value="1"> <h5>Incase of
				                                                                                   Transfer</h5>
			</div>
			<div class="checkbox">
                                        <span>
                                            <input type="checkbox" class="transferChild" id="transfer-tc" name="transfer-tc" value="1"> <label
		                                        class="control-label">Orginal
                                                                      Transfer Certificate</label>
                                        </span>
			</div>
			<div class="checkbox" style="margin-bottom: 20px">
                                         <span>
                                            <input type="checkbox" class="transferChild" id="transfer-mc" name="transfer-mc" value="1"> <label
		                                         class="control-label">Orginal
                                                                       Migration Certificate<br/>(If child has studied in another
                                                                       State/Country)</label>
                                        </span>
			</div>
			<div class="checkbox" style="margin-bottom: 20px">
                                         <span>
                                            <input type="checkbox" class="transferChild" id="transfer-cc" name="transfer-cc" value="1"> <label
		                                         class="control-label">Orginal
                                                                       Caste Certificate<br/>(If not specified in Transfer Certificate)</label>
                                        </span>
			</div>

		</fieldset>
	</div>
	<div class="span5 offset1">
		<div class="checkbox">
			<input type="checkbox" id="fresh" name="fresh" value="1"> <h5>Incase of Fresh
			                                                              Admission</h5>
		</div>
		<div class="checkbox">
                                        <span>
                                            <input type="checkbox" id="fresh-bc" name="fresh-bc" value="1"> <label
		                                        class="control-label">Orginal
                                                                      Birth Certificate</label>
                                        </span>
		</div>
		<div class="checkbox">
                                         <span>
                                            <input type="checkbox" id="fresh-cc" name="fresh-cc" value="1"> <label
		                                         class="control-label">Orginal
                                                                       Caste Certificate (In case of SC/ST Only)</label>
                                        </span>
		</div>

	</div>


</div>
<div class="form-actions stdFormAction">
	<button type="reset" class="btn" tabindex="36" id="cancel">Cancel</button>
	<button type="button" class="btn btn-primary" tabindex="35" id="save">Save</button>
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