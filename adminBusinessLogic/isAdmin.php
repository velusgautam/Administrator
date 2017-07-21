<?php
if ($_SESSION['Role'] != "1") {
    redirect_to("dashboard.php");
    exit;
}
