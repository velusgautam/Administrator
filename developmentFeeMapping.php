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


	<?php include('includes/checkbox_jquery_fee.php'); ?>
</head>
<body class="inside-body">

<?php include_once('includes/topBody.php'); ?>
<?php include_once("includes/topMessagesBar.php"); ?>

<?php include_once("includes/topNewMessagesBar.php"); ?>

<div class="container">

	<?php include_once('includes/developmentMenu.php'); ?>
	<div class="row-fluid">

		<div class="span12">
			<div>
				<?php
					if($_SESSION['developmentFeeSet']==1)
					{
						$_SESSION['developmentFeeSet'] = "";
						echo '<div class="alert alert-success alert-block" style="width: 500px;text-align: center;margin: 0 auto;margin-bottom: 20px;">
                    <a class="close" data-dismiss="alert" href="#">x</a>
                    <h5 class="alert-heading">Updated Development Fees Successfully.</h5></div>';
					}
					else if($_SESSION['developmentFeeSet']==2)
					{
						$_SESSION['developmentFeeSet'] = "";
						echo '<div class="alert alert-warning alert-block" style="width: 500px;text-align: center;margin: 0 auto;margin-bottom: 20px;">
                    <a class="close" data-dismiss="alert" href="#">x</a>
                    <h5 class="alert-heading">Some Error Occurred Please try Again.</h5></div>';
					}

				?>
			</div>

			<div class="top-bar">
				<h3><i class="icon-user"></i>School Setting
					<Page></Page>
				</h3>
			</div>

			<div class="well no-padding">

				<form id="developmentFeeForm" method="post" class="form-horizontal" enctype="multipart/form-data"
				      action="adminBusinessLogic/developmentFeeSettingSave.php">
					<div class="control-group">
						<?php
							$data = $db->query_first("Select TS.school_name FROM " . TABLE_SCHOOL . " TS WHERE `schl_id`=" . $_GET['id']);
							$count = $db->affected_rows;
							if ($count == 0 || $count > 1) {
								redirect_to('developmentSchoolSetting.php');
							}
							print"<div align=\"center\"><h5>" . $data['school_name'] . "</h5>";
							?>

							<select name="academicYear" id="academicYear" style="width: 140px">

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



							<?php print "</div> <input type='hidden' value='" . $_GET['id'] . "' name='schoolId' >";
						?>
					</div>

					<div class="control-group" id="developmentFeeSetting">


					</div>

					<div class="form-actions stdFormAction">

						<button type="reset" id="cancel" class="btn" tabindex="9">Cancel</button>
						<input type="submit" class="btn btn-primary" id="save" tabindex="8" value="Save">

						<div id='loading'></div>
					</div>

				</form>

			</div>

		</div>

	</div>

</div>
<?php include('includes/footer.php'); ?>
</body>
<script>
	$(document).ready(function () {
		$.ajax({
			method: "POST",
			url: "projectinc/developmentFeeSetting.php",
			data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
		}).done(function (data) {
			document.getElementById('developmentFeeSetting').innerHTML = data;
		});

		$('#academicYear').on('change', function () {
			$.ajax({
				method: "POST",
				url: "projectinc/developmentFeeSetting.php",
				data: {id: "<?php echo  $_GET['id']?>", academic_year: $("#academicYear").val()}
			}).done(function (data) {
				document.getElementById('developmentFeeSetting').innerHTML = data;
			});
		});
	});

</script>
<?php include_once('includes/footerJavascript.php'); ?>
</html>