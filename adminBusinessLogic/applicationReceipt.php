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

		$sql = "select `id`, `application_date`, `application_no`, `form_no`, `amount`, `class_name`, `school_code`, `name`, `entered_by`, `count`  from " . TABLE_APPLICATION_RECEIPT . " TAR LEFT OUTER JOIN ".TABLE_CLASS." TC ON
		TC.class_id = TAR.class_applied  Where application_no = ". $id;
		$rows = $db->query_first($sql);



		$feeSql = "SELECT fee_id, fee_name, amount  FROM " . TABLE_APPLICATION_FEE . " WHERE school_id=" . $rows['school_code'];
		$feeRows = $db->query_first($feeSql);
		if ($db->affected_rows == 0) {
			$noData = 1;
		} else {

			$Fees = $feeRows['amount'];
			$total = $Fees;

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
	<?php include_once('includes/menu.php'); ?>
	<div class="row-fluid">
		<div class="span12">

			<?php

				if (intval($noData) > 0) {
					echo "<div class=\"span12 alert alert-warning alert-block\" style='margin-left: 0px'>
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
  				<h4 class=\"alert-heading\">Information!!!</h4>
  				<div>
  				No Application Fees Set for the School Please Contact Administrator to Set Application Fee for this school and Continue.
  				<a href='applicationFormListing.php' > <button class='btn-success btn-large' style='float: right'>Back</button></a>
  				</div></div>";
				} else {
					?>

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
											<td style="text-align: left; width: 40%">Name: <?php echo $rows['name']; ?></td>
											<td style="width:35%">&nbsp;</td>
											<td style="width: 25%; text-align: left">Receipt No: <?php echo $rows['id']; ?></td>
										</tr>
										<tr>
											<td><?php if(!empty($rows['form_no'])) { ?> Application Form No: <?php echo $rows['form_no']; }?></td>
											<td>&nbsp;</td>
											<td>Date: <?php
													$newDate = $rows['application_date'];
													echo date("d-m-Y",strtotime($newDate)); ?></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<table style="width:100%; border:1px solid black">
													<tr>
														<td colspan="4" style="text-align:center;border-bottom:1px solid black; width: 80%">Particulars</td>
														<td style="border-bottom:1px solid black; border-left: 1px solid black; text-align: center">Amount (In Rs.)</td>
													</tr>
													<tr>

														<td colspan="4" style="padding-left: 20px;"><?php echo $feeRows['fee_name']; echo (isset($rows['class_name']))? " for ".$rows['class_name']:""; ?>. </td>

														<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px"><?php echo formatMoney($Fees); ?></td>
													</tr>
													<tr>
														<td colspan="4" style="padding-left: 20px;"></td>

														<td style="border-left: 1px solid #000000; text-align: right; padding-right: 10px"></td>
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
														<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"></td>
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
														<td style="font-size:16px; font-weight:bold;text-align: right; padding-right: 10px"><?php echo formatMoney(intval($total)); ?></td>
													</tr>

												</table>
											</td>
										</tr>

										<tr>
											<td colspan="2">Rupees (In Words) :
												<nobr><?php echo rtrim(trim(ucwords(no_to_words(intval($total)))), "&") . " Rupees Only." ?></nobr>
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
				<?php
				}
			?>
		</div>
	</div>
</div>


<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>