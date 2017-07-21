<?php
	if ($surl == "dashboard.php") {

		$booster->js_minify = true;
		$booster->js_source = '../assets/js/jquery.hotkeys.js';
		echo $booster->js_markup();
		?>
		<script type="text/javascript">
			$("[rel='tooltip']").tooltip();

			$("[rel='tooltip']").each(function (index) {
				$(this).data('tooltip').options.placement = 'bottom';
			});
		</script>
	<?php
	}

	if ($surl == "studentRegistration.php" || $surl == "studentUpdate.php") {
		$booster->js_minify = true;
		$booster->js_source = '../assets/js/jquery.easing.min.js';
		echo $booster->js_markup();
		?>

	<?php

	}

	if ($surl == "adminPanel.php" || $surl == "smsStatus.php" || $surl == "studentChangeListing.php") {
		$booster->js_minify = true;
		$booster->js_source = '../assets/js/jquery-ui-1.10.2.custom.min.js,../assets/js/jquery.pajinate.js,../assets/js/jquery.dataTables.min.js';
		echo $booster->js_markup();
	}

	$booster->js_minify = true;
	$booster->js_source = '../assets/js/bootstrap-typeahead.js';
	echo $booster->js_markup();

	if ($surl == "feePayment.php") {
		$booster->js_minify = true;
		$booster->js_source = '../assets/js/jquery.multiselect.js';
		echo $booster->js_markup();

	}
	if ($surl == "studentListing.php" || $surl == "inactiveStudentListing.php") {
		?>
		<script type="text/javascript">
			$(function () {
				$("#name").focus();
			});
		</script>
	<?php

	}

if ($surl == "developmentFeeReport.php")
{
    echo "<script type=\"text/javascript\" src=\"//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js\" ></script>


    <script type=\"text/javascript\">
    $(document).ready(function(){
    var table = $('#reportTable').DataTable({
    'deferRender': true
    });
    table.draw();
    $( '#academicYear' ).change(function() {
    	table.draw();
    });
    $( '#school' ).change(function() {
    	table.draw();
    });
    $( '#month' ).change(function() {
    	table.draw();
    });
});
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
       var academicYear = $('#academicYear option:selected').text();
       var academicYearData = data[5];
       
       var school = $('#school option:selected').text();
       var schoolData = data[3];
       
       var month = $('#month option:selected').text();
       var monthData = data[1];
       
       
      
       if(school !== 'Select' && month !== 'All'){
        if (academicYear.trim() ==  academicYearData.trim() && school.trim() == schoolData.trim() && month.trim() == monthData.trim())
        {
            return true;
        }
        else{
          return false;
        }

       }
       else if(school !== 'Select' && month == 'All'){
        if (academicYear.trim() ==  academicYearData.trim() && school.trim() == schoolData.trim())
        {
            return true;
        }
        else{
          return false;
        }

       }
       else if(school == 'Select' && month !== 'All'){
        if (academicYear.trim() ==  academicYearData.trim() && month.trim() == monthData.trim())
        {
            return true;
        }
        else{
          return false;
        }

       }
       else if (academicYear.trim() ==  academicYearData.trim())
       {
            return true;
       }
       else {
        return false;
       }
    }
);
</script>
    ";
}
?>
