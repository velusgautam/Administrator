<div class="modal fade" id="excel-popup" tabindex="-1" role="dialog" aria-labelledby="excelModal" aria-hidden="true" style="width:65%; left: 35%; display: none;">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<span style="font-family:'Segoe UI'; font-weight: bold" id="myModalLabel">Excel Export</span>

			</div>
			<div class="modal-body" style="overflow-y: hidden">
				<script type="text/javascript">
					$(document).ready(function () {
						$('#searchBtn').click('change', function () {
							$("#data").html('');
							$("#search").ajaxForm({
								target:  '#data',
								success: function (html) {
									$("#loading").css("display", "none");
									$("#searchBtn").css("display", "");

								}
							}).submit();
						});


						$('#wait_1').hide();

						$('#school').change(function () {
							$('#wait_1').show();
							$.get("projectinc/excelDD.php", {
								func:    "streamSelect",
								schl_id: $('#school').val()
							}, function (response) {

								setTimeout("finishAjax('result_1', '" + escape(response) + "')", 100);

							});
							return false;
						});
					});

					function finishAjax(id, response) {
						$('#wait_1').hide();
						$('#' + id).html(unescape(response));
						$('#' + id).fadeIn();
					}
					function finishAjax_tier_three(id, response) {
						$('#wait_2').hide();
						$('#' + id).html(unescape(response));
						$('#' + id).fadeIn();
					}
					function finishAjax_division(id, response) {
						$('#wait_3').hide();
						$('#' + id).html(unescape(response));
						$('#' + id).fadeIn();
					}

				</script>
				<form id="search" method="post" class="form-horizontal" enctype="multipart/form-data" action="adminBusinessLogic/excelGeneratorStudentListing.php">
					<?php
						$width = "22%";
						if ($_SESSION['Role'] == "1") {
							$admin = true;
							$width = "18%";
						}
					?>
					<table style="width: 100%">
						<tr>
							<?php if ($admin) echo "<td style='width: $width'>School</td>"; ?>
							<td style="width:<?php echo $width; ?>">Stream</td>
							<td style="width:<?php echo ($width + 3) . "%"; ?>">Class</td>
							<td style="width:<?php echo ($width - 3) . "%"; ?>">Division</td>
							<td style="width:12%">Status</td>

						</tr>
						<tr>
							<?php if ($admin) {
								echo '
                            <td>
                                <select name="school" id="school" style="width: 135px">';
								include('projectinc/schlDDMsg.php');
								echo '</select>
                            <span id="wait_1" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
                            </td>
                            ';
								?>
								<td id="result_1">
									<select name="stream" id="stream" style="width: 150px;">

									</select>
								</td>
							<?php
							} else {

								$sql_1 = "SELECT DISTINCT  stream_id, IF( stream_id =  '1',  'STATE',  'ICSE' ) AS stream_name FROM `" . TABLE_CLASS_MAPPING . "` WHERE  schl_id=" . $_SESSION['SchoolCode'] . "";
								$result = $db->query($sql_1);
								$count = $db->affected_rows;
								if ($count > 1)
								{
									echo '<td id="result_1">'.PHP_EOL.'
									<select class="input-block-level" data-placeholder="Choose a Stream" tabindex="4" name="stream" id="streamSelect" style="width: 150px;">
										<option value="All"  selected="selected">All</option>';

									while ($streamSelect = $db->fetch_array($result)) {
										echo '<option value="' . $streamSelect['stream_id'] . '">' . $streamSelect['stream_name'] . '</option>';
									}

									echo '</select>
										<span id="wait_2" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
										</td>';
									echo "<script type=\"text/javascript\">
								    $('#wait_2').hide();
									$('#streamSelect').change(function(){
									  $('#wait_2').show();
									   $('#division').html(\"\");
									   $('#class').html(\"\");
								        $('#result_2').show();
									      $.get(\"projectinc/excelDD.php\", {
											func: \"classSelect\",
											drop_var: $('#streamSelect').val()+\"~\"+" . $_SESSION['SchoolCode'] . "
									      }, function(response){

									        setTimeout(\"finishAjax_tier_three('result_3', '\"+escape(response)+\"')\", 100);
									      });
									        return false;
										});
								</script>";
							}
							}
							?>

							<td id="result_3">
								<select name="class" id="class" style="width: 175px;">

								</select>
							</td>
							<td id="result_4">
								<select name="division" id="division" style="width: 150px;">

								</select>
							</td>
							<td id="cresult_5">
								<select name="status" id="status" style="width: 150px;">
									<option value="1" selected>Active</option>
									<option value="2">Terminated</option>

								</select>
							</td>

						</tr>
					</table>
					<div style="width: 100%">
						<hr>

						<div style="width: 100%; margin: 15px 10px; text-align: center">
							<h5>Student Details in Excel</h5>
						</div>
						<div  style="margin:10px 0px; width: 160px; float: left;">
							Admission Number :
							<input type="checkbox" value="1" checked name="adminNo">
						</div>
						<div  style="margin:10px 0px; width: 160px; float: left;">
							Student Name :
							<input type="checkbox" value="1" checked name="studentName">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							School Name:
							<input type="checkbox" value="1" checked name="schoolName">
						</div>
						<div  style="margin:10px 0px;width: 160px; float: left;">
							Stream:
							<input type="checkbox" value="1" checked name="streamCheck">
						</div>
						<div  style="margin:10px 0px;width: 160px; float: left;">
							Class :
							<input type="checkbox" value="1" checked name="classCheck">
						</div>
						<div  style="margin:10px 0px;width: 160px; float: left;">
							Division :
							<input type="checkbox" value="1" checked name="divisionCheck">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							D.O.B :
							<input type="checkbox" value="1" checked name="dob">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							Father Name :
							<input type="checkbox" value="1" checked name="fatherName">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							Phone Number :
							<input type="checkbox" value="1" checked name="fNumber">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							Mother Name :
							<input type="checkbox" value="1" checked name="motherName">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							Phone Number:
							<input type="checkbox" value="1" checked name="mNumber">
						</div>
						<div style="margin:10px 0px;width: 160px; float: left;">
							Status:
							<input type="checkbox" value="1" checked name="statusCheck">
						</div>
						<div style="width: 100%; float: left; text-align: right"">
								<br>
								<button style="padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px" name="search" id="searchBtn" type="button" class="btn btn-primary btn-large">Excel Export</button>
								<div id='loading'></div>

						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>