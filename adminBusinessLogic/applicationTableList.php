<?php
	$booster->css_source = array('../assets/css/jtable.css,../assets/css/jquery-ui.css');
	$booster->debug = false;
	$booster->librarydebug = false;
	$booster->css_totalparts = 1;
	echo $booster->css_markup();

	$booster->js_minify = true;
	$booster->js_source = '../assets/js/jquery-ui-1.10.0.min.js,../assets/js/jquerySchool.jtable.js';
	echo $booster->js_markup();

	error_reporting(0);
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	if ($_SESSION['Role'] == '1') {
		$result = $db->query("SELECT schl_id,school_code FROM `" . TABLE_SCHOOL . "`");
	} else {
		$result = $db->query("SELECT schl_id,school_code FROM `" . TABLE_SCHOOL . "` WHERE `schl_id`=" . $_SESSION['SchoolCode']);
	}

	$dsting = "{ ";
	while ($row = $db->fetch_array($result)) {

		$dsting .= " '" . $row['schl_id'] . "' : '" . $row['school_code'] . "',";
	}
	$dsting = rtrim($dsting, ',') . " }";


?>
<div id="applicationTableContainer" style="width: 100%;"></div>
<script type="text/javascript">
	$(document).ready(function () {


		$('#applicationTableContainer').jtable({
			title:          '<i class="icon-file"></i> Application Form Listing',
			paging:         true,
			pageSize:       10,
			sorting:        true,
			defaultSorting: 'sl ASC',
			actions:        {
				listAction:   'adminBusinessLogic/applicationListingData.php?action=list'
				<?php if ($_SESSION['Role'] == '1') { ?>,
				deleteAction: 'adminBusinessLogic/applicationListingData.php?action=delete'
				<?php } ?>
			},
			toolbar:        {
				items: [
					{
						tooltip: 'Click Register Application Form',
						icon:    'assets/img/add.png',
						text:    'Add New Application',
						click:   function () {
							window.parent.location.href = "applicationForm.php";
						}
					}
				]
			},
			fields:         {

				sl:               {
					title:  'Sl:No',
					create: false,
					edit:   false,
					list:   true,
					width:  '4.3%'
				},
				application_no:   {
					title:  'Applctn No',
					key:    true,
					create: false,
					edit:   false,
					list:   false
				},
				form_no:   {
					title:  'Applctn No',
					create: false,
					edit:   false,
					list:   true
				},
				application_date: { title: 'Date',
					width:                 '8.7%'
				},
				name:             {
					title: 'Name',
					width: '14%'
				},
				academic_year:    {
					title:  'Academic Yr',
					create: false,
					edit:   false,
					list:   true,
					width:  '9%'
				},
				school_code:      {
					title:  'SchoolName',
					width:  '9%',
					create: false,
					edit:   true,
					list: <?php if($_SESSION['Role']=='1') {echo "true"; } else {echo "false";}?>,
					options: <?php echo $dsting; ?>

				},
				contact_name:     {
					title: 'Contact Name',
					width: '12%'
				},
				mobile_no:        {
					title:   'Contact Number',
					sorting: false,
					width:   '12%'
				},
				register:         {
					title:   'Register',
					create:  false,
					edit:    false,
					sorting: false,
					width:   '13%',

					display: function (data) {

						var $link = $('<a href="#"><button class="btn-info">New Admission</button></a>');
						$link.click(function () {
							window.parent.location.href = "studentRegistration.php?id=" + data.record.application_no;
						});
						return $link;
							}

				},
				print:            {
					title:   'Print',
					width:   '4.7%',
					create:  false,
					edit:    false,
					sorting: false,
					display: function (data) {
						var $link = $('<a href="#"><img src="assets/img/print.png" alt="Print Previous Receipt"> </a>');
						$link.click(function () {
							window.parent.location.href = "applicationReceipt.php?id=" + data.record.application_no;
						});
						return $link;
					}
				}

			}



		});

		//Load person list from server
		$('#applicationTableContainer').jtable('load');

		$('#LoadRecordsButton').click(function (e) {
			e.preventDefault();
			$('#applicationTableContainer').jtable('load', {
				name: $('#name').val(),
				form_no: $('#application_no').val()
			});
		});

		//Load all records when page is first shown
		$('#LoadRecordsButton').click();

	});
</script>

