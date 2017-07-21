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


		if (!isset($_GET[id]) || $_GET[id] <= 0) {
			redirect_to('studentListing.php');
		} else {

			$sql_1 = "SELECT student_id, date, academic_year, admission_id,  stream_id, student_name, schl_id, class_id, division_id,  status
         FROM `" . TABLE_STUDENT . "` WHERE student_id ='" . $_GET['id'] . "'";
			$studentData = $db->query_first($sql_1);
			$data = $db->query_first("Select ts.`school_name`, ta.* from " . TABLE_ADMISSION_FORM . " ta INNER JOIN " . TABLE_SCHOOL . " ts ON ts.schl_id = ta.school_code where ta.`id`=" . intval($studentData['admission_id']));
		}
	?>
	<script type="text/javascript">
		$(document).ready(function () {

			$('#save').click('change', function () {
				if(confirm('Do you really want to submit the form?')){
				$("#preview").html('');
				$("#save").css("display", "none");
				$("#cancel").css("display", "none");
				$("#loading").css("display", "");
				$("#loading").html('<img src="assets/img/loader.gif" alt="Updating.."/>');
				$("#studentForm").ajaxForm({
					target:  '#preview',
					success: function (html) {
						$("#save").css("display", "");
						$("#cancel").css("display", "");
						$("#loading").css("display", "none");
						$('html').animate({scrollTop: 0}, 'slow');
						$('body').animate({scrollTop: 0}, 'slow');
						var content = $("#preview1");

					}
				}).submit();
				}
			});

			$('#streamSelect').change(function () {

				$('#wait_1').show();
				$.get("projectinc/studentRegDD.php", {
					func:     "classSelect",
					drop_var: $('#streamSelect').val() + "~" + "<?php echo $data['school_code'] ;?>"
				}, function (response) {
					setTimeout("finishAjax('result_2', '" + escape(response) + "')", 100);
				});
				return false;
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
	include_once('includes/topBody.php');
	include_once("includes/topMessagesBar.php");
	include_once("includes/topNewMessagesBar.php");
?>
<div class="container">
	<?php include_once('includes/menu.php'); ?>

	<div class="row-fluid">
		<div class="span12">
			<div id='preview'>
				<div class="alert alert-warning alert-block">
					<a class="close" data-dismiss="alert" href="#">x</a>
					<h4 class="alert-heading">WARNING!!!</h4>
					<table border="0" width="100%">
						<tbody><tr><td width="80%">The Data Updated here is permanent. Please confirm your change!!!</td>

						</tr></tbody></table></div>
			</div>

			<div class="top-bar">
				<h3><i class="icon-user"></i>Student Update</h3>
			</div>
			<div class="well no-padding">
				<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
				      action="adminBusinessLogic/studentUpdate.php" >

					<?php
						//print_r($studentData);
						echo "<input type='hidden' value='" . $studentData['admission_id'] . "' name='applicationId'>" . PHP_EOL;
						echo "<input type='hidden' value='" . $data['school_code'] . "' name='schlId'>" . PHP_EOL . PHP_EOL;
//						echo "<input type='hidden' value='" . $data['name'] . "' name='studentName'>" . PHP_EOL . PHP_EOL;
						echo "<input type='hidden' value='" . $data['academic_year'] . "' name='academicYear'>" . PHP_EOL . PHP_EOL;
						echo "<input type='hidden' value='" . $studentData['student_id'] . "' name='updateId'>" . PHP_EOL . PHP_EOL;

					?>

					<div class="control-group">
						<div align="center"><h5><?php echo $data['school_name'] ?></h5></div>
					</div>
					<div class="control-group">
						<div class="span3"><label class="control-label">Name: <?php echo "<input type='text' value='" . $data['name'] . "' name='studentName'>" . PHP_EOL . PHP_EOL; ?></label></div>
						<div class="span3"><label class="control-label">Admission Date: <?php echo $data['admission_date']; ?></label></div>
						<div class="span3"><label class="control-label">Academic
						                                                Year: <?php echo $data['academic_year']; ?></label></div>

					</div>
					<div class="control-group">
						<div align="center"><h5>Academic Details</h5></div>
					</div>

					<div class="control-group">

						<div class="span4" id="result_1">
							<label class="control-label">Stream:</label>

							<div class="controls">
								<select class="input-block-level" data-placeholder="Choose a Stream" tabindex="1"
								        name="stream" id="streamSelect">
									<?php
										$streamRows = $db->query("Select DISTINCT(`stream_id`) FROM " . TABLE_CLASS_MAPPING . " WHERE `schl_id`=" . $studentData['schl_id']);
										while ($_streamRow = $db->fetch_array($streamRows)) {
											$_streamName = ($_streamRow['stream_id'] == "1") ? "STATE" : "ICSE";
											$_selected = ($_streamRow['stream_id'] == $studentData['stream_id']) ? " selected" : "";
											?>

											<option value="<?php echo $_streamRow['stream_id']; ?>" <?php echo $_selected; ?>><?php echo $_streamName; ?></option>
										<?php
										}
									?>
								</select>
							</div>
						</div>

						<div class="span4" id="result_2">
							<label class="control-label">Class:</label>

							<div class="controls">
								<select class="input-block-level" data-placeholder="Choose Standard" tabindex="2"
								        name="class" id="classSelect">
									<?php
										$classRows = $db->query("Select TC.`class_id`, TC.`class_name` FROM " . TABLE_CLASS . " TC WHERE class_id IN ( Select class_id from " . TABLE_CLASS_MAPPING . " TCM WHERE TCM.`schl_id`="
											. $studentData['schl_id'] . " AND TCM.stream_id=" . $studentData['stream_id'] . ")");
										while ($_classRow = $db->fetch_array($classRows)) {
											$_classSelected = ($_classRow['class_id'] == $studentData['class_id']) ? " selected" : "";
											?>
											<option value="<?php echo $_classRow['class_id']; ?>" <?php echo $_classSelected; ?>><?php echo $_classRow['class_name']; ?></option>
										<?php
										}
									?>
								</select>
							</div>
							<div id="classChange">
								<script type="text/javascript">
									$('#wait_3').hide();
									$('#classSelect').change(function(){
										$('#wait_3').show();


										$.get("projectinc/studentRegDD.php", {
											func: "division",
											drop_var: $('#classSelect').val()+"~"+ <?php echo $studentData['stream_id'] ;?>+"~"+<?php echo $data['school_code'] ;?>
										}, function(response){

											setTimeout("finishAjax_division('result_3', '"+escape(response)+"')", 0);
										});
										return false;
									});
								</script>
							</div>
						</div>

						<div class="span4" id="result_3">
							<label class="control-label">Division:</label>

							<div class="controls">
								<select class="input-block-level" data-placeholder="Choose Division" tabindex="3"
								        name="division" id="divisionSelect">
									<?php
										$divisionRows = $db->query("Select TD.`division_id`, TD.`division_name` FROM " . TABLE_DIVISION . " TD WHERE division_id IN ( Select division_id from " . TABLE_CLASS_MAPPING . " TCM WHERE TCM.`schl_id`="
											. $studentData['schl_id'] . " AND TCM.stream_id=" . $studentData['stream_id'] . " AND TCM.class_id=" . $studentData['class_id'] . ")");
										while ($_divisionRow = $db->fetch_array($divisionRows)) {
											$_divisionSelected = ($_divisionRow['division_id'] == $studentData['division_id']) ? " selected" : "";
											?>
											<option value="<?php echo $_divisionRow['division_id']; ?>" <?php echo $_divisionSelected; ?>><?php echo $_divisionRow['division_name']; ?></option>
										<?php
										}
									?>
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

									<option value="1" <?php echo ($studentData['status'] == 1) ? "selected" : "" ?>>Active</option>
									<option value="0" <?php echo ($studentData['status'] == 0) ? "selected" : "" ?>>Inactive</option>
<!--									<option value="2" --><?php //echo ($studentData['status'] == 2) ? "selected" : "" ?><!-->Terminated</option>-->

								</select>

							</div>
						</div>
					</div>
					<div class="form-actions stdFormAction">
						<button type="reset" class="btn" tabindex="5" id="cancel">Cancel</button>
						<button type="button" class="btn btn-primary" tabindex="6" id="save">Update</button>
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