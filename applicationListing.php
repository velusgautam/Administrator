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

    <?php include_once('includes/menu.php'); ?>

    <div class="row-fluid">

        <div class="span12">
	        <form>
		        <table style="width: 100%; border-radius: 5px; background-color: #fff; margin-top: 5px; ">
			        <tr>
				        <td style="width: 16%; height: 25px">
				        </td>
				        <td style="width: 40%;text-align: center">Student Name:</td>

				        <td style="text-align: center">
					        Application Number
				        </td>

				        <td rowspan="2">
					        <button class="btn-success" style="padding: 8px 16px;border-radius: 5px;margin-left: 15px;margin-top: 10px;" type="submit" id="LoadRecordsButton">Search</button>
				        </td>
				        <td style="width: 20%">

				        </td>
			        </tr>
			        <tr>
				        <td>
				        </td>
				        <td style="text-align: right; vertical-align: top" >
					        <input class="input-block-level" type="text" name="name" id="name"/>

				        </td>

				        <td>
					        <input class="input-block-level" style="padding: 0px 10px" type="text" name="application_no" id="application_no"/>

				        </td>


				        <td style="width: 20%">

				        </td>
			        </tr>
		        </table>
	        </form>
                <?php include_once('adminBusinessLogic/applicationTableList.php'); ?>

        </div>

    </div>

</div>

<?php include('includes/footer.php'); ?>

</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>