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
			//redirect_to('studentDetails.php');
		}


		$sql = "SELECT * FROM ".TABLE_SCHOOL_TC."  WHERE id = " . $id;

		$rows = $db->query_first($sql);

		if ($db->affected_rows == 0) {
			//redirect_to('studentListing.php');
		}




	?>
	<script language="javascript" type="text/javascript">
		window.history.forward(1);
		function printDiv(divID) {
			var divElements = document.getElementById(divID).innerHTML;
			var oldPage = document.body.innerHTML;
			var page = "<html><head><title></title><style>@page {size: legal;}</style>";

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
	<?php include_once('includes/menu.php');

	?>
	<div class="row-fluid">
		<div class="span12">

			<div class="top-bar">
				<h3><i class="icon-user"></i>TRANSFER CERTIFICATE</h3>
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
				<div class="widget-box" style="border: 1px solid #000000; margin-bottom: 30px" >
										<div class="span12 text-center"><h4>TRANSFER CERTIFICATE</h4></div>
					<div id="receipt" style="margin:15px;">
						<br>

						<div style="font-family:'Segoe UI'; font-size:13px; width:650px; margin:0 auto; padding:20px; padding-top: 25px">
							<table style="width: 100%">
								<tr>
									<td style="width: 50%">
										<?php echo $rows['school_name'] ?>
									</td>
									<td style="width: 50%">
										<div style=" text-align: right; padding-right: 40px; padding-bottom: 30px"><?php echo $rows['hs_language'] ?></div>
										<div style=" text-align: right; padding-right: 40px"><?php echo $rows['hs_electives'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 35px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['admin_no'] ?></div>
									</td>
									<td>
										<div style="  margin-top: 40px; text-align: right; padding-right: 40px; padding-bottom: 10px"><?php echo $rows['medium_of_instruction'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: -10px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['cumilative_recordno'] ?></div>
									</td>
									<td>
										<div style="  margin-top: 42px; text-align: left; padding-left: 150px; padding-bottom: 20px"><?php echo date("d-m-Y",strtotime($rows['dot'])) ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: -15px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['student_name'] ?></div>
									</td>
									<td>
										<div style="  margin-top: 30px; text-align: left; padding-left: 150px; padding-bottom: 20px"><?php echo $rows['fee_dues'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: -15px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['gender'] ?></div>
									</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: -5px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['nationality'] ?></div>
									</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 0px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['relegion'] ?></div>
									</td>
									<td>
										<div style="  margin-top: -35px; text-align: left; padding-left: 150px; padding-bottom: 20px"><?php echo $rows['fee_concessions'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 0px; text-align: right; padding-right: 120px; padding-bottom: 20px"><?php echo $rows['caste'] ?></div>
									</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 10px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo $rows['father_name'] ?></div>
									</td>
									<td>
										<div style="  margin-top: -35px; text-align: left; padding-left: 150px; padding-bottom: 20px"><?php echo $rows['scholarship'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 10px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo $rows['mother_name'] ?></div>
									</td>
									<td>
										<div style="  margin-top: -35px; text-align: right; padding-left: 150px; padding-bottom: 20px"><?php echo $rows['medicalExamined'] ?></div>
									</td>
								</tr>
								<tr>
									<td>

									</td>
									<td>
										<div style="  margin-top: -5px; text-align: right; padding-left: 150px; padding-bottom: 20px"><?php echo $rows['whethersct'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 15px; text-align: right; padding-right: 180px; padding-bottom: 20px"><?php echo $rows['medicalExamined'] ?></div>
									</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 12px; text-align: right; padding-right: 180px; padding-bottom: 20px"><?php echo $rows['whether_qualified'] ?></div>
									</td>
									<td>
										<div style="  margin-top: -8px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo date("d-m-Y",strtotime($rows['tcapplication_date'])) ?></div>
									</td>
								</tr>
								<tr>
									<td>

									</td>
									<td>
										<div style="  margin-top: 0px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo date("d-m-Y",strtotime($rows['date'])) ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: -25px; text-align: left; padding-left: 20px; padding-bottom: 20px">
											<span style="padding-left:80px; " ><?php echo date("d-m-Y",strtotime($rows['dob'])) ?></span>
											<span style="line-height: 2; margin-left: -10px;"><br/><nobr><?php
												$month = date('F', strtotime($rows['dob']));
												$day = date('d', strtotime($rows['dob']));
												$year = date('Y', strtotime($rows['dob']));
												echo trim(ucwords(trim(no_to_words($day)))." - ".trim($month)." - ".trim(ucwords(no_to_words($year))));
												?></nobr></span>
										</div>
									</td>
									<td>
										<div style="  margin-top: 25px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo $rows['no_schooldays'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 20px; text-align: left; padding-left: 20px; padding-bottom: 20px">
											<span style="padding-left:0px; " ><?php echo $rows['place'] ?></span>
											<span style="padding-left: 10px; "><?php echo $rows['taluk'] ?></span>
											<span style="padding-left: 10px; "><?php echo $rows['district'] ?></span>

										</div>
									</td>
									<td>
										<div style="  margin-top: 10px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo $rows['no_schooldays_attended'] ?></div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="  margin-top: 40px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo $rows['standard_leaving'] ?></div>
									</td>
									<td>
										<div style="  margin-top: -45px; text-align: right; padding-right: 80px; padding-bottom: 20px"><?php echo $rows['conduct'] ?></div>
									</td>
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