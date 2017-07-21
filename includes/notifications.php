<?php
echo '
<!-- User Navigation: Notifications -->
					<li class="dropdown">
';
if ($_SESSION['Role'] == "1") {
    //$sqlCount = "Select Count(*) as Count FROM ".TABLE_APPROVAL." WHERE is_approved = '0'";
    //$sql = "Select ts.school_code, ta.phone_numbers as numbers, ta.initiated_by as user, ta.date FROM ".TABLE_APPROVAL." ta JOIN ".TABLE_SCHOOL." ts ON ts.schl_id = ta.schl_id WHERE ta.is_approved = '0' ORDER BY ta.approval_id DESC LIMIT 0, 5";
} else {
    // $sqlCount = "Select Count(*) as Count FROM ".TABLE_APPROVAL." WHERE is_approved = '0' AND schl_id = '".trim($_SESSION['SchoolCode'])."'";
    // $sql = "Select Count(*) as Count FROM ".TABLE_APPROVAL." WHERE is_approved = '0' AND schl_id = '".trim($_SESSION['SchoolCode'])."'";
}
//$result = $db->query_first($sqlCount);

echo '

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-align-justify icon-white"></i>
							<span class="hidden-phone"> Notification </span>
							<span class="badge badge-inverse">' . $result['Count'] . '</span>
						</a>
						<ul class="dropdown-menu widget">
						<li>
								<h2><i class="icon-align-justify"></i> Approval\'s Pending
								<span class="badge badge-light small">' . $result['Count'] . '</span></h2>

							</li>';

$row = $db->query($sql);
while ($data = $db->fetch_array($row)) {
    $tagArray = explode(",", $data['numbers']);
    $_smsCount = count($tagArray);
    echo '<li>
								<a href="#" class="note">
									<small>' . date("Y-m-d", strtotime($data['date'])) . '</small>
									<p><i class="icon-envelope"></i> <b>' . $_smsCount . '</b> SMS send by ' . ucfirst($data['user']) . ' of ' . $data['school_code'] . '.</p>
								</a>
							</li>';
}


if ($_SESSION['Role'] == "1") {
    echo '<li><a href="adminPanel.php" class="text-center"><i class="icon-inbox"></i> View All Notifications</a></li>';
}


echo '</ul>
                        </li>';
?>