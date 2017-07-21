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
<div class="top-bar" style="background-color: #5EABD6;">
	<h3><i class="icon-user"></i>Student Admission Updation</h3>
</div>
<div class="well no-padding">
<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
      action="adminBusinessLogic/admissionSave.php">
<?php
	$rows = $db->query_first("Select * from " . TABLE_ADMISSION_FORM . " Where `id`=" . $_GET['id']);
	if ($_SESSION['Role'] == 1) {
		?>
		<div class="control-group">
			<label class="control-label margin-schl">Select School </label>

			<div class="controls">
				<select class="span6 m-wrap margin-schl" data-placeholder="Choose School" tabindex="1" name="schoolCode"
				        id="schoolName">
					<?php
						$sql = "SELECT schl_id, school_code FROM `" . TABLE_SCHOOL . "` WHERE published='1' ORDER BY school_name ASC";
						$schoolRows = $db->query($sql);
						echo "<option value=\"\">Select</option>";
						while ($record = $db->fetch_array($schoolRows)) {
							echo "<option value=\"$record[schl_id]\" ";
							if ($rows['school_code'] == $record[schl_id]) {
								echo "Selected";
							}
							echo ">$record[school_code]</option>";
						}
						$schoolRows = null;
						$sql = null;
					?>
				</select>
            <span id="wait_1" class="help-inline" style="display: none;"><img alt="Please Wait"
                                                                              src="assets/img/ajax-loader.gif"/></span>
			</div>
		</div>

	<?php
	} else {
		?>
		<input type="hidden" value="<?php echo $rows['school_code'] ?>" name="schoolCode">
	<?php
	}


	echo "<input type='hidden' value='" . $rows['id'] . "' name='updateId'>" . PHP_EOL . PHP_EOL;
	//print_r($rows);

?>
<div class="control-group headings">
	<div align="center">
		<h5>Academic Details</h5>
	</div>
</div>
<div class="control-group">

	<div class="span3">
		<label class="control-label">Admission Date:</label>

		<div class="controls">
			<input class="datepicker" type="text" tabindex="2" id="date"
			       value="<?php echo date("d-m-Y", strtotime($rows['admission_date'])); ?>"
			       name="date" style="width: 120px"/>
		</div>
	</div>

	<div class="span3">
		<label class="control-label">Academic Year:</label>

		<div class="controls">
			<select class="input-block-level" data-placeholder="Choose a Academic Year" tabindex="3"
			        name="academicYear" id="academicYear">

				<option value="2013-2014" <?php echo ($rows['academic_year'] == '2013-2014') ? "selected" : ""; ?>>2013-2014</option>
				<option value="2014-2015" <?php echo ($rows['academic_year'] == '2014-2015') ? "selected" : ""; ?>>2014-2015</option>
				<option value="2015-2016" <?php echo ($rows['academic_year'] == '2015-2016') ? "selected" : ""; ?>>2015-2016</option>
				<option value="2016-2017" <?php echo ($rows['academic_year'] == '2016-2017') ? "selected" : ""; ?>>2016-2017</option>
				<option value="2017-2018" <?php echo ($rows['academic_year'] == '2017-2018') ? "selected" : ""; ?>>2017-2018</option>
				<option value="2018-2019" <?php echo ($rows['academic_year'] == '2018-2019') ? "selected" : ""; ?>>2018-2019</option>
				<option value="2019-2020" <?php echo ($rows['academic_year'] == '2019-2020') ? "selected" : ""; ?>>2019-2020</option>
			</select>
		</div>
	</div>

	<div class="span3">
		<label class="control-label">Admission No:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="4" placeholder="Admission No" name="admissionNo" value="<?php echo $rows['admin_no'] ?>">
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
				<option></option>
				<option value="PRE KG" <?php echo ($rows['standard_leaving']=="PRE KG")?" Selected":""; ?>>PRE KG</option>
				<option value="KG" <?php echo ($rows['standard_leaving']=="KG")?" Selected":""; ?>>KG</option>
				<option value="Class I" <?php echo ($rows['standard_leaving']=="Class I")?" Selected":""; ?>>Class I</option>
				<option value="Class II" <?php echo ($rows['standard_leaving']=="Class II")?" Selected":""; ?>>Class II</option>
				<option value="Class III" <?php echo ($rows['standard_leaving']=="Class III")?" Selected":""; ?>>Class III</option>
				<option value="Class IV" <?php echo ($rows['standard_leaving']=="Class IV")?" Selected":""; ?>>Class IV</option>
				<option value="Class V" <?php echo ($rows['standard_leaving']=="Class V")?" Selected":""; ?>>Class V</option>
				<option value="Class VI" <?php echo ($rows['standard_leaving']=="Class VI")?" Selected":""; ?>>Class VI</option>
				<option value="Class VII" <?php echo ($rows['standard_leaving']=="Class VII")?" Selected":""; ?>>Class VII</option>
				<option value="Class VIII" <?php echo ($rows['standard_leaving']=="Class VIII")?" Selected":""; ?>>Class VIII</option>
				<option value="Class IX" <?php echo ($rows['standard_leaving']=="Class IX")?" Selected":""; ?>>Class IX</option>
				<option value="Class X" <?php echo ($rows['standard_leaving']=="Class X")?" Selected":""; ?>>Class X</option>
				<option value="Class XI" <?php echo ($rows['standard_leaving']=="Class XI")?" Selected":""; ?> >Class XI</option>
				<option value="Class XII" <?php echo ($rows['standard_leaving']=="Class XII")?" Selected":""; ?>>Class XII</option>
			</select>

		</div>
	</div>

	<div class="span5">
		<div class="span7"><label class="control-label appln-label-large">Medium of instruction,the pupil<br> had taken
		                                                                  in the previous school:</label></div>

		<div class="span5">
			<input type="text" class="input-block-level" tabindex="6"
			       placeholder="Medium of instruction"
			       name="previousSchool" value="<?php echo $rows['prev_school']; ?>">
		</div>
	</div>
	<div class="span3">
		<label class="control-label">T.C No And Date:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="7" placeholder="T.C No And Date:" name="tcDate"
			       value="<?php echo $rows['tcdate'] ?>">
		</div>
	</div>
</div>
<div class="control-group headings">
	<div align="center">
		<h5>Personal Details</h5>
	</div>

</div>
<div class="control-group">

	<div class="span5">
		<label class="control-label">Name:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="8" id="name" placeholder="Name" name="name"
			       value="<?php echo $rows['name'] ?>">
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
				<label class="radio" style="margin-left: -40px;margin-top: 5px;"><span><input type="radio" name="gender" tabindex="9" value="Male" <?php echo (strtolower($rows['gender']) == "male") ? "Checked" : ""; ?>></span>
					Male</label>
			</div>
			<div class="span6">
				<label class="radio" style="margin-left: -25px;margin-top: 5px;"><span><input type="radio" name="gender" tabindex="10" value="Female" <?php echo (strtolower($rows['gender']) == "female") ? "Checked" : ""; ?>></span> Female</label>
			</div>

		</div>
	</div>
	<div class="span4">
		<label class="control-label">Date Of Birth:</label>

		<div class="controls" style="float: left">
			<input class="datepicker" style="width: 80px; margin-left: -10px" type="text" name="dateOfBirth" tabindex="11"
			       value="<?php echo ($rows['dob'] != '0000-00-00') ? date("d-m-Y", strtotime($rows['dob'])) : ""; ?>" id="dateOfBirth" onchange="Calculate_Age()"/>

		</div>
		<span style="float: left;padding-left: 5px;padding-top: 5px" id="age"></span>

	</div>
</div>

<div class="control-group">

	<div class="span4">
		<label class="control-label">Nationality:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="12" placeholder="Nationality" name="nationality"
			       value="<?php echo $rows['nationality'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Place Of Birth:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="13" placeholder="Place Of Birth" name="placeOfBirth"
			       value="<?php echo $rows['placeofbirth'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Mother Tongue:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="14" placeholder="Mother Tongue" name="motherTongue"
			       value="<?php echo $rows['mothertongue'] ?>">
		</div>
	</div>


</div>


<div class="control-group">

	<div class="span4">
		<label class="control-label">Place:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="15" placeholder="Place" name="place"
			       value="<?php echo $rows['place'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Taluk:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="16" placeholder="Taluk" name="taluk"
			       value="<?php echo $rows['taluk'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Dist:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="17" placeholder="District" name="district"
			       value="<?php echo $rows['district'] ?>">
		</div>
	</div>


</div>

<div class="control-group">

	<div class="span4">
		<label class="control-label">Religion:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="18" placeholder="Religion" name="religion"
			       value="<?php echo $rows['religion'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label">Caste&SubCaste:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="19" placeholder="Caste&SubCaste"
			       name="casteSubCaste" value="<?php echo $rows['caste'] ?>">
		</div>
	</div>
</div>

<div class="control-group">
	<div class="span8">
		<div class="span6"><label class="control-label">Whether Schedule Caste/Tribe (If Yes,Please Specify):</label>
		</div>
		<div class="span6"><input type="text" class="input-block-level" tabindex="20"
		                          placeholder="Whether Schedule Caste/Tribe (If Yes,Please Specify)"
		                          name="whetherSCT" value="<?php echo $rows['whethersct'] ?>"></div>
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
			<input type="text" class="input-block-level ap-form-input80" tabindex="21" placeholder="Father's Name" name="fathersName"
			       value="<?php echo $rows['father_name'] ?>" id="fathersName">
			<script type="text/javascript">
				var fathersName = new LiveValidation('fathersName', { validMessage: " ", wait: 500 });
				fathersName.add(Validate.Presence, { failureMessage: "Enter Father's Name" });
			</script>
		</div>
	</div>

	<div class="span6">
		<label class="control-label">Mother Name:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="22" placeholder="Mother Name" id="motherName" name="motherName" value="<?php echo $rows['mother_name'] ?>">
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
			<input type="text" class="input-block-level ap-form-input80" tabindex="23" placeholder="Father's Qualification"
			       name="fatherQualification" value="<?php echo $rows['father_qualification'] ?>">
		</div>
	</div>
	<div class="span6">
		<label class="control-label appln-label-large">Mother's <br>Qualification:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="24" placeholder="Mother's Qualification"
			       name="motherQualification" value="<?php echo $rows['mother_qualification'] ?>">
		</div>
	</div>

</div>

<div class="control-group">

	<div class="span6">
		<label class="control-label appln-label-large">Father's <br>Occupation:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="25" placeholder="Father's Occupation"
			       name="fatherOccupation"  value="<?php echo $rows['father_occupation'] ?>">
		</div>
	</div>
	<div class="span6">
		<label class="control-label appln-label-large">Mother's <br>Occupation:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="26" placeholder="Mother's Occupation"
			       name="motherOccupation" value="<?php echo $rows['mother_occupation'] ?>">
		</div>
	</div>
</div>

<div class="control-group">

	<div class="span6">
		<label class="control-label">Father's Phone:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" id="fatherPhone" tabindex="27" placeholder="Father's Phone"
			       name="fatherPhone" value="<?php echo $rows['father_phone'] ?>" >
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
			<input type="text" class="input-block-level ap-form-input80" id="motherPhone" tabindex="28" placeholder="Mother's Phone"
			       name="motherPhone" value="<?php echo $rows['mother_phone'] ?>" >
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
			<input type="text" class="input-block-level ap-form-input80" tabindex="29" placeholder="Father's Email"
			       name="fatherEmail" value="<?php echo $rows['father_email'] ?>" >
		</div>
	</div>
	<div class="span6">
		<label class="control-label">Mother's Email:</label>

		<div class="controls">
			<input type="text" class="input-block-level ap-form-input80" tabindex="30" placeholder="Mother's Email"
			       name="motherEmail" value="<?php echo $rows['mother_email'] ?>">
		</div>
	</div>
</div>

<div class="control-group">
	<div class="span4">
		<label class="control-label appln-label-large">Number Of <br> Brothers:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="31" placeholder="Number Of Brothers"
			       name="noOfBrothers" value="<?php echo $rows['noofbro'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label appln-label-large">Number Of<br> Sisters:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="32" placeholder="Number Of Sisters"
			       name="noOfSisters" value="<?php echo $rows['noofsis'] ?>">
		</div>
	</div>
	<div class="span4">
		<label class="control-label appln-label-large">Parent Annual <br>Income:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="33"
			       placeholder="Parent Annual Income" name="parentAnnualIncom" value="<?php echo $rows['annual_income'] ?>">
		</div>
	</div>

</div>

<div class="control-group">
	<div class="span12">
		<div class="span2">
			<label class="control-label">Permanent Address:</label>
		</div>
		<div class="span10">

			<textarea class="input-block-level" tabindex="34" placeholder="Permanent Address"
			          name="permanentAddress"><?php echo $rows['permanent_address'] ?></textarea>
		</div>
	</div>

</div>
<div class="control-group">

	<div class="span6">
		<label class="control-label">Resi No:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="35" placeholder="Residense No" name="resiNo" id="resiNo" value="<?php echo $rows['resi_no'] ?>">
			<script type="text/javascript">
				var resiNo = new LiveValidation('resiNo', { validMessage: " ", wait: 500 });
				resiNo.add(Validate.Numericality, { failureMessage: " " });
			</script>
		</div>
	</div>
	<div class="span6">
		<label class="control-label">Office No:</label>

		<div class="controls">
			<input type="text" class="input-block-level" tabindex="36" placeholder="Office No" name="officeNo" id="officeNo" value="<?php echo $rows['office_no'] ?>">
			<script type="text/javascript">
				var officeNo = new LiveValidation('officeNo', { validMessage: " ", wait: 500 });
				officeNo.add(Validate.Numericality, { failureMessage: " " });
			</script>
		</div>
	</div>

</div>
<div class="control-group headings">
	<div align="center"><h5>Other Details</h5></div>
</div>
<div class="control-group">

	<div class="span5 offset1">
		<fieldset>
			<div class="checkbox">
				<?php
					$_isTransfer = ($rows['transfer_tc'] == 1 || $rows['transfer_mc'] == 1 || $rows['transfer_cc'] == 1) ? "Checked" : "";
				?>
				<input type="checkbox" id="transfer" tabindex="37" name="transfer" level="parent" value="1" <?php echo $_isTransfer ?>> <h5>Incase of
				                                                                                   Transfer</h5>
			</div>
			<div class="checkbox">
                                        <span>
                                            <input type="checkbox" tabindex="38" class="transferChild" id="transfer-tc" name="transfer-tc" value="1" <?php echo ($rows['transfer_tc'] ==1)?"Checked":""; ?>> <label
		                                        class="control-label">Orginal
                                                                      Transfer Certificate</label>
                                        </span>
			</div>
			<div class="checkbox" style="margin-bottom: 20px">
                                         <span>
                                            <input type="checkbox" tabindex="39" class="transferChild" id="transfer-mc" name="transfer-mc" value="1" <?php echo ($rows['transfer_mc'] ==1)?"Checked":""; ?>> <label
		                                         class="control-label">Orginal
                                                                       Migration Certificate<br/>(If child has studied in another
                                                                       State/Country)</label>
                                        </span>
			</div>
			<div class="checkbox" style="margin-bottom: 20px">
                                         <span>
                                            <input type="checkbox" tabindex="40" class="transferChild" id="transfer-cc" name="transfer-cc" value="1" <?php echo ($rows['transfer_cc'] ==1)?"Checked":""; ?>> <label
		                                         class="control-label">Orginal
                                                                       Caste Certificate<br/>(If not specified in Transfer Certificate)</label>
                                        </span>
			</div>

		</fieldset>
	</div>
	<div class="span5 offset1">
		<div class="checkbox">
			<?php
				$_isFresh = ($rows['fresh_bc'] == 1 || $rows['fresh_cc'] == 1 ) ? "checked" : "";
			?>
			<input type="checkbox" tabindex="41" id="fresh" name="fresh" value="1" <?php echo $_isFresh ?>> <h5>Incase of Fresh
			                                                              Admission</h5>
		</div>
		<div class="checkbox">
                                        <span>
                                            <input type="checkbox" tabindex="42" id="fresh-bc" name="fresh-bc" value="1" <?php echo ($rows['fresh_bc'] ==1)?"Checked":""; ?>> <label
		                                        class="control-label">Orginal
                                                                      Birth Certificate</label>
                                        </span>
		</div>
		<div class="checkbox">
                                         <span>
                                            <input type="checkbox" tabindex="43" id="fresh-cc" name="fresh-cc" value="1" <?php echo ($rows['fresh_cc'] ==1)?"Checked":""; ?>> <label
		                                         class="control-label">Orginal
                                                                       Caste Certificate (In case of SC/ST Only)</label>
                                        </span>
		</div>

	</div>

</div>
<div class="form-actions stdFormAction">
	<button type="reset" class="btn" tabindex="45" id="cancel">Cancel</button>
	<button type="button" class="btn btn-primary" tabindex="44" id="save">Update</button>
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