<?php
require_once("securityInside.php");
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") /* checking whether form is posted */ {
    $sql = null;

    if (isset($_POST['schoolId'])) {
        $classSql = "Select class_id, class_name FROM " . TABLE_CLASS . " WHERE status = '0'";
        $classRows = $db->query($classSql);
        while ($classRow = $db->fetch_array($classRows)) {
            $className = trim(strtolower(preg_replace('/\s+/', '', $classRow['class_name'])));

            if (isset($_POST[$className])) {

                //echo $classRow['class_name']."--".$_POST[$className].PHP_EOL;
                $classId = $_POST[$className];

                if (isset($_POST[$className . "-icse"])) {
                    $streamId = $_POST[$className . '-icse'];
                    //echo $classRow['class_name']."-ICSE--".$_POST[$className.'-icse'].PHP_EOL;

                    $divisionSql = "Select division_id, division_name FROM " . TABLE_DIVISION . " WHERE status = '0'";
                    $divisionRows = $db->query($divisionSql);
                    while ($divisionRow = $db->fetch_array($divisionRows)) {
                        $divisionName = trim(strtolower(preg_replace('/\s+/', '', $divisionRow['division_name'])));
                        if (isset($_POST[$className . "-icse-" . $divisionName])) {
                            $divisionId = $_POST[$className . '-icse-' . $divisionName];
                            //echo "ClassID: ".$classId." Stream:".$streamId." DivisionId:".$divisionId.PHP_EOL;
                            $sql .= "( 'NULL', '" . $classId . "','" . $streamId . "','" . $divisionId . "','" . $_POST['schoolId'] . "'),";
                        }
                    }
                }
                if (isset($_POST[$className . "-state"])) {
                    $streamId = $_POST[$className . '-state'];
                    $divisionSql = "Select division_id, division_name FROM " . TABLE_DIVISION . " WHERE status = '0'";
                    $divisionRows = $db->query($divisionSql);
                    while ($divisionRow = $db->fetch_array($divisionRows)) {
                        $divisionName = trim(strtolower(preg_replace('/\s+/', '', $divisionRow['division_name'])));
                        if (isset($_POST[$className . "-state-" . $divisionName])) {
                            $divisionId = $_POST[$className . '-state-' . $divisionName];
                            //echo "ClassID: ".$classId." Stream:".$streamId." DivisionId:".$divisionId.PHP_EOL;
                            $sql .= "( 'NULL', '" . $classId . "','" . $streamId . "','" . $divisionId . "','" . $_POST['schoolId'] . "'),";
                        }
                    }
                }

            }
        }
    }

    $sql = rtrim($sql, ",");


    $dSql = $db->query("Delete  FROM " . TABLE_CLASS_MAPPING . " WHERE `schl_id`=" . $_POST['schoolId']);
    $newSql = "INSERT INTO " . TABLE_CLASS_MAPPING . " (`class_map_id`, `class_id`, `stream_id`, `division_id`, `schl_id`) VALUES " . $sql;

    $id = $db->query($newSql);
    if (isset($id) && is_int($id) || $id > 0) {

	    $_SESSION['schoolClassStatus']=1;
        redirect_to('../schoolClassMapping.php?id=' . $_POST['schoolId']);
    } else {
	    $_SESSION['schoolClassStatus']=2;
        redirect_to('../schoolClassMapping.php?id=' . $_POST['schoolId']);
    }
}
$db->close();
exit;

?>