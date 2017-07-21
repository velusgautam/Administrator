<?php
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
    if(empty($_GET['schl_id']) || trim($_GET['schl_id']) == "All" )
    {
        echo '
   	    
   	    <select  data-placeholder="Choose a Stream" tabindex="1" name="stream"  style="width: 170px">
   	    <option value="All" >Select Stream</option>
    	</select>';
		
		echo "<script type=\"text/javascript\">
			$('#wait_1').hide();
            $('#wait_2').hide();
            $('#result_3').show();
			</script>";
    }
    else
    {
        $sql_1 = "SELECT DISTINCT  stream_id, IF( stream_id =  '1',  'STATE',  'ICSE' ) AS stream_name FROM `".TABLE_CLASS_MAPPING."` WHERE  schl_id=".$schl_id."";
        $result = $db->query($sql_1);
        $count = $db->affected_rows;
        if($count === 1)
        {
            echo '
   	        <select  data-placeholder="Choose a Stream" tabindex="1" name="stream" id="streamSelect" readonly style="width: 170px">';
            while($streamSelect = $db->fetch_array( $result ))
            {
                $streamVal = $streamSelect['stream_id'];
                echo '<option value="'.$streamVal.'">'.$streamSelect['stream_name'].'</option>';
            }

            echo '</select>
             <span id="wait_2" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
            ';
            echo"<script type=\"text/javascript\">
            $('#wait_2').show();
            $('#result_3').show();
            $('#wait_1').hide();
            $.get(\"projectinc/studentChangeDD.php\", {
   		        func: \"classSelect\",
   		        streamVal: $('#streamSelect').val()+\"~\"+".$schl_id."
            },
            function(response){
                setTimeout(\"finishAjax_class('result_3', '\"+escape(response)+\"')\", 1);
            });
            </script>";
        }
        else
        {

            echo '
   	            <select  data-placeholder="Choose a Stream" tabindex="2" name="stream" id="streamSelect" style="width: 170px">
   	            <option value="All"  selected="selected">Select Stream</option>';

            while($streamSelect = $db->fetch_array( $result ))
            {
                echo '<option value="'.$streamSelect['stream_id'].'">'.$streamSelect['stream_name'].'</option>';
            }

            echo '</select>
   	            <span id="wait_2" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
            	';
            echo "<script type=\"text/javascript\">
                $('#wait_1').hide();
                $('#streamSelect').change(function(){
   	            $('#wait_2').show();
                $('#result_3').show();
   
                $.get(\"projectinc/studentChangeDD.php\", {
   		            func: \"classSelect\",
   		            streamVal: $('#streamSelect').val()+\"~\"+".$schl_id."
                },
                function(response){
                setTimeout(\"finishAjax_class('result_3', '\"+escape(response)+\"')\", 1);
                 });
       	        return false;
   	            });
                </script>";
        }
    }
}

if($_GET['func'] == "classSelect" && isset($_GET['func'])) {
    classSelect($_GET['streamVal']);
}

function classSelect($streamVal)
{
    $_stream = explode("~", $streamVal);
    define("_VALID_PHP", true);
    include('../dbcon/dbConfig.php');
    require_once("../dbcon/connection.php");
    $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    //$sql_1 = "SELECT schl_id, school_name FROM `".TABLE_SCHOOL."` WHERE published='1' AND schl_id='$schl_id' ORDER BY school_name ASC ";
    $sql_1 = "SELECT class_id, class_name FROM `".TABLE_CLASS."` WHERE class_id IN (Select DISTINCT class_id from ".TABLE_CLASS_MAPPING." WHERE schl_id=".$_stream[1]." and  stream_id=".$_stream[0].") ORDER BY class_name ASC";
    $result = mysql_query($sql_1);

    echo '
   	<select name="classSelect" id="classSelect"  data-placeholder="Choose a Class" tabindex="2" style="width: 170px">';
    echo '<option value="All"  selected="selected">Select Class</option>';

    while($classSelect = mysql_fetch_array( $result ))
    {
        echo '<option value="'.$classSelect['class_id'].'">'.$classSelect['class_name'].'</option>';
    }

    echo '</select>';

    echo '<span id="wait_3" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>';
    
    echo "<script type=\"text/javascript\">
        $('#wait_2').hide();
   	    $('#classSelect').change(function(){
   	    $('#wait_3').show();
         $.get(\"projectinc/studentChangeDD.php\", {
   		func: \"division\",
   		drop_var: $('#classSelect').val()+\"~\"+".$_stream[1]."+\"~\"+".$_stream[0]."
         }, function(response){
           $('#result_4').fadeOut();
           setTimeout(\"finishAjax_division('result_4', '\"+escape(response)+\"')\", 1);
           $('#wait_3').hide();
         });
       	return false;
   	});
   </script>";
}


if($_GET['func'] == "division" && isset($_GET['func'])) {
    division($_GET['drop_var']);
}

function division($classId)
{
    $drop_var = explode("~", $classId);
    define("_VALID_PHP", true);
    include('../dbcon/dbConfig.php');
    require_once("../dbcon/connection.php");
    $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    $result = mysql_query("SELECT division_id, division_name FROM `".TABLE_DIVISION."` WHERE division_id IN (Select DISTINCT division_id from ".TABLE_CLASS_MAPPING." WHERE class_id='".$drop_var['0']."' AND schl_id=".$drop_var['1']." and
     stream_id=".$drop_var[2].") ORDER  BY division_name ASC ")

    or die(mysql_error());

    echo '
   							<select name="division" id="division" style="width: 170px">';
    echo'<option value="All"  selected="selected">Select Division</option>';

    while($division = mysql_fetch_array( $result ))
    {
        echo '<option value="'.$division['division_id'].'">'.$division['division_name'].'</option>';
    }

    echo '</select>';
}

?>