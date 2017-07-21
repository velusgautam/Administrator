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
<div id="feeTableContainer" style="width: 100%;"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#feeTableContainer').jtable({
            title: 'Fee Listing',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'sl ASC',
            actions: {
                listAction: 'adminBusinessLogic/feeListingData.php?action=list&role=<?php echo $_SESSION['Role']; ?>',
                createAction: 'adminBusinessLogic/feeListingData.php?action=create',
                updateAction: 'adminBusinessLogic/feeListingData.php?action=update'
	            <?php if($_SESSION['Role'] == '1') { ?>
	            ,deleteAction: 'adminBusinessLogic/feeListingData.php?action=delete'
	            <?php } ?>

            },

            fields: {
                fee_id: {
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

                fee_name: {
                    title: 'Fee Name',
                    width: '30%'

                }
            }

        });

        //Load person list from server
        $('#feeTableContainer').jtable('load');

    });
</script>

