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
	?>
	<?php include('includes/checkbox_jquery.php'); ?>
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
					if ($_SESSION['schoolClassStatus'] == 1) {
						$_SESSION['schoolClassStatus'] = null;
						?>
						<div class="alert alert-success alert-block">
							<a href="#" data-dismiss="alert" class="close">x</a>
							<h4 class="alert-heading">Information!!!</h4>
							<table width="100%" border="0">
								<tbody>
								<tr>
									<td width="100%"><br>SuccessFully Set Class Details!!!</td>
								</tr>
								</tbody>
							</table>
						</div>

					<?php
					} elseif ($_SESSION['schoolClassStatus'] == 2) {
						$_SESSION['schoolClassStatus'] = null;
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
				<h3><i class="icon-user"></i>School Setting Page
				</h3>
			</div>
			<div class="well no-padding">
				<form id="staffForm" method="post" class="form-horizontal" enctype="multipart/form-data"
				      action="adminBusinessLogic/classMappingSave.php">
					<div class="control-group">
						<?php
							$data = $db->query_first("Select TS.school_name FROM " . TABLE_SCHOOL . " TS WHERE `schl_id`=" . $_GET['id']);
							$count = $db->affected_rows;
							if ($count == 0 || $count > 1) {
								redirect_to('schoolSetting.php');
							}
							print"<div align=\"center\"><h5>" . $data['school_name'] . "</h5></div>";
							print "<input type='hidden' value='" . $_GET['id'] . "' name='schoolId' >";
						?>
					</div>
					<div class="control-group">
						<div class="span12 class-div" style="margin-bottom:15px;">
							<div class="span2 text-center">
								<h5>CLASS</h5>
							</div>
							<div class="span5 text-center">
								<?php $icseCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `stream_id`='2'"); ?>
								<h5><span class="padding-smallcheck" style="float:none"><input type="checkbox" id="icseDivision" <?php echo ($icseCheck['count'] > 0) ? "Checked" : ""; ?>> </span> ICSE DIVISION</h5>
							</div>
							<div class="span5 text-center">
								<?php $stateCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `stream_id`='1'"); ?>
								<h5><span class="padding-smallcheck" style="float:none"><input type="checkbox" id="sstateDivision" <?php echo ($stateCheck['count'] > 0) ? "Checked" : ""; ?>> </span>STATE DIVISION</h5>
							</div>
						</div>
						<?php
							$classSql = "Select class_id, class_name FROM " . TABLE_CLASS . " WHERE status = '0'";
							$classRows = $db->query($classSql);
							while ($classRow = $db->fetch_array($classRows)) {
								?>
								<div class="span12">
									<div class="span2">
										<label class="checkbox">
											<div class="checker"><span>
												<?php $statusCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `class_id`=" . $classRow['class_id']); ?>
													<input type="checkbox"
													       id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>"
													       name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>"
													       class="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>"
													       value="<?php echo $classRow['class_id'] ?>" <?php echo ($statusCheck['count'] > 0) ? "Checked" : ""; ?>></span>
											</div>
											<label
												class="control-label no-padding"><?php echo $classRow['class_name']; ?></label>
										</label>
									</div>
									<div class="span5 text-center class-div">
										<div class="checker">
											<span class="padding-smallcheck">
											<?php $statusStreamCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `class_id`=" . $classRow['class_id'] . " AND
											`stream_id`='2'"); ?>
												<input type="checkbox"
												       id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse"
												       class="case<?php echo $classRow['class_id']; ?>"
												       name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-icse"
												       value="2" <?php echo ($statusStreamCheck['count'] > 0) ? "Checked" : ""; ?>
													>ICSE</span>
											<?php
												$divisionSql = "Select division_id, division_name FROM " . TABLE_DIVISION . " WHERE status = '0'";
												$divisionRows = $db->query($divisionSql);
												while ($divisionRow = $db->fetch_array($divisionRows)) {
													$statusDivCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `class_id`=" . $classRow['class_id'] . " AND
													`division_id`=" . $divisionRow['division_id'] . " AND `stream_id`='2'");
													?>
													<span class="padding-smallcheck">
											<input type="checkbox"
											       id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . " " . trim(strtolower(preg_replace('/\s+/', '', $divisionRow['division_name']))) ?>-icse"
											       class="<?php echo 'case' . $classRow['class_id'] . ' icse' . $classRow['class_id']; ?>"
											       name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . "-icse-" . trim(strtolower(preg_replace('/\s+/', '', $divisionRow['division_name']))) ?>"
											       value="<?php echo $divisionRow['division_id']; ?>" <?php echo ($statusDivCheck['count'] == 1) ? "Checked" : ""; ?>> <?php echo $divisionRow['division_name']; ?> </span>

												<?php } ?>
										</div>
									</div>
									<div class="span5 text-center class-div">
										<div class="checker">
											<span class="padding-smallcheck">
											<?php $statusStreamCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `class_id`=" . $classRow['class_id'] . " AND
											`stream_id`='1'"); ?>
												<input type="checkbox"
												       id="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state"
												       name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) ?>-state"
												       class="case<?php echo $classRow['class_id']; ?>"
												       value="1" <?php echo ($statusStreamCheck['count'] > 0) ? "Checked" : ""; ?>>STATE</span>
											<?php
												$divisionSql = "Select division_id,division_name FROM " . TABLE_DIVISION . " WHERE status = '0'";
												$divisionRows = $db->query($divisionSql);
												while ($divisionRow = $db->fetch_array($divisionRows)) {
													$statusDivCheck = $db->query_first("Select Count(*) as count from " . TABLE_CLASS_MAPPING . " WHERE `schl_id`= '" . $_GET['id'] . "' AND `class_id`=" . $classRow['class_id'] . " AND
													`division_id`=" . $divisionRow['division_id'] . " AND `stream_id`='1'");
													?>
													<span class="padding-smallcheck">
											<input type="checkbox"
											       id="state <?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . " " . trim(strtolower(preg_replace('/\s+/', '', $divisionRow['division_name']))) ?>"
											       name="<?php echo trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name']))) . "-state-" . trim(strtolower(preg_replace('/\s+/', '', $divisionRow['division_name']))) ?>"
											       class="<?php echo 'case' . $classRow['class_id'] . ' state' . $classRow['class_id']; ?>"
											       value="<?php echo $divisionRow['division_id']; ?>"
												<?php echo ($statusDivCheck['count'] == 1) ? "Checked" : ""; ?>><?php echo $divisionRow['division_name']; ?> </span>
												<?php } ?>
										</div>
									</div>
								</div>
							<?php
							}
						?>
					</div>
					<div class="form-actions stdFormAction">
						<a href="schoolSetting.php" class="btn" id="cancel">Cancel</a>
						<input type="submit" class="btn btn-primary" id="save" value="submit" tabindex="8"/>
						<div id='loading'></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("input[id='icseDivision']").change(function () {
			if (document.getElementById('icseDivision').checked) {
				$("input[id$='-icse']").removeAttr("disabled");
			}
			else {
				$("input[id$='-icse']").attr("disabled", "disabled");
				$("input[id$='-icse']").prop("checked", false);
			}
		});
		if (!document.getElementById('icseDivision').checked) {
			$("input[id$='-icse']").attr("disabled", "disabled");
			$("input[id$='-icse']").prop("checked", false);
		}
		$("input[id='sstateDivision']").change(function () {
			if (document.getElementById('sstateDivision').checked) {
				$("input[id^='state']").removeAttr("disabled");
				$("input[id$='-state']").removeAttr("disabled");
			}
			else {
				$("input[id$='-state']").attr("disabled", "disabled");
				$("input[id^='state']").attr("disabled", "disabled");
				$("input[id^='state']").prop("checked", false);
				$("input[id$='-state']").prop("checked", false);
			}
		});
		if (!document.getElementById('sstateDivision').checked) {
			$("input[id$='-state']").attr("disabled", "disabled");
			$("input[id^='state']").attr("disabled", "disabled");
			$("input[id^='state']").prop("checked", false);
			$("input[id$='-state']").prop("checked", false);
		}
	});
</script>
<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>