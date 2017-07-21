<?php
error_reporting(E_ALL);
ini_set('display_errors', 'OFF');
ini_set('log_errors', 'On');
require_once("dbcon/dbConfig.php");
require_once("dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$url = explode('/', $_SERVER['PHP_SELF']);
$surl = $url[count($url) - 1];
