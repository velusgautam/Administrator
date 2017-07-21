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
			title:          '<i class="icon-file"></i> Admission Form Listing',
			paging:         true,
			pageSize:       10,
			sorting:        true,
			defaultSorting: 'sl ASC',
			actions:        {
				listAction:   'adminBusinessLogic/admissionListingData.php?action=list'
				<?php if ($_SESSION['Role'] == '1') { ?>,
				deleteAction: 'adminBusinessLogic/admissionListingData.php?action=delete'
				<?php } ?>
			},
			fields:         {
				id:             {
					title:  'Key',
					key:    true,
					create: false,
					edit:   false,
					list:   false
				},
				sl:             {
					title:  'Sl:No',
					create: false,
					edit:   false,
					list:   true,
					width:  '8%'
				},
				admission_date: {
					title: 'Admn Date',
					width: '12%'
				},
				academic_year:  {
					title:  'Academic Yr',
					create: false,
					edit:   false,
					list:   true,
					width:  '15%'
				},

				school_code:  {
					title:  'SchoolName',
					width:  '9%',
					create: false,
					edit:   true,
					list: <?php if($_SESSION['Role']=='1') {echo "true"; } else {echo "false";}?>,
					options: <?php echo $dsting; ?>

				},
				name:         {
					title: 'Name',
					width: '30%'
				},
				father_phone: {
					title:   'FatherNo',
					sorting: false,
					width:   '15%'
				},
				mother_phone: {
					title:   'MotherNo',
					sorting: false,
					width:   '15%'
				},
				edit:         {
					title:   'Edit',
					create:  false,
					edit:    false,
					sorting: false,
					display: function (data) {
						var $link = $('<a href="#"><img src="assets/img/edit.png"> </a>');
						$link.click(function () {
							window.parent.location.href = "admissionFormUpdate.php?id=" + data.record.id;
						});
						return $link;
					}
				}

			}



		});

		//Load person list from server
		$('#applicationTableContainer').jtable('load');

	});
</script>

