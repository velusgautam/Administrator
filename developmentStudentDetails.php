<?php
	include_once('adminBusinessLogic/developmentSecurity.php');
	include_once('includes/headerPhp.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		require_once("includes/headerMeta.php");
		require_once("includes/headerStyles.php");
		require_once("includes/headerScripts.php");

		$id = intval($_GET['id']);

		$sql = "SELECT TS.student_id, TS.date, TS.academic_year, TS.admission_id,  TS.stream_id, TS.student_name, TS.schl_id, TS.class_id, TS.division_id,  TS.status, TA.transfer_tc, TA.transfer_mc, TA.transfer_cc,
				TA.fresh_bc, TA.fresh_cc, TC.class_name, TD.division_name, TSS.school_code, TA.tcdate, TA.admin_no, TA.admission_date, TA.standard_leaving, TA.prev_school,
				TA.taluk, TA.place, TA.district, TA.mothertongue, TA.religion, TA.caste, TA.dob, TA.gender, TA.placeofbirth, TA.nationality, TA.whethersct, TA.father_name, TA.father_qualification,
				TA.father_occupation, TA.mother_name, TA.mother_qualification, TA.mother_occupation,TA.annual_income, TA.noofsis, TA.noofbro, TA.father_email, TA.permanent_address, TA.father_phone, TA.resi_no
				FROM " . TABLE_STUDENT . " TS
				INNER JOIN " . TABLE_ADMISSION_FORM . " TA ON TA.`id` = TS.`admission_id`
				INNER JOIN " . TABLE_SCHOOL . " TSS ON TSS.schl_id = TS.schl_id
				INNER JOIN " . TABLE_CLASS . " TC ON TC.class_id = TS.class_id
				INNER JOIN " . TABLE_DIVISION . " TD ON TD.division_id = TS.division_id
				WHERE student_id ='" . $id . "'";

		$rows = $db->query_first($sql);

	?>

</head>
<body class="inside-body">
<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>
<?php include_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
	<?php include_once('includes/developmentMenu.php'); ?>
	<div class="row-fluid">
		<div class="span12">

			<div class="top-bar">
				<h3><i class="icon-user"></i>STUDENT DETAILS</h3>
			</div>
			<div class="well no-padding">
				<div class="control-group" style="min-height: 30px">




					<div class="span12 text-right"><a href="developmentPreviousFeeListing.php?id=<?php echo $rows['student_id'] ?>">
							<button class="btn-inverse btn">Previous Development Receipts</button>
						</a></div>
				</div>
				<div class="control-group" style="min-height: 30px">
					<div class="span10" style="text-align: left"><h4>STUDENT DETAILS OF : <strong><?php echo $rows['student_name'] ?></strong></h4></div>
					<div class="btn-group" style="margin-left: 120px;"> <a href="developmentStudentListing.php" > <div class=" btn-large btn-success" >Back</div></a>
					</div>
				</div>
				<div class="control-group" style="background-color: #FFF7CA;padding: 5px 0px;">
					<div style="text-align: center"><h5>Academic Details</h5></div>
				</div>
				<div class="control-group" style="min-height: 20px">

					<div class="span6"><label class="control-label"><span style="font-weight: 100">Academic Year:</span> <?php echo $rows['academic_year']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Admission Date:</span> <?php echo date("d-M-Y", strtotime($rows['date'])); ?></label></div>

				</div>
				<div class="control-group" style="min-height: 20px">

					<div class="span3"><label class="control-label"><span style="font-weight: 100">Name:</span> <?php echo $rows['student_name']; ?></label></div>

					<div class="span3"><label class="control-label"><span style="font-weight: 100">School:</span> <?php echo $rows['school_code']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Class :</span> <?php echo $rows['class_name']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Division :</span> <?php echo $rows['division_name']; ?></label></div>

				</div>
				<div class="control-group" style="background-color: #FFF7CA;padding: 5px 0px;">
					<div style="text-align: center"><h5>Documents Submitted</h5></div>
				</div>
				<?php
					if ($rows['transfer_mc'] == 1 || $rows['transfer_cc'] == 1 || $rows['transfer_tc'] == 1) {
						?>
						<div class="control-group" style="min-height: 40px">
							<div class="span4"><label class="control-label"><span style="font-weight: 100">Original Transfer Certificate:</span> <?php echo ($rows['transfer_tc']) ? " Yes" : " No"; ?></label></div>
							<div class="span4"><label class="control-label"><span style="font-weight: 100">Original Migration Certificate <br>
							                                                 (If child has studied in another State/Country) :</span>
									<?php echo ($rows['transfer_mc']) ? " Yes" : " No"; ?></label></div>
							<div class="span4"><label class="control-label"><span style="font-weight: 100">Original Caste Certificate<br/>
							                                                 (If not specified in Transfer Certificate) :</span>
									<?php echo ($rows['transfer_cc']) ? " Yes" : " No"; ?></label></div>

						</div>
					<?php
					}
					if ($rows['fresh_bc'] == 1 || $rows['fresh_cc'] == 1) {
						?>
						<div class="control-group" style="min-height: 40px">
							<div class="span6"><label class="control-label"><span style="font-weight: 100">Original Birth Certificate:</span> <?php echo ($rows['fresh_bc']) ? " Yes" : " No"; ?></label></div>
							<div class="span6"><label class="control-label"><span style="font-weight: 100">Original Caste Certificate (In case of SC/ST Only):</span>
									<?php echo ($rows['fresh_cc']) ? " Yes" : " No"; ?></label></div>

						</div>
					<?php
					}
				?>
				<div class="control-group" style="background-color: #dcfff1;padding: 5px 0px;">
					<div style="text-align: center"><h5>Application Form Details</h5></div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span3"><label class="control-label"><span style="font-weight: 100"> Application Date:</span> <?php echo date('d-M-Y', strtotime($rows['admission_date'])); ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100"> Admission Number:</span> <?php echo $rows['admin_no']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100"> Previous Class :</span> <?php echo $rows['standard_leaving']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100"> TC No & Date :</span> <?php echo $rows['tcdate']; ?></label></div>

				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span12"><label class="control-label"><span style="font-weight: 100">Medium of instruction,the pupil had taken in the previous school:</span> <?php echo $rows['prev_school']; ?></label></div>

				</div>
				<div class="control-group" style="background-color: #e9ffda;padding: 5px 0px;">
					<div style="text-align: center"><h5>Personal Details</h5></div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Gender:</span> <?php echo $rows['gender']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">DOB:</span> <?php echo date("d-m-Y", strtotime($rows['dob'])); ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Nationality :</span> <?php echo $rows['nationality']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Place of Birth :</span> <?php echo $rows['placeofbirth']; ?></label></div>

				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Taluk/District:</span> <?php echo $rows['talukdist']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Mother Tongue:</span> <?php echo $rows['mothertongue']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Religion :</span> <?php echo $rows['religion']; ?></label></div>
					<div class="span3"><label class="control-label"><span style="font-weight: 100">Caste & Sub Caste :</span> <?php echo $rows['caste']; ?></label></div>

				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span12">
						<label class="control-label"><span style="font-weight: 100">Whether Schedule Caste/Tribe (If Yes,Please Specify):</span> <?php echo $rows['whethersct']; ?></label>
					</div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Father Name: </span> <?php echo $rows['father_name']; ?></label></div>
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Mother Name:</span> <?php echo $rows['mother_name']; ?></label></div>



				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Father Qualification:</span> <?php echo $rows['father_qualification']; ?></label></div>
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Mother Qualification:</span> <?php echo $rows['mother_qualification']; ?></label></div>


				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Father Occupation:</span> <?php echo $rows['father_occupation']; ?></label></div>
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Mother Occupation:</span> <?php echo $rows['mother_occupation']; ?></label></div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Father Phone:</span> <?php echo $rows['father_phone']; ?></label></div>
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Mother Phone:</span> <?php echo $rows['mother_phone']; ?></label></div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Father Email:</span> <?php echo $rows['father_email']; ?></label></div>
					<div class="span6"><label class="control-label"><span style="font-weight: 100">Mother Email:</span> <?php echo $rows['mother_email']; ?></label></div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span4"><label class="control-label "><span style="font-weight: 100">Number Of Brothers:</span> <?php echo $rows['noofbro']; ?></label></div>
					<div class="span4"><label class="control-label"><span style="font-weight: 100">Number Of Sisters:</span> <?php echo $rows['noofsis']; ?></label></div>
					<div class="span4"><label class="control-label"><span style="font-weight: 100">Parent Annual Income:</span> <?php echo $rows['annual_income']; ?></label></div>

				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span12">
						<label class="control-label"><span style="font-weight: 100">Permanent Address:</span> <?php echo $rows['permanent_address']; ?></label>
					</div>
				</div>
				<div class="control-group" style="min-height: 20px">
					<div class="span4"><label class="control-label"><span style="font-weight: 100">Residence Number:</span> <?php echo $rows['resi_no']; ?></label></div>
					<div class="span4"><label class="control-label"><span style="font-weight: 100">Office Number:</span> <?php echo $rows['resi_no']; ?></label></div>

				</div>
				<div class="control-group" style="min-height: 20px">
				</div>
			</div>
		</div>
	</div>
</div>


<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>