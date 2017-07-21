<?php
include_once('adminBusinessLogic/security.php');
include_once('includes/headerPhp.php');
require_once('adminBusinessLogic/isAdmin.php');
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

                        <?php include_once('adminBusinessLogic/feeTableList.php'); ?>

            </div>
        </div>
        <?php include('includes/footer.php'); ?>
    </body>
    <?php include_once('includes/footerJavascript.php'); ?>
</html>