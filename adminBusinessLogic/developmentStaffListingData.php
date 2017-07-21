<?php
error_reporting(0);
define("_VALID_PHP", true);
include_once('../dbcon/dbConfig.php');
try {
    //Open database connection
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_DATABASE, $con);

    //Getting records (listAction)
    if ($_GET["action"] == "list") {
        //Get record count
        $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_DEV_USER . ";");

        $row = mysql_fetch_array($result);
        $recordCount = $row['RecordCount'];

        //Get records from database
        $sql = "SELECT @a:=@a+1 sl, uid, name, username, null as pass, schl_id, role_id, role_name, date, phone_number FROM `" . TABLE_DEV_USER . "` , (SELECT @a:= 0) AS a ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
        $result = mysql_query($sql);

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
    }

     //Creating a new record (createAction)
    else if ($_GET["action"] == "create") {
        //Insert record into database
        if ($_POST["role_id"] == 1) {
            $_roleName = "Administrator";
            $_schlId = "-1";
        } else {
            $_roleName = "Staff";
            $_schlId = $_POST["schl_id"];
        }


        $result = mysql_query("INSERT INTO " . TABLE_DEV_USER . "(name, username, password, schl_id, role_name, role_id, date, phone_number) VALUES('" . $_POST["name"] . "', '" . $_POST["username"] . "', '" . md5($_POST["pass"]) . "', '" . $_schlId . "', '" . $_roleName . "', '" . $_POST["role_id"] . "', '" . "NOW()" . "', '" . $_POST["phone_number"] . "');");
        //Get last inserted record (to return to jTable)
        $result = mysql_query("SELECT @a:=@a+1 sl, uid, name, username, null as pass, schl_id, role_id, role_name, phone_number FROM `" . TABLE_DEV_USER . "` , (SELECT @a:= 0) AS a WHERE uid = LAST_INSERT_ID();");
        $row = mysql_fetch_array($result);
        $_schlId = null;
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    } //Updating a record (updateAction)
    else if ($_GET["action"] == "update") {

        $_passData = null;
        if (!empty($_POST['pass'])) {

            $_passData = ", password ='" . md5($_POST['pass']) . "' ";
        }


        if ($_POST["role_id"] == 1) {
            $_roleName = "Administrator";
            $_schlId = "-1";
        } else {
            $_roleName = "Staff";
            $_schlId = $_POST["schl_id"];
        }
        //Update record in database
        $sqlQuery = "UPDATE " . TABLE_DEV_USER . " SET name = '" . $_POST["name"] . "' " . $_passData . " , role_id = '" . $_POST["role_id"] . "', username = '" . $_POST["username"] . "', phone_number = '" . $_POST["phone_number"] . "', role_name = '" . $_roleName . "', schl_id = '" . $_schlId . "' WHERE uid = '" . $_POST["uid"] . "';";
        //echo $sqlQuery;
        $result = mysql_query($sqlQuery);

        $_schlId = null;

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    } //Deleting a record (deleteAction)
    else if ($_GET["action"] == "delete") {
        //Delete from database
        $result = mysql_query("DELETE FROM " . TABLE_DEV_USER . " WHERE uid = " . $_POST["uid"] . ";");

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