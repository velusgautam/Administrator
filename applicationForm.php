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
	<?php include_once('includes/menu.php');
		$countQuery = "Select application_no+1 as count FROM " . TABLE_NEW_APPLICATION . " ORDER by application_no DESC";
//        if($countQuery == 0 || $countQuery == null)
//            $countQuery = 1;
		$applicationNo = $db->query_first($countQuery);
	?>
	<div class="row-fluid">
		<div class="span12">
			<div id='preview'></div>
			<div class="top-bar">
				<h3><i class="icon-user"></i>Application Registration</h3>
			</div>
			<div class="well no-padding">
				<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
				      action="adminBusinessLogic/applicationSave.php">
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
									<span id="wait_1" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
								</div>
							</div>
							<script type="text/javascript">
								$("#schoolName").change(function () {
									var id = $(this).val();
									var dataString = 'id=' + id;
									$.ajax
									({
										type: "POST",
										url: "projectinc/ajax-admin-class.php",
										data: dataString,
										cache: false,
										success: function (html) {
											$("#classDiv").html(html);
										}
									});
								});
							</script>
						<?php
						} else {
							?>
							<input type="hidden" value="<?php echo $_SESSION['SchoolCode'] ?>" name="schoolCode">
						<?php
						}
					?>
					<div class="control-group headings">
						<div align="center">
							<h5>Application Details (Form No: <?php echo $applicationNo['count']; ?>)</h5>
							<input type="hidden" value="<?php echo $applicationNo['count']; ?>" name="applicationNo">
						</div>
					</div>
					<div class="control-group">

						<div class="span3">
							<label class="control-label">Application Date:</label>

							<div class="controls">
								<input class="datepicker" style="width: 100px" type="text" tabindex="2" id="date" value="<?php echo date("d-m-Y"); ?>"
								       name="date" autocomplete="off"/>
							</div>
						</div>
						<div class="span3">
							<label class="control-label">Academic Year:</label>

							<div class="controls">
								<select class="input-block-level" data-placeholder="Choose a Academic Year" tabindex="3"
								        name="academicYear" id="academicYear" style="width: 140px">
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
						<div class="span3">
							<div class="span6">
								<label class="control-label">Application Form No:</label>
							</div>
							<div class="controls">
								<input style="width: 80px; margin-left: 20px;" type="text" tabindex="4" id="formNo" autocomplete="off" name="formNo"/>
								<script type="text/javascript">
									var formNo = new LiveValidation("formNo", { validMessage: " ", wait: 500 });
									formNo.add(Validate.Presence, { failureMessage: "Please Enter Application Form Serial No." });
								</script>
							</div>
						</div>
						<div class="span3">
							<label class="control-label">Type:</label>

							<div class="controls">
								<div class="span4">
									<label class="radio" style="margin-left: -40px;margin-top: 5px;"><span><input type="radio" name="type" tabindex="5" value="1" checked></span>
										New</label>
								</div>
								<div class="span6">
									<label class="radio" style="margin-left: -25px;margin-top: 5px;"><span><input type="radio" name="type" tabindex="6" value="2"></span> ReAdmission</label>
								</div>

							</div>
						</div>
					</div>

					<div class="control-group headings">
						<div align="center ">
							<h5>Personal Details</h5>
						</div>

					</div>
					<div class="control-group">

						<div class="span6">
							<label class="control-label">Student Name:</label>

							<div class="controls">
								<input type="text" class="input-block-level ap-form-input80" tabindex="7" id="name" placeholder="Student Name" name="name">
								<script type="text/javascript">
									var studName = new LiveValidation("name", { validMessage: " ", wait: 500 });
									studName.add(Validate.Presence, { failureMessage: "Please Enter Name." });
								</script>
							</div>
						</div>
						<?php
							$classCount = 1;
							if($_SESSION['Role'] == 2)
							{
								$data = $db->query_first("Select Count(DISTINCT stream_id) as count from ".TABLE_CLASS_MAPPING." WHERE schl_id=".$_SESSION['SchoolCode']."");
								if($data['count'] ==2)
								{
									$classCount = 2;
							?>
							<div class="span6" >
								<div class="span5">
									<div class="span3">
										<label class="control-label">Stream:</label>
									</div>
									<div class="controls" style="margin-left: 80px">
									<select class="input-block-level ap-form-input80" tabindex="8"
									        name="streamApplied" id="streamApplied">
										<option value="1">STATE</option>
										<option value="2">ICSE</option>
									</select>
										<script type="text/javascript">
											$("#streamApplied").change(function () {
												var streamId = $(this).val();
												var id = <?php echo $_SESSION['SchoolCode']?>;
												var dataString = 'id=' + id+'& sid='+streamId;
												$.ajax
												({
													type: "POST",
													url: "projectinc/ajax-class.php",
													data: dataString,
													cache: false,
													success: function (html) {
														$("#classApplied").html(html);
													}
												});
											});
										</script>
										</div>
								</div>
								<div class="span7">
									<div class="span3">
										<label class="control-label">Class Applied For:</label>
									</div>
									<div class="controls">
										<select class="input-block-level ap-form-input80" tabindex="8" placeholder="Class Applied For"
										        name="classApplied" id="classApplied">
											<?php
												if($_SESSION['Role'] == 2)
												{

													$sql_1 = "SELECT class_id, class_name FROM `".TABLE_CLASS."` WHERE class_id IN (Select DISTINCT class_id from ".TABLE_CLASS_MAPPING." WHERE schl_id=".$_SESSION['SchoolCode']." AND
													stream_id = 1 ) ORDER BY class_name ASC";

													$result = $db->query($sql_1);
													echo '<option value="All"  selected="selected">Select Class</option>';
													while($classSelect = $db->fetch_array( $result ))
													{
														echo '<option value="'.$classSelect['class_id'].'">'.$classSelect['class_name'].'</option>';
													}

												}
											?>
										</select>
									</div>
								</div>
							</div>
							<?php
								}
							}
							if($classCount == 1)
							{
							if($_SESSION['Role'] == 2)
							{
								$sData = $db->query_first("Select DISTINCT stream_id as streamId from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $_SESSION['SchoolCode'] . "");
								echo "<input type='hidden' value='" . intval(trim($sData['streamId'])) . "' name='streamApplied'>" . PHP_EOL;
							}
							?>
						<div class="span6" id="classDiv">
							<div class="span3">
								<label class="control-label">Class Applied For:</label>
							</div>
							<div class="controls">
								<select class="input-block-level ap-form-input80" tabindex="8" placeholder="Class Applied For"
								        name="classApplied" id="classApplied">

									<?php
										if($_SESSION['Role'] == 2)
										{

											$sql_1 = "SELECT class_id, class_name FROM `".TABLE_CLASS."` WHERE class_id IN (Select DISTINCT class_id from ".TABLE_CLASS_MAPPING." WHERE schl_id=".$_SESSION['SchoolCode'].") ORDER BY class_name
										ASC";

											$result = $db->query($sql_1);
											echo '<option value="All"  selected="selected">Select Class</option>';
											while($classSelect = $db->fetch_array( $result ))
											{
												echo '<option value="'.$classSelect['class_id'].'">'.$classSelect['class_name'].'</option>';
											}

										}
									?>
								</select>
								<?php
									if($_SESSION['Role'] == 2)
									{
										if($db->affected_rows ==0)
										{
											echo '<span class=" LV_validation_message LV_invalid"> No Class Defied for this School. Please contact Administrator.</span>';
										}
									}
								?>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="control-group">
						<div class="span6">
							<label class="control-label">Contact Name:</label>

							<div class="controls">
								<input type="text" class="input-block-level ap-form-input80" tabindex="9" placeholder="Contact Name" name="contactName" id="contactName">
								<script type="text/javascript">
									var contactName = new LiveValidation('contactName', { validMessage: " ", wait: 500 });
									contactName.add(Validate.Presence, { failureMessage: "Enter Contact Name" });
								</script>
							</div>
						</div>
						<div class="span6">
							<div class="span3">
								<label class="control-label">Contact Number:</label>
							</div>
							<div class="controls">
								<input type="text" class="input-block-level ap-form-input80" id="contactNumber" tabindex="10" placeholder="Contact Number"
								       name="contactNumber">
								<script type="text/javascript">
									var contactNumber = new LiveValidation('contactNumber', { validMessage: " ", wait: 500 });
									contactNumber.add(Validate.Presence, { failureMessage: " Contact Number is Missing" });
									contactNumber.add(Validate.Numericality, { failureMessage: " Contact Number should be a number." });
									contactNumber.add(Validate.Exclusion, { within: [ ',', '@', '!', '`', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '}', '{', ']', '[', '"', ';', ':', "'", '/' ], partialMatch: true, failureMessage: "Please Enter only Numbers" });
									contactNumber.add(Validate.Length, { minimum: 10, maximum: 10 });
								</script>
							</div>
						</div>

					</div>

					<div class="form-actions stdFormAction">
						<button type="reset" class="btn" tabindex="12" id="cancel">Cancel</button>
						<button type="button" class="btn btn-primary" tabindex="11" id="save">Save</button>
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