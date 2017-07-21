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
        <div class="span12">
            <div id='preview'>
                <?php
                if($_SESSION['dbstatus']==1)
                {
                    $_SESSION['dbstatus'] = "";
                    echo '<div class="alert alert-success alert-block" style="width: 500px;text-align: center;margin: 0 auto;margin-bottom: 20px;">
                    <a class="close" data-dismiss="alert" href="#">x</a>
                    <h5 class="alert-heading">Backup Done. Only One backup Per/Day is Created.</h5></div>';
                }
                ?>
            </div>

            <div class="top-bar">
                <h3><i class="icon-user"></i>Db Backup Listing

                </h3>
            </div>
            <div class="well no-padding">

                <div class="control-group" style="font-size:30px;text-align:center;">
                    <img src="assets/img/database-icon.png">
               Create new backup file manually&nbsp;
               <a href="adminBusinessLogic/dbBackup.php" class="btn  btn-lg" role="button">Create Backup</a>

                </div>
                <div class="control-group">
                    <div align="center"> <h5>Previous Backup Files</h5></div>
                </div>
                <div class="span12 control-group">
                    <?php
                    $sql = "Select backup_id, backup_name, backup_time FROM " . TABLE_DB_BACKUP ." ORDER BY backup_id DESC";
                    $rows = $db->query($sql);
                    $i=0;
                    while ($row = $db->fetch_array($rows)) {
                        ?>
                        <div class="span3 padding <?php echo ($i % 4 == 0) ? "no-left-margin" : "" ?>">
                            <div class="span4">
                                <img src="assets/img/database-icon.png">
                            </div>
                            <div class="8">
                                <?php echo '<strong>Database Backup</strong><br/>' . date('d-m-Y', strtotime($row['backup_time'])) . '<br/>'; ?>
                            </div>

                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>


            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>