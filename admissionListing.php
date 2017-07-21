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
                <?php include_once('adminBusinessLogic/admissionTableList.php'); ?>

        </div>

    </div>

</div>

<?php include('includes/footer.php'); ?>

</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>