<?php
/**
 * Created by Wixzi Solutions.
 * Project: Administration
 * User: Gautam
 * Date: 11/17/13
 * FileName: topBody.php
 */
echo '
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
		<div class="container">
		<a href="#">
					<button type="button" class="btn btn-navbar mobile-menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</a>
				<a class="brand" href="#"><i class="icon-user"></i>GNR Administration <b>Portal</b></a>
				<ul class="nav pull-right">';

if($_SESSION['IsDev']=="1")
    include_once('devUserProfile.php');
else
    include_once('userProfile.php');
echo '
</ul>
</div>
</div>
';
include_once('includes/breadcrub.php');
echo '
</div>';
?>