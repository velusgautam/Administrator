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


		$sql = "SELECT  TA.id, TSH.school_name, TSH.school_code, TA.admin_no, TA.id, TS.student_name, TA.gender, TA.nationality, TA.religion ,
		TA.caste, TA.father_name, TA.mother_name, TA.whethersct, DATE_FORMAT(TA.dob,'%d-%m-%Y') as dob, TA.placeofbirth, TA.taluk, TA.district, TA.place, DATE_FORMAT(TS.date,'%d-%m-%Y') as date,
		TA.admission_date,TC.`class_name`,TD.`division_name` FROM " . TABLE_STUDENT . " TS
		        INNER JOIN " . TABLE_SCHOOL . " TSH ON TS.schl_id = TSH.schl_id
		        INNER JOIN " . TABLE_CLASS . " TC ON TS.class_id = TC.class_id
		        INNER JOIN " . TABLE_DIVISION . " TD ON TS.division_id = TD.division_id
		        INNER JOIN " . TABLE_ADMISSION_FORM . " TA ON TA.id = TS.admission_id
		        WHERE TS.student_id = " . $id;

		$rows = $db->query_first($sql);
		if ($db->affected_rows == 0) {
			//redirect_to('studentListing.php');
		}




	?>
	<script type="text/javascript">
		$(document).ready(function () {

			$('#save').click('change', function () {
				$("#preview").html('');
				$("#save").css("display", "none");
				$("#cancel").css("display", "none");
				$("#loading").css("display", "");
				$("#loading").html('<img src="assets/img/loader.gif" alt="Sending.."/>');
				$("#generateTc").ajaxForm({
					target:  '#preview',
					success: function (html) {
						$("#save").css("display", "");
						$("#cancel").css("display", "");
						$("#loading").css("display", "none");
						$('html').animate({scrollTop: 0}, 'slow');
						$('body').animate({scrollTop: 0}, 'slow');
						var content = $("#preview1");
						
					}}).submit();
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
			<form id="generateTc" method="post" class="form-horizontal" enctype="multipart/form-data" action="adminBusinessLogic/studentTCSave.php">
				<div class="top-bar">
					<h3><i class="icon-user"></i>TRANSFER CERTIFICATE</h3>
				</div>
				<div class="well no-padding">
					<table width="100%">
						<tbody>
						<tr>
							<td style="float: right; padding-top: 15px; ">
								<div class="btn-group" style="padding-right:125px;"> <a href="studentDetails.php?id=<?php echo $id?>" > <div class=" btn-large btn-success" style="color: #000" >Back</div></a>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
					<div class="widget-box">
						<div class="span12 text-center"><h4>TRANSFER CERTIFICATE OF <?php echo $rows['student_name']; ?></h4></div>
						<div id="receipt" style="margin:15px;">
							<br>
							<input type="hidden" value="<?php echo $id;?>" name="studentId">
							<div style="font-family:'Segoe UI'; font-size:14px;  margin:0 auto; padding:20px; padding-top: 45px">
								<table style="width: 100%">
									<tr>
										<td colspan="2" style="text-align: center;" >
											<div style=" margin-bottom: 30px">TC NUMBER: <input type="text" tabindex="1" id="tc_number" name="tc_number" style="width: 250px;" value=""></div>
											<script type="text/javascript">
												var tc_number = new LiveValidation("tc_number", { validMessage: " ", wait: 500 });
												tc_number.add(Validate.Presence, { failureMessage: "Please Enter Transfer Certificate Number." });
											</script>
										</td>
									</tr>
									<tr>
										<td style="width: 50%; vertical-align: top">
											<div style="padding-top: 5px">1. Name of School : <input type="text" tabindex="1" name="school_name" style="width: 250px" value="<?php echo $rows['school_name']; ?>"></div>
										</td>
										<td style="width: 50%">
											16. In Case of Pupil of Higher Standards
											<div style=" text-align: right; padding-right: 40px; padding-bottom: 30px">a) Language Studied : <input name="hs_language" type="text"  tabindex="18" style="width: 250px" value=""></div>
											<div style=" text-align: right; padding-right: 40px">b) Electives Studied : <input type="text"  name="hs_electives" style="width: 250px" tabindex="19"  value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 35px; text-align: left; padding-bottom: 20px">2. Admission Number : <input type="text" name="admin_no" style="width: 200px"  tabindex="2" value="<?php echo $rows['admin_no']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 40px; text-align: left; padding-right: 20px; padding-bottom: 10px">17. Medium of Instruction : <input  tabindex="20" type="text" style="width: 250px" id="medium_of_instruction"
											                                                                                                                                 name="medium_of_instruction" value=""></div>
											<script type="text/javascript">
												var medium_of_instruction = new LiveValidation("medium_of_instruction", { validMessage: " ", wait: 500 });
												medium_of_instruction.add(Validate.Presence, { failureMessage: "Please Enter Medium of Instruction." });
											</script>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">3. Cumilative Record No : <input type="text" style="width: 200px" name="cumilative_recordno"  tabindex="3"  value="<?php echo $rows['id']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">18. Date of Admission or Promotion to that Class or Standard : <input class="datepicker" type="text" style="width:
											120px"  tabindex="21" name="doa" value="<?php echo $rows['date']; ?>"></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">4. Name of Pupil in full : <input type="text"  tabindex="4" name="student_name"style="width: 250px" value="<?php echo $rows['student_name']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">19. Whether the pupil has paid all the fees due to the School : <input type="text" style="width:120px"  tabindex="22" name="fee_dues" value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">5. Sex : <input type="text" tabindex="5"  name="gender" style="width: 250px" value="<?php echo $rows['gender']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">20. Fees concessions, if any (nature & period to be specified) : <br><input type="text" style="width:420px" tabindex="23"  name="fee_concessions" value=""></div>
										</td>
									</tr>
									<tr>
										<td>

											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">6. Nationality <input type="text" tabindex="6"  style="width: 250px" name="nationality" value="<?php echo $rows['nationality']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">21. Scholarship if any(nature & period to be specified) : <br><input type="text" style="width:420px"  tabindex="24" name="scholarship" value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">7. Religion : <input type="text" tabindex="7"  style="width: 250px" name="religion" value="<?php echo $rows['religion']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">22. Whether medically examined or not :
												<select  tabindex="25" name="medicalExamined" style="width: 100px">
													<option selected></option>
													<option>Yes</option>
													<option>No</option>
													</select>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">8. Caste : <input type="text" tabindex="8"  style="width: 250px" name="caste" value="<?php echo $rows['caste']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">23. Date of pupil's last attendance at the School : <input class="datepicker"  type="text" style="width:120px"  tabindex="26"  name="date_last_attendence" value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">9. Name of Father : <input type="text" tabindex="9"  style="width: 250px" name="father_name" value="<?php echo $rows['father_name']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">24. Date on which  the application for the TC was received:
												<input type="text" class="datepicker" name="tcapplication_date"  tabindex="27" style="width:120px" value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">10. Name of Mother : <input type="text" tabindex="10"  style="width: 250px" name="mother_name" value="<?php echo $rows['mother_name']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">25. Date of issue of the Transfer Certificate:
												<input class="datepicker" name="dot" type="text" style="width:120px"  tabindex="28" value="<?php echo date("d-m-Y"); ?>"></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">11. Whether the candidate belongs to Schedule caste or Schedule tribe : <input type="text" style="width: 50px" tabindex="11"  value="<?php echo $rows['whethersct']; ?>" name="whethersct"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">26. Number of School Days up to the date of Leaving:
												<input type="text"  tabindex="29"  name="no_schooldays" style="width:120px" value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-bottom: 20px">12. Whether qualified for promotion to a higher standard :
												<select  tabindex="12" name="whetherqualified" style="width: 100px">
													<option selected></option>
													<option>Yes</option>
													<option>No</option>
												</select>

											</div>
										</td>
										<td>
											<div style="margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">27. Number of School Days the pupil attended:
												<input type="text"  tabindex="30" name="no_schooldays_attended" style="width:120px" value=""></div>
										</td>
									</tr>
									<tr>
										<td>
											<div style="margin-top: 25px; text-align: left; padding-bottom: 20px">13. Student Date of Birth : <input type="text" tabindex="13" class="datepicker" style="width: 150px" name="dob" value="<?php echo $rows['dob']; ?>"></div>
										</td>
										<td>
											<div style="  margin-top: 25px; text-align: left; padding-right: 10px; padding-bottom: 20px">28. Character and Conduct
												<input type="text"  tabindex="31" name="conduct" style="width:300px" value=""></div>
										</td>
									</tr>

									<tr>
										<td>
											<div style="margin-top: 20px; text-align: left;  padding-bottom: 20px">
												14.
												<span style="padding-left:70px; ">Place</span>
												<span style="padding-left: 140px; ">Taluk</span>
												<span style="padding-left: 140px; ">District</span><br>
												<span style="padding-left:20px; "><input type="text" style="width: 140px" name="place"  tabindex="14"  value="<?php echo $rows['place']; ?>"></span>
												<span style="padding-left: 10px; "><input type="text" style="width: 140px" name="taluk"  tabindex="15" value="<?php echo $rows['taluk']; ?>"></span>
												<span style="padding-left: 20px; "><input type="text" style="width: 140px" name="district" tabindex="16"  value="<?php echo $rows['district']; ?>"></span>

											</div>
										</td>
										<td>

										</td>
									</tr>
									<tr>
										<td>
											<div style="margin-top: 25px; text-align: left; padding-bottom: 20px">15. Standard in which the pupil was reading at the time of leaving the school (In Words) :
												<input type="text" name="standard_leaving" style="margin-left:20px; width:150px"  tabindex="17"   value="<?php echo $rows['class_name'];?>"></div>

										</td>
										<td style="text-align: right">
<!--											<input type="submit" id="save" class="btn btn-primary" tabindex="100" style="width: 80px; height: 40px; font-size: 16px" value="Save">-->
                                            <button type="button" class=" btn-primary btn-large" tabindex="35" id="save">Generate TC</button>
										</td>
									</tr>
								</table>

							</div>
						</div>

					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
<script type="text/javascript">
		document.getElementById("tc_number").focus();
</script>
</html>