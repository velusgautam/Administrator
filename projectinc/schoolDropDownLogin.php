<?php

if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
$sql = "SELECT schl_id, school_code FROM `" . TABLE_SCHOOL . "` WHERE published='1' ORDER BY school_name ASC";
$rows = $db->query($sql);
echo "<option value=\"-1\">Select</option>";
while ($record = $db->fetch_array($rows)) {
    echo "<option value=\"$record[schl_id]\">$record[school_code]</option>";
}
$rows = NULL;
$sql = NULL;
?>
