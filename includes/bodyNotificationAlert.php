<?php
$_SESSION['pageviews'] = ($_SESSION['pageviews']) ? $_SESSION['pageviews'] + 1 : 1;
if ($_SESSION['pageviews'] == 1) {
    ?>
    <div class="alert alert-light">
        <a class="close" data-dismiss="alert">&times;</a>
        <i class="icon-comment"></i> Welcome back, <b><?php echo ucfirst($_SESSION['UserName']); ?> </b>. We have missed
        you!
    </div>

<?php
}
?>