<?php
define("_VALID_PHP", true);
error_reporting(0);
include_once('../dbcon/dbConfig.php');
	include_once('functions.php');
try {
    //Open database connection
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_DATABASE, $con);

    //Getting records (listAction)
    if ($_GET["action"] == "list") {
	    $academic_year = ($_POST['academic_year'] !="")? $_POST['academic_year'] : academicYear();

        //Get record count
        if (isset($_POST['student_name']) && isset($_POST['class_id']) && isset($_POST['academic_year'])&& $_POST['class_id'] == "All") {

	        if ($_GET["role"] == '1') {

                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT . " WHERE `status`= 1 AND `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND `student_name` LIKE '" . mysql_real_escape_string(trim($_POST['student_name'])) . "%' ;");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];

                $sql = "SELECT @a:=@a+1 sl, student_id, student_name, schl_id, academic_year, class_id, division_id, stream_id  FROM `" . TABLE_STUDENT . "` , (SELECT @a:= " . $_GET["jtStartIndex"] . ") AS a WHERE `status`= 1 AND
                `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND
                `student_name`
                LIKE
                 '"
	                . mysql_real_escape_string(trim($_POST['student_name'])) . "%' ORDER BY division_id ASC, " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
            } else {
                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT . " WHERE `status`= 1 AND `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND `schl_id`=" . trim(mysql_real_escape_string
	                ($_GET["schlid"])) . " AND  `student_name` LIKE '" . mysql_real_escape_string(trim($_POST['student_name'])) . "%';");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                $sql = "SELECT @a:=@a+1 sl, student_id, student_name, schl_id,academic_year, class_id, division_id, stream_id  FROM `" . TABLE_STUDENT . "` , (SELECT @a:= " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . ") AS
                a  WHERE `status`= 1 AND `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND `schl_id`=" . trim(mysql_real_escape_string($_GET["schlid"])) . " AND  `student_name` LIKE '" . mysql_real_escape_string(trim($_POST['student_name'])) . "%' ORDER BY " . trim(mysql_real_escape_string($_GET["jtSorting"])) . " LIMIT " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . "," . trim(mysql_real_escape_string($_GET["jtPageSize"])) . ";";
            }

        } elseif (isset($_POST['student_name']) && isset($_POST['class_id']) && $_POST['class_id'] != "All") {
            if ($_GET["role"] == '1') {
                $studVal = explode("~",trim($_POST['class_id']));

                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT . "
                WHERE `status`= 1 AND `student_name` LIKE '" . $_POST['student_name'] . "%'  AND
                `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND
                 `schl_id`=" . mysql_real_escape_string(trim($studVal[0])) . "  AND
                 `class_id`=" . mysql_real_escape_string(trim($studVal[1])) . "  AND
                 `stream_id`=" . mysql_real_escape_string(trim($studVal[2])) . "  ;");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                $sql = "SELECT @a:=@a+1 sl, student_id, student_name, academic_year, schl_id, class_id, division_id, stream_id  FROM `" . TABLE_STUDENT . "` , (SELECT @a:= " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . ") AS a
                WHERE `status`= 1 AND  `student_name` LIKE '" . mysql_real_escape_string(trim($_POST['student_name'])) . "%' AND
               `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND
               `schl_id`=" . mysql_real_escape_string(trim($studVal[0])) . "  AND
                 `class_id`=" . mysql_real_escape_string(trim($studVal[1])) . "  AND
                 `stream_id`=" . mysql_real_escape_string(trim($studVal[2])) . "
                ORDER BY division_id ASC, " . trim(mysql_real_escape_string($_GET["jtSorting"])) . " LIMIT " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . "," . trim(mysql_real_escape_string($_GET["jtPageSize"])) . ";";
            } else {
	            $studVal = explode("~",trim($_POST['class_id']));
                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT . " WHERE `status`= 1 AND
                 `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND
                 `schl_id`=" . mysql_real_escape_string(trim($studVal[0])) . "  AND
                 `class_id`=" . mysql_real_escape_string(trim($studVal[1])) . "  AND
                 `stream_id`=" . mysql_real_escape_string(trim($studVal[2])) . "
                  AND  `student_name` LIKE '" . trim(mysql_real_escape_string($_POST['student_name'])) . "%';");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                $sql = "SELECT @a:=@a+1 sl, student_id, student_name,academic_year, schl_id, class_id, division_id, stream_id  FROM `" . TABLE_STUDENT . "` , (SELECT @a:= " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . ") AS a  WHERE `status`= 1 AND `schl_id`=" . trim(mysql_real_escape_string($_GET["schlid"])) . " AND
                `student_name` LIKE '" . mysql_real_escape_string(trim($_POST['student_name'])) . "%' AND
                 `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND
                 `schl_id`=" . mysql_real_escape_string(trim($studVal[0])) . "  AND
                 `class_id`=" . mysql_real_escape_string(trim($studVal[1])) . "  AND
                 `stream_id`=" . mysql_real_escape_string(trim($studVal[2])) . "
                 ORDER BY " . trim(mysql_real_escape_string($_GET["jtSorting"])) . " LIMIT " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . "," . trim(mysql_real_escape_string($_GET["jtPageSize"])) . ";";
            }
        } else {
            if ($_GET["role"] == '1') {
                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT . " WHERE `status`= 1 ;");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                $sql = "SELECT @a:=@a+1 sl, student_id, student_name, schl_id, class_id, division_id,academic_year, stream_id  FROM `" . TABLE_STUDENT . "` , (SELECT @a:= " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . ") AS
                a WHERE `status`= 1 AND `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' ORDER
                BY `division_id` ASC, " . trim(mysql_real_escape_string($_GET["jtSorting"])) . " LIMIT " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . "," . trim(mysql_real_escape_string($_GET["jtPageSize"])) . ";";
            } elseif (isset($_GET['schlid'])) {
                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT . " WHERE `status`= 1 AND `academic_year` = ".mysql_real_escape_string(trim($academic_year))." AND `schl_id`=" . trim(mysql_real_escape_string($_GET["schlid"])) . ";");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                $sql = "SELECT @a:=@a+1 sl, student_id, student_name, schl_id, class_id, division_id,academic_year, stream_id  FROM `" . TABLE_STUDENT . "` , (SELECT @a:= " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . ") AS
                a  WHERE `status`= 1 AND `academic_year` = '".mysql_real_escape_string(trim($academic_year))."' AND `schl_id`=" . trim(mysql_real_escape_string($_GET["schlid"])) . " ORDER BY " . trim(mysql_real_escape_string($_GET["jtSorting"])) . "," . $_GET["jtSorting"] . " LIMIT " . trim(mysql_real_escape_string($_GET["jtStartIndex"])) . "," . trim(mysql_real_escape_string($_GET["jtPageSize"])) . ";";
            }
        }
//echo $sql;
        $result = mysql_query($sql);

        $rows = array();
        while ($row = mysql_fetch_array($result))
        {
            $rows[] = $row;
        }


        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    }

    else if ($_GET["action"] == "delete") {

        $result = mysql_query("DELETE FROM " . TABLE_STUDENT . " WHERE student_id = " . trim(mysql_real_escape_string($_POST["student_id"])) . ";");

        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }


    mysql_close($con);

} catch (Exception $ex) {

    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}

?>