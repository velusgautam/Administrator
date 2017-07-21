<?php
	include_once('adminBusinessLogic/security.php');
	include_once('includes/headerPhp.php');
	if (isset($_GET['id']) && intval(trim($_GET[id])) > 0)
		$shl = $db->query_first('Select school_name FROM ' . TABLE_SCHOOL . ' where schl_id=' . intval(trim($_GET[id])));
	else
		redirect_to('schoolSetting.php')
?>

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
			var name = $('#fname').val();
			var amount = $('#amount').val();
			$("#preview").html('');
			$("#save").css("display", "none");
			$("#cancel").css("display", "none");
			$("#loading").css("display", "");
			$("#loading").html('<img src="assets/img/loader.gif" alt="Sending.."/>');
			$("#studentForm").ajaxForm({
				target:  '#preview',
				success: function (html) {
					if(amount > 0){
					$('#fee_name').html(name);
					$('#fee_amount').html(amount);
					}
					$("#save").css("display", "");
					$("#cancel").css("display", "");
					$("#loading").css("display", "none");
					$('html').animate({scrollTop: 0}, 'slow');
					$('body').animate({scrollTop: 0}, 'slow');

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
			<div class="top-bar">
				<h3><i class="icon-user"></i>Application Fee Setting</h3>
			</div>
			<div class="well no-padding">
				<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
				      action="adminBusinessLogic/applicationFeeSave.php">
					<input type="hidden" name="schl_id" value="<?php echo intval(trim($_GET['id'])) ?>">

					<div class="control-group headings">
						<div align="center">
							<h5>Application Fee Setting : <?php echo $shl['school_name'] ?></h5>
						</div>
					</div>
					<div class="control-group">

						<div class="span4">
							<label class="control-label">Fee Name:</label>

							<div class="controls">
								<input class="input-block-level" type="text" tabindex="1" id="fname" name="name"/>
								<script type="text/javascript">
									var fname = new LiveValidation("fname", { validMessage: " ", wait: 500 });
									fname.add(Validate.Presence, { failureMessage: "Please Enter Amount ." });
								</script>

							</div>
						</div>
						<div class="span4">
							<label class="control-label">Amount:</label>

							<div class="controls">
								<input type="text" class="input-block-level" tabindex="2" placeholder="Amount" name="amount" id="amount">
								<script type="text/javascript">
									var amount = new LiveValidation("amount", { validMessage: " ", wait: 500 });
									amount.add(Validate.Presence, { failureMessage: "Please Enter Amount ." });
									amount.add(Validate.Numericality, { failureMessage: "Please Enter Valid Amount ." });
								</script>

							</div>
						</div>
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

					</div>

					<div class="form-actions stdFormAction">
						<button type="reset" class="btn" tabindex="20" id="cancel">Cancel</button>
						<button type="button" class="btn btn-primary" tabindex="19" id="save">Save</button>
						<!--    <input type="submit" class="btn btn-primary" tabindex="19" id="save" value="Save">-->

					</div>
				</form>

			</div>
			<div style="width: 100%;">

				<div class="top-bar">
					<h3><i class="icon-user"></i>Previous Application Fees</h3>
				</div>
				<div class="well no-padding">
					<div class="span12">
						<div style="margin: 15px">
							<table style="width: 100%; border-radius: 5px; background-color: #f5f5f5; margin-top: 5px; ">
								<thead>
								<tr style="height:45px; border-bottom: 1px solid #C8C8C8;">
									<th>Sl.No</th>
									<th>Fee Name</th>
									<th>Amount</th>
									<th>School</th>
									<th>Academic Year</th>
									<th>Delete</th>
								</tr>

								</thead>
								<?php
									$sql = "Select * FROM " . TABLE_APPLICATION_FEE . " WHERE school_id = " . intval(trim($_GET['id'])) . " ORDER BY fee_id	DESC";
									$result = $db->query($sql);
									if ($db->affected_rows == 0) {
										?>
										<tr style="height: 40px; color: #1a1a1a; font-family: 'Segoe UI Semibold'; <?php if ($i % 2 == 0) echo "background-color: #eeeeee"; ?>">
											<td colspan="6" class="text-center">No data in Table.</td>
										</tr>
									<?php
									}
									$i = 1;
									while ($data = $db->fetch_array($result)) {

										?>
										<tr style="height: 40px; color: #1a1a1a; font-family: 'Segoe UI Semibold'; <?php if ($i % 2 == 0) echo "background-color: #eeeeee"; ?>">
											<td style="text-align: center"><?php echo $i; ?></td>
											<td id="fee_name" style="text-align: center"><?php echo $data['fee_name']; ?></td>
											<td id="fee_amount" style="text-align: center"><?php echo $data['amount']; ?></td>
											<td style="text-align: center"><?php echo $shl['school_name']; ?></td>
											<td style="text-align: center"><?php echo $data['academic_year']; ?></td>
											<td style="text-align: center"><?php echo "<button onclick=\"if (confirm('Are you sure you want to Delete Application Fee?')) window.location = 'adminBusinessLogic/applicationFeeDelete.php?id=" .
													$data['fee_id'] . "&appId=" . intval(trim($_GET[id])) . "'\" title=\"Click to Delete Application Fee\"  class='btn-sm btn-danger'>Delete </button>"; ?></td>

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
<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>