<?php session_start();
define("_VALID_PHP", true);
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
$userId = $_SESSION['UserId'];
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$data['logout'] = "NOW()";
$db->query_update(TABLE_DEV_USER, $data, "uid = $userId");
$db->close();
session_destroy();
session_unset();
define("_VALID_PHP", true);
require_once("functions.php");
if (count($_SESSION) == 0) {
    $_SESSION = array();
    session_destroy();
}
redirect_to("../development.php");
exit;
?>