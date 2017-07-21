<?php
$booster->css_source = array('../assets/css/jtable.css,../assets/css/jquery-ui.css');
$booster->debug = FALSE;
$booster->librarydebug = FALSE;
$booster->css_totalparts = 1;
echo $booster->css_markup();
$booster->js_minify = TRUE;
$booster->js_source = '../assets/js/jquery-ui-1.10.0.min.js,../assets/js/jquerySchool.jtable.js';
echo $booster->js_markup();
//echo'<script type="text/javascript" src="http://jtable.org/Scripts/validationEngine/jquery.validationEngine.js"></script>
//<script type="text/javascript" src="http://jtable.org/Scripts/validationEngine/jquery.validationEngine-en.js"></script>';
?>
<div id="division" style="width: 100%;"></div>
<?php
//$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
//mysql_select_db(DB_DATABASE, $con);
//if($_SESSION['Role']=='1')
//    {
//        $sql = "SELECT sc.class_id, ss.school_code, IF( sc.stream_id =  '1',  'STATE',  'ICSE' ) AS stream, sc.class_name FROM `".TABLE_CLASS."` sc INNER JOIN `".TABLE_SCHOOL."` ss ON sc.schl_id = ss.schl_id";
//    }
//    else
//    {
//        $sql = "SELECT sc.class_id, ss.school_code, IF( sc.stream_id =  '1',  'STATE',  'ICSE' ) AS stream, sc.class_name FROM `".TABLE_CLASS."` sc INNER JOIN `".TABLE_SCHOOL."` ss ON sc.schl_id = ss.schl_id WHERE sc.schl_id=".$_SESSION['SchoolCode'];
//    }
//    $result = mysql_query($sql);
//    $id = null;
//    $val = null;
//    $dsting = "{ ";
//    $i=0;
//   // $rows = array();
//    while($row = mysql_fetch_array($result))
//    {
//        $dsting .=   " '".$row[0]."' : '".$row[1]." - ".$row[2]." - ".$row[3]."',";
//    }
//
//    $dsting = rtrim($dsting,',')." }";
//print_r($row);
?>
<script type="text/javascript">

    $(document).ready(function () {

        //Prepare jTable
        $('#division').jtable({
            title: 'Division Listing',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'sl ASC',
            actions: {
                listAction: 'adminBusinessLogic/divisionListingData.php?action=list&role=<?php echo $_SESSION['Role']; ?>&schlid=<?php echo $_SESSION['SchoolCode'];?>',
                createAction: 'adminBusinessLogic/divisionListingData.php?action=create',
                updateAction: 'adminBusinessLogic/divisionListingData.php?action=update'
                //deleteAction: 'smsbl/divisionListingData.php?action=delete'
            },
            fields: {
                division_id: {
                    title: 'Key',
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                sl: {
                    title: 'Sl:No',
                    create: false,
                    edit: false,
                    list: true
                },

                division_name: {
                    title: 'Division Name',
                    width: '30%'

                }
            }

        });

        //Load person list from server
        $('#division').jtable('load');

    });

</script>
