<?php
require_once('securityInside.php');
require_once("../dbcon/dbConfig.php");
require_once("../dbcon/connection.php");
require_once("functions.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$filename = backup_tables(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$data['backup_name'] = $db->escape($filename);

$sql = 'INSERT INTO '.TABLE_DB_BACKUP.'  (backup_name, backup_time) VALUES (\''.$data['backup_name'].'\', \''.date("Y-m-d").'\') ON DUPLICATE KEY UPDATE  backup_name = (\''.$data['backup_name'].'\')';
echo $sql;

$status = $db->query($sql);
if(isset($filename))
{
    $_SESSION['dbstatus'] = 1;
    redirect_to('../dbBackupListing.php');
}
else
{
    redirect_to('../dbBackupListing.php?status=2');
}

function backup_tables($host, $user, $pass, $name, $tables = '*')
{

    $link = mysql_connect($host, $user, $pass);
    mysql_select_db($name, $link);

    //get all of the tables
    if ($tables == '*') {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while ($row = mysql_fetch_row($result)) {
            $tables[] = $row[0];
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }
    $return = NULL;
    $return .= PHP_EOL.PHP_EOL."-- Database Export for GNR Administration---".PHP_EOL."-- Database Name : ".$name.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL;
    //cycle through
    foreach ($tables as $table) {
        $result = mysql_query('SELECT * FROM ' . $table);
        $num_fields = mysql_num_fields($result);
        $return .= "-- Table Structure for Table : ". $table .PHP_EOL.PHP_EOL;
        $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $table));
        $return .= "\n\n" . $row2[1] . ";\n\n";

        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysql_fetch_row($result)) {
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("/\n/", "/\\n/", $row[$j]);
                    if (isset($row[$j])) {
                        $return .= '"' . $row[$j] . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($num_fields - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n\n";
    }

    //save file
    $filename = 'db-backup-' . '-' . date("d-m-Y") . '.sql';
    $filepath = '../backup/db-backup-' . '-' . date("d-m-Y");

    $handle = fopen($filepath . '.sql', 'w+');

    $file = fwrite($handle, $return);
    if ($file) {

        fclose($handle);

        return ($filename);
    }
}

?>