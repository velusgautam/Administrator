<div class="navbar navbar-inverse" id="nav">


    <div class="navbar-inner">


        <ul class="nav">


            <li <?php if ($surl == "developmentStudentListing.php") {
                echo 'class="active"';
            } ?>><a href="developmentStudentListing.php"><i class="icon-home"></i> Student Listing</a></li>
            <li <?php if ($surl == "developmentAdvanceStudentListing.php") {
                echo 'class="active"';
            } ?>><a href="developmentAdvanceStudentListing.php"><i class="icon-home"></i> Advance Payment Listing</a></li>

            <li <?php if ($surl == "developmentFeeReport.php") {
                echo 'class="active"';
            } ?>><a href="developmentFeeReport.php"><i class="icon-file"></i> Development Fee Report</a></li>

	        <?php if ($_SESSION['Role'] === "1") { ?>
	        <li <?php if ($surl == "developmentSchoolSetting.php") {
		        echo 'class="active"';
	        } ?>><a href="developmentSchoolSetting.php"><i class="icon-file"></i> Development Fee Setting</a></li>
		        <li <?php if ($surl == "developmentStaffListing.php") {
			        echo 'class="active"';
		        } ?>><a href="developmentStaffListing.php"><i class="icon-file"></i> Login Listing</a></li>
	        <?php } ?>
        </ul>


    </div>


</div>
