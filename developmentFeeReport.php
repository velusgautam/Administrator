<?php
include_once('adminBusinessLogic/security.php');
include_once('includes/headerPhp.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
require_once("includes/headerMeta.php");
require_once("includes/headerStyles.php");
require_once("includes/headerScripts.php");
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#searchBtn').click('change', function () {
                    $("#data").html('');
                    $("#searchBtn").css("display", "none");
                    $("#loading").css("display", "");
                    $("#loading").html('<img src="assets/img/loader.gif" alt="Searching...."/>');

                    $("#search").ajaxForm({
                        target: '#data',
                        success: function (html) {
                            $("#loading").css("display", "none");
                            $("#searchBtn").css("display", "");
                        }
                    }).submit();
                });
				$('#ExcelBtn').click('change', function () {
                    $("#search").ajaxForm({
	                    url: 'adminBusinessLogic/excelDevFeeReport.php',
                        success: function (html) {
                            $("#loading1").css("display", "none");
                            $("#ExcelBtn").css("display", "");
                        }
                    }).submit();


                });

            });
        </script>

    </head>

    <body class="inside-body">
        <body class="inside-body">
            <?php include_once('includes/topBody.php'); ?>
            <div class="container">
                <?php include_once('includes/developmentMenu.php'); ?>                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="span 12 padding well">
                            <form id="search" method="post" class="form-horizontal" enctype="multipart/form-data" action="adminBusinessLogic/developmentFeesSearchList.php">
                                <?php
						        $width = "18%";
                                if($_SESSION['Role'] == "1")
                                {
                                    $admin = true;
                                    $width = "14%";
                                }
                                ?>
                                <table style="width: 100%" >
                                    <tr>
                                        <?php if($admin) echo "<td style='width: $width'>School</td>"; ?>
                                        <td style="width:10%">AcademicYear</td>
	                                    <td style="width:12%">Month</td>
                                        <td style="width:6%">Search</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" value="Excel Export" name="excel">
                                        <?php if($admin) {echo '
                                        <td>
                                            <select name="school" id="school" style="width: 140px">';
                                        include('projectinc/schlDDMsg.php');
                                        echo'</select>
                                        <span id="wait_1" class="help-inline" style="display: none;"><img alt="Please Wait" src="assets/img/ajax-loader.gif"/></span>
                                        </td> ';
                                        }
                                        ?>
                                        <td id="result_8" >
                                            <select name="academicYear" id="academicYear" style="width: 140px">
	                                            <option
                                                        value="2013-2014" <?php echo (((date("n") < 5) && (date("Y") == 2014)) || ((date("n") >= 5) && (date("Y") == 2013))) ? "selected" : ""; ?>>
                                                    2013-2014
                                                </option>
                                                <option
                                                        value="2014-2015" <?php echo (((date("n") < 5) && (date("Y") == 2015)) || ((date("n") >= 5) && (date("Y") == 2014))) ? "selected" : ""; ?>>
                                                    2014-2015
                                                </option>
                                                <option
                                                        value="2015-2016" <?php echo (((date("n") < 5) && (date("Y") == 2016)) || ((date("n") >= 5) && (date("Y") == 2015))) ? "selected" : ""; ?>>
                                                    2015-2016
                                                </option>
                                                <option
                                                        value="2016-2017" <?php echo (((date("n") < 5) && (date("Y") == 2017)) || ((date("n") >= 5) && (date("Y") == 2016))) ? "selected" : ""; ?>>
                                                    2016-2017
                                                </option>
                                                <option
                                                        value="2017-2018" <?php echo (((date("n") < 5) && (date("Y") == 2018)) || ((date("n") >= 5) && (date("Y") == 2017))) ? "selected" : ""; ?>>
                                                    2017-2018
                                                </option>
                                                <option
                                                        value="2018-2019" <?php echo (((date("n") < 5) && (date("Y") == 2019)) || ((date("n") >= 5) && (date("Y") == 2018))) ? "selected" : ""; ?>>
                                                    2018-2019
                                                </option>
                                                <option
                                                        value="2019-2020" <?php echo (((date("n") < 5) && (date("Y") == 2020)) || ((date("n") >= 5) && (date("Y") == 2019))) ? "selected" : ""; ?>>
                                                    2019-2020
                                                </option>

                                            </select>
                                        </td>
                                        <td id="result_6">
                                            <select name="status" id="status" style="width: 140px">
                                                <option value="All" selected>All</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                                <option value="1">January</option>
                                                <option value="2">Februvary</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                            </select>
                                        </td>

                                        <td >
                                            <button style="padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px" name="search" id="searchBtn" type="button" class="btn btn-primary btn-large">Search</button>
                                            <div id='loading'></div>
                                        </td>
	                                    <td >
		                                    <button style="padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px" name="ExcelBtn" id="ExcelBtn" type="button" class="btn btn-primary btn-large">Excel Export</button>
		                                    <div id='loading1'></div>
	                                    </td>
                                    </tr>
                                </table>

                            </form>

                        </div>
                    </div>

                        <div class="row-fluid">

                            <div class="top-bar">
                                <h3><i class="icon-eye-open"></i> Student Details</h3>
                            </div>

                            <div class="well no-padding" id="data">

                                <table class="data-table">
                                    <thead>
                                        <tr >

                                            <th>Sl No</th>
                                            <th>Month</th>
                                            <th>StudentName</th>
                                            <th>School</th>
                                           
                                            <th>Class</th>
                                            
                                            <th>AcademicYear</th>
                                            <th>Development Fees</th>
                                            <th>Waived Off</th>
                                            <th>Balance</th>
                                            <th>Add On</th>
                                            <th class="center">Status</th>

                                        </tr>
                                    </thead>
                                    <tbody >



                                    </tbody>
                                    <tfoot>
                                        <tr>

                                            <th style="padding-left: 20px">Sl No</th>
                                            <th>Month</th>
                                            <th>StudentName</th>
                                            <th>School</th>
                                           
                                            <th>Class</th>
                                           
                                            <th>AcademicYear</th>
                                            <th>Development Fees</th>
                                             <th>Waived Off</th>
                                            <th>Balance</th>
                                            <th>Add On </th>
                                            <th class="center" style="padding-right: 20px">Status</th>

                                        </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>




                </div>
            </div>

            <?php include('includes/footer.php'); ?>


        </body>
        <?php include_once('includes/footerJavascript.php'); ?>
        </html>