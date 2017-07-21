<?php

session_start();
define("_VALID_PHP", true);
include_once("functions.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {

    if (empty($_POST['username'])) {
        $err = "no_u";
    }
    if (empty($_POST['password'])) {
        $err = "no_p";
    }

    if (empty($_POST['school'])) {
        $err = "no_s";
    }


    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['school'])) {
        $_name = $_POST['username'];
        $_password = $_POST['password'];
        $_school = $_POST['school'];
        $db->connect();
        $_nameEscaped = mysql_real_escape_string($_name);
        $_passwordEscaped = md5(mysql_real_escape_string($_password));
//        $_passwordEscaped = mysql_real_escape_string($_password);
        $_schoolEscaped = mysql_real_escape_string($_school);


        if (!isset($err)) {
            $sqlLoginCheck = "Select uid, schl_id, role_id, name, username from " . TABLE_DEV_USER . " WHERE `username` = '" . $_nameEscaped . "' AND `password` = '" . $_passwordEscaped . "' AND `schl_id` = '" . $_schoolEscaped . "' LIMIT 0, 1";


            $output = $db->query($sqlLoginCheck);

            if ($db->affected_rows > 0) {
                $row = mysql_fetch_array($output);
                $_SESSION['UserId'] = $row['uid'];
                $_SESSION['UserName'] = $row['username'];
                $_SESSION['Name'] = $row['name'];
                $_SESSION['Role'] = $row['role_id'];
	            $_SESSION['IsDev']=1;
                if ($row['role_id'] == 1) {
                    $_SESSION['SchoolName'] = "All Schools";
	                $_SESSION['SchoolCode'] = "All";

                } else {
                    $sqlSchoolCheck = "Select schl_id, school_name from " . TABLE_SCHOOL . " WHERE `schl_id` = '" . $_schoolEscaped . "' LIMIT 0, 1";
                    $output_school = $db->query_first($sqlSchoolCheck);
                    $_SESSION['SchoolCode'] = $output_school['schl_id'];
                    $_SESSION['SchoolName'] = $output_school['school_name'];
                }

                $data['login'] = "NOW()";
                $db->query_update(TABLE_DEV_USER, $data, "uid = " . $row['uid']);
                $db->close();


                redirect_to("../developmentStudentListing.php");


                $db->close();
            } else {
                $err = 2;
                session_destroy();
                session_unset();
                redirect_to("../development.php?error=" . $err);
            }


        } else {
            redirect_to("../development.php?error=" . $err);
        }

    } else {
        redirect_to("../development.php?error=" . $err);
    }


} else {
    redirect_to('../index.php');
}