<?php
	/**
	 * Created by Wixzi Solutions.
	 * Project: SMS
	 * User: Gautam
	 * Date: 11/17/13
	 * FileName: breadcrub.php
	 */
	echo '
<div class="breadcrumb clearfix">

			<!-- Top Fixed Bar: Breadcrumb Container -->
			<div class="container">

				<!-- Top Fixed Bar: Breadcrumb Location -->
				<ul class="pull-left">';
	if ($surl == "dashboard.php") {
		echo '<li class="active"><a href="#"><i class="icon-home"></i> Dashboard</a></li>';
	}
	if ($surl == "quickMessage.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-envelope"></i> SMS Message</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-envelope"></i> Quick Message</a></li>';
	}
	if ($surl == "staffMessage.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-envelope"></i> SMS Message</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-envelope"></i> Staff Message</a></li>';
	}
	if ($surl == "scheduleMessage.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-envelope"></i> SMS Message</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-envelope-alt"></i> Schedule Message</a></li>';
	}
	if ($surl == "routeMessage.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-envelope"></i> SMS Message</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-envelope"></i> Route Message</a></li>';
	}
	if ($surl == "groupMessage.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-envelope"></i> SMS Message</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-envelope-alt"></i> Group Message</a></li>';
	}
	if ($surl == "staffRegistration.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Staff Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user-md"></i> Staff Registration</a></li>';
	}
	if ($surl == "staffListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Staff Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user-md"></i> Staff Listing</a></li>';
	}
	if ($surl == "admissionListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user"></i> Admission Form Listing (Student Registration)</a></li>';
	}
	if ($surl == "applicationListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Admission</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user"></i> Application Listing </a></li>';
	}
	if ($surl == "admittedApplicationListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Admission</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user"></i>Admitted Application Listing </a></li>';
	}
	if ($surl == "studentListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user"></i> Student Listing</a></li>';
	}
	if ($surl == "studentUpdate.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li><a href="studentListing.php"><i class="icon-user"></i> Student Listing</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user-md"></i> Student Update</a></li>';
	}
	if ($surl == "studentDetails.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li><a href="studentListing.php"><i class="icon-user"></i> Student Listing</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-file"></i> Student Details</a></li>';
	}
	if ($surl == "feePayment.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li><a href="studentListing.php"><i class="icon-user"></i> Student Listing</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-dollar"></i> Fee Payment</a></li>';
	}
	if ($surl == "studentCertificateListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-file"></i> Student Certificate Listing</a></li>';
	}
	if ($surl == "inactiveStudentListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-user"></i> Inactive Student Listing</a></li>';
	}
	if ($surl == "unpaidStudentListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-minus"></i> Student Unpaid Listing</a></li>';
	}
	if ($surl == "studentPromotion.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-plus-sign"></i> Student Promotion</a></li>';
	}
	if ($surl == "insidePromottedStudentListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-plus-sign-alt"></i> Inside Promotion Listing</a></li>';
	}
	if ($surl == "studentAfterTCListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-eye-open"></i> Student After TC Listing</a></li>';
	}
if ($surl == "studentArchiveListing.php") {
	echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
	echo '<li><a href="#"><i class="icon-user"></i> Student Details</a><span class="divider">/</span></li>';
	echo '<li class="active"><a href="#"><i class="icon-eye-open"></i> Student Archive Listing</a></li>';
}
	if ($surl == "schoolRegistration.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-envelope"></i> Admin Controls</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-building"></i> School Registration</a></li>';
	}

	if ($surl == "schoolListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-building"></i> Schools</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-building"></i> School Listing</a></li>';
	}

	if ($surl == "classListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-building"></i> Schools</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-list-alt"></i> Class Listing</a></li>';
	}

	if ($surl == "divisionListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-building"></i> Schools</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-list-alt"></i> Division Listing</a></li>';
	}
	if ($surl == "feeListing.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-building"></i> Schools</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-list-alt"></i> Fees Listing</a></li>';
	}
if ($surl == "schoolSetting.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-building"></i> Schools</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-list-alt"></i> School Setting Page</a></li>';
	}

	if ($surl == "adminPanel.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user-md"></i> Administrator</a><span class="divider">/</span></li>';
		echo '<li class="active"><a href="#"><i class="icon-unlock"></i> Admin Panel</a></li>';
	}
	if ($surl == "developmentFeePayment.php") {
		echo '<li><a href="developmentStudentListing.php"><i class="icon-home"></i>Student Listing</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-user-md"></i> Development Fee Payment</a></li>';
	}

	if ($surl == "developmentStudentListing.php") {
		echo '<li><a href="developmentStudentListing.php"><i class="icon-home"></i>Student Listing</a></li>';

	}

	if ($surl == "developmentFeeReport.php") {
		echo '<li><a href="developmentFeeReport.php"><i class="icon-file"></i>Development Fee Report</a></li>';

	}

	if ($surl == "developmentSchoolSetting.php") {
		echo '<li><a href="developmentStudentListing.php"><i class="icon-home"></i>Student Listing</a><span class="divider">/</span></li>';
		echo '<li><a href="developmentSchoolSetting.php"><i class="icon-dollar"></i>Development Fee Setting</a></li>';

	}

	if ($surl == "applicationFeeSetting.php") {
		echo '<li><a href="schoolSetting.php"><i class="icon-building"></i>School Setting</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-dollar"></i> Application Fee Setting</a></li>';
	}

	if ($surl == "schoolFeeMapping.php") {
		echo '<li><a href="schoolSetting.php"><i class="icon-building"></i>School Setting</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-dollar"></i> School Fee Setting</a></li>';
	}

	if ($surl == "schoolClassMapping.php") {
		echo '<li><a href="schoolSetting.php"><i class="icon-building"></i>School Setting</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-sign-blank"></i> School Class Setting</a></li>';
	}

	if ($surl == "applicationForm.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i>Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-file-text"></i> Application Form</a></li>';
	}
	if ($surl == "admissionForm.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i>Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-file-text"></i> Admission Form</a></li>';
	}
	if ($surl == "reportSchoolFees.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i>Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-file-text"></i>Fee Reporting</a></li>';
	}
	if ($surl == "reportBalanceSchoolFees.php") {
		echo '<li><a href="dashboard.php"><i class="icon-home"></i>Dashboard</a><span class="divider">/</span></li>';
		echo '<li><a href="#"><i class="icon-file-text"></i>Balance Fee Reporting</a></li>';
	}

	echo '</ul>
				<ul class="pull-right">
					<li class="dropdown">
						<!-- Top Fixed Bar: Breadcrumb Theme Link -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-building"></i> ';
	echo $_SESSION['SchoolName'];

	echo '</a>
					</li>';

if($_SESSION['IsDev']=="1")
				echo'<li><a href="adminBusinessLogic/devLogout.php"><i class="icon-off"></i> Logout</a></li>';
else
				echo'<li><a href="adminBusinessLogic/logout.php"><i class="icon-off"></i> Logout</a></li>';

				echo'</ul>
		</div>

		</div>
		';
?>