<?php
$booster->css_source = array('../assets/css/jtable.css,../assets/css/jquery-ui.css');
$booster->debug = FALSE;
$booster->librarydebug = FALSE;
$booster->css_totalparts = 1;
echo $booster->css_markup();

$booster->js_minify = TRUE;
$booster->js_source = '../assets/js/jquery-ui-1.10.0.min.js,../assets/js/jquerySchool.jtable.js';
echo $booster->js_markup();
?>

<div id="classTableContainer" style="width: 100%;"></div>
<?php
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_select_db(DB_DATABASE, $con);
$result = mysql_query("SELECT schl_id,school_code FROM `" . TABLE_SCHOOL . "`");
$id = null;
$val = null;
$dsting = "{ ";
$i = 0;
// $rows = array();
while ($row = mysql_fetch_array($result)) {
    $dsting .= " '" . $row[0] . "' : '" . $row[1] . "',";
}
$dsting .= "'-1':'All Schools',";
$dsting = rtrim($dsting, ',') . " }";


//print_r($row);
?>
<script type="text/javascript">

    $(document).ready(function () {

        //Prepare jTable
        $('#classTableContainer').jtable({
            title: 'Staff Listing',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'sl ASC',
            actions: {
                listAction: 'adminBusinessLogic/staffListingData.php?action=list',
                createAction: 'adminBusinessLogic/staffListingData.php?action=create',
                updateAction: 'adminBusinessLogic/staffListingData.php?action=update',
                deleteAction: 'adminBusinessLogic/staffListingData.php?action=delete'
            },

            fields: {
                uid: {
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

                name: {
                    title: 'Name',
                    width: '30%'

                },

                username: {
                    title: 'Username',
                    create: true,
                    edit: true,
                    list: true


                },
                pass: {
                    title: 'Password',
                    type: 'password',
                    create: true,
                    edit: true,
                    list: false


                },
                schl_id: {
                    title: 'School Name',
                    create: true,
                    edit: true,
                    list: true,
                    options: <?php echo $dsting; ?>

                },

                role_id: {
                    title: 'Role',
                    width: '10%',
                    create: true,
                    edit: true,
                    list: true,
                    options: {  '2': 'Staff', '1':'Administrator' }

                },

                phone_number: {
                    title: 'Phone Number',
                    width: '10%',
                    create: true,
                    edit: true,
                    list: true


                }
            }

        });

        //Load person list from server
        $('#classTableContainer').jtable('load');
    });

</script>

