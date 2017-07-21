<?php
error_reporting(E_ALL);
ini_set('display_errors','Off');
ini_set('log_errors', 'On');

if($_GET['func'] == "streamSelect" && isset($_GET['func'])) {
    streamSelect($_GET['schl_id']);
}
function streamSelect($schl_id)
{
    define("_VALID_PHP", true);
    include('../dbcon/dbConfig.php');
    require_once("../dbcon/connection.php");
    $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    if(empty($_GET['schl_id']))
    {
        echo '<label class="control-label">Stream:</label>
							<div class="controls">
	<select class="input-block-level" data-placeholder="Choose a Stream" tabindex="4" name="stream">
	<option value="" >Select Stream</option>
	</select>';
    }
    else
    {
        $sql_1 = "SELECT DISTINCT  stream_id, IF( stream_id =  '1',  'STATE',  'ICSE' ) AS stream_name FROM `".TABLE_CLASS_MAPPING."` WHERE  schl_id=".$schl_id."";

         $result = $db->query($sql_1);
         $count = $db->affected_rows;
        if($count === 1)
        {
            echo '<label class="control-label">Stream:</label><div class="controls">
	                <select class="input-block-level" data-placeholder="Choose a Stream" tabindex="4" name="stream" id="streamSelect" readonly>';
                    while($streamSelect = $db->fetch_array( $result ))
                    {
                     $streamVal = $streamSelect['stream_id'];
                        echo '<option value="'.$streamVal.'">'.$streamSelect['stream_name'].'</option>';
                    }

                     echo '</select></div>';
echo"<script type=\"text/javascript\">
$('#result_1').show();
$('#wait_2').show();
 $('#result_2').show();

      $.get(\"projectinc/studentRegDD.php\", {
		func: \"classSelect\",
		drop_var: $('#streamSelect').val()+\"~\"+".$schl_id."
      }, function(response){

        setTimeout(\"finishAjax_tier_three('result_2', '\"+escape(response)+\"')\", 100);
      });
</script>";



}
else
    {

    echo '<label class="control-label">Stream:</label>
	<div class="controls">
	<select class="input-block-level" data-placeholder="Choose a Stream" tabindex="4" name="stream" id="streamSelect">
	<option value="All"  selected="selected">Select Stream</option>';

    while($streamSelect = $db->fetch_array( $result ))
    {
        echo '<option value="'.$streamSelect['stream_id'].'">'.$streamSelect['stream_name'].'</option>';
    }

    echo '</select>
	<span id="wait_2" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
	</div>
						</div>';
    echo "<script type=\"text/javascript\">
    $('#wait_2').hide();
	$('#streamSelect').change(function(){
	  $('#wait_2').show();
 $('#result_2').show();

      $.get(\"projectinc/studentRegDD.php\", {
		func: \"classSelect\",
		drop_var: $('#streamSelect').val()+\"~\"+".$schl_id."
      }, function(response){

        setTimeout(\"finishAjax_tier_three('result_2', '\"+escape(response)+\"')\", 100);
      });
    	return false;
	});
</script>";
}
}
}

if($_GET['func'] == "classSelect" && isset($_GET['func'])) {
    classSelect($_GET['drop_var']);
}

function classSelect($streamVal)
{
$drop_var = explode("~", $streamVal);
define("_VALID_PHP", true);
include('../dbcon/dbConfig.php');
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
    $sql_1 = "SELECT class_id, class_name FROM `".TABLE_CLASS."` WHERE  `class_id` IN(Select class_id FROM ".TABLE_CLASS_MAPPING." WHERE `schl_id` =".$drop_var[1]." and  stream_id=".$drop_var[0].") ORDER BY class_name ASC";

	$result = mysql_query($sql_1);
	
	echo '
							<label class="control-label">Class:</label>
							<div class="controls">
	<select class="input-block-level" data-placeholder="Choose a Class"  name="class" id="classSelect" tabindex="5">
	  <option value="All"  selected="selected">Select Class</option>    ';

		   while($classSelect = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$classSelect['class_id'].'">'.$classSelect['class_name'].'</option>';
			}
	
	echo '</select>
	<span id="wait_3" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
	</div>
						</div>';
	echo "<script type=\"text/javascript\">
    $('#wait_3').hide();
	$('#classSelect').change(function(){
	  $('#wait_3').show();


      $.get(\"projectinc/studentRegDD.php\", {
		func: \"division\",
		drop_var: $('#classSelect').val()+\"~\"+".$drop_var[0]."+\"~\"+".$drop_var[1]."
      }, function(response){

        setTimeout(\"finishAjax_division('result_3', '\"+escape(response)+\"')\", 0);
      });
    	return false;
	});
</script>";
}


//**************************************
//     Second selection results     //
//**************************************
if($_GET['func'] == "division" && isset($_GET['func'])) { 
   $dropvar = $_GET['drop_var'];
    $drop_var = explode("~", $dropvar);
    $schl_id = $drop_var[2];
    $stream_id = $drop_var[1];
    $class_id = $drop_var[0];

    if(is_numeric($schl_id) && is_numeric($stream_id) && is_numeric($class_id))
        division($schl_id, $class_id, $stream_id);
    else
    {
        echo '<label class="control-label">Division:</label>
		<div class="controls">

		<select class="input-block-level" data-placeholder="Choose a Division"  name="division" id="division" tabindex="6">
	    <option value="All"  selected="selected">No Division</option>
	    </select>  ';

    }
}

function division($schl_id, $class_id, $stream_id)
{


define("_VALID_PHP", true);
include('../dbcon/dbConfig.php');
require_once("../dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
	$result = mysql_query("SELECT division_id, division_name FROM `".TABLE_DIVISION."` WHERE  `division_id` IN ( SELECT division_id FROM ".TABLE_CLASS_MAPPING." WHERE `class_id`=".$class_id." AND `stream_id`=".$stream_id." AND `schl_id`=".$schl_id." ) ORDER BY division_name ASC ")or die(mysql_error());

	
	echo '<label class="control-label">Division:</label>
		<div class="controls">

		<select class="input-block-level" data-placeholder="Choose a Division"  name="division" id="division" tabindex="6">
	     ';

		   while($division = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$division['division_id'].'">'.$division['division_name'].'</option>';
			}
	
	echo '</select>

	</div>
						</div>';


}


?>