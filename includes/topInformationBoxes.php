<div class="row-fluid">
	<!-- Information Boxes: Users Registered -->
	<div class="span4 well infobox">
		<i class="icon-6x icon-group"></i>

		<div class="pull-right text-right">
			Total Students<br>
			<b class="huge"><?php include_once('projectinc/totalStudentsActive.php'); ?></b><br>
			<span class="caps muted">Active</span>
		</div>
	</div>

	<!-- / Information Boxes: Images -->
	<div class="span4 well infobox">
		<i class="icon-6x icon-shield"></i>

		<div class="pull-right text-right">
			Academic Year<br><b> <?php echo academicYear(); ?></b><br>
			<b class="huge">+<?php include_once('projectinc/totalAdmissionCount.php'); ?></b><br>
			<span class="caps muted">Application's</span>
		</div>
	</div>
	<!-- Information Boxes: Applications -->
	<div class="span4 well infobox">
		<i class="icon-6x icon-dollar"></i>

		<div class="pull-right text-right">
			Fees Paid in <?php echo date("M") ?><br>
			<b class="huge"><?php include_once('projectinc/feesPaid.php'); ?></b><br>
            <span class="caps muted"><?php include_once('projectinc/feesPaidToday.php'); ?><?php ?> Paid Today.
	            <?php if ($_SESSION['Role'] == "1") { ?>
                <br/>Total <?php include_once ('projectinc/feesPaidTotal.php'); ?><?php ?>.
	            <?php } ?>
	        </span>
		</div>
	</div>
	<!-- / Information Boxes: Applications -->

</div>