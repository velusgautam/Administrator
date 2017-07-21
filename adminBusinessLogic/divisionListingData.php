<?php
define("_VALID_PHP", true);
include_once('../dbcon/dbConfig.php');
try {
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_DATABASE, $con);

    if ($_GET["action"] == "list") {
        if ($_GET["role"] == '1') {
            $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_DIVISION . ";");
            $row = mysql_fetch_array($result);
            $recordCount = $row['RecordCount'];
            $sql = mysql_query("SELECT @a:=@a+1 sl, sd.division_id, sd.division_name FROM `" . TABLE_DIVISION . "` sd , (SELECT @a:= 0) AS a ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
        }
        $rows = array();
        while ($row = mysql_fetch_array($sql)) {
            $rows[] = $row;
        }

        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    } else if ($_GET["action"] == "create") {
        $result = mysql_query("INSERT INTO " . TABLE_DIVISION . "(division_name, status) VALUES('" . strtoupper($_POST["division_name"]) . "', '0');");
        $result = mysql_query("SELECT @a:=@a+1 sl, sd.division_id, sd.division_name FROM `" . TABLE_DIVISION . "` sd , (SELECT @a:= 0) AS a WHERE sd.division_id = LAST_INSERT_ID();");
        $row = mysql_fetch_array($result);
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    } else if ($_GET["action"] == "update") {
        //Update record in database
        $result = mysql_query("UPDATE " . TABLE_DIVISION . " SET division_name = '" . $_POST["division_name"] . "' WHERE division_id = '" . $_POST["division_id"] . "';");
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    } else if ($_GET["action"] == "delete") {
        //Delete from database
        $result = mysql_query("DELETE FROM " . TABLE_DIVISION . " WHERE division_id = " . $_POST["division_id"] . ";");
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