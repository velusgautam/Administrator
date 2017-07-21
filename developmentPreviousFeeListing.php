<?php
	include_once('adminBusinessLogic/security.php');
	include_once('includes/headerPhp.php');
?>
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
	<div class="row-fluid ">
		<div class="span12">
			<div id='preview'>
				<?php

					if(isset($_SESSION['developmentFeeStatus']))
				{
				echo "<div class=\"alert alert-light alert-block\">
				<a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
				<h4 class=\"alert-heading\"> Information!!!</h4>
				<h5> " . $_SESSION['developmentFeeStatus']."</h5></div>";
					$_SESSION['developmentFeeStatus']=null;
				}
					?>
			</div>
			<?php include_once('adminBusinessLogic/developmentPreviousFeeTableList.php'); ?>
			</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>