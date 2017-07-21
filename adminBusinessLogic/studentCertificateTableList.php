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
<div id="studentTableContainer" style="width: 100%;"></div>
<?php
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_select_db(DB_DATABASE, $con);
if ($_SESSION['Role'] == '1') {
    $result = mysql_query("SELECT schl_id, school_code FROM `" . TABLE_SCHOOL . "`");
} else {
    $result = mysql_query("SELECT schl_id,school_code FROM `" . TABLE_SCHOOL . "` WHERE `schl_id`=" . $_SESSION['SchoolCode']);
}

$dsting = "{ ";
while ($row = mysql_fetch_array($result)) {
    $dsting .= " '" . $row[0] . "' : '" . $row[1] . "',";
}
$dsting = rtrim($dsting, ',') . " }";

$resultClass = mysql_query("SELECT class_id,class_name FROM `" . TABLE_CLASS . "`");
$dstingClass = "{ ";
while ($rowClass = mysql_fetch_array($resultClass)) {
    $dstingClass .= " '" . $rowClass[0] . "' : '" . $rowClass[1] . "',";
}
$dstingClass = rtrim($dstingClass, ',') . " }";

$resultDivision = mysql_query("SELECT division_id, division_name FROM `" . TABLE_DIVISION . "`");
$dstingDivision = "{ ";
while ($rowDivision = mysql_fetch_array($resultDivision)) {
    $dstingDivision .= " '" . $rowDivision[0] . "' : '" . $rowDivision[1] . "',";
}
$dstingDivision = rtrim($dstingDivision, ',') . " }";


?>
<script type="text/javascript">

    $(document).ready(function () {

        //Prepare jTable
        $('#studentTableContainer').jtable({
            title: '<i class="icon-certificate"></i> Student Certificate Listing',
            paging: true,
            pageSize: 15,
            sorting: true,
            defaultSorting: 'student_name ASC',
            actions: {
                listAction: 'adminBusinessLogic/studentListingData.php?action=list&role=<?php echo $_SESSION['Role']; ?>&schlid=<?php echo $_SESSION['SchoolCode'];?>',

            },



            fields: {
                student_id: {
                    title: 'Key',
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                sl: {
                    title: 'Sl:No',
                    create: false,
                    width: '5%',
                    edit: false,
                    list: true
                },

                student_name: {
                    title: 'Name',
                    width: '15%',
                    inputClass: 'validate[required]'
                },
	            academic_year: {
		            title: 'AcademicYear',
		            width: '10%'

	            },
                schl_id: {
                    title: 'SchoolName',
                    width: '10%',
                    create: false,
                    edit: true,
                    list: <?php if($_SESSION['Role']=='1') {echo "true"; } else {echo "false";}?>,
                    options: <?php echo $dsting; ?>

                },
                stream_id: {
                    title: 'Stream',
                    width: '8%',
                    create: false,
                    edit: true,
                    list: true,
                    options: { '1': 'STATE', '2': 'ICSE' }

                },
                class_id: {
                    title: 'Class',
                    width: '10%',
                    create: true,
                    edit: true,
                    list: true,
                    options: <?php echo $dstingClass; ?>

                },
                division_id: {
                    title: 'Division',
                    width: '8%',
                    create: true,
                    edit: true,
                    list: true,
                    options: <?php echo $dstingDivision; ?>

                },
                transfer: {
                    title: 'Generate TC',
                    create: false,
                    edit: false,
                    sorting:false,
                    display: function (data) {
                        var $link = $('<a href="#"><button>Generate TC</button></a>');
                        $link.click(function(){
                            window.parent.location.href = "generateTc.php?id=" + data.record.student_id;
                        });
                        return $link;
                    }
                },
                school_certificate: {
                    title: 'Study Certificate',
                    create: false,
                    edit: false,
                    sorting:false,
                    display: function (data) {
                        var $link = $('<a href="#"><button>Study Certificate</button></a>');
                        $link.click(function(){
                            window.parent.location.href = "generateSchoolCertificate.php?id=" + data.record.student_id;
                        });
                        return $link;
                    }
                }

            },
            formCreated: function (event, data) {
                data.form.validationEngine();
            },
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            }

        });

        //Load person list from server
        $('#studentTableContainer').jtable('load');


        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#studentTableContainer').jtable('load', {
	            student_name: $('#name').val(),
	            class_id: $('#classData').val(),
	            academic_year: $('#academicYear').val()
            });
        });

        //Load all records when page is first shown
        $('#LoadRecordsButton').click();


    });

</script>
