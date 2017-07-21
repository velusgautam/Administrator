<?php
	include_once('adminBusinessLogic/developmentSecurity.php');
	include_once('includes/headerPhp.php');
	function notowords($no) {
		$words = array('0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninty', '100' => 'hundred &', '1000' => 'thousand', '100000' => 'lakh', '10000000' => 'crore');
		if ($no == 0)
			return ' ';
		else {
			$novalue = '';
			$highno = $no;
			$remainno = 0;
			$value = 100;
			$value1 = 1000;
			while ($no >= 100) {
				if (($value <= $no) && ($no < $value1)) {
					$novalue = $words["$value"];
					$highno = (int) ($no / $value);
					$remainno = $no % $value;
					break;
				}
				$value = $value1;
				$value1 = $value * 100;
			}
			if (array_key_exists("$highno", $words))
				return $words["$highno"] . " " . $novalue . " " . notowords($remainno);
			else {
				$unit = $highno % 10;
				$ten = (int) ($highno / 10) * 10;
				return $words["$ten"] . " " . $words["$unit"] . " " . $novalue . " " . notowords($remainno);
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		require_once("includes/headerMeta.php");
		require_once("includes/headerStyles.php");
		require_once("includes/headerScripts.php");
		$id = $_GET['id'];
		$partId = $_GET['partId'];
		if (intval($partId) > 0) {
			$sql = "SELECT TS.student_id, TS.application_no, TS.admission_id,  TSDP.payment_now, TSDP.balance, TSDF.id, TSDF.`student_name`, TSDF.`academic_year`,TSDF.`date`,TSDF.development_fees, TSDF.waive_off, TSDF.add_on, TSDF.total,
			TSDF.payment_type,
			TSDF.payment_status,
			TSDF.cheque_no, DATE_FORMAT(TSDF.cheque_date,'%d-%m-%Y') as cheque_date ,	TSDF.cheque_bank ,	TC.`class_name`, TS.stream_id,	TD.`division_name` FROM " . TABLE_STUDENT_DEVELOPMENT_FEE_PART . " TSDP
				INNER JOIN " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF ON TSDF.id = TSDP.development_fee_id
		        INNER JOIN " . TABLE_STUDENT . " TS ON TS.student_id = TSDF.student_id
		        INNER JOIN " . TABLE_CLASS . " TC ON TS.class_id = TC.class_id
		        INNER JOIN " . TABLE_DIVISION . " TD ON TS.division_id = TD.division_id
		        WHERE TSDF.id = " . $id." AND TSDP.part_id=".$partId;
			$rows = $db->query_first($sql);
		} else {
			$sql = "SELECT TS.student_id, TS.application_no,  TSDF.id, TSDF.`student_name`, TSDF.`academic_year`,TSDF.`date`,TSDF.development_fees, TSDF.waive_off, TSDF.add_on, TSDF.total,  TSDF.payment_type, TSDF.cheque_no,
			DATE_FORMAT(TSDF.cheque_date,
		'%d-%m-%Y') as cheque_date ,TSDF.cheque_bank ,	TC.`class_name`, TS.stream_id,	TD.`division_name` FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
		        INNER JOIN " . TABLE_STUDENT . " TS ON TS.student_id = TSDF.student_id
		        INNER JOIN " . TABLE_CLASS . " TC ON TS.class_id = TC.class_id
		        INNER JOIN " . TABLE_DIVISION . " TD ON TS.division_id = TD.division_id
		        WHERE TSDF.id = " . $id;
			$rows = $db->query_first($sql);
		}
		if ($db->affected_rows == 0) {
			redirect_to('developmentStudentListing.php');
		}
		$studentId = $rows['student_id'];
		$applicationId = $rows['application_no'];
		$admnId = $rows['admission_id'];
    if ($admnId > 0) {
        $fName = $db->query_first("Select father_name FROM " . TABLE_ADMISSION_FORM . " where id=" . $admnId);
        if (!empty($fName['father_name'])) {
            $fatherName = " " . $fName['father_name'] . " ";
        } else {
            $gName = $db->query_first("Select contact_name FROM " . TABLE_NEW_APPLICATION . " where application_no=" . $applicationId);
            $fatherName = " " . $gName['contact_name'] . " ";
        }
    }
		$developmentFee = $rows['development_fees'] + $rows['add_on'];
		$waiveOff = $rows['waive_off'];
		$addOn = $rows['add_on'];
		$balance = $rows['balance'];
		$status = $rows['payment_status'];
    $_streamName = ($rows['stream_id'] == 2) ? " (ICSE)" : (($rows['stream_id'] == 1) ? " (STATE)" : "");
		if ($total == $rows['total']) {
			$validation = true;
		}
	?>
	<script language="javascript" type="text/javascript">
		window.history.forward(1);
		function printDiv(divID) {
			var divElements = document.getElementById(divID).innerHTML;
			var oldPage = document.body.innerHTML;
			var page = "<html><head><title></title>";

			page = page + "</head><body>" + divElements + "</body>";
			document.body.innerHTML = page;
			window.print();
			document.body.innerHTML = oldPage;
		}
	</script>
</head>
<body class="inside-body">
<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>
<?php include_once("includes/topNewMessagesBar.php"); ?>
<div class="container">
	<?php include_once('includes/developmentMenu.php'); ?>
	<div class="row-fluid">
		<div class="span12">

			<div id='preview'>
				<?php
					if(isset($_SESSION['developmentFeeFull']))
					{
						echo "<div class=\"alert alert-light alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
				<h4 class=\"alert-heading\"> Information!!!</h4>
				<h5> " . $_SESSION['developmentFeeFull']."</h5></div>";
						$_SESSION['developmentFeeFull']=null;
					}
				?>
			</div>
			<div class="top-bar">
				<h3><i class="icon-user"></i>CASH RECEIPT</h3>
			</div>
			<div class="well no-padding">
				<table width="100%">
					<tbody>
					<tr>
						<td style="float: right; padding-top: 15px; ">
							<div class="btn-group" style="padding-right:125px;"><input class="btn-group btn-large btn-success" type="button" value="Print"
							                                                           onClick="javascript:printDiv('receipt')"/></div>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="widget-box">

					<div id="receipt" style="margin:15px; background-color: #ffffff">
						<br>

						<div style="font-family:'Segoe UI'; font-size:13px; width:600px; margin:0 auto; padding:20px; padding-top: 40px">

							<table style="width:100%;">

								<tr>
									<td style="text-align: left; width: 40%">Name: <?php echo $rows['student_name']; ?></td>
									<td style="width:35%">&nbsp;</td>
									<td style="padding-left: 30px; width: 25%; text-align: left">Receipt No: <?php echo $rows['id']; ?></td>
								</tr>
								<tr>
									<td>Standard: <?php echo $rows['class_name'] . " - " . $rows['division_name'].$_streamName; ?></td>
									<td>&nbsp;</td>
									<td style="padding-left: 30px;">Date: <?php echo date("d-m-Y", strtotime($rows['date'])); ?></td>
								</tr>

								<tr>
									<td></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="3" style="line-height: 2">
										<?php if ($rows['payment_status'] == 0) {
											?>
											Received with thanks sum of <strong><?php echo rtrim(trim(ucwords(notowords(intval($rows['total'])))), "&") . " " ?></strong>Rupees
											Only towards the Annual Development Fees for the Academic Year:  <?php echo $rows['academic_year']?>.
											<?php
                                        } elseif ($rows['payment_status'] == 1 || $rows['payment_status'] == 2) {
											?>
											Received with thanks from <?php echo $fatherName; ?>, A sum of <strong><?php echo rtrim(trim(ucwords(notowords(intval($rows['payment_now'])))), "&") . " " ?></strong>Rupees
											Only towards the Annual Development Fees for the Academic Year:  <?php echo $rows['academic_year']?>.

<!--											<table style="width:100%; border:1px solid black">-->
<!--												<tr>-->
<!--													<td colspan="4" style="text-align:center;border-bottom:1px solid black; width: 80%">Particulars</td>-->
<!--													<td style="border-bottom:1px solid black; border-left: 1px solid black; text-align: center">Amount (In Rs.)</td>-->
<!--												</tr>-->
<!--												<tr>-->
<!---->
<!--													<td colspan="4" style="padding-left: 20px;">DEVELOPMENT FEES : --><?php //echo formatMoney($developmentFee); ?><!--</td>-->
<!---->
<!--													<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px"></td>-->
<!--												</tr>-->
<!--												<tr>-->
<!--													<td colspan="4" style="padding-left: 20px;">PAYMENT NOW (+)</td>-->
<!---->
<!--													<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px">--><?php //echo formatMoney($rows['payment_now']); ?><!--</td>-->
<!--												</tr>-->
<!--												<tr>-->
<!--													<td colspan="4" style="padding-left: 20px;">ADD ON (+)</td>-->
<!---->
<!--													<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px">--><?php //echo formatMoney($addOn); ?><!--</td>-->
<!--												</tr>-->
<!--												<tr>-->
<!--													<td colspan="4" style="padding-left: 20px;">WAIVED OFF (-)</td>-->
<!---->
<!--													<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px">--><?php //echo formatMoney($waiveOff); ?><!--</td>-->
<!--												</tr>-->
<!--												<tr>-->
<!--													<td colspan="2" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000">Balance: --><?php //echo formatMoney($balance); ?><!-- </td>-->
<!---->
<!--													<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; ">&nbsp;</td>-->
<!--													<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;text-align: right">Total:</td>-->
<!--													<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000; text-align: right; padding-right: 10px">--><?php //echo formatMoney($rows['total']);
//														?><!--</td>-->
<!--												</tr>-->
<!--												<tr>-->
<!--													<td class="auto-style1">&nbsp;</td>-->
<!--													<td class="auto-style1">&nbsp;</td>-->
<!--													<td class="auto-style3">&nbsp;</td>-->
<!--													<td style="font-size:16px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;text-align: right; padding: 5px">Grand Total:</td>-->
<!--													<td style="font-size:16px; font-weight:bold;text-align: right; padding-right: 10px">--><?php //echo formatMoney(intval($rows['total'])); ?><!--</td>-->
<!--												</tr>-->
<!---->
<!--											</table>-->
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" style="height: 15px">
<!--										<hr>-->
									</td>
								</tr>
								<tr>
									<td>Amount :
										<?php if ($rows['payment_status'] == 0) {
										?>
										<strong><nobr>Rs.<?php echo intval($rows['total']) ?>.00</nobr></strong>
										<?php
                                        } elseif ($rows['payment_status'] == 1 ||  $rows['payment_status'] == 2) {
										?>
										<strong><nobr>Rs.<?php echo intval($rows['payment_now']) ?>.00</nobr></strong>
										<?php } ?>
									</td>
<!--									--><?php
//										if (strtolower(trim($rows['payment_type'])) == "cheque") {
//											$chequeDetails = "Cheque No: " . $rows['cheque_no'] . ", Date: " . $rows['cheque_date'] . ", Bank: " . $rows['cheque_bank'];
//										}
//									?>
									<td colspan="2"><?php //echo $chequeDetails ?></td>
								</tr>
<!--								<tr>-->
<!--									<td colspan="2">Rupees (In Words) :-->
<!--										<nobr>--><?php //echo rtrim(trim(ucwords(notowords(intval($rows['total'])))), "&") . " Rupees Only." ?><!--</nobr>-->
<!--									</td>-->
<!---->
<!--									<td>&nbsp;</td>-->
<!--								</tr>-->
								<tr>
									<td>Place: Bangalore</td>
									<td>&nbsp;</td>
									<td style="text-align: right; padding-right: 30px">Cashier</td>
								</tr>
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