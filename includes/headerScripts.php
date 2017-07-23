<?php
$booster->js_minify = true;
$booster->js_source = '../assets/js/jquery.min.js,../assets/js/jquery.jpanelmenu.min.js,../assets/js/bootstrap.min.js';
echo $booster->js_markup();
?>
    <?php
if ($surl == "reportBalanceSchoolFees.php" || $surl == "studentAfterTCListing.php" || $surl == "studentArchiveListing.php" || $surl == "studentPromotion.php" || $surl == "applicationFeeSetting.php" || $surl == "applicationReceipt.php" || $surl == "admissionFormUpdate.php" || $surl == "applicationForm.php" || $surl ==
    "admissionForm.php" || $surl == "studentListing.php" || $surl ==
    "feePayment.php" || $surl == "generateTc.php" || $surl == "applicationFormUpdate.php" || $surl == "studentRegistration.php" || $surl == "staffRegistration.php" || $surl == "studentChangeListing.php" || $surl == "studentUpdate.php"
) {

    $booster->js_minify = true;
    $booster->js_source = '../assets/js/jquery.form.js,../assets/js/jquery.cookie.js';
    echo $booster->js_markup();
}
if ($surl == "reportSchoolFees.php" || $surl == "developmentFeeReport.php") {
    $booster->js_minify = true;
    $booster->js_source = '../assets/js/jquery.form.js';
    echo $booster->js_markup();
}
if ($surl == "applicationForm.php" || $surl == "admissionForm.php" || $surl == "admissionFormUpdate.php" || $surl == "generateTc.php" || $surl == "generateSchoolCertificate.php" || $surl == "developmentFeeAdvancePayment.php"|| $surl == "developmentFeePayment.php" || $surl ==
    "applicationFormUpdate.php" || $surl == "studentUpdate.php" || $surl == "feePayment.php" || $surl == "developmentPartFeePayment.php"
) {
    $booster->js_minify = true;
    $booster->js_source = '../assets/js/jquery-ui.js';
    echo $booster->js_markup();

    echo '<script>
		$(function() {
			$( ".datepicker" ).datepicker({ changeYear:true, changeMonth:true, showMonthAfterYear:true, yearRange:\'1988:2020\', dateFormat: \'dd-mm-yy\' });

		});
	</script>';

}
if ($surl == "applicationListing.php" || $surl == "schoolFeeMapping.php" || $surl == "schoolClassMapping.php" || $surl == "feePayment.php" || $surl == "developmentPartFeePayment.php" || $surl == "developmentFeePayment.php" || $surl ==
    "generateSchoolCertificate.php" || $surl ==
    "generateTc.php"
) {
    $booster->js_minify = true;
    $booster->js_source = '../assets/js/livevalidation_standalone.compressed.js';
    echo $booster->js_markup();
}


if ($surl == "studentListing.php") {
    echo "
	<script type=\"text/javascript\">
	$(document).ready(function() {
		$('#excelexport').click(function(){

		$('#excel-popup').modal('show');

		});
		});
	</script>";
}
if ($surl == "studentAfterTCListing.php" || $surl == "studentArchiveListing.php" || $surl == "studentPromotion.php" || $surl == "reportSchoolFees.php" || $surl == "reportBalanceSchoolFees.php") {

    echo "
	<script type=\"text/javascript\">

	var info;
	$(document).ready(function() {
	$('#wait_1').hide();
	$('#school').change(function(){
	  $('#wait_1').show();

      $.get(\"projectinc/studentChangeDD.php\", {
		func: \"streamSelect\",
		schl_id: $('#school').val()
      }, function(response){
        $('#result_1').fadeOut();
        setTimeout(\"finishAjax('result_1', '\"+escape(response)+\"')\", 1);
      });
    	return false;
	});
});



function finishAjax(id, response) {
  $('#wait_1').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}
function finishAjax_stream(id, response) {
  $('#wait_1').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}
function finishAjax_class(id, response) {
  $('#wait_2').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}
function finishAjax_division(id, response) {
  $('#wait_3').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}

</script>";

}

?>