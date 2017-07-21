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
		$stream = intval($_POST[sid]);
		if (!empty($schl_id) && empty($stream)) {
			$sql_1 = "SELECT class_id, class_name FROM `" . TABLE_CLASS . "` WHERE class_id IN (Select DISTINCT class_id from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $schl_id . ") ORDER BY class_name
										ASC";
			$result = $db->query($sql_1);
			echo '<option value="All"  selected="selected">Select Class</option>';
			while ($classSelect = $db->fetch_array($result)) {
				echo '<option value="' . $classSelect['class_id'] . '">' . $classSelect['class_name'] . '</option>';
			}
		}
		else if(!empty($schl_id) && !empty($stream)) {
			$sql_1 = "SELECT class_id, class_name FROM `" . TABLE_CLASS . "` WHERE class_id IN (Select DISTINCT class_id from " . TABLE_CLASS_MAPPING . " WHERE schl_id=" . $schl_id . " AND stream_id = ".$stream.") ORDER BY class_name
										ASC";
			$result = $db->query($sql_1);
			
			while ($classSelect = $db->fetch_array($result)) {
				echo '<option value="' . $classSelect['class_id'] . '">' . $classSelect['class_name'] . '</option>';
			}
		}
		else
		{
			echo '<option value="All"  selected="selected">Select Class</option>';
		}
	}
?>