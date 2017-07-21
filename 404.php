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
        ?>
    </head>

    <body class="inside-body">

        <?php include_once('includes/topBody.php'); ?>

        <?php include_once("includes/topMessagesBar.php"); ?>

        <?php include_once("includes/topNewMessagesBar.php"); ?>


        <div class="container">
            <?php include_once('includes/menu.php'); ?>

            <div class="row-fluid">

                <div class="span12" >
                    <div class="well  text-center">
                        <div style="font-size: 150px; margin-top:100px;  height: 180px; color: #eb6363">Oops 404!!!</div>
                        <h3>Page Not Found.</h3><h5>Looks like the page you are trying to visit doesn't exist or some error occurred.</h5>
                        <h5>Try again and if it still shows up, contact your administrator.</h5>
                    </div>
                </div>
            </div>

        </div>

        <?php include('includes/footer.php'); ?>

    </body>

    <?php include_once('includes/footerJavascript.php'); ?>

</html>