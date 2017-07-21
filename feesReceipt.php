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

		$sql = "SELECT TSFP.id, TSFP.`student_name`, TSFP.`academic_year`,TSFP.`date`, TSFP.grand_total, TSFP.payment_type, TSFP.cheque_no, DATE_FORMAT(TSFP.cheque_date,'%d-%m-%Y') as cheque_date , TSFP.cheque_bank ,
		TS.`stream_id`, TC.`class_name`, TD.`division_name` FROM " . TABLE_STUDENT_FEE_PRIMARY . " TSFP
		        INNER JOIN " . TABLE_STUDENT . " TS ON TS.student_id = TSFP.student_id
		        INNER JOIN " . TABLE_CLASS . " TC ON TS.class_id = TC.class_id
		        INNER JOIN " . TABLE_DIVISION . " TD ON TS.division_id = TD.division_id
		        WHERE TSFP.id = " . $id;
		$rows = $db->query_first($sql);
		if($db->affected_rows ==0)
		{
			redirect_to('studentListing.php');
		}
		$feeSql = "SELECT DISTINCT (fee_id), fee_name, fee_type, months, amount, waive_off FROM " . TABLE_STUDENT_FEE_SECONDARY . " WHERE primary_id=" . $id;
		$feeRows = $db->query($feeSql);
		$tuitionFee = null;
		$tuitionAmount = null;
		$otherFees = null;
		$otherFeeAmount = null;
		$waiveOff = null;
		while ($feeRow = $db->fetch_array($feeRows)) {
			if ($feeRow['fee_type'] == "M") {
				$tuitionFee = $feeRow['fee_name']." for the months of <span style=\"font-size:11px\"> (". $feeRow['months']. ")</span>";
				$tuitionAmount = $feeRow['amount'];
			} else {
				$otherFees .= $feeRow['fee_name'] . ", ";
				$otherFeeAmount = $otherFeeAmount + $feeRow['amount'];

			}
			$waiveOff = $waiveOff + $feeRow['waive_off'];
		}
		$otherFees = rtrim(trim($otherFees), ",");
		$total = $tuitionAmount + $otherFeeAmount;

		$_streamName = ($rows['stream_id']==2)?" (ICSE)":(($rows['stream_id']==1)? " (STATE)":"");




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
	<?php include_once('includes/menu.php'); ?>
	<div class="row-fluid">
		<div class="span12">

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

						<div style="font-family:'Segoe UI'; font-size:13px; width:600px; margin:0 auto; padding:20px; padding-top: 20px">

							<table style="width:100%;">
<!--								<tr>-->
<!--									<td colspan="3" style="font-weight: bold; text-decoration: underline; font-size: 18px; text-align: center; padding-bottom: 5px; padding-top: 20px">CASH RECEIPT</td>-->
<!--								</tr>-->
								<tr>
									<td style="text-align: left; width: 40%">Name: <?php echo $rows['student_name']; ?></td>
									<td style="width:40%">&nbsp;</td>
									<td style="width: 20%; text-align: left">Receipt No: <?php echo $rows['id']; ?></td>
								</tr>
								<tr>
									<td>Standard: <?php echo $rows['class_name'] . " - " . $rows['division_name'].$_streamName; ?></td>
									<td>&nbsp;</td>
									<td>Date: <?php echo date("d-m-Y", strtotime($rows['date'])); ?></td>
								</tr>
								<tr>
									<td>Academic Year: <?php echo $rows['academic_year']; ?></td>
									<td>&nbsp;</td>
									<td> </td>
								</tr>
<!--								<tr>-->
<!--									<td>&nbsp;</td>-->
<!--									<td>&nbsp;</td>-->
<!--									<td>&nbsp;</td>-->
<!--								</tr>-->
								<tr>
									<td colspan="3">
										<table style="width:100%; border:1px solid black">
											<tr>
												<td colspan="4" style="text-align:center;border-bottom:1px solid black; width: 80%">Particulars</td>
												<td style="border-bottom:1px solid black; border-left: 1px solid black; text-align: center">Amount (In Rs.)</td>
											</tr>
											<tr>

												<td colspan="4" style="padding-left: 10px;"><?php echo $tuitionFee ?></td>

												<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px"><?php echo formatMoney($tuitionAmount); ?></td>
											</tr>
											<tr>
												<td colspan="4" style="padding-left: 10px;"><?php echo $otherFees ?></td>

												<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px"><?php echo formatMoney($otherFeeAmount); ?></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td style="border-left: 1px solid #000000">&nbsp;</td>
											</tr>
											<tr>
												<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000">&nbsp;</td>
												<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000">Waved Off : Rs. <?php echo formatMoney(intval($waiveOff)); ?></td>
<!--                                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"></td>-->
                                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; ">&nbsp;</td>
												<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;text-align: right">Total:</td>
												<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000; text-align: right; padding-right: 10px"><?php echo formatMoney($total);
													?></td>
											</tr>
											<tr>
												<td class="auto-style1">&nbsp;</td>
												<td class="auto-style1">&nbsp;</td>
												<td class="auto-style3">&nbsp;</td>
												<td style="font-size:16px; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;text-align: right; padding: 5px">Grand Total:</td>
												<td style="font-size:16px; font-weight:bold;text-align: right; padding-right: 10px"><?php echo formatMoney(intval($rows['grand_total'])); ?></td>
											</tr>

										</table>
									</td>
								</tr>
								<tr>
									<td >Payment Type :
										<nobr><?php echo $rows['payment_type']?></nobr>
									</td>
									<?php
									if(strtolower(trim($rows['payment_type'])) == "cheque")
									{
										$chequeDetails = "Cheque No: ".$rows['cheque_no'].", Date: ".$rows['cheque_date'].", Bank: ".$rows['cheque_bank'];
									}
									?>
									<td colspan="2"><?php echo $chequeDetails?></td>
								</tr>
								<tr>
									<td colspan="2">Rupees (In Words) :
										<nobr><?php echo rtrim(trim(ucwords(no_to_words(intval($rows['grand_total'])))), "&") . " Rupees Only." ?></nobr>
									</td>

									<td>&nbsp;</td>
								</tr>
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