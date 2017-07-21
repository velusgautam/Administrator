<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error;
		$counter = $db->query_first("Select count(*) as counter, count FROM " . TABLE_APPLICATION_RECEIPT . " WHERE `application_no`=" . intval(trim($_POST['applicationNo'])));
		$count = (intval($counter['counter']) > 0) ? intval($counter['count']) + 1 : 1;
		$data['count'] = $count;
		$data['application_no'] = $db->escape($_POST['applicationNo']);
		$data['amount'] = $db->escape($_POST['amount']);
		$data['school_code'] = $db->escape($_POST['schoolCode']);
		$data['name'] = $db->escape($_POST['name']);
		$data['entered_by'] = $db->escape($_POST['entered_by']);
		if (intval($counter['counter']) > 0)
			$id = $db->query_update(TABLE_APPLICATION_RECEIPT, $data, " application_no=".$data['application_no']);
		else
			$id = $db->query_insert(TABLE_APPLICATION_RECEIPT, $data);
	}
?>