<?php
define("_VALID_PHP", true);
include_once('../dbcon/dbConfig.php');
include_once("../dbcon/connection.php");
try {
    //Open database connection
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_DATABASE, $con);

    //Getting records (listAction)
    if ($_GET["action"] == "list") {
        //Get record count
        if (isset($_GET["studid"])) {
            $result = mysql_query("SELECT COUNT(*) AS RecordCount  FROM " . TABLE_STUDENT_FEE_PRIMARY . " WHERE `student_id`= ".$_GET["studid"].";");
            $row = mysql_fetch_array($result);
            $recordCount = $row['RecordCount'];
            $sql = mysql_query("SELECT @a:=@a+1 sl, id, student_name, academic_year, DATE_FORMAT(date,'%d-%m-%Y') as date, payment_type, grand_total  FROM `" . TABLE_STUDENT_FEE_PRIMARY . "`,
            (SELECT @a:= 0) AS a WHERE `student_id`= ".$_GET["studid"]." ORDER BY " . $_GET["jtSorting"] . " LIMIT " .
	            $_GET["jtStartIndex"] . ",
            " . $_GET["jtPageSize"] . ";");
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



     //Deleting a record (deleteAction)

    else if ($_GET["action"] == "delete") {
	    $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	    $db->connect();
        //Delete from database
	    $studentStatus = $db->query_first("Select student_id, academic_year from ".TABLE_STUDENT_FEE_PRIMARY."  WHERE id = " . $_POST["id"] . ";");
	    $studentfeeStatus = $db->query_first("Select count(*) as count from ".TABLE_STUDENT_FEE_PRIMARY."  WHERE student_id=".$studentStatus['student_id']." AND academic_year='".$studentStatus['academic_year']."';");
	    if($studentfeeStatus['count']==1)
	    {
	    $sData['status']= 3;
	    $studentUpdate = $db->query_update(TABLE_STUDENT,$sData," student_id=".$studentStatus['student_id']." AND academic_year='".$studentStatus['academic_year']."'");
	    }
	    $result = mysql_query("DELETE FROM " . TABLE_STUDENT_FEE_PRIMARY . " WHERE id = " . $_POST["id"] . ";");
	    $result1 = mysql_query("DELETE FROM " . TABLE_STUDENT_FEE_SECONDARY . " WHERE primary_id = " . $_POST["id"] . ";");

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