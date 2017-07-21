<?php
define("_VALID_PHP", true);
include_once('../dbcon/dbConfig.php');
try {
    //Open database connection
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_DATABASE, $con);

    //Getting records (listAction)
    if ($_GET["action"] == "list") {
        //Get record count
        $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_SCHOOL . ";");

        $row = mysql_fetch_array($result);
        $recordCount = $row['RecordCount'];

        //Get records from database
        $result = mysql_query("SELECT @a:=@a+1 sl, schl_id, school_name, school_code, school_address FROM " . TABLE_SCHOOL . ", (SELECT @a:= 0) AS a ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

        //Add all records to an array
        $rows = array();
        while ($row = mysql_fetch_array($result)) {
            $rows[] = $row;
        }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    } //Creating a new record (createAction)
    else if ($_GET["action"] == "create") {
        //Insert record into database
        //echo "INSERT INTO sms_school(school_name, school_code, school_address) VALUES('" . $_POST["school_name"] . "', '" . $_POST["school_code"] . "', '" . $_POST["school_address"] . "' );";
        $result = mysql_query("INSERT INTO " . TABLE_SCHOOL . "(school_name, school_code, school_address) VALUES('" . $_POST["school_name"] . "', '" . strtoupper($_POST["school_code"]) . "', '" . $_POST["school_address"] . "');");

        //Get last inserted record (to return to jTable)
        $result = mysql_query("SELECT schl_id, school_name, school_code, school_address FROM " . TABLE_SCHOOL . " WHERE schl_id = LAST_INSERT_ID();");
        $row = mysql_fetch_array($result);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    } //Updating a record (updateAction)
    else if ($_GET["action"] == "update") {
        //Update record in database
        $result = mysql_query("UPDATE " . TABLE_SCHOOL . " SET school_name = '" . $_POST["school_name"] . "', school_code = '" . strtoupper($_POST["school_code"]) . "', school_address = '" . $_POST["school_address"] . "' WHERE schl_id = '" . $_POST["schl_id"] . "';");

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    } //Deleting a record (deleteAction)
    else if ($_GET["action"] == "delete") {
        //Delete from database
        $result = mysql_query("DELETE FROM " . TABLE_SCHOOL . " WHERE schl_id = " . $_POST["schl_id"] . ";");

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