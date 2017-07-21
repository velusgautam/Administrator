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
	    if ($_SESSION['Role'] == '1') {

        $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_NEW_APPLICATION . " WHERE application_status = 1;");
        $row = mysql_fetch_array($result);
	    $counter = $row['RecordCount'] +1;
        $recordCount = $row['RecordCount'];
        $sqlQuery = "SELECT application_no, @a:=@a-1 sl, academic_year, school_code, DATE_FORMAT(application_date,'%d-%m-%Y') as application_date, name, class_applied, contact_name, contact_number as mobile_no  FROM `" . TABLE_NEW_APPLICATION. "`,
        (SELECT @a:= ".$counter.") AS a WHERE application_status = 1 ORDER BY " . $_GET["jtSorting"]. "   LIMIT "
	        .$_GET["jtStartIndex"]."," .$_GET["jtPageSize"] . ";";
	    }
	    else {
		    if (intval($_SESSION['SchoolCode']) > 0) {
			    $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_NEW_APPLICATION . " WHERE application_status = 1 AND `school_code`=" . $_SESSION['SchoolCode'] . ";");
			    $row = mysql_fetch_array($result);
			    $counter = $row['RecordCount'] +1;
			    $recordCount = $row['RecordCount'];
			    $sqlQuery = "SELECT application_no, @a:=@a-1 sl, academic_year, school_code, DATE_FORMAT(application_date,'%d-%m-%Y') as application_date, name, class_applied, contact_name, contact_number as mobile_no  FROM `" . TABLE_NEW_APPLICATION. "`,
        (SELECT @a:= ".$counter.") AS a WHERE application_status = '1' AND `school_code`=".$_SESSION['SchoolCode']." ORDER BY " . $_GET["jtSorting"]. "   LIMIT "
				    .$_GET["jtStartIndex"]."," .$_GET["jtPageSize"] . ";";
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
    }

    else if ($_GET["action"] == "delete") {
        //Delete from database
        $result = mysql_query("DELETE FROM " . TABLE_NEW_APPLICATION . " WHERE application_no = " . $_POST["application_no"] . ";");

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