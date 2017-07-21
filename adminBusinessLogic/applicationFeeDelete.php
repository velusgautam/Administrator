<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);
	$id = trim($_GET['id']);

	if (intval($id) > 0 && intval(trim($_GET['appId'])) > 0) {
		$Sql = "Delete from `" . TABLE_APPLICATION_FEE . "` WHERE `fee_id` = '" . trim($id) . "'";

		$queryOut = $db->query($Sql);
		$db->close();
		if (isset($queryOut)) {
			redirect_to("../applicationFeeSetting.php?id=" . trim($_GET['appId']));
		} else {
			redirect_to("../applicationFeeSetting.php?id=" . trim($_GET['appId']));
		}

		exit;
	}
?>