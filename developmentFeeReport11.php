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

    <?php include_once('includes/developmentMenu.php'); ?>

    <div class="row-fluid">

        <div class="span12">
            <div id='preview'></div>
            <div class="top-bar">
                <h3><i class="icon-user"></i>Development Fee Report</h3>
            </div>
            <div class="well no-padding">
                <div class="span12">
                    <div style="margin: 15px">

                        <?php
                       // if ($_SESSION['Role'] == '1') {
                            ?>

                            <form action="adminBusinessLogic/excelDevFeeReport.php" method="post">
	                            <div class="span3">
		                            <label class="span6 devLabel">Choose Academic Year</label>
		                            <select class="span6 input-block-level" data-placeholder="Choose a Academic Year" tabindex="3"
		                                    name="academicYear" id="academicYear">
			                            <option
				                            value="2013-2014" <?php echo (((date("n") < 5) && (date("Y") == 2014)) || ((date("n") >= 5) && (date("Y") == 2013))) ? "selected" : ""; ?>>
				                            2013-2014
			                            </option>
			                            <option
				                            value="2014-2015" <?php echo (((date("n") < 5) && (date("Y") == 2015)) || ((date("n") >= 5) && (date("Y") == 2014))) ? "selected" : ""; ?>>
				                            2014-2015
			                            </option>
			                            <option
				                            value="2015-2016" <?php echo (((date("n") < 5) && (date("Y") == 2016)) || ((date("n") >= 5) && (date("Y") == 2015))) ? "selected" : ""; ?>>
				                            2015-2016
			                            </option>
			                            <option
				                            value="2016-2017" <?php echo (((date("n") < 5) && (date("Y") == 2017)) || ((date("n") >= 5) && (date("Y") == 2016))) ? "selected" : ""; ?>>
				                            2016-2017
			                            </option>
			                            <option
				                            value="2017-2018" <?php echo (((date("n") < 5) && (date("Y") == 2018)) || ((date("n") >= 5) && (date("Y") == 2017))) ? "selected" : ""; ?>>
				                            2017-2018
			                            </option>
			                            <option
				                            value="2018-2019" <?php echo (((date("n") < 5) && (date("Y") == 2019)) || ((date("n") >= 5) && (date("Y") == 2018))) ? "selected" : ""; ?>>
				                            2018-2019
			                            </option>
			                            <option
				                            value="2019-2020" <?php echo (((date("n") < 5) && (date("Y") == 2020)) || ((date("n") >= 5) && (date("Y") == 2019))) ? "selected" : ""; ?>>
				                            2019-2020
			                            </option>
		                            </select>
	                            </div>
								 <div class="span3">
		                            <label class="span6 devLabel">Choose School</label>
		                           <select  class="span6 input-block-level" data-placeholder="Choose a School"  id="school" name="school">
			                            <?php include_once('projectinc/schoolDropDownLogin.php'); ?>
		                         </select>
	                            </div>
								<div class="span3">
		                            <label class="span6 devLabel">Choose Month</label>
		                           <select  class="span6 input-block-level" data-placeholder="Choose Month"  id="month" name="month">			                           
                                                <option value="All" selected>All</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                                <option value="1">January</option>
                                                <option value="2">Februvary</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>                                           
		                         </select>
	                            </div>
                                <input type="submit" class="button btn-success btn-large pull-right" name="excel"
                                       id="excelExport" value="Excel Export"/>
                            </form>
                        <?php //} ?>
                        <table style="width: 100%; border-radius: 5px; background-color: #dddddd; margin-top: 5px; "
                               id="reportTable">
                            <thead>
                            <tr style="height:45px; border-bottom: 1px solid #C8C8C8;">
                                <th>Sl.No</th>
                                <th>Month</th>
                                <th>Student Name</th>
                                <th>School Code</th>
                                <th>Class Name</th>
                                <th>Academic Year</th>
                                <th>Development Fees</th>
                                <th>Waived Off</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Details</th>

							</tr>

							</thead>
							<?php

								if ($_SESSION['Role'] == '1') {
								$sql = "Select TSDF.student_id, MONTHNAME(TSDF.date) as month, TSDF.student_name,TSC.class_name, TSS.school_code, TSDF.development_fees, TSDF.total, TSDF.waive_off, (TSDF.development_fees - (TSDF.waive_off +TSDF.total)) as balance,
								TSDF.academic_year FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
								INNER JOIN ".TABLE_STUDENT." TS on TSDF.student_id = TS.student_id
								INNER JOIN ".TABLE_SCHOOL." TSS on TS.schl_id= TSS.schl_id
								INNER JOIN ".TABLE_CLASS." TSC on TSC.class_id= TS.class_id
								WHERE TS.status=1 ORDER BY TSDF.date DESC";

                            } else {
                                $sql = "Select TSDF.student_id, MONTHNAME(TSDF.date) as month, TSDF.student_name, TSC.class_name, TSS.school_code, TSDF.development_fees, TSDF.total, TSDF.waive_off, (TSDF.development_fees - (TSDF.waive_off +TSDF.total)) as balance,
								 TSDF.academic_year FROM " . TABLE_STUDENT_DEVELOPMENT_FEE . " TSDF
								INNER JOIN " . TABLE_STUDENT . " TS on TSDF.student_id = TS.student_id
								INNER JOIN " . TABLE_SCHOOL . " TSS on TS.schl_id= TSS.schl_id
								INNER JOIN " . TABLE_CLASS . " TSC on TSC.class_id= TS.class_id
								WHERE TS.status=1 AND TS.schl_id= " . $_SESSION['SchoolCode'] . " ORDER BY TSDF.date DESC";
                            }
                            $rows = $db->query($sql);
                            $i = 1;
                            if ($db->affected_rows == 0) {
                                ?>
                                <tr style="height: 40px; background-color: #D2D9DC">
                                    <td colspan="7" style="text-align: center">No Data found for the school.</td>
                                </tr>
                            <?php
                            }
                            while ($row = $db->fetch_array($rows)) {

									?>
									<tr style="height: 40px;  <?php if ($i % 2 == 0) echo "background-color: #eeeeee"; ?>">
										<td style="text-align: center"><?php echo $i; ?></td>
										<td style="text-align: center"><?php echo $row['month']; ?></td>
										<td style="text-align: center"><?php echo $row['student_name']; ?></td>
										<td style="text-align: center"><?php echo $row['school_code']; ?></td>
										<td style="text-align: center"><?php echo $row['class_name']; ?></td>
										<td style="text-align: center"><?php echo $row['academic_year']; ?></td>
										<td style="text-align: center"><?php echo $row['development_fees']; ?></td>
										<td style="text-align: center"><?php echo $row['waive_off']; ?></td>
										<td style="text-align: center"><?php echo $row['total']; ?></td>
										<td style="text-align: center"><?php echo $row['balance']; ?></td>
										<td style="text-align: center"><a href="developmentPreviousFeeListing.php?id=<?php echo $row['student_id'] ?>"><button>Details</button></a> </td>

                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>