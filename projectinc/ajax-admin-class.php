<?php
	define("_VALID_PHP", true);
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$schl_id = intval($_POST[id]);

		if (!empty($schl_id)) {
			$data = $db->query_first("Select Count(DISTINCT stream_id) as count from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $schl_id . "");
			if ($data['count'] == 2) {

				?>

				<div class="span5">
					<div class="span3">
						<label class="control-label">Stream:</label>
					</div>
					<div class="controls" style="margin-left: 80px">
						<select class="input-block-level ap-form-input80" tabindex="8"
						        name="streamApplied" id="streamApplied">
							<option value="1">STATE</option>
							<option value="2">ICSE</option>
						</select>
						<script type="text/javascript">
							$("#streamApplied").change(function () {
								var streamId = $(this).val();
								var id = <?php echo $schl_id?>;
								var dataString = 'id=' + id+'& sid='+streamId;
								$.ajax
								({
									type: "POST",
									url: "projectinc/ajax-class.php",
									data: dataString,
									cache: false,
									success: function (html) {
										$("#classApplied").html(html);
									}
								});
							});
						</script>
					</div>
				</div>
				<div class="span7">
				<div class="span3">
					<label class="control-label">Class Applied For:</label>
				</div>
				<div class="controls">
				<select class="input-block-level ap-form-input80" tabindex="8" placeholder="Class Applied For"
				name="classApplied" id="classApplied">
					<?php
						$sql_1 = "SELECT class_id, class_name FROM `" . TABLE_CLASS . "` WHERE class_id IN (Select DISTINCT class_id from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $schl_id . " stream_id = 1) ORDER BY class_name
										ASC";
						$result = $db->query($sql_1);
						echo '<option value="All"  selected="selected">Select Class</option>';
						while ($classSelect = $db->fetch_array($result)) {
							echo '<option value="' . $classSelect['class_id'] . '">' . $classSelect['class_name'] . '</option>';
						}
					?>
				</select>
				</div>
				<?php

			} else {
				$sData = $db->query_first("Select DISTINCT stream_id as streamId from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $schl_id . "");

				?>
				<div class="span3">
					<label class="control-label">Class Applied For:</label>
				</div>
				<div class="controls">
					<select class="input-block-level ap-form-input80" tabindex="8" placeholder="Class Applied For"
					        name="classApplied" id="classApplied">
						<?php
							$sql_1 = "SELECT class_id, class_name FROM `" . TABLE_CLASS . "` WHERE class_id IN (Select DISTINCT class_id from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $schl_id . ") ORDER BY class_name
										ASC";
							$result = $db->query($sql_1);
							echo '<option value="All"  selected="selected">Select Class</option>';
							while ($classSelect = $db->fetch_array($result)) {
								echo '<option value="' . $classSelect['class_id'] . '">' . $classSelect['class_name'] . '</option>';
							}
						?>
					</select>
				</div>

			<?php
				echo "<input type='hidden' value='" . intval(trim($sData['streamId'])) . "' name='streamApplied'>" . PHP_EOL;
			}
		} else {
			echo '<option value="All"  selected="selected">Select Class</option>';
		}
	}
?>