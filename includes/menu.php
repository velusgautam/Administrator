<div class="navbar navbar-inverse" id="nav">

	<div class="navbar-inner">

		<ul class="nav">

			<li <?php if ($surl == "dashboard.php") {
				echo 'class="active"';
			} ?>><a href="dashboard.php"><i class="icon-home"></i> Dashboard</a></li>

			<li class="dropdown <?php if ( $surl == "applicationForm.php" || $surl == "applicationListing.php" || $surl == "admissionForm.php" || $surl == "admittedApplicationListing.php" || $surl == "admissionListing.php") {
				echo 'active';
			} ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-shield"></i> Admission <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">

					<li <?php if ($surl == "applicationForm.php") {
						echo 'class="active"';
					} ?>><a href="applicationForm.php"><i class="icon-file"></i>New Application From</a></li>
					<li style="background-color: lightgreen" <?php if ($surl == "applicationListing.php") {
						echo 'class="active"';
					} ?>><a href="applicationListing.php"><i class="icon-th"></i> Application Listing</a></li>
					<li <?php if ($surl == "admittedApplicationListing.php") {
						echo 'class="active"';
					} ?>><a href="admittedApplicationListing.php"><i class="icon-th"></i>Admitted Application Listing</a></li>
					<li <?php if ($surl == "admissionListing.php") {
						echo 'class="active"';
					} ?>><a href="admissionListing.php"><i class="icon-th"></i> Admission Form Listing</a></li>


				</ul>
			</li>

			<li class="dropdown <?php if ($surl == "studentPromotion.php" ||$surl == "studentAfterTCListing.php" ||$surl == "insidePromottedStudentListing.php" ||$surl == "unpaidStudentListing.php" || $surl == "feePayment.php" ||$surl == "studentCertificateListing.php" ||$surl == "inactiveStudentListing.php" ||$surl == "studentRegistration.php" || $surl ==
				"studentListing.php" || $surl == "studentChangeListing.php"|| $surl == "studentUpdate.php"|| $surl == "studentDetails.php") {
				echo 'active';
			} ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-user"></i> Student Details <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">

					<li <?php if ($surl == "studentListing.php") {
						echo 'class="active"';
					} ?>><a href="studentListing.php"><i class="icon-user-md"></i>Active Student Listing</a></li>

					<li <?php if ($surl == "inactiveStudentListing.php") {
						echo 'class="active"';
					} ?>><a href="inactiveStudentListing.php"><i class="icon-user"></i> Inactive Student Listing</a></li>

					<li <?php if ($surl == "unpaidStudentListing.php") {
						echo 'class="active"';
					} ?>><a href="unpaidStudentListing.php"><i class="icon-user"></i> Unpaid Student Listing</a></li>

					<li <?php if ($surl == "studentCertificateListing.php") {
						echo 'class="active"';
					} ?>><a href="studentCertificateListing.php"><i class="icon-th"></i> Student Certificates</a></li>
					<li <?php if ($surl == "studentPromotion.php") {
						echo 'class="active"';
					} ?>><a href="studentPromotion.php"><i class="icon-th"></i> Student Promotion</a></li>
                    <li <?php if ($surl == "insidePromottedStudentListing.php") {
						echo 'class="active"';
					} ?>><a href="insidePromottedStudentListing.php"><i class="icon-th"></i> Inside Promotted Listing</a></li>
					<li <?php if ($surl == "studentAfterTCListing.php") {
						echo 'class="active"';
					} ?>><a href="studentAfterTCListing.php"><i class="icon-th"></i> After TC Listing</a></li>
					<li <?php if ($surl == "studentArchiveListing.php") {
						echo 'class="active"';
					} ?>><a href="studentArchiveListing.php"><i class="icon-th"></i> After Archive Listing</a></li>
				</ul>
			</li>




			<?php if ($_SESSION['Role'] === "1") { ?>
				<li class="dropdown <?php if ($surl == "staffRegistration.php" || $surl == "staffListing.php") {
					echo 'active';
				} ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user-md"></i> Staff Details <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li <?php if ($surl == "staffRegistration.php") {
							echo 'class="active"';
						} ?>><a href="staffRegistration.php"><i class="icon-th"></i> Staff Registration</a></li>
						<li <?php if ($surl == "staffListing.php") {
							echo 'class="active"';
						} ?>><a href="staffListing.php"><i class="icon-th"></i> Staff Listing</a></li>
					</ul>
				</li>
			<?php } ?>


			<?php if ($_SESSION['Role'] === "1") { ?>
				<li class="dropdown <?php if ($surl == "schoolListing.php" ||$surl == "schoolSetting.php" || $surl == "classListing.php"|| $surl == "feeListing.php"|| $surl == "divisionListing.php") {
					echo 'active';
				} ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-building"></i> School <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">

						<li><a href="schoolListing.php"><i class="icon-building"></i> School Listing</a></li>
						<li><a href="classListing.php"><i class="icon-book"></i> Class Listing</a></li>
						<li><a href="divisionListing.php"><i class="icon-caret-right"></i> Division Listing</a></li>
						<li><a href="feeListing.php"><i class="icon-user-md"></i> Fee Listing</a></li>
						<li><a href="schoolSetting.php"><i class="icon-building"></i> School Setting</a></li>

					</ul>
				</li>
			<?php } ?>
			<li class="dropdown <?php if ($surl == "reportSchoolFees.php" || $surl == "reportBalanceSchoolFees.php" ) {
				echo 'active';
			} ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-file"></i>Reporting <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">

					<li <?php if ($surl == "reportSchoolFees.php") {
						echo 'class="active"';
					} ?>><a href="reportSchoolFees.php"><i class="icon-download"></i>Fee Reporting</a></li>
					<li <?php if ($surl == "reportBalanceSchoolFees.php") {
						echo 'class="active"';
					} ?>><a href="reportBalanceSchoolFees.php"><i class="icon-download"></i>Balance Fee Reporting</a></li>
				</ul>
			</li>
			<?php if ($_SESSION['Role'] === "1") { ?>
				<li class="dropdown <?php if ($surl == "adminPanel.php" || $surl == "dbBackupListing.php") {
					echo 'active';
				} ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-file"></i>Backup <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">

						<li <?php if ($surl == "dbBackupListing.php") {
							echo 'class="active"';
						} ?>><a href="dbBackupListing.php"><i class="icon-download"></i>Database Backup</a></li>
					</ul>
				</li>
			<?php } ?>



		</ul>

	</div>

</div>
