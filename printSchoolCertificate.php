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
			redirect_to('studentCertificateListing.php');
		}


		$sql = "SELECT  * FROM ".TABLE_SCHOOL_CERTIFICATE." TS
		        WHERE TS.id = " . $id;

		$rows = $db->query_first($sql);

		if ($db->affected_rows == 0) {
			redirect_to('studentCertificateListing.php');
		}




	?>
	<script language="javascript" type="text/javascript">
		window.history.forward(1);
		function printDiv(divID) {
			var divElements = document.getElementById(divID).innerHTML;
			var oldPage = document.body.innerHTML;
			var page = "<html><head><title></title>";

			page = page + "</head><body style='background-color: #ffffff'>" + divElements + "</body>";
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
				<h3><i class="icon-user"></i>STUDY CERTIFICATE</h3>
			</div>
			<div class="well no-padding">
				<table width="100%">
					<tbody>
					<tr>
						<td style="float: right; padding-top: 15px; ">

							<div class="btn-group" ><input class=" btn-large btn-success" type="button" value="Print"
							                                                           onClick="javascript:printDiv('receipt')"/></div>
							<div class="btn-group" style="padding-right:75px;"> <a href="studentDetails.php?id=<?php echo $_GET['studid']?>" > <div class="btn-large btn-primary" style="color: #ffffff; height: 24px" >Back</div></a>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="widget-box" style="border: 1px solid #000000; margin-bottom: 30px" >
										<div class="span12 text-center"><h4>STUDY CERTIFICATE</h4></div>
					<div id="receipt" style="margin:15px; background-color: #ffffff">
						<br>

						<div style="font-family:'Segoe UI'; font-size:13px; width:650px; margin:0 auto; padding:20px; padding-top: 25px">
							<table style="width: 100%; margin-top: 312px">
								<tr>
									<td style="width: 100%">
										<div style="text-align: left; padding-left:230px; font-size: 18px; font-weight: bold"><?php echo $rows['student_name']?></div>
									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 18px; padding-left:130px; font-size: 18px; font-weight: bold"><?php echo $rows['father_name']?></div>
									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 17px; padding-left:330px;  font-size: 18px; font-weight: bold">
											<span><?php echo $rows['f_year']?></span>
											<span style="padding-left: 100px"><?php echo $rows['t_year']?></span>
										</div>

									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 16px; padding-left:210px;  font-size: 18px; font-weight: bold">
											<span><?php echo $rows['s_from']?></span>
											<span style="padding-left: 140px"><?php echo $rows['s_to']?></span>
										</div>

									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 16px; padding-left:500px;  font-size: 18px; font-weight: bold">
											<span><?php echo date("d-m-Y",strtotime($rows['dob']))?></span>

										</div>

									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 16px; padding-left:130px;  font-size: 18px; font-weight: bold">
											<span ><?php
													$month = date('F', strtotime($rows['dob']));
													$day = date('d', strtotime($rows['dob']));
													$year = date('Y', strtotime($rows['dob']));
													echo ucwords(trim(no_to_words($day)))." - ".$month." - ".ucwords(no_to_words($year));
												?></span>

										</div>

									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 16px; padding-left:260px;  font-size: 18px; font-weight: bold">
											<span><?php echo $rows['conduct']?></span>

										</div>

									</td>
								</tr>
								<tr>
									<td style="width: 100%;">
										<div style="text-align: left;  margin-top: 70px; padding-left:165px;  font-size: 18px; font-weight: bold">
											<span><?php echo date("d-m-Y")?></span>

										</div>

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