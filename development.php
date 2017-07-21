<?php 






define("_VALID_PHP", true);
error_reporting(E_ALL);
ini_set('display_errors', 'OFF');
ini_set('log_errors', 'off');
include('wixzify/booster_inc.php');
$booster = new Booster();
require_once("dbcon/dbConfig.php");
require_once("dbcon/connection.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>GNR Schools Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $booster->css_source = array('../assets/css/bootstrap-responsive.css,../assets/css/bootstrap.min.css');
    $booster->debug = FALSE;
    $booster->librarydebug = FALSE;
    $booster->css_totalparts = 1;
    echo $booster->css_markup();
    ?>


    <!-- HTML5, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="login-body">

<?php
if (isset($_GET['error'])) {
    echo "<div class=\"alert alert-error alert-block\" style='width: 500px;text-align: center;margin: 0 auto;margin-bottom: 20px;'>
         <a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>
         <h4 class=\"alert-heading\"> Information!!!</h4>";
}
if ($_GET['error'] == 2)
    echo "<h6>Username, Password or School is Wrong</h6> Please try again with filling every field correctly</div>";
if ($_GET['error'] == "no_u")
    echo "<h6>Username is missing.</h6> Please try again with filling every field correctly</div>";
if ($_GET['error'] == "no_p")
    echo "<h6>Password is missing.</h6> Please try again with filling every field correctly</div>";
if ($_GET['error'] == "no_s")
    echo "<h6>School is missing.</h6> Please try again with filling every field correctly</div>";
?>
<div class="container">


    <form class="form-signin form-horizontal login-form-width" method="post" enctype="multipart/form-data"
          action="adminBusinessLogic/developmentLoginCheck.php">
        <div class="top-bar" style="background-color:#46d3ff; border-color:#CCCCCC; height:80px">
            <h3><span style="font-size:28px; color:#000;"><i class="icon-user" style="color:#FFFFFF"></i>GNR Administration <b>Portal</b></span>
            </h3>
        </div>
        <div class="well no-padding">

            <div class="control-group">
                <label class="control-label" for="inputName"><i class="icon-user"></i></label>

                <div class="controls">
                    <input type="text" id="username" name="username" placeholder="Username" style="width: 340px;">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputUsername"><i class="icon-key"></i></label>

                <div class="controls">
                    <input type="password" id="password" name="password" placeholder="Password" style="width: 340px;">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputName"><i class="icon-building"></i></label>

                <div class="controls">
                    <select style="width: 360px; color: #555555;" id="school" name="school">
                        <?php include_once('projectinc/schoolDropDownLogin.php'); ?>
                    </select>
                </div>
            </div>

            <div class="padding  login-float">
                <button class="btn btn-primary" type="submit">Sign in</button>
            </div>
        </div>
    </form>
</div>
</body>
<?php
//echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>   ';
$booster->js_minify = TRUE;
$booster->js_source = '../assets/js/jquery.min.js,../assets/js/bootstrap.min.js,../assets/js/bootstrap-typeahead.js,../assets/js/jquery.easing.min.js,../assets/js/jquery.chosen.min.js,../assets/js/wixzi-custom.js';
echo $booster->js_markup();
?>
</html>