<?php
	require_once('adminBusinessLogic/developmentSecurity.php');
	require_once('includes/headerPhp.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		require_once("includes/headerMeta.php");
		require_once("includes/headerStyles.php");
		require_once("includes/headerScripts.php");
	?>
</head>
<body class="inside-body">
<?php require_once('includes/topBody.php'); ?>
<?php require_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
	<?php include_once('includes/developmentMenu.php'); ?>
	<div class="row-fluid">
		<div class="span12">
			<div id='preview'>
				<?php
					if (isset($_SESSION['developmentFeeReceiptError'])) {
						echo "<div class=\"alert alert-error alert-block\">
			<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  			<h4 class=\"alert-heading\">Information !!!</h4>
			<div style=\"color:#e32c2c\">" . $_SESSION['developmentFeeReceiptError'] . "</div><br>Please try again with filling every field correctly</div>";
						$_SESSION['developmentFeeReceiptError'] = null;
					}
                $academicYr = $db->query_first("Select academic_year from ".TABLE_STUDENT." where student_id=".intval($_GET['id']));
				?>
			</div>

			<div class="top-bar">
				<h3><i class="icon-dollar"></i>Fee Payment</h3>
			</div>
			<?php

				$dataCheck = $db->query_first("SELECT id, development_fees, payment_status, academic_year FROM `" . TABLE_STUDENT_DEVELOPMENT_FEE . "` Where `student_id`='" . intval(trim($_GET['id']))."' AND academic_year = '".academicYear()."' ORDER BY id DESC");
				if ($db->affected_rows > 0)
{
					if (trim($dataCheck['academic_year']) == trim($academicYr['academic_year'])) {
						if ($dataCheck['payment_status'] == 0) {
							$_SESSION['developmentFeeFull'] = "Paid Full Development Fees for the Academic Year " . $academicYr['academic_year'] . ".";
							redirect_to('developmentFeesReceipt.php?id=' . $dataCheck[id]);
						} elseif ($dataCheck['payment_status'] == 1) {
							$partSum = $db->query_first("SELECT sum(payment_now) as total FROM " . TABLE_STUDENT_DEVELOPMENT_FEE_PART . " WHERE development_fee_id = " . $dataCheck[id]);
							if ($partSum['total'] < $dataCheck['development_fees']) {
								redirect_to('developmentPartFeePayment.php?id=' . intval(trim($_GET['id'])));
							} else {
								$_SESSION['developmentFeeStatus'] = "Paid Full Development Fees for the Academic Year " . academicYear() . ".";
								redirect_to('developmentPreviousFeeListing.php?id=' . intval(trim($_GET['id'])) . '');
							}
						}
					}
}
				$rows = $db->query_first("Select st.schl_id, st.student_id, st.student_name, st.academic_year, st.stream_id, tc.class_name, tc.class_id,  td.division_name, ts.school_name, st.admission_id,
				st.admission_status
            FROM " . TABLE_STUDENT . " as st
            INNER JOIN " . TABLE_CLASS . " tc on tc.class_id = st.class_id
            INNER JOIN " . TABLE_DIVISION . " td on td.division_id = st.division_id
            INNER JOIN " . TABLE_SCHOOL . " ts on ts.schl_id = st.schl_id
            Where st.`student_id`=" . $_GET['id']);
				$stream = ($rows['stream_id'] == 2) ? "ICSE" : "STATE";
				$developmentFeeAmount = $db->query_first("Select `fee_amount`, `fee_re_amount` FROM " . TABLE_DEVELOPMENT_FEE_MAPPING . " WHERE `class_id`= " . intval(trim($rows['class_id'])) . " AND `schl_id`=" . intval(trim
					($rows['schl_id'])) . " AND academic_year = '".academicYear()."'");
			?>
			<div class="well no-padding">

				<form id="studentForm" method="post" class="form-horizontal" enctype="multipart/form-data"
				      action="adminBusinessLogic/developmentFeePaymentSave.php">
					<?php
						echo "<input type='hidden' value='" . intval(trim($rows['schl_id'])) . "' name='schlId'>" . PHP_EOL;
						echo "<input type='hidden' value='" . intval(trim($rows['class_id'])) . "' name='classId'>" . PHP_EOL;
						echo "<input type='hidden' value='" . $rows['student_id'] . "' name='studentId'>" . PHP_EOL . PHP_EOL;
						echo "<input type='hidden' value='" . $rows['student_name'] . "' name='studentName'>" . PHP_EOL . PHP_EOL;
						echo "<input type='hidden' value='" . $rows['academic_year'] . "' name='academicYear'>" . PHP_EOL . PHP_EOL;
					?>
					<div class="control-group">
						<div align="center"><h5><?php echo $rows['school_name'] ?></h5></div>
					</div>
					<div class="control-group">
						<div class="span3"><label
								class="control-label">Name: <?php echo $rows['student_name']; ?></label></div>
						<div class="span3"><label class="control-label">Academic
						                                                Year: <?php echo $rows['academic_year']; ?></label></div>
						<div class="span2"><label class="control-label">Stream: <?php echo $stream; ?></label></div>
						<div class="span2"><label
								class="control-label">Class: <?php echo $rows['class_name']; ?></label></div>
						<div class="span2"><label
								class="control-label">Division: <?php echo $rows['division_name']; ?></label></div>
					</div>
					<div class="control-group">
						<div class="span4">
							<div class="span3">
								<label class="control-label">Date:</label>
							</div>
							<div class="span9">

								<input class="datepicker" type="text" tabindex="1" id="date"
								       value="<?php echo date("d-m-Y"); ?>" name="date"/>
								<script type="text/javascript">
									var date = new LiveValidation('date', { validMessage: " ", wait: 500 });
									date.add(Validate.Presence, { failureMessage: "Please Check Date" });

								</script>
							</div>
						</div>
						<div class="span8">
							<div class="span3">
								<label class="control-label" style="padding-left: 15px">Type of Payment: </label>
							</div>
							<div class="span9">

								<label style="float: left"><input type="radio" name="paymentType" id="cash" value="Cash" tabindex="3" checked/> <span style="padding-right: 40px; ">Cash</span></label>
								<label style="float: left">
									<input type="radio" name="paymentType" id="cheque" tabindex="4" value="Cheque"/> Cheque <br>

								</label>
								<nobr>
									<input type="text" class="span4" name="chequeNumber" id="cN" placeholder="Cheque Number" disabled="disabled" tabindex="5"/>
									<input type="text" id="cD" class="span4 datepicker" name="chequeDate" data-date-format="dd-mm-yyyy" placeholder="Cheque Date" disabled="disabled" tabindex="6"/>
									<input type="text" id="cB" class="span4" name="chequeBank" placeholder="Cheque Bank" disabled="disabled" tabindex="7"/></nobr>

							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="span2">
							<div class="span12 appln-label-large"><label class="control-label">Payment</label></div>
							<div class="span4"><input type="radio" name="payment" id="full" value="full" checked tabindex="8"> Full</div>
							<div class="span4"><input type="radio" name="payment" id="part" value="part" tabindex="9"> Part</div>

						</div>
						<div class="span3">
							<div class="span4 text-right" style=""><label class="control-label">Development Fees:</label></div>
							<div class="span6 text-left">
								<?php
								$developmentFees = 0;
									if($rows['admission_status'] ==2)
										$developmentFees =  $developmentFeeAmount['fee_re_amount'];
									else
										$developmentFees =  $developmentFeeAmount['fee_amount'];
								?>
								<input type="text" style="text-align: right; width: 100px; margin-left: 50px" name="developmentFees"
								       id="developmentFees" tabindex="10" value="<?php print $developmentFees ?>" readonly>
								<script type="text/javascript">
									var developmentFees = new LiveValidation('developmentFees', { validMessage: " ", wait: 500 });
									developmentFees.add(Validate.Presence, { failureMessage: "Please Check Development Fees" });
									developmentFees.add(Validate.Numericality, { failureMessage: "Please Check Development Fees" });

								</script>
							</div>
						</div>
						<div class="span2">
							<div class="span6 text-right" style=""><label class="control-label">Waive Off:</label></div>
							<div class="span6 text-left">
								<input type="text" style="text-align: right; width: 70px; margin-left: 0px" name="waiveOff"
								       id="waiveOff" tabindex="11" value="0">
								<script type="text/javascript">
									var waiveOff = new LiveValidation('waiveOff', { validMessage: " ", wait: 500 });
									waiveOff.add(Validate.Numericality, { failureMessage: "Please Check Waive Off Amount" });

								</script>
							</div>
						</div>
						<div class="span2">
							<div class="span5 text-right" style=""><label class="control-label">Add On:</label></div>
							<div class="span7 text-left">
								<input type="text" style="text-align: right; width: 70px; margin-left: 0px" name="addOn"
								       id="addOn" tabindex="12" value="0">
								<script type="text/javascript">
									var addOn = new LiveValidation('addOn', { validMessage: " ", wait: 500 });
									addOn.add(Validate.Numericality, { failureMessage: "Please Check Add On Amount" });
								</script>
							</div>
						</div>

						<div class="span3" id="paymentNowDiv">
							<div class="span6 text-right" style=""><label class="control-label">Payment Now:</label></div>
							<div class="span6 text-left">
								<input type="text" style="text-align: right; width: 100px; margin-left: 0px" name="paymentNow"
								       id="paymentNow" tabindex="13" value="0" disabled>
								<script type="text/javascript">
									var paymentNow = new LiveValidation('paymentNow', { validMessage: " ", wait: 500 });
									paymentNow.add(Validate.Numericality, { failureMessage: "Please Check Payment Now Amount" });
								</script>
							</div>
						</div>

					</div>

					<div class="control-group">
						<div class="span4 text-right" style="padding-left: 14px; font-weight: bold" id="paymentNow">

						</div>
						<div class="span4 text-right" style="padding-left: 14px; font-weight: bold" id="pendingBal">

						</div>
						<div class="span4 text-right" style="padding-left: 14px; font-weight: bold" id="total">

						</div>
					</div>

					<div class="form-actions">
						<div class="stdFormAction">
							<button type="reset" id="cancel" class="btn" tabindex="15">Cancel</button>
							<input type="submit" id="save" class="btn btn-primary" tabindex="14" value="Save"/>

						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function () {

			$('#waiveOff').focusout(function(){

				var total = $('#developmentFees').val().trim();
				var waiveoff = $('#waiveOff').val().trim();

				if(parseInt(waiveoff) > parseInt(total))
				{
					alert("Waive Off Should not be larger than Development Fees");
					$('#waiveOff').val(0);
					if (document.getElementById('full').checked) {
						totalValue();
					}
					else if (document.getElementById('part').checked) {
						newTotal();
					}
				}
				if(parseInt(waiveoff) < 0)
				{
					alert("Waive Off cannot be Negative");
					$('#waiveOff').val(0);
					if (document.getElementById('full').checked) {
						totalValue();
					}
					else if (document.getElementById('part').checked) {
						newTotal();
					}
				}



			});
		$('#waiveOff').keyup(function(){
		if($('#waiveOff').val() == '' || $('#waiveOff').val() == ' ' || $('#waiveOff').val() == null || $('#waiveOff').val() == undefined ){
			$('#waiveOff').val(0);
		}
		});
		$('#addOn').keyup(function(){
			if($('#addOn').val() == '' || $('#addOn').val() == ' ' || $('#addOn').val() == null || $('#addOn').val() == undefined ){
				$('#addOn').val(0);
			}
		});
		$('#addOn').focusout(function(){

			var addOn = $('#addOn').val().trim();


			if(parseInt(addOn) <0)
			{
				alert("Add On cannot be Negative");
				$('#addOn').val(0);
				if (document.getElementById('full').checked) {
					totalValue();
				}
				else if (document.getElementById('part').checked) {
					newTotal();
				}
			}

		});

		$('#cN').hide();
		$('#cD').hide();
		$('#cB').hide();
		$('#paymentNowDiv').hide();

		$('#part').click(function () {
			$('#paymentNowDiv').show();
			$('#paymentNow').removeAttr("disabled");
			newTotal();
		});

		$('#full').click(function () {
			$('#paymentNowDiv').hide();
			$('#pendingBal').html('');
			$('#paymentNow').attr("disabled", "disabled");
			totalValue();
		});

		$('#paymentNow').change(function () {
			newTotal();
		});

		$('#cheque').click(function () {
			$('#cN').removeAttr("disabled");
			$('#cD').removeAttr("disabled");
			$('#cB').removeAttr("disabled");
			$('#cN').show();
			$('#cD').show();
			$('#cB').show();
		});

		$('#cash').click(function () {
			$('#cN').attr("disabled", "disabled");
			$('#cD').attr("disabled", "disabled");
			$('#cB').attr("disabled", "disabled");
			$('#cN').hide();
			$('#cD').hide();
			$('#cB').hide();
		});
		$("#date").focus();

		totalValue();

		$("#waiveOff").change(function () {
			if (document.getElementById('full').checked) {
				totalValue();
			}
			else if (document.getElementById('part').checked) {
				newTotal();
			}
		});

		$("#addOn").change(function () {
			if (document.getElementById('full').checked) {
				totalValue();
			}
			else if (document.getElementById('part').checked) {
				newTotal();
			}
		});

		function newTotal() {
			var total = parseInt(parseInt($('#developmentFees').val().trim()) - parseInt($('#waiveOff').val().trim()) + parseInt($('#addOn').val().trim()));
			var balance = total - parseInt($('#paymentNow').val().trim());
			$('#pendingBal').html('Pending Balance: Rs. ' + balance + '.00');
			$("#total").html('Total: Rs. ' + parseInt($('#paymentNow').val().trim()) + '.00');
		}

		function totalValue() {
			var total = parseInt(parseInt($('#developmentFees').val().trim()) - parseInt($('#waiveOff').val().trim()) + parseInt($('#addOn').val().trim()));
			$("#total").html('Total: Rs. ' + total + '.00');
		}
	});
</script>
<?php include_once('includes/footerJavascript.php'); ?>
</body>
</html>