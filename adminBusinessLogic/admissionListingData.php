<?php session_start();
define("_VALID_PHP", true);
include_once('../dbcon/dbConfig.php');
error_reporting(0);

try {
    //Open database connection
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_DATABASE, $con);

    //Getting records (listAction)
    if ($_GET["action"] == "list") {
        //Get record count
        if ($_SESSION['Role'] == '1') {
            $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_ADMISSION_FORM . " WHERE reg_status = 0;");
            $row = mysql_fetch_array($result);
            $recordCount = $row['RecordCount'];
            $sqlQuery = "SELECT id, @a:=@a+1 sl, academic_year, school_code, DATE_FORMAT(admission_date,'%d-%m-%Y') as admission_date , name,father_phone ,mother_phone  FROM `" . TABLE_ADMISSION_FORM . "`,
				(SELECT @a:= 0) AS a WHERE reg_status = 0 ORDER BY " . $_GET["jtSorting"] . "
        LIMIT " . $_GET["jtStartIndex"] .
                ",
				" . $_GET["jtPageSize"] . ";";

        } else {
            if (intval($_SESSION['SchoolCode']) > 0) {
                $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_ADMISSION_FORM . " WHERE reg_status = 0 AND `school_code`=" . $_SESSION['SchoolCode'] . ";");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                $sqlQuery = "SELECT id, @a:=@a+1 sl, academic_year, school_code, DATE_FORMAT(admission_date,'%d-%m-%Y') as admission_date, name,father_phone ,mother_phone  FROM `" . TABLE_ADMISSION_FORM . "`,
			    (SELECT @a:= 0) AS a WHERE reg_status = 0 AND `school_code`=" . $_SESSION['SchoolCode'] . " ORDER BY " . $_GET["jtSorting"] . "
        LIMIT " . $_GET["jtStartIndex"] .
                    ",
				" . $_GET["jtPageSize"] . ";";
            }
        }

        $sql = mysql_query($sqlQuery);
        $rows = array();
        while ($row = mysql_fetch_array($sql)) {
            $rows[] = $row;
        }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    } else if ($_GET["action"] == "delete") {
        //Delete from database
        $result = mysql_query("DELETE FROM " . TABLE_ADMISSION_FORM . " WHERE id = " . $_POST["id"] . ";");

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }

    //Close database connection
    mysql_close($con);

} catch (Exception $ex) {
    //Return error message
    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}

?>