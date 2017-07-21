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
        if ($_GET["role"] == '1') {
            $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_CLASS . ";");
            $row = mysql_fetch_array($result);
            $recordCount = $row['RecordCount'];
            $sql = mysql_query("SELECT @a:=@a+1 sl, class_id, class_name FROM `" . TABLE_CLASS . "`, (SELECT @a:= 0) AS a ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
        }

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
    } //Creating a new record (createAction)
    else if ($_GET["action"] == "create") {
        $result = mysql_query("INSERT INTO " . TABLE_CLASS . " (class_name) VALUES('" . trim(strtoupper(mysql_real_escape_string($_POST["class_name"]))) . "');");
        $result = mysql_query("SELECT @a:=@a+1 sl, sc.class_id, sc.class_name FROM `" . TABLE_CLASS . "` sc , (SELECT @a:= 0) AS a WHERE sc.class_id = LAST_INSERT_ID();");
        $row = mysql_fetch_array($result);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    } //Updating a record (updateAction)
    else if ($_GET["action"] == "update") {
        //Update record in database
        $result = mysql_query("UPDATE " . TABLE_CLASS . " SET class_name = '" . trim(strtoupper(mysql_real_escape_string($_POST["class_name"]))) . "' WHERE class_id = '" . $_POST["class_id"] . "';");
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
//        $jTableResult['Record'] = $rows;
        print json_encode($jTableResult);
    } //Deleting a record (deleteAction)
    else if ($_GET["action"] == "delete") {
        //Delete from database
        $result = mysql_query("DELETE FROM " . TABLE_CLASS . " WHERE class_id = " . $_POST["class_id"] . ";");

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