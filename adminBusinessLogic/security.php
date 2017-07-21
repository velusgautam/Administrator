<?php session_start();
define("_VALID_PHP", true);
require_once("functions.php");
if (empty($_SESSION['UserName']) && empty($_SESSION['Role']) && empty($_SESSION['SchoolName'])) {
    session_destroy();
    redirect_to("index.php");
    exit;
}
include('wixzify/booster_inc.php');
$booster = new Booster();
