<?php
	include_once('adminBusinessLogic/developmentSecurity.php');
	include_once('includes/headerPhp.php'); ?>
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
<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>
<?php include_once("includes/topNewMessagesBar.php"); ?>
<div class="container">

	<?php include_once('includes/developmentMenu.php'); ?>

	<div class="row-fluid">

		<div class="span12">
			<div id='preview'></div>
			<div class="top-bar">
				<h3><i class="icon-user"></i>School Setting Page</h3>
			</div>
			<div class="well no-padding">
				<div class="span12">
					<div style="margin: 15px">
						<table style="width: 100%; border-radius: 5px; background-color: #dddddd; margin-top: 5px; "
							>
							<thead>
							<tr style="height:45px; border-bottom: 1px solid #C8C8C8;">
								<th>Sl.No</th>
								<th>School Code</th>
								<th>School Name</th>
								<th>Fees Setting</th>
							</tr>

							</thead>
							<?php
								$sql = "Select TS.schl_id, TS.school_code, TS.school_name FROM " . TABLE_SCHOOL . " TS ORDER BY TS.school_code ASC";
								$resultSchoolData = $db->query($sql);
								$i = 1;
								while ($schoolRow = $db->fetch_array($resultSchoolData)) {
									?>
									<tr style="height: 40px;  <?php if ($i % 2 == 0) echo "background-color: #eeeeee"; ?>">
										<td style="text-align: center"><?php echo $i; ?></td>
										<td style="text-align: center"><?php echo $schoolRow['school_code']; ?></td>
										<td style="text-align: center"><?php echo $schoolRow['school_name']; ?></td>

										<td style="text-align: center"><?php echo "<button onclick=\"if (confirm('Are you sure you want to Add/ Modify Fees Settings?')) window.location = 'developmentFeeMapping.php?id=" . $schoolRow['schl_id'] . "'\"
                                    title=\"Click to Set Fees\"  class='btn-sm btn-info'>Development Fees Settings</button>"; ?></td>
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
<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>