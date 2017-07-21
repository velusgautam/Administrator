<?php
$booster->css_source = array('../assets/css/jtable.css,../assets/css/jquery-ui.css');
$booster->debug = FALSE;
$booster->librarydebug = FALSE;
$booster->css_totalparts = 1;
echo $booster->css_markup();

$booster->js_minify = TRUE;
$booster->js_source = '../assets/js/jquery-ui-1.10.0.min.js,../assets/js/jquerySchool.jtableOptimized.js';
echo $booster->js_markup();

?>
<div id="PeopleTableContainer" style="width: 100%;"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#PeopleTableContainer').jtable({
            title: 'School Listing',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'school_name ASC',
            actions: {
                listAction: 'adminBusinessLogic/schoolListingData.php?action=list',
                createAction: 'adminBusinessLogic/schoolListingData.php?action=create',
                updateAction: 'adminBusinessLogic/schoolListingData.php?action=update'
//					deleteAction: 'smsbl/schoolListingData.php?action=delete'
            },
            fields: {
                schl_id: {
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
                school_code: {
                    title: 'School Code',
                    width: '20%',
                    inputClass: 'validate[required]'
                },
                school_name: {
                    title: 'School Name',
                    width: '30%',
                    inputClass: 'validate[required]'
                },
                school_address: {
                    title: 'School Address',
                    width: '40%',
                    type: 'textarea'
                }
            }
        });
        $('#PeopleTableContainer').jtable('load');
    });
</script>
 

