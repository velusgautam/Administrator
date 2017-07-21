<?php
	require_once("securityInside.php");
	require_once("../dbcon/dbConfig.php");
	require_once("../dbcon/connection.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	error_reporting(E_ALL);

	if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
		$error = null;

		$_studId = $_POST['sid'];
		if (empty($_studId)) {
			$error .= 'Please check StudentId is Missing <br>';
		}
		$_studName = $_POST['studName'];
		if (empty($_studName)) {
			$error .= 'Please check Student Name is Missing <br>';
		}
		$_sond = $_POST['sond'];
		if (empty($_sond)) {
			$error .= 'Please check Father Name is Missing <br>';
		}
		$_fyear = $_POST['fyear'];
		if (empty($_fyear)) {
			$error .= 'Please check From Year is Missing <br>';
		}
		$_tyear = $_POST['tyear'];
		if (empty($_tyear)) {
			$error .= 'Please check To Year Missing <br>';
		}

		$_sfrom = $_POST['sfrom'];
		if (empty($_sfrom)) {
			$error .= 'Please check From Class Missing <br>';
		}
		$_sto = $_POST['sto'];
		if (empty($_sto)) {
			$error .= 'Please check To Class Missing <br>';
		}
		$_dob = $_POST['dob'];
		if (empty($_dob)) {
			$error .= 'Please check Date of DOB Missing <br>';
		}
		$_conduct = $_POST['conduct'];
		if (empty($_conduct)) {
			$error .= 'Please check Date of DOB Missing <br>';
		}

		if (!isset($error))
		{
			$data['date'] = $db->escape(date("Y-m-d"));
			$data['student_id'] = trim($db->escape($_studId));
			$data['student_name'] = $db->escape($_studName);
			$data['father_name'] = $db->escape($_sond);
			$data['f_year'] = $db->escape($_fyear);
			$data['t_year'] = $db->escape($_tyear);
			$data['s_from'] = $db->escape($_sfrom);
			$data['s_to'] = $db->escape($_sto);
			$data['dob'] = $db->escape(date("Y-m-d",strtotime($_dob)));
			$data['conduct'] = $db->escape($_conduct);

			$id = $db->query_insert(TABLE_SCHOOL_CERTIFICATE, $data);

			if(intval($id)>0)
			{
				redirect_to("../printSchoolCertificate.php?studid=".trim($db->escape($_studId))."&id=".$id);
			}
		}
		else
		{
		$_SESSION['SCError'] =$error;
		redirect_to("../generateSchoolCertificate.php?id=".$_POST['sid']);
		}
	}
	else
	{
		$_SESSION['SCError'] =$error;
		redirect_to("../generateSchoolCertificate.php?id=".$_POST['sid']);
	}
?>