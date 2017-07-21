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
    <!-- Alert -->
    <?php include_once('includes/bodyNotificationAlert.php'); ?>
    <!-- Information Boxes -->
    <?php include_once('includes/topInformationBoxes.php'); ?>

    <div class="row-fluid text-center">
        <a href="applicationForm.php" class="dashboard-links dl-bgcolor10" rel="tooltip" title="Application Form"><i
                class="icon-pencil"></i><span class="dashboard-text">Application Form</span></a>
	    <a href="applicationListing.php" class="dashboard-links dl-bgcolor1" rel="tooltip" title="Student Admission"><i
                class="icon-file"></i><span class="dashboard-text">Student Admission</span></a>
        <a href="admissionListing.php" class="dashboard-links dl-bgcolor2" rel="tooltip" title="Admission List"><i
                class="icon-list"></i><span class="dashboard-text">Admission List</span></a>
        <a href="studentListing.php" class="dashboard-links dl-bgcolor3" rel="tooltip" title="Student Listing"><i
                class="icon-group"></i><span class="dashboard-text">Student Listing</span></a>
	    <a href="unpaidStudentListing.php" class="dashboard-links dl-bgcolor4" rel="tooltip" title="Promoted Unpaid"><i
			    class="icon-dollar"></i><span class="dashboard-text">Promoted <br/> Unpaid</span></a>
	    <a href="studentPromotion.php" class="dashboard-links dl-bgcolor5" rel="tooltip" title="Student Promotion"><i
			    class="icon-plus-sign"></i><span class="dashboard-text">Student <br/>Promotion</span></a>
	    <a href="studentAfterTCListing.php" class="dashboard-links dl-bgcolor6" rel="tooltip" title="Inside Promotion After TC"><i
			    class="icon-plus-sign-alt"></i><span class="dashboard-text">Inside Promotion<br/> After TC</span></a>
	    <a href="inactiveStudentListing.php" class="dashboard-links dl-bgcolor11" rel="tooltip" title="Inactive Students"><i
			    class="icon-check-minus"></i><span class="dashboard-text">Inactive <br/>Students</span></a>
<!--        <a href="#" class="dashboard-links dl-bgcolor3" rel="tooltip" title="Book Issue List"><i-->
<!--                class="icon-book"></i><span class="dashboard-text">Book Issue List</span></a>-->
<!--        <a href="#" class="dashboard-links dl-bgcolor4" rel="tooltip" title="Withdraw List"><i-->
<!--                class="icon-remove"></i><span class="dashboard-text">Withdraw List</span></a>-->

        <a href="studentCertificateListing.php" class="dashboard-links dl-bgcolor7" rel="tooltip" title="Generate Certificate"><i
                class="icon-file"></i><span class="dashboard-text">Generate<br/> Certificate</span></a>


<!--        <a href="studentChangeListing.php" class="dashboard-links dl-bgcolor6" rel="tooltip"-->
<!--           title="Student Promotion"><i class="icon-user"></i><span class="dashboard-text">Promote Student</span></a>-->

        <?php if ($_SESSION['Role'] == 1) { ?>
            <a href="staffRegistration.php" class="dashboard-links dl-bgcolor8" rel="tooltip" title="Add Satff"
               style="padding-left: 37px; padding-right: 37px"><i class="icon-user-md"></i><span class="dashboard-text">Add Staff</span></a>
            <a href="schoolListing.php" class="dashboard-links dl-bgcolor9" rel="tooltip" title="School Listing"><i
                    class="icon-building"></i><span class="dashboard-text">School Listing</span></a>
	        <a href="dbBackupListing.php" class="dashboard-links dl-bgcolor10" rel="tooltip" title="Database Backup"><i
			        class="icon-download-alt"></i><span class="dashboard-text">DB Backup</span></a>
        <?php } ?>
        <!--<a href="classListing.php" class="dashboard-links dl-bgcolor10" rel="tooltip" title="Class Listing"><i
                class="icon-bookmark"></i><span class="dashboard-text">Class Listing</span></a>
        <a href="divisionListing.php" class="dashboard-links dl-bgcolor11" rel="tooltip" title="Division Listing"><i
                class="icon-bookmark-empty"></i><span class="dashboard-text">Division Listing</span></a>-->
        <!--            <a href="groupListing.php" class="dashboard-links dl-bgcolor12" rel="tooltip" title="Add Group"><i class="icon-group"></i><span class="dashboard-text">Group Listing</span></a>-->
        <!--            <a href="routeListing.php" class="dashboard-links dl-bgcolor13" rel="tooltip" title="Add Route"><i class="icon-truck"></i><span class="dashboard-text">Route Listing</span></a>-->
    </div>

</div>

<?php include('includes/footer.php'); ?>

</body>

<?php include_once('includes/footerJavascript.php'); ?>

</html>