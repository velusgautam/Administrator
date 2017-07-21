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
		$id = $_GET['id'];
		$id = intval($id);
		if ($id < 0 || $id == 0) {
			redirect_to('studentDetails.php');
		}


		$sql = "SELECT  TS.academic_year, TS.registered_academic_year , TA.id, TSH.school_name, TSH.school_code, TA.admin_no, TA.id, TS.student_name, TA.gender, TA.nationality, TA.religion ,
		TA.caste, TA.father_name, TA.mother_name, TA.whethersct, DATE_FORMAT(TA.dob,'%d-%m-%Y') as dob, TA.placeofbirth, DATE_FORMAT(TS.date,'%d-%m-%Y') as date, TS.registered_date,
		TS.registered_class, TA.admission_date,TC.`class_name`,TD.`division_name` FROM " . TABLE_STUDENT . " TS
		        INNER JOIN " . TABLE_SCHOOL . " TSH ON TS.schl_id = TSH.schl_id
		        INNER JOIN " . TABLE_CLASS . " TC ON TS.class_id = TC.class_id
		        INNER JOIN " . TABLE_DIVISION . " TD ON TS.division_id = TD.division_id
		        INNER JOIN " . TABLE_ADMISSION_FORM . " TA ON TA.id = TS.admission_id
		        WHERE TS.student_id = " . $id;

		$rows = $db->query_first($sql);
		if ($db->affected_rows == 0) {
			//redirect_to('studentCertificateListing.php');
		}




	?>
	<style>
		.LV_valid {
			display: none!important;
		}.LV_invalid {
			display: none!important;
		}
	</style>
</head>
<body class="inside-body">
<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>
<?php include_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
	<?php include_once('includes/menu.php'); ?>
	<div class="row-fluid">
		<div class="span12">

			<div class="top-bar">
				<h3><i class="icon-user"></i>STUDY CERTIFICATE</h3>
			</div>
			<div class="well no-padding">
				<form id="generateTc" method="post" class="form-horizontal" enctype="multipart/form-data" action="adminBusinessLogic/schoolCertificateSave.php">
					<?php
						if (isset($_SESSION['SCError'])) {
							echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $_SESSION['SCError'] . "</div><br>Please try again with filling every field correctly</div>";
							$_SESSION['SCError'] = null;
						}

					?>
					<table width="100%">
						<tbody>
						<tr>
							<td style="float: right; padding-top: 15px; ">
								<div class="btn-group" style="padding-right:125px;"><a href="studentDetails.php?id=<?php echo $id ?>">
										<div class=" btn-large btn-success" style="color: #000">Back</div>
									</a>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
					<div class="widget-box">
						<div class="span12 text-center"><h4>STUDY CERTIFICATE OF <?php echo $rows['student_name']; ?></h4></div>
						<div id="receipt" style="margin:15px;">
							<br>
							<input type="hidden" name="sid" value="<?php echo $id ?>">

							<div style="font-family:'Segoe UI'; font-size:14px;  margin:0 auto; padding:20px; padding-top: 45px">
								<table style="width: 100%">
									<tr>
										<td style="width: 50%; vertical-align: top">
											<div style="padding-top: 5px">Name :
												<input type="text" style="width: 250px" name="studName" id="studName" value="<?php echo $rows['student_name']; ?>"></div>
											<script type="text/javascript">
												var studName = new LiveValidation('studName', { validMessage: " ", wait: 500 });
												studName.add(Validate.Presence, { failureMessage: " " });

											</script>
										</td>
										<td style="width: 50%">
											<div style="padding-top: 5px">Son/Daugher of : <input name="sond" type="text" id="sond" style="width: 250px" value="<?php echo $rows['father_name']; ?>"></div>
											<script type="text/javascript">
												var sond = new LiveValidation('sond', { validMessage: " ", wait: 500 });
												sond.add(Validate.Presence, { failureMessage: " " });
											</script>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; ">From :
												<input type="text" style="width: 100px" name="fyear" id="fyear" value="<?php echo $rows['registered_academic_year']; ?>">
											                                                    to
												<input type="text" style="width: 100px" name="tyear" id="tyear" value="<?php echo $rows['academic_year']; ?>">
											</div>
											<script type="text/javascript">
												var fyear = new LiveValidation('fyear', { validMessage: " ", wait: 500 });
												fyear.add(Validate.Presence, { failureMessage: " " });
												var tyear = new LiveValidation('tyear', { validMessage: " ", wait: 500 });
												tyear.add(Validate.Presence, { failureMessage: " " });
											</script>
										</td>
										<td>
											<?php
												if(intval($rows['registered_class'])>0)
												$regClass = $db->query_first("Select class_name from " . TABLE_CLASS . " WHERE class_id =" . $rows['registered_class']);
											?>
											<div style="  margin-top: 35px; text-align: left; ">Studied From :
												<input type="text" style="width: 100px" name="sfrom" value="<?php echo strtoupper($regClass['class_name']) ?>" id="sfrom">
											                                                    to
												<input type="text" style="width:100px" name="sto" value="<?php echo $rows['class_name']; ?>" id="sto">

											</div>
											<script type="text/javascript">
												var sfrom = new LiveValidation('sfrom', { validMessage: " ", wait: 500 });
												sfrom.add(Validate.Presence, { failureMessage: " " });
												var sto = new LiveValidation('sto', { validMessage: " ", wait: 500 });
												sto.add(Validate.Presence, { failureMessage: " " });
											</script>
										</td>
									</tr>
									<tr>
										<td>
											<div style=" margin-top: 25px;  text-align: left;  ">
												Date of Birth :
												<input type="text" class="datepicker" name="dob" id="dob" style="width: 100px" value="<?php echo $rows['dob']; ?>">
												<script type="text/javascript">
													var dob = new LiveValidation('dob', { validMessage: " ", wait: 500 });
													dob.add(Validate.Presence, { failureMessage: "Please Enter DOB." });
												</script>

											</div>
										</td>
										<td>
											<div style="  margin-top: 35px; text-align: left; ">
												Conduct of Student : <input type="text" name="conduct" id="conduct" style="width: 300px">
												<script type="text/javascript">
													var conduct = new LiveValidation('conduct', { validMessage: " ", wait: 500 });
													conduct.add(Validate.Presence, { failureMessage: " " });
												</script>
											</div>
										</td>
									</tr>

									<tr>
										<td>

										</td>
										<td style="text-align: right">
											<input type="submit" id="save" class="btn btn-primary" tabindex="100" style="width: 80px; height: 40px; font-size: 16px" value="Save">
										</td>
									</tr>
								</table>

							</div>
						</div>

					</div>
				</form>

				<div style="width: 97%; padding: 0 18px">

					<div class="top-bar">
						<h3><i class="icon-user"></i>Previous Study Certificates</h3>
					</div>
					<div class="well no-padding">
						<div class="span12">
							<div style="margin: 15px">
								<table style="width: 100%; border-radius: 5px; background-color: #f5f5f5; margin-top: 5px; "
									>
									<thead>
									<tr style="height:45px; border-bottom: 1px solid #C8C8C8;">
										<th>Sl.No</th>
										<th>Date</th>
										<th>Name</th>
										<th>Son of</th>
										<th>Conduct of Student</th>
										<th>Print</th>
									</tr>

									</thead>
									<?php
										$sql = "Select DATE_FORMAT(date,'%d-%m-%Y') as date, id,  student_name,father_name, student_id, conduct FROM " . TABLE_SCHOOL_CERTIFICATE . " WHERE student_id = " . intval(trim($_GET['id'])) . " ORDER BY
										 id
										DESC";
										$resultSchoolCer = $db->query($sql);
										$i = 1;
										while ($schoolCer = $db->fetch_array($resultSchoolCer)) {
											?>
											<tr style="height: 40px; color: #1a1a1a; font-family: 'Segoe UI Semibold'; <?php if ($i % 2 == 0) echo "background-color: #eeeeee"; ?>">
												<td style="text-align: center"><?php echo $i; ?></td>
												<td style="text-align: center"><?php echo $schoolCer['date']; ?></td>
												<td style="text-align: center"><?php echo $schoolCer['student_name']; ?></td>
												<td style="text-align: center"><?php echo $schoolCer['father_name']; ?></td>
												<td style="text-align: center"><?php echo $schoolCer['conduct']; ?></td>
												<td style="text-align: center"><?php echo "<button onclick=\"if(confirm('Are you sure you want to Print Previous Study Certificate?'))  window.location = 'printSchoolCertificate.php?studid=" . $schoolCer['student_id'] . "&id=" . $schoolCer['id'] . "'\" title=\"Click to Print Study Certificate\"  class='btn-sm btn-info'>Print </button>"; ?></td>

											</tr>
											<?php
											$i++;
										}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>


<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>