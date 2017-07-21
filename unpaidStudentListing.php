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
<div class="container">
	<?php include_once('includes/menu.php'); ?>
	<div class="row-fluid">
		<div class="span12">

			<form>
				<table style="width: 100%; border-radius: 5px; background-color: #fff; margin-top: 5px; ">
					<tr>
			                <td style="width: 12%; height: 25px">
						</td>
				        <td style="width: 32%;text-align: center">Student Name:</td>
				        <td style="text-align: center">
					        CLASS
				        </td>
						<td style="text-align: center">
							ACADEMIC YEAR
						</td>

				        <td rowspan="2">
				                <button class="btn-success" style="padding: 8px 16px;border-radius: 5px;margin-left: 15px;margin-top: 10px;" type="submit" id="LoadRecordsButton">Search</button>
				        </td>
						
			                <td style="width: 12%">

				        </td>
			        </tr>
			        <tr>
						<td>
</td>
				        <td style="text-align: right; vertical-align: top" >
						<input class="input-block-level" type="text" name="name" id="name" tabindex="1"/>
						</td>

				        <td style="padding:0px 5px 0px 5px;">
							<select class="input-block-level" name="classData" id="classData" tabindex="2">
								<?php
									echo "<option value='All'>All</option>";
									if ($_SESSION['Role'] == '1') {
										$sql = "Select DISTINCT TC.class_name, TCM.schl_id, TS.school_code, TC.class_id, TCM.stream_id FROM " . TABLE_CLASS_MAPPING . " TCM
                                        INNER JOIN " . TABLE_SCHOOL . " TS ON TS.schl_id = TCM.schl_id
                                        INNER JOIN " . TABLE_CLASS . " TC ON TC.class_id = TCM.class_id
                                         ORDER BY TS.school_code ASC";

									} else {
										$sql = "Select  DISTINCT TC.class_name, TCM.schl_id, TS.school_code, TC.class_id, TCM.stream_id FROM " . TABLE_CLASS_MAPPING . " TCM
                                        INNER JOIN " . TABLE_SCHOOL . " TS ON TS.schl_id = TCM.schl_id
                                        INNER JOIN " . TABLE_CLASS . " TC ON TC.class_id = TCM.class_id
                                        WHERE TCM.schl_id= " . $_SESSION['SchoolCode'];
										$counter = $db->query_first("Select DISTINCT stream_id FROM ".TABLE_CLASS_MAPPING." where schl_id= " . $_SESSION['SchoolCode']."");
									}

									$resultClassData = $db->query($sql);
									while ($classRow = $db->fetch_array($resultClassData)) {
										$stream = ($classRow['stream_id'] == '1') ? "STATE" : "ICSE";
										$studVal = $classRow['schl_id'] . "~" . $classRow['class_id'] . "~" . $classRow['stream_id'];

									if ($_SESSION['Role'] == '1') {
										echo "<option value='" . $studVal . "'>" . $classRow['school_code'] . "-" . $stream. "-" .   $classRow['class_name']. "</option>";
									}
										else if(intval($counter)==1)
										{
											echo "<option value='" . $studVal . "'>" . $classRow['class_name']. "</option>";
										}
										else
										{
											echo "<option value='" . $studVal . "'>" .  $stream. "-" .   $classRow['class_name']. "</option>";
										}
									}

								?>
							</select>
						</td>
				        <td style="padding:0px 0px 0px 5px;">
					        <select class="input-block-level" data-placeholder="Choose a Academic Year" tabindex="3"
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
				        </td>


				        <td colspan="2" style="width: 10%">

                            </td>
                        </tr>
                    </table>
                </form>
				<div class="well no-padding">
                    <?php include_once('adminBusinessLogic/unpaidStudentTableList.php');?>
				</div>
			</div>
		</div>
	</div>
  <?php include('includes/footer.php'); ?>
</body>
<?php include_once('includes/footerJavascript.php'); ?>
</html>