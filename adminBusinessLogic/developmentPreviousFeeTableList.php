<?php
	$booster->css_source = array('../assets/css/jtable.css,../assets/css/jquery-ui.css');
	$booster->debug = false;
	$booster->librarydebug = false;
	$booster->css_totalparts = 1;
	echo $booster->css_markup();

	$booster->js_minify = true;
	$booster->js_source = '../assets/js/jquery-ui-1.10.0.min.js,../assets/js/jquerySchool.jtable.js';
	echo $booster->js_markup();

	if(intval($_GET['id'])>0)
	{
		$status = $db->query_first("Select payment_status from ".TABLE_STUDENT_DEVELOPMENT_FEE." where student_id=".intval($_GET['id'])." ORDER BY id DESC");
        $academicYr = $db->query_first("Select academic_year from ".TABLE_STUDENT." where student_id=".intval($_GET['id']));
	}

?>
<div id="previousFeeTableContainer" style="width: 100%;"></div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#previousFeeTableContainer').jtable({
			title:          'Development Previous Fee Listing',
			paging:         true,
			pageSize:       10,
			sorting:        true,
			defaultSorting: 'sl ASC',
			actions:        {
			    <?php if($status['payment_status']==1 || $status['payment_status']==2)
			    {?>
				listAction:'adminBusinessLogic/developmentPreviousPartFeeListingData.php?action=list&studid=<?php echo $_GET['id']; ?>&ay=<?php echo $academicYr['academic_year'];?>'
			   <?php } else { ?>
				listAction:'adminBusinessLogic/developmentPreviousFeeListingData.php?action=list&studid=<?php echo $_GET['id']; ?>&ay=<?php echo $academicYr['academic_year'];?>'
				<?php } ?>
				<?php if ($_SESSION['Role'] == '1') { ?>
				, deleteAction: 'adminBusinessLogic/developmentPreviousFeeListingData.php?action=delete'
				<?php } ?>
			},

			fields: {
				<?php if($status['payment_status']==1)
				{?>
				part_id:            {
					title:  'Key',
					key:    true,
					create: false,
					edit:   false,
					list:   false
				},
				id:            {
					title:  'pkey',
					create: false,
					edit:   false,
					list:   false
				},
				<?php } else { ?>
				id:            {
					title:  'Key',
					key:    true,
					create: false,
					edit:   false,
					list:   false
				},
				<?php } ?>
				sl:            {
					title:  'Sl:No',
					create: false,
					edit:   false,
					list:   true,
					width:  '1%'
				},
				student_name:  {
					title: 'Student Name'
				},
				academic_year: {
					title: 'Academic Year'
				},
				date:          {
					title: 'Date'
				},
				payment_type:  {
					title: 'Type'
				},
				cheque_no:  {
					title: 'CHQ NO'
				},
				cheque_date:  {
					title: 'CHQ Date'
				},
				cheque_bank:  {
					title: 'CHQ Bank'
				},
                development_fees:
                {
                    title: 'Devlp Fees'
                },
                waive_off:  {
                    title: 'Waived Off'
                },
				<?php if($status['payment_status']==1 || $status['payment_status']==2)
			{?>
				payment_now:         {
					title: 'Payment'
				},
				<?php } else { ?>
				total:         {
					title: 'Payment'
				},
				<?php } ?>

				<?php if($status['payment_status']==1 || $status['payment_status']==2)
				{?>
				print:         {
					title:   'Print',
					create:  false,
					width:   '8%',
					edit:    false,
					sorting: false,
					display: function (data) {
						var $link = $('<a href="#"><button >Print Receipt</button></a>');
						$link.click(function () {
							window.parent.location.href = "developmentFeesReceipt.php?id=" + data.record.id+"&partId=" + data.record.part_id;
						});
						return $link;
					}
				}
				<?php } else { ?>
				print:         {
					title:   'Print',
					create:  false,
					width:   '8%',
					edit:    false,
					sorting: false,
					display: function (data) {
						var $link = $('<a href="#"><button >Print Receipt</button></a>');
						$link.click(function () {
							window.parent.location.href = "developmentFeesReceipt.php?id=" + data.record.id;
						});
						return $link;
					}
				}
				<?php } ?>
			}

		});

		//Load person list from server
		$('#previousFeeTableContainer').jtable('load');

	});
</script>

