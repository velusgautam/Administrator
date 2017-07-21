<?php
    $booster->css_source = array('../assets/css/bootstrap.min.css,../assets/css/bootstrap-responsive.css');
    $booster->debug = FALSE;
    $booster->librarydebug = FALSE;
    $booster->css_totalparts = 1;
    echo $booster->css_markup();

if ($surl == "applicationForm.php" || $surl == "admissionForm.php" || $surl == "admissionFormUpdate.php" || $surl == "applicationFormUpdate.php" ||$surl == "studentRegistration.php" || $surl == "scheduleMessage.php" || $surl ==
    "studentUpdate.php" || $surl == "feePayment.php" || $surl == "developmentFeePayment.php"|| $surl == "developmentFeeAdvancePayment.php"|| $surl == "developmentPartFeePayment.php" || $surl == "generateTc.php" || $surl == "generateSchoolCertificate.php") {
    $booster->css_source = array('../assets/css/jquery-ui.css');
    $booster->debug = FALSE;
    $booster->librarydebug = FALSE;
    $booster->css_totalparts = 1;
    echo $booster->css_markup();

}
if ($surl == "feePayment.php")
{
    $booster->css_source = array('../assets/css/jquery.multiselect.css');
    $booster->debug = FALSE;
    $booster->librarydebug = FALSE;
    $booster->css_totalparts = 1;
    echo $booster->css_markup();
}
if ($surl == "developmentFeeReport.php")
{
echo '<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">';
}