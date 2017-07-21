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
<script type="text/javascript">
    $(document).ready(function () {
        $('#classTableContainer').jtable({
            title: 'Class Listing',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'sl ASC',
            actions: {
                listAction: 'adminBusinessLogic/classListingData.php?action=list&role=<?php echo $_SESSION['Role']; ?>',
                createAction: 'adminBusinessLogic/classListingData.php?action=create',
                updateAction: 'adminBusinessLogic/classListingData.php?action=update'

            },

            fields: {
                class_id: {
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

                class_name: {
                    title: 'Class Name',
                    width: '30%'

                }
            }

        });

        //Load person list from server
        $('#classTableContainer').jtable('load');

    });
</script>

